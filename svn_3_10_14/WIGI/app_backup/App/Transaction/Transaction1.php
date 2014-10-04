<?php

class App_Transaction_Transaction  extends App_Models_Db_Wigilog_Transaction {
    protected $dbh;
    protected $transres;

    public function __construct($id=0,$tz=0) {

    if ($id > 0) {
      parent::__construct();

      $result = $this->fetchRow(
        $this->select()
          ->where('transaction_id = ?', $id)
      );

      $this->res["Transaction ID"] = $result->transaction_id;
      //$this->res["Account"] = $result->from_description;
      //$this->res["Balance"] = $result->balance;
      //$this->res["Effective Balance"] = $result->temp_balance;
      $this->res["Type"] = $result->description;
      $this->res["WPC"] = App_DataUtils::fmtCode($result->wigi_code_id);
      //$this->res["Type"] = $result->direction;
      //$this->res["Date"] = $result->stamp;
      //$this->res["Amount"] = "₹".$result->amount;
      //$this->res["Language"] = $result->language;
      $this->res["IP Address of Client"] = $result->ip_address;
      $this->res["Message"] = $result->user_description;

      if ($result->gps !== "") { 
          
          $gres = $result->gps;
          $tmg = preg_split("/,/",$gres);

          if($tmg[0] > 360){
              $tmg[0]/=1000000;  
              $tmg[1]/=1000000;  
              $gres = $tmg[0].",".$tmg[1];
          }   
          $this->res["GPS"] = "<a href=\"http://maps.google.com/?q=".$gres."\" target=\"_blank\">".$gres."</a>"; 

          if($tmg[0] == 0){
            $this->res["GPS"] = "GPS Data not collected"; 
          }
          
          #$this->res["GPS"] = "<a href=\"http://maps.google.com/?q=".$result->gps."\" target=\"_blank\">".$result->gps."</a>"; 
      }

      $this->res["POS Device Name"] = $result->pos_name;
      $this->res["Device"] = $result->device_model;
      $this->res["Device ID"] = $result->os_id;
      $this->res["App Name"] = $result->app_name;
      $this->res["InCashMe App Version"] = $result->app_version;
      $this->res["Device Name"] = $result->system_name;
      $this->res["Device OS Version"] = $result->system_version;
      $this->res["Browser"] = $result->browser_string;
      if ($result->to > 0) {
        try {
          $c = new App_Cellphone($result->to);
          $u = new App_User($c->getUserId());
          $this->res["Name"] = $u->getFirstName() . " " . $u->getLastName();
          $this->res["Business Name"] = $u->getBusinessName();
          $this->res["Business Phone"] = $u->getBusinessPhone();

          $bt = $u->getBusinessType(); $bt = str_replace(" ","",$bt);
          if ($bt !== "") { $this->res["Merchant ID"] = $u->getMerchantId(); }
        } catch(Exception $e) {}
      }

      $this->transres = array();
      foreach ($this->res as $var => $val) {
        $val2 = str_replace(" ","",$val);
        if ($val2 !== "") {
          $this->transres[$var] = $val;
        }
      }

    }
  }

  public function getInfo() {
    return $this->transres;
  }

