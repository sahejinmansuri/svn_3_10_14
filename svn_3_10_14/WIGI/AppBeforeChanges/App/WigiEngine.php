<?php

class App_WigiEngine  {



  public function generateWigiCode($i=0) { 
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand( $seed );    
    $randval = mt_rand(1000000,9999999);
    return $randval;
  
  }

  public function generateChecksum($code) {
    $sum = (7*$code) % 100;
    if ($sum < 10) $sum = 0 . $sum;
    return $sum;
  }

  public function isRedeemed($code,$mobileid) {
	$sp  = new App_Db_Sp_IsRedeemed();
	$res = $sp->getSimpleResponse(array('CODE' => $code, 'MOBILEID' => $mobileid));
	return $res['@res'];
  }

  public function codeExists($code,$mobileid) {
    	$sp  = new App_Db_Sp_WigiExists();
	$res = $sp->getSimpleResponse(array('CODE' => $code, 'MOBILEID' => $mobileid));
	return $res['@p_res'];
  }

  public function isExpired($code,$mobileid) {
    	$sp  = new App_Db_Sp_IsExpired();
	$res = $sp->getSimpleResponse(array('CODE' => $code,'MOBILEID' => $mobileid));
	return $res['@p_res'];
  }

  public function checkActiveUser($userid) {
      $u = new App_User($userid);
      if (!$u->isActive()) {
        throw new App_Exception_WsException("Account must be active");
        return false;
      }
  }

  public function checkActiveCellphone($mobileid) {
      $c = new App_Cellphone($mobileid);
      $message = "Cellphone is not active at this time";
      if ($c->getMobileType() === "virtualpos") { $message = "Merchant is not active at this time";  }
      if (!$c->isActive()) {
        throw new App_Exception_WsException($message);
        return false;
      }
  }

  public function createTransaction($extinfo,$mobileid,$amount,$minutes,$timezone,$logging = true) {

    $c = new App_Cellphone($mobileid,null);
    $u = new App_User($c->getUserId());

    $code = "";
 
    //lock table
  

    if ($amount == 0) {
      throw new App_Exception_WsException('Amount must be greater than $0.00');
      return false;
    }
 
    //check to see if they have enough money for the transaction
    
    if (!$c->hasEnoughMoney($amount)) {
      error_log("AMOUNT: " . $amount . " AVAILABLE: " . $c->getTempBalance());
      throw new App_Exception_WsException('Insufficient Funds');
      return false;
    }

    do {
      $code = $this->generateWigiCode();
    } while ($this->codeExists($code,$mobileid));
    
    $csum = $this->generateChecksum($code);

    $fullcode = $code . $csum;

    //$expires = strtotime("+" . $minutes . " minutes");
    //$expires = date("Y-m-d H:i:s",$expires);
    $expdate = new Zend_Date();
    $expdate->add($minutes,Zend_Date::MINUTE);

    $sp  = new App_Db_Sp_WigiCreate();
$inputspwigicreate = array('MOBILEID' => $mobileid,'AMOUNT' => $amount,'CODE' => $fullcode,'EXPIRES' => $expdate->get(Zend_Date::ISO_8601));
    $result = $sp->getSimpleResponse($inputspwigicreate);

/*

$con = mysql_connect("localhost","root","InCashMe@123?");
$db = mysql_select_db("incashme_dev_log",$con);
$query = "INSERT INTO wigi_code (`wigi_code_id`,`amount`,`from_mobile_id`,`date_expires`,`date_added`) VALUES ('".$fullcode."','".$amount."','".$mobileid."','".$expdate->get(Zend_Date::ISO_8601)."',now())";
mysql_query($query);
$query2 = "select date_added as @p_date_added, date_expires as @p_date_expires from wigi_code where wigi_code_id = '".$fullcode."'";
$rrr = mysql_query($query2);
@$result = mysql_fetch_assoc($rrr);
mysql_close($con);
*/
    $ac = str_split($fullcode);

    $return = array();
    $return['date_added']    = App_DataUtils::datetime_fmtdate($result['@p_date_added'],$timezone);
    $return['time_added']    = App_DataUtils::datetime_fmttime($result['@p_date_added'],$timezone);
    $return['date_expires']  = App_DataUtils::datetime_fmtdate($result['@p_date_expires'],$timezone);
    $return['time_expires']  = App_DataUtils::datetime_fmttime($result['@p_date_expires'],$timezone);
    $return['wigicode']      = $fullcode;
    $return['wigicode_fmt']  = $ac[0] . $ac[1] . $ac[2] . "-" . $ac[3] . $ac[4] . "-" . $ac[5] . $ac[6] . $ac[7] . $ac[8];
    $return['minutes']       = $minutes;
    //reduce their temporary balance by that amount
    $c->reduceFromTempBalance($amount);

    $fmt_code = App_DataUtils::fmtCode($fullcode);
   
    $balance = $c->getBalance();
    $temp_balance = $c->getTempBalance() - $amount;

    if ($logging == true) {
        App_Transaction_Transaction::log(App_Transaction_Type::CREATE_WIGI_CODE,'Info',$amount,$balance,$temp_balance,$mobileid,'0',App_Transaction_Type::getConstName(App_Transaction_Type::CREATE_WIGI_CODE) . " $fmt_code",$c->getFmtCellphone(),"N/A",$c->getUserId(),"N/A",$u->getEmail(),"N/A",$fullcode,$extinfo);
    }

    //unlock table

    return $return;

  }

  public function getCodeAmount($code,$mobileid) {

    	$sp  = new App_Db_Sp_WigiGetAmount();
	$res = $sp->getSimpleResponse(array('CODE' => $code,'MOBILEID' => $mobileid));
	return $res['@p_amount'];
  }

  public function setCodeAmount($code,$mobileid,$amount) {
    	$sp  = new App_Db_Sp_WigiReduceAmount();
	$res = $sp->getSimpleResponse(array('CODE' => $code,'AMOUNT' => $amount, 'MOBILEID' => $mobileid));
	return true;

  }

  public function setTransactionViewed($transaction_id) {
    	$sp  = new App_Db_Sp_SetTransactionViewed();
	$res = $sp->getSimpleResponse(array('TRANSACTION_ID' => $transaction_id));
  }

  public static function billUser($mobileid,$amount,$transaction_type) {

     $c = new App_Cellphone($mobileid);
     $userid = $c->getUserId();
     $u = new App_User($userid);
     $billing_amount = 0;

     if ($u->getType() === "consumer") {
         $data = App_Transaction_WigiBill::calculateConsumerBilling(
                                $session_data->wigi_billing_settings, 
                                $mobileid, 
                                $amount, 
                                $transaction_type);
          $billing_amount = $data['charge'];
     } else {

         $data = App_Transaction_WigiBilling::calculateMerchantBilling(
                                $session_data->wigi_billing_settings, 
                                $session_data->current_wigi_special_billing_setting, 
                                $userid, 
                                $amount,
                                $transaction_type); 
          $billing_amount = $data['charge'];
     }
     
     //check to see if there's enough money
     if (!$c->hasEnoughMoney($billing_amount) || !$c->hasEnoughMoney($billing_amount,"real")) {
        throw new App_Exception_WsException('Insufficient billing funds');
        return false;

     }
       //reduce the balance
       $c->reduceFromBalance($billing_amount);
       //reduce the temp balance
       $c->reduceFromTempBalance($billing_amount);

       return $billing_amount;
  }