  public static function log($type,$direction,$amount,$balance,$temp_balance,$from,$to,$description,$from_description,$to_description,
                             $from_user_id,$to_user_id,$from_user_id_description,$to_user_id_description,$wigi_code_id,$extinfo) {

      $billing_amount = 0;//App_WigiEngine::billUser($from,$amount,$type);
      $balance -= $billing_amount;
      $temp_balance -= $billing_amount;

      if (!array_key_exists("processor_transaction_id",$extinfo) ) {
        $extinfo["processor_transaction_id"] = "";
      }

      if (!array_key_exists("user_description",$extinfo) ) {
        $extinfo["user_description"] = "";
      }

      if (!array_key_exists("tax",$extinfo) ) {
        $extinfo["tax"] = "";
      }

      if (!array_key_exists("tip",$extinfo) ) {
        $extinfo["tip"] = "";
      }
      if (!array_key_exists("raw_amount",$extinfo) ) {
        $extinfo["raw_amount"] = "";
      }

      if (!array_key_exists("pos_name",$extinfo) ) {
        $extinfo["pos_name"] = "";
      }

      if (!array_key_exists("order_id",$extinfo) ) {
        $extinfo["order_id"] = "";
      }


      $csp = new App_Db_Sp_LogTransaction();
      $res = $csp->getSimpleResponse(array('DIRECTION' => $direction, 
                                         'AMOUNT' => $amount,
					 'BILLING_AMOUNT' => $billing_amount, 
                                         'BALANCE' => $balance,
                                         'TEMP_BALANCE' => $temp_balance,
                                         'FROM' => $from, 
                                         'TO' => $to,
                                         'FROM_DESCRIPTION' => $from_description,
                                         'TO_DESCRIPTION' => $to_description,
                                         'DESCRIPTION' => $description,
                                         'FROM_USER_ID' => $from_user_id,
                                         'TO_USER_ID' => $to_user_id,
                                         'FROM_USER_ID_DESCRIPTION' => $from_user_id_description,
                                         'TO_USER_ID_DESCRIPTION' => $to_user_id_description,
                                         'TYPE' => $type,
                                         'IP_ADDRESS' => $extinfo["ip_address"],
                                         'GPS' => $extinfo["gps"],
                                         'SERVER_DATETIME' => $extinfo["server_datetime"],
                                         'CLIENT_DATETIME' => $extinfo["client_datetime"],
                                         'APP_NAME' => $extinfo["appname"],
                                         'APP_VERSION' => $extinfo["appversion"],
                                         'DEVICE_MODEL' => $extinfo["devicemodel"],
                                         'SYSTEM_NAME' => $extinfo["systemname"],
                                         'SYSTEM_VERSION' => $extinfo["systemversion"],
                                         'OS' => $extinfo["os"],
                                         'BROWSER_STRING' => $extinfo["browser_string"],
                                         'LANGUAGE' => $extinfo["language"],
                                         'OS_ID' => $extinfo["osid"],
                                         'PROCESSOR_TRANSACTION_ID' => $extinfo["processor_transaction_id"],
                                         'USER_DESCRIPTION' => $extinfo["user_description"],
                                         'TAX' => $extinfo["tax"],
                                         'TIP' => $extinfo["tip"],
                                         'RAW_AMOUNT' => $extinfo["raw_amount"],
                                         'POS_NAME' => $extinfo["pos_name"],
                                         'WIGI_CODE_ID' => $wigi_code_id,
                                         'ORDER_ID' => $extinfo["order_id"],
                                         ));
      return $res['@res'];
  }

  public static function blankPersonal(&$array) {
    foreach($array as $key => $val) {
      if ($key === "user_description") {continue;}
      if ($key === "tax") {continue;}
      if ($key === "tip") {continue;}
      if ($key === "raw_amount") {continue;}
      if ($key === "pos_name") {continue;}
      if ($key === "order_id") {continue;}
      $array[$key] = "";
    }
  }