  public function redeemTransaction($extinfo,$dstmobileid,$code,$srcmobileid,$amount,$logging = true,$userdescription = "", $type1 = "", $type2 = "") {

    if ($type1 === "") { $type1 = App_Transaction_Type::REDEEMED_WIGI_CODE_CONSUMER; }
    if ($type2 === "") { $type2 = App_Transaction_Type::REDEEMED_WIGI_CODE_MERCHANT; }

    $extinfo['user_description'] = $userdescription;

    $wc = new App_WigiCode($code,$srcmobileid);

    $code_amount = $wc->getAmount();
$amount = substr($amount,4);

    //make sure code actually exists
   // if (!$this->codeExists($code,$srcmobileid)) {
   //   throw new App_Exception_WsException('IMPC not found.');
   //   return false;
   // }

    $wgcstatus = $wc->getStatus();

    if ($wgcstatus === "redeemed") {
      throw new App_Exception_WsException('IMPC already redeemed.');
      return false;
    }

    if ($wgcstatus === "expired") {
      throw new App_Exception_WsException('IMPC has expired.');
      return false;
    }

    if ($wgcstatus === "deleted") {
      throw new App_Exception_WsException('IMPC has been deleted.');
      return false;
    }

    if ($wgcstatus !== "active" && $wgcstatus !== "pending") {
      throw new App_Exception_WsException('IMPC is not active. Only active codes can be redeemed.');
      return false;
    }

    if ($wgcstatus === "pending" && ($wc->getToId() != $dstmobileid) ) {
      throw new App_Exception_WsException('Pending IMPC can only be redeemed by their owner.');
      return false;
    }

    //check to see if code has enough money
    if ($amount > $code_amount) {
      throw new App_Exception_WsException('The IMPC entered is less than the amount charged.');
      return false;
    }

    $dst_c = new App_Cellphone($dstmobileid,null);
    $src_c = new App_Cellphone($srcmobileid,null);
    $dst_u = new App_User($dst_c->getUserId());
    $src_u = new App_User($src_c->getUserId());

    //if code if for more than requested amount
    if ($amount < $code_amount) {

      throw new App_Exception_WsException('Charge amount and IMPC amount must be the same.');
      return false;

      /*
      //get difference between amounts
      $diff_amount = $code_amount - $amount;

      //reduce the amount of the wigicode
      $this->setCodeAmount($code,$srcmobileid,$amount);
      //log reduction

      //return the difference to the account
      $src_c->addToTempBalance($diff_amount);
 
      //log the balance increase
      */
    }

    //redeem the code
    $sp  = new App_Db_Sp_WigiRedeem();
    $res = $sp->getSimpleResponse(array('CODE' => $code, 'TO_MOBILE_ID' => $dstmobileid, 'FROM_MOBILE_ID' => $srcmobileid));

    //log the transaction


    //increase the dst user balance by that amount
    $dst_c->addToBalance($amount); 
    $dst_c->addToTempBalance($amount);

    //reduce the src user balance by that amount
    $src_c->reduceFromBalance($amount);

    $m = new App_User($dst_c->getUserId());

    $ac = str_split($code);
    $code_fmt  = $ac[0] . $ac[1] . $ac[2] . "-" . $ac[3] . $ac[4] . "-" . $ac[5] . $ac[6] . $ac[7] . $ac[8];


    $src_balance      = $src_c->getBalance() - $amount;
    $src_temp_balance = $src_c->getTempBalance();
    $dst_balance      = $dst_c->getBalance() + $amount;
    $dst_temp_balance = $dst_c->getTempBalance() + $amount;

    $id = "";
    if ($logging == true) {

        //This is to set a different user id if the user is a pos user
        $merchuid = $dst_c->getUserId(); $merchemail = $dst_u->getEmail();
        if (array_key_exists('userid',$extinfo)) { $merchuid = $extinfo['userid']; $merchemail = $extinfo['useremail']; }

	//shows up in merchant hisotry
        $id = App_Transaction_Transaction::log($type2,'Credit',$amount,$dst_balance,$dst_temp_balance,$dst_c->getMobileId(),$src_c->getMobileId(),App_Transaction_Type::getConstName($type2) . " $code_fmt",$dst_c->getCellphone(),$src_c->getFmtCellphone(),$merchuid,$src_c->getUserId(),$merchemail,$src_u->getEmail(),$code,$extinfo);
        
        App_Transaction_Transaction::blankPersonal($extinfo);
        //shows up in user history
        App_Transaction_Transaction::log($type1,'Debit',$amount,$src_balance,$src_temp_balance,$src_c->getMobileId(),$dst_c->getMobileId(),App_Transaction_Type::getConstName($type1) . " $code_fmt",$src_c->getFmtCellphone(),$m->getBusinessName(),$src_c->getUserId(),$merchuid,$src_u->getEmail(),$merchemail,$code,$extinfo);
    
    }
 
    return $id;

  }

  public function sendMoney($extinfo,$from,$to,$amount,$type = "Money") {
 
 
    //lock
    $c_from = new App_Cellphone($from,null); 
    $c_to = new App_Cellphone($to,null);
    $u_from = new App_User($c_from->getUserId());
    $u_to = new App_User($c_to->getUserId());

    //$this->checkActiveUser($c_to->getUserId());
    $this->checkActiveCellphone($to);

    //check to see if they have enough money for the transaction
    if ($from === $to) {
      throw new App_Exception_WsException("Can not send to yourself");
      return false;
    }

    //check to see if they have enough money for the transaction
    if (!$c_from->hasEnoughMoney($amount)) {
      throw new App_Exception_WsException('Insufficient Funds');
      return false;
    }

    //reduce their temp and regular balance by that amount
    //$c_from->reduceFromTempBalance($amount);
    //$c_from->reduceFromBalance($amount);
    
    //Create WGC
    $wigicode = $this->createTransaction($extinfo,$from,$amount,'2','0',false);
    
    $from_balance      = $c_from->getBalance() - $amount;
    $from_temp_balance = $c_from->getTempBalance() - $amount;
    
    $trans_type1 = ""; $trans_type2 = "";

    $dst_name = $u_to->getFirstName() . " " . $u_to->getLastName();
    $dst_cell = $c_to->getFmtCellphone();

    if ($type === "Donation") {
        $trans_type1 = App_Transaction_Type::SEND_DONATION;
        $trans_type2 = App_Transaction_Type::RECEIVE_DONATION;
	$dst_name = $u_to->getBusinessName();
        $dst_cell = "";

    } 

    else if ($type === "Move") {
        $trans_type1 = App_Transaction_Type::SEND_INTERNAL_MONEY;
        $trans_type2 = App_Transaction_Type::RECEIVE_INTERNAL_MONEY;
    }

    else {
        $trans_type1 = App_Transaction_Type::SEND_MONEY;
        $trans_type2 = App_Transaction_Type::RECEIVE_MONEY;
    }


    //log the reduce
    //shows up in the senders history
    App_Transaction_Transaction::log($trans_type1,'Debit',$amount,$from_balance,$from_temp_balance,$from,$to,"Send $type to " . $dst_name . " WGC " . App_DataUtils::fmtCode($wigicode["wigicode"]),$c_from->getFmtCellphone(),$dst_cell,$c_from->getUserId(),$c_to->getUserId(),$u_from->getEmail(),$dst_name,$wigicode["wigicode"],$extinfo);

    //increase the other balance
    //$c_to->addToBalance($amount);

    //Redeem WGC
    $this->redeemTransaction($extinfo,$to,$wigicode['wigicode'],$from,$amount,false);

    $to_balance      = $c_to->getBalance() + $amount;
    $to_temp_balance = $c_to->getTempBalance() + $amount;


    App_Transaction_Transaction::blankPersonal($extinfo);
    //log the increase
    //shows up in the receivers history
    App_Transaction_Transaction::log($trans_type2,'Credit',$amount,$to_balance,$to_temp_balance,$to,$from,"Receive $type from "  . $u_from->getFirstName() . " " . $u_from->getLastName()  . " WGC " . App_DataUtils::fmtCode($wigicode["wigicode"]),$c_to->getFmtCellphone(),$c_from->getFmtCellphone(),$c_to->getUserId(),$c_from->getUserId(),$u_to->getEmail(),$u_from->getEmail(),$wigicode["wigicode"],$extinfo);

    //unlock table

  }

  public function logBankTransfer($direction,$amount,$mobileid,$processor) {

  }

  public function getActiveWigiCodes($mobileid,$timezone) {

    $t = new App_Models_Db_Wigi_ViewActiveWigiCodes();

    $raw = $t->fetchAll(
      $t->select()
        ->where('from_mobile_id = ?', $mobileid)
    );

    $result = array();

    foreach ($raw as $row) {

      $zd_exp = new Zend_Date($row->date_expires, Zend_Date::ISO_8601);
      $zd_now = new Zend_Date();
      $diff = $zd_exp->sub($zd_now)->toValue()/60;

      $ac = str_split($row->wigi_code_id);
      $s['wigicode']     = $row->wigi_code_id;
      $s['wigicode_fmt'] = $ac[0] . $ac[1] . $ac[2] . "-" . $ac[3] . $ac[4] . "-" . $ac[5] . $ac[6] . $ac[7] . $ac[8];
      $s['amount']       = $row->amount;
      $s['date_expires'] = App_DataUtils::datetime_fmtdate($row->date_expires,$timezone);
      $s['time_expires'] = App_DataUtils::datetime_fmttime($row->date_expires,$timezone);
      $s['date_added']   = App_DataUtils::datetime_fmtdate($row->date_added,$timezone);
      $s['time_added']   = App_DataUtils::datetime_fmttime($row->date_added,$timezone);
      $s['minutes']      = $diff;
      array_push($result,$s);
    }

    return $result;

  }