  public function checkpoint($mobileid) {
    //get the current amount in the user_mobile cache
    $c = new App_Cellphone($mobileid);
    //get the datetime,balance, and temp_balance of the last checkpoint
    $table_check = new App_Models_Db_Wigilog_Checkpoint();

    $check_row = $table_check->fetchRow(
      $table_check->select()
        ->where('mobile_id = ?', $mobileid)->order('stamp DESC')->limit(1)
    );

    $check_balance = 0;
    $check_temp_balance = 0;
    $check_stamp = '1970-01-01 00:00:00';


    if (count($check_row) == 1) {

      $check_balance = $check_row->balance;
      $check_temp_balance = $check_row->temp_balance;
      $check_stamp = $check_row->stamp;

    }

    $current_balance = $c->getBalance();
    $current_temp_balance = $c->getTempBalance();

    //loop through the transactions and make sure the balance and temp_balance match
    $table_transaction = new App_Models_Db_Wigilog_Transaction();

    $transaction_raw = $table_transaction->fetchAll(
      $table_transaction->select()
        ->where('`from` = ?', $mobileid)->where('stamp >= ?',$check_stamp)->order('stamp')
    );

    foreach ($transaction_raw as $row) {
      switch ($row->type) {

      case App_Transaction_Type::SEND_MONEY:
        $check_balance       -= $row->amount;
        $check_temp_balance  -= $row->amount;
        break;
      case App_Transaction_Type::RECEIVE_MONEY:
        $check_balance       += $row->amount;
        $check_temp_balance  += $row->amount;
        break;
      case App_Transaction_Type::CREATE_WIGI_CODE:
        $check_temp_balance  -= $row->amount;
        break;
      case App_Transaction_Type::WIGI_CODE_EXPIRED:
        $check_temp_balance  += $row->amount;
        break;
      case App_Transaction_Type::MERCHANT_REDEEMED_WIGI_CODE:
        $check_balance       -= $row->amount;
        break;
      case App_Transaction_Type::WIGI_USER_TO_MERCHANT:
        $check_balance       += $row->amount;
        $check_temp_balance  += $row->amount;
        break;
      case App_Transaction_Type::SCAN_AND_BUY:
        $check_temp_balance  -= $row->amount;
        break;
      case App_Transaction_Type::FUND_FROM_CREDIT_CARD:
        $check_balance       += $row->amount;
        $check_temp_balance  += $row->amount;
        break;
      case App_Transaction_Type::WITHDRAW_TO_CREDIT_CARD:
        $check_balance       -= $row->amount;
        $check_temp_balance  -= $row->amount;
        break;
      case App_Transaction_Type::WITHDRAW_TO_CREDIT_CARD:
        $check_balance       += $row->amount;
        $check_temp_balance  += $row->amount;
        break;
      case App_Transaction_Type::WIGI_CODE_DELETED:
        $check_temp_balance  += $row->amount;
        break;
      case App_Transaction_Type::FUND_FROM_BANK_ACCOUNT:
        $check_temp_balance  += $row->amount;
        break;
      case App_Transaction_Type::WITHDRAW_TO_BANK_ACCOUNT:
        $check_balance       += $row->amount;
        $check_temp_balance  += $row->amount;
        break;
      case App_Transaction_Type::CASH_SALE:
        break;
      case App_Transaction_Type::CREDIT_SALE:
        break;

      }

    }

    if ( ($check_balance != $current_balance) || ($check_temp_balance != $current_temp_balance) ) {
      throw new App_Exception_WsException("Account balance violation for mobileid " . $mobileid);
      return false; 
    }

    echo "FOR MOBILE ID $mobileid. FINAL CHECK BALANCE: $check_balance. FINAL BALANCE: $current_balance. FINAL CHECK TEMP BALANCE: $check_temp_balance. FINAL CURRENT BALANCE: $current_temp_balance.\n";

  }