  public function getHistory($mobileid,$timezone,$limit="all",$date="all") {

    $t = new App_Models_Db_Wigi_ViewHistory();

    $raw = "";

    if ($date !== "all") {
      $from_date = App_DataUtils::shift_datetime("$date 00:00:00",$timezone);
      $to_date = App_DataUtils::shift_datetime("$date 23:59:59",$timezone);

      $raw = $t->fetchAll(
        $t->select()
          ->where('`from` = ?', $mobileid)->order("`stamp` desc")->limit($limit)
      );

    }


    else if ($limit !== "all") {

      $raw = $t->fetchAll(
        $t->select()
          ->where('`from` = ?', $mobileid)->limit($limit)->order("stamp desc")
      );

    } 

    $result = array();

    foreach ($raw as $row) {
      $t = array();
      $t['type']            = $row['type'];
      $t['tax']             = App_DataUtils::fmtMoney($row['tax']);
      $t['tip']             = App_DataUtils::fmtMoney($row['tip']);
      $t['raw_amount']      = App_DataUtils::fmtMoney($row['raw_amount']);
      $t['transaction_id']  = $row['transaction_id'];
      $t['viewed']          = $row['viewed'];
      $t['amount']          = App_DataUtils::fmtMoney($row['amount']);
      $t['direction']       = $row['direction'];
      $t['description']     = $row['description'];
      $t['from_description']= $row['from_description'];
      $t['to_description']  = $row['to_description'];

      $dname = ""; $loginid = $row['from_user_id_description'];
      if (strpos($row['from_user_id_description'],":")) {
        $a = explode(':',$row['from_user_id_description']);
        $dname = $a[0]; $loginid = $a[1];
      }

      $t['dname'] = $dname;
      $t['loginid'] = $loginid;

      $t['reason']          = $row['user_description'];
      $t['gps']             = $row['gps'];
      $t['stamp_date']      = App_DataUtils::datetime_fmtdate($row['stamp'],$timezone);
      $t['stamp_time']      = App_DataUtils::datetime_fmttime($row['stamp'],$timezone);
      array_push($result,$t);
    }

    if (count($result) == 0) {
        throw new App_Exception_WsException("No transactions");
        return false;
    }

    return $result;

  }

  public function getStatement($userid,$from_date,$to_date,$timezone) {


    $result = array();

    $u = new App_User($userid);
    $cellphones = $u->getCellphones();

    foreach ($cellphones as $cellphone) {

    $cellnum = $cellphone->cellphone;

    $result[$cellnum] = array();

    $mobileid = $cellphone->mobile_id;

    $t = new App_Models_Db_Wigilog_Transaction();

    $raw = $t->fetchAll(
      $t->select()
        ->where('`from` = ?', $mobileid)->where('stamp >= ?', $from_date)->where('stamp < ?',$to_date)
        ->order('stamp DESC')
    );

    $result[$cellnum]["cc_fund"]      = 0;
    $result[$cellnum]["cc_withdraw"]  = 0;
    $result[$cellnum]["ba_fund"]      = 0;
    $result[$cellnum]["ba_withdraw"]  = 0;
    $result[$cellnum]["send_money"]   = 0;
    $result[$cellnum]["recv_money"]   = 0;
    $result[$cellnum]["wigi_spent"]   = 0;
    $result[$cellnum]["scanandbuy"]   = 0;
    $result[$cellnum]["scanandpay"]   = 0;

    $result[$cellnum]["wigi_created"]    = 0;
    $result[$cellnum]["wigi_invalid"]    = 0;
    $result[$cellnum]["wigi_redeemed"]   = 0;
    $result[$cellnum]["wigi_used"]       = 0;
    $result[$cellnum]["wigi_pending"]       = 0;

    $result[$cellnum]["transactions"] = array();

    foreach ($raw as $row) {

        array_push($result[$cellnum]["transactions"],$row);

        switch ($row->type) {

            case App_Transaction_Type::SEND_MONEY:
                 $result[$cellnum]["send_money"] += $row->amount;
                 break;
            case App_Transaction_Type::RECEIVE_MONEY:
                 $result[$cellnum]["recv_money"] += $row->amount;
                 break;
            case App_Transaction_Type::FUND_FROM_CREDIT_CARD:
                 $result[$cellnum]["cc_fund"] += $row->amount;
                 break;
            case App_Transaction_Type::WITHDRAW_TO_CREDIT_CARD:
                 $result[$cellnum]["cc_withdraw"] += $row->amount;
                 break;
            case App_Transaction_Type::FUND_FROM_BANK_ACCOUNT:
                 $result[$cellnum]["ba_fund"] += $row->amount;
                 break;
            case App_Transaction_Type::WITHDRAW_TO_BANK_ACCOUNT:
                 $result[$cellnum]["ba_withdraw"] += $row->amount;
                 break;
            case App_Transaction_Type::SCAN_AND_PAY_CONSUMER:
                 $result[$cellnum]["scanandpay"] += $row->amount;
                 break;
            case App_Transaction_Type::SCAN_AND_BUY_CONSUMER:
                 $result[$cellnum]["scanandbuy"] += $row->amount;
                 break;
            case App_Transaction_Type::CREATE_WIGI_CODE:
                 $result[$cellnum]["wigi_created"] += $row->amount;
                 break;
            case App_Transaction_Type::WIGI_CODE_EXPIRED:
                 $result[$cellnum]["wigi_invalid"] += $row->amount;
                 break;
            case App_Transaction_Type::WIGI_CODE_DELETED:
                 $result[$cellnum]["wigi_invalid"] += $row->amount;
                 break;
            case App_Transaction_Type::REDEEMED_WIGI_CODE_CONSUMER:
                 $result[$cellnum]["wigi_redeemed"] += $row->amount;
                 break;
            case App_Transaction_Type::WIGI_CODE_PENDING:
                 $result[$cellnum]["wigi_pending"] += $row->amount;
                 break;

            //case App_Transaction_Type::MERCHANT_REDEEMED_WIGI_CODE:
            //     $result[$cellnum]["wigi_spent"] += $row->amount;
            //     break;

        }


    }

    }

    return $result;

  }