  public function getLastDaySendGiftAmt($mobileid) {
      $sp = new App_Db_Sp_GetLastDayAmt();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'TYPE'=> App_Transaction_Type::SEND_MONEY ));
      return $res['@p_res'];
  }

  public function getLastDayReceiveGiftAmt($mobileid) {
      $sp = new App_Db_Sp_GetLastDayAmt();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'TYPE'=> App_Transaction_Type::RECEIVE_MONEY ));
      return $res['@p_res'];
  }

  public function getLastDayWigiAmt($mobileid) {
      $sp = new App_Db_Sp_GetLastDayAmt();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'TYPE'=> App_Transaction_Type::REDEEMED_WIGI_CODE_CONSUMER ));
      return $res['@p_res'];
  }

  public function getLastDayFundingAmt($mobileid) {
      $sp = new App_Db_Sp_GetLastDayAmt();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'TYPE'=> App_Transaction_Type::FUND_FROM_CREDIT_CARD ));
      $cc_tot = $res['@p_res'];

      $sp = new App_Db_Sp_GetLastDayAmt();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'TYPE'=> App_Transaction_Type::FUND_FROM_BANK_ACCOUNT ));
      $ba_tot = $res['@p_res'];

      return $cc_tot + $ba_tot;

  }

  public static function getProcessorTransactionId($mobileid) {

      $exists = true;
      $id = "";

      $salt = hash("sha256", mt_rand() + md5($mobileid));

      do {

        $id = md5( time() + $salt );

        $sp = new App_Db_Sp_ProcessorTransactionIdExists();
        $res = $sp->getSimpleResponse(array( 'ID' => $id ));
        $exists = $res['@p_res'];

      } while ($exists);

      return $id;

  }

  /*public function getNoCodes($start_date,$id) {
    $stm = $this->dbh->prepare("select count(*) as count from view_transaction where `type` = '3' and `from` = '$id' and `stamp` >= '$start_date'");
    $stm->execute();
    $result = $stm->fetchAll();
    return $result[0]['count'];
  }

  public function getAmountCodes($start_date,$id) {
    $stm = $this->dbh->prepare("select sum(amount) as tot_amount from view_transaction where `type` = '3' and `from` = '$id' and `stamp` >= '$start_date'");
    $stm->execute();
    $result = $stm->fetchAll();
    return $result[0]['tot_amount'];
  }

  public function getNoCredit($start_date,$id) {
    $stm = $this->dbh->prepare("select count(*) as count from view_transaction where `type` = '7' and `from` = '$id' and `stamp` >= '$start_date'");
    $stm->execute();
    $result = $stm->fetchAll();
    return $result[0]['count'];
  }

  public function getAmountCredit($start_date,$id) {
    $stm = $this->dbh->prepare("select sum(amount) as tot_amount from view_transaction where `type` = '7' and `from` = '$id' and `stamp` >= '$start_date'");
    $stm->execute();
    $result = $stm->fetchAll();
    return $result[0]['tot_amount'];
  }

  public function getNoDebit($start_date,$id) {
    $stm = $this->dbh->prepare("select count(*) as count from view_transaction where `type` = '8' and `from` = '$id' and `stamp` >= '$start_date'");
    $stm->execute();
    $result = $stm->fetchAll();
    return $result[0]['count'];
  }

  public function getAmountDebit($start_date,$id) {
    $stm = $this->dbh->prepare("select sum(amount) as tot_amount from view_transaction where `type` = '8' and `from` = '$id' and `stamp` >= '$start_date'");
    $stm->execute();
    $result = $stm->fetchAll();
    return $result[0]['tot_amount'];
  }

  public function getNoSendMoney($start_date,$id) {
    $stm = $this->dbh->prepare("select count(*) as count from view_transaction where `type` = '1' and `from` = '$id' and `stamp` >= '$start_date'");
    $stm->execute();
    $result = $stm->fetchAll();
    return $result[0]['count'];
  }

  public function getAmountSendMoney($start_date,$id) {
    $stm = $this->dbh->prepare("select sum(amount) as tot_amount from view_transaction where `type` = '1' and `from` = '$id' and `stamp` >= '$start_date'");
    $stm->execute();
    $result = $stm->fetchAll();
    return $result[0]['tot_amount'];
  }
  */
  public static function search($p,$timezone,$count=false) {
  
    $t = new App_Models_Db_Wigilog_Transaction();
    $select = $t->select();

    if (array_key_exists("USER_ID",$p)) {
      $select->where("from_user_id = ?",$p["USER_ID"]);
    }

    if (array_key_exists("USER_ID_MULTIPLE",$p)) {
      $s = "";
      foreach ($p["USER_ID_MULTIPLE"] as $uid) {
          $s .= " `from_user_id` = '$uid' or";
      }
      preg_match('/^(.*) or$/', $s, $m);
      $select->where($m[1] . "?","");
    }


    if (array_key_exists("DATE_FROM",$p)) {
      $d = App_DataUtils::shift_datetime($p["DATE_FROM"], $timezone);
      $select->where("stamp >= ?",$d);
    }
    if (array_key_exists("DATE_TO",$p)) {
      $d = App_DataUtils::shift_datetime($p["DATE_TO"], $timezone,'1');
      $select->where("stamp < ?",$d);
    }

    if (array_key_exists("TRANSACTION_TYPE",$p)) {

      if ($p['TRANSACTION_TYPE'] === "CREDIT" || $p['TRANSACTION_TYPE'] === "DEBIT" || $p['TRANSACTION_TYPE'] === "INFO") {
          $select->where("`direction` = ?",$p["TRANSACTION_TYPE"]);
      } else {
          $select->where("`type` = ?",$p["TRANSACTION_TYPE"]);
      }
    }

    if (array_key_exists("TRANSACTION_TYPE_MULTIPLE",$p)) {
      $s = "";
      foreach ($p["TRANSACTION_TYPE_MULTIPLE"] as $type) {
          $s .= " `type` = '$type' or";
      }
      preg_match('/^(.*) or$/', $s, $m);
      $select->where($m[1] . "?","");
    }

    if (array_key_exists("AMOUNT_FROM",$p)) {
      $select->where("amount >= ?",$p["AMOUNT_FROM"]);
    }
    if (array_key_exists("AMOUNT_TO",$p)) {
      $select->where("amount <= ?",$p["AMOUNT_TO"]);
    }

    if (array_key_exists("CELLPHONE_FROM",$p)) {
      $select->where("`from` = ?",$p["CELLPHONE_FROM"]);
    }

    $select->order("stamp desc");

    $rpp = 20;
    if (array_key_exists("RPP",$p)) {
      $rpp = $p["RPP"];
    }

    
    if (array_key_exists("PAGE",$p) && $count == false) {
      $select->limit($rpp,$p["PAGE"]*$rpp);
    }


    if ($count) {
        $select->from($t->_name,'COUNT(*) AS num');
        $raw = $t->fetchRow($select)->num;
        return $raw;
    } else {
        $raw = $t->fetchAll($select);
    }


    $finalraw = array();

    foreach ($raw as $row) {
      $r = array();
      foreach ($row as $key => $val) {
     
        //if ($key === "from_description" || $key === "to_description") { $val = App_DataUtils::fmtphone($val);  }
 
        $r[$key] = $val;

      }
      array_push($finalraw,$r);
    }

    return $finalraw;

    }
    
    /**
     * Currently for admin dashboard gets the count of tranactions
     * from the view wigi_log.view_transaction for a given direction
     * and cutoff date.
     * @param string $direction "INFO", "CREDIT", or "DEBIT" only
     * @param mysqldate $fromdate example: "2012-03-31 07:31:00"
     * @return int 
     */
    public static function getTransactionCount($direction="INFO", $fromdate="2006-12-31 00:00:00") {

        $txdb = new App_Models_Db_Wigilog_Transaction();
        $select = $txdb->select();
        $txCount = 0;

        $select->from($txdb->_name, 'COUNT(*) AS num');
        $select->where("direction = ?", $direction );
        $select->where("stamp >= ?", $fromdate);

        $txCount = $txdb->fetchRow($select)->num;
        return $txCount;
    }


    public static function getTransactionCounts($fromdate="2006-12-31 00:00:00") {

        $txdb = new App_Models_Db_Wigilog_Transaction();
        $select = $txdb->select();
        $txCount = 0;

        $select->from($txdb->_name, array('COUNT(direction) AS counts', 'direction'));
        $select->where("stamp >= ?", $fromdate);
        $select->group("direction");
		//return $select;

		$result = $txdb->fetchAll($select);
		return $result->toArray();
    }


    public static function getAmountCountsForTypes($codeStr, $fromdate="2006-12-31 00:00:00") {

        $txdb = new App_Models_Db_Wigilog_Transaction();
        $select = $txdb->select();
        $txCount = 0;

        $select->from($txdb->_name, array('sum(amount) AS total_amount', 'type'));
        $select->where("type in (".$codeStr.")");
        $select->where("stamp >= ?", $fromdate);
        $select->group("type");

		//return $select;

		$result = $txdb->fetchAll($select);
		return $result->toArray();
    }


}

?>