  public function bulkExpireAndReturnFunds() {


    $t = new App_Models_Db_Wigi_WigiCode();

    $raw = $t->fetchAll(
      $t->select()
        ->where('status = ?', 'active')
        ->where('date_expires < ?' , new Zend_Db_Expr('NOW()') )
    );

    $result = array();

    foreach ($raw as $row) {
      try {
      //create a cellphone object
      $c = new App_Cellphone($row->from_mobile_id);
      $u = new App_User($c->getUserId());      
 
      $sp  = new App_Db_Sp_WigiExpire();
      $res = $sp->getSimpleResponse(array('CODE' => $row['wigi_code_id'], 'MOBILEID' => $row['from_mobile_id']));
      
      //return funds to cellphone account
      $c->addToTempBalance($row['amount']);
    
      $balance = $c->getBalance();
      $temp_balance = $c->getTempBalance() + $row['amount'];
 
      $extinfo = App_DataUtils::getCronExtInfo();
 
      //log return transaction
      $fmt_code = App_DataUtils::fmtCode($row['wigi_code_id']);
      App_Transaction_Transaction::log(App_Transaction_Type::WIGI_CODE_EXPIRED,'Info',$row['amount'],$balance,$temp_balance,$row['from_mobile_id'],'0',App_Transaction_Type::getConstName(App_Transaction_Type::WIGI_CODE_EXPIRED) . " $fmt_code",$c->getFmtCellphone(),"N/A",$c->getUserId(),"",$u->getEmail(),"",$row['wigi_code_id'],$extinfo);
      } catch (Exception $e) {}
    }
  }

  public function bulkReleaseFunds($date) {

    $total_recs = 0;
    $page = 0;

    do {

      $records = array();

      $achdirect = new App_Achdirect;
      $val =  $achdirect->getTransactions($date,$page,'200');

      $total_recs = $val->TotalRecords;

      if ($total_recs == 0) {
        return;
      }

      else if ($total_recs == 1) {
        //The data structure is sent different if there's exactly one record
        //put it into a normal data structure
        array_push($records,$val->getSettleDetailResult->Settle);
      } 

      else {
        $records = $val->getSettleDetailResult->Settle;
      }

      foreach ($records as $record) {

       if ($record->Transaction->ConsumerOrderID === "") {
         continue;
       }

       $type1 = ""; $type2 = "";
       if ($record->PaymentType === "E") {
         $type1 = App_Transaction_Type::FUND_FROM_BANK_ACCOUNT;
         $type2 = App_Transaction_Type::getConstName(App_Transaction_Type::FUND_FROM_BANK_ACCOUNT);
       } else if ($record->PaymentType === "C") {
         $type1 = App_Transaction_Type::FUND_FROM_CREDIT_CARD;
         $type2 = App_Transaction_Type::getConstName(App_Transaction_Type::FUND_FROM_CREDIT_CARD);
       }
         $t = new App_Models_Db_Wigilog_Transaction();

         $row = $t->fetchRow(
           $t->select()
              ->where('processor_transaction_id = ?', $record->Transaction->ConsumerOrderID)
         );

         if ( (count($row) == 1) && !$row->settled) {

           $c = new App_Cellphone($row->from);
           $u = new App_User( $c->getUserId() );

           error_log("RELEASING FUNDS FOR " . $u->getEmail() . " AMOUNT " . $row->amount . " TRANSACTION ID " . $record->Transaction->ConsumerOrderID);

           $c->addToTempBalance($row->amount);
           $data = array("settled"=>"1");
           $t->update($data,$t->getAdapter()->quoteInto('processor_transaction_id = ?', $record->Transaction->ConsumerOrderID));

           $balance      = $c->getBalance();
           $temp_balance = $c->getTempBalance() + $row->amount;

           $extinfo = App_DataUtils::getCronExtInfo();

           //log transaction
           App_Transaction_Transaction::log($type1,'Credit',$row->amount,$balance,$temp_balance,$c->getMobileId(),'0',$type2,$c->getFmtCellphone(),$type2,$c->getUserId(),"",$u->getEmail(),"","",$extinfo);

           $c->sendMessage("Your WiGime account funding of US $" . $row->amount . " has cleared and funds are now available.");
 
         }


      }

      $total_recs -= 200;
      $page++;

    } while ($total_recs > 0); 


  }

  public function deleteCode($extinfo,$code,$mobileid) {

    $wgc = new App_WigiCode($code,$mobileid);
    $status = $wgc->getStatus();
    $dstid = $wgc->getToId();
    if ($status === "expired") { //expired
      throw new App_Exception_WsException("WGC is expired. Can not delete.");
    } else if ($status === "redeemed") { //redeemed already
      throw new App_Exception_WsException("WGC is already redeemed. Can not delete.");
    } else if ($status === "deleted") { //already deleted
      throw new App_Exception_WsException("WGC is already deleted. Can not delete again.");
    } else if ($status !== "active" && $status !== "pending") { //general "not active" state
      throw new App_Exception_WsException("WGC must be active to delete. Can not delete.");
    }


    //TODO Make sure mobileid is the owber of the code
    $w = new App_WigiCode($code,$mobileid);
    $sp  = new App_Db_Sp_WigiDelete();
    $res = $sp->getSimpleResponse(array('CODE' => $code, 'MOBILEID' => $mobileid));
    $fmt_code = App_DataUtils::fmtCode($code);

    //return funds to cellphone account
    $c = new App_Cellphone($mobileid);
    $u = new App_User($c->getUserId());
    $c->addToTempBalance($w->getAmount());

    $balance      =  $c->getBalance();
    $temp_balance =  $c->getTempBalance() + $w->getAmount();

    App_Transaction_Transaction::log(App_Transaction_Type::WIGI_CODE_DELETED,'Info',$w->getAmount(),$balance,$temp_balance,$w->getFromId(),'0',App_Transaction_Type::getConstName(App_Transaction_Type::WIGI_CODE_DELETED) .  " $fmt_code",$c->getFmtCellphone(),"N/A",$c->getUserId(),"",$u->getEmail(),"",$code,$extinfo);

    if ($dstid > 0) {
      $dst_c = new App_Cellphone($dstid);
      $dst_u = new App_User($dst_c->getUserId());

      App_Transaction_Transaction::blankPersonal($extinfo);
      App_Transaction_Transaction::log(App_Transaction_Type::WIGI_CODE_DELETED,'Info',$w->getAmount(),$dst_u->getBalance(),$dst_u->getTempBalance(),$w->getToId(),$w->getFromId(),App_Transaction_Type::getConstName(App_Transaction_Type::WIGI_CODE_DELETED) .  " $fmt_code","",$c->getFmtCellphone(),$dst_c->getUserId(),$c->getUserId(),$dst_u->getEmail(),$u->getEmail(),$code,$extinfo); 

    }
  }

}

?>