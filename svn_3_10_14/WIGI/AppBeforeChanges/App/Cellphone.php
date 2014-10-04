<?php

class App_Cellphone extends App_Models_Db_Wigi_UserMobile{

  private $mobileid;
  private $userid;
  private $cellphone;
  private $balance;
  private $temp_balance;
  private $pin;
  private $status;
  private $suspend_count;
  private $codeExpires;

  public function __construct($mid=null, $cellno = null) {

    parent::__construct();

    #$mu = new App_Models_Db_Wigi_UserMobile();
    if( $mid ){
        $result = $this->find($mid)->current();
        if(!$result){
            //error_log("mobileid $mobileid does not exist");
            return false;
        }
    }else if($cellno){
        $result = $this->fetchRow($this->select()->where('cellphone = ?', $cellno));
        if(!$result){
            error_log("cellnumber $cellno does not exist");
            return false;
        }	
    }

    $this->mobileid                = $result->mobile_id;
    $this->userid                  = $result->user_id;
    $this->cellphone               = $result->cellphone;
    $this->balance                 = $result->balance;
    $this->temp_balance            = $result->temp_balance;
    $this->confirmationCode        = $result->mobile_confirmation_code;
    $this->codeExpires             = $result->code_expires;
    $this->pin                     = $result->pin;
    $this->status                  = $result->status;
    $this->new_message             = $result->has_message;
    $this->suspend_count           = $result->suspend_count;
    $this->question                = $result->question;
    $this->answer                  = $result->answer;
    $this->alias                   = $result->alias;
    $this->mobile_type             = $result->mobile_type;
    $this->is_default              = $result->is_default;

    $p = new App_Prefs();
    $this->prefs = $p->getCellphonePrefs($this->userid,$this->mobileid);

  }

  public function getPrefs() {
                $prefs = $this->prefs;

                $result["session_timeout"] = $prefs["system"]["timeout"];
                $result["timezone"]        = $prefs["system"]["timezone"];

                $result["wigicode_timeout"] = $prefs["wigi"]["timeout"];
                //$result["minimum_balance"] = $prefs["wigi"]["minbal"];
                $result["max_wigi_amt_txn"] = $prefs["wigi"]["max_per_trans"];
                $result["max_wigi_amt_day"] = $prefs["wigi"]["max_per_day"];
                $result["international_trans"] = $prefs["wigi"]["international_trans"];

                $result["max_gift_amt_txn"] = $prefs["gift"]["max_per_trans"];
                $result["max_gift_amt_day"] = $prefs["gift"]["max_per_day"];
                $result["max_gift_get_amt_day"] = $prefs["gift"]["max_get_per_day"];

                $result["max_fund_amt_txn"] = $prefs["funding"]["max_per_trans"];
                $result["max_fund_amt_day"] = $prefs["funding"]["max_per_day"];

                //$result["statement_method"] = $prefs["notification"]["statement"];
                $result["alert_method"] = $prefs["notification"]["alert"];
                return $result;
  }


  public function getRandConf() {

    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand( $seed );
    $randval = mt_rand(100000,999999);
    return $randval;


  }

  public function getSuspendCount() {
    return $this->suspend_count;
  }

  public function getMobileId() {
    return $this->mobileid;
  }

  public function getMobileType() {
    return $this->mobile_type;
  }

  public function getAlias() {
    return $this->alias;
  }

  public function getCellphone() {
    return $this->cellphone;
  }

  public function getFmtCellphone() {
    return App_DataUtils::fmtphone($this->cellphone);
  }

  public function getPin(){
    return $this->pin;    
  }

  public function getStatus(){
    return $this->status;    
  }

  public function getBalance() {
    return $this->balance;
  }

  public function getTempBalance() {
    return $this->temp_balance;
  }

  public function getUserId() {
    return $this->userid;
  }

  public function getAnswer() {
    return $this->answer;
  }

  public function getConfirmationCode() {
    return $this->confirmationCode;
  }

  public function getNewMessage() {
    return $this->new_message;
  }

  public function isDefault() {
    return $this->is_default;
  }

  public function unsetNewMessage() {
	$sp  = new App_Db_Sp_MobileUnsetMessageFlag();
	$res = $sp->getSimpleResponse(array('MOBILEID' => $this->mobileid));
  }

  public static function getIdFromCellphone($cellphone,$countrycode) {
	$sp  = new App_Db_Sp_GetMobileIdFromCellphone();
	$res = $sp->getSimpleResponse(array('CELLPHONE' => $cellphone,'COUNTRY_CODE' => $countrycode));
	if ($res['@p_mobile_id'] === "") {
            throw new App_Exception_WsException('Cellphone does not exist');
            return false;
        }
	return $res['@p_mobile_id'];
  }


  public static function getIdFromOSId($osid) {
	$sp  = new App_Db_Sp_MobileIdFromOsId();
	$res = $sp->getSimpleResponse(array('OS_ID' => $osid));
	return $res['@p_mobile_id'];
  }

  public static function mobileIdExists($mobileid) {
	$sp  = new App_Db_Sp_MobileIdExists();
	$res = $sp->getSimpleResponse(array('MOBILEID' => $mobileid));
	return $res['@p_res'];
  }

  public function isActivated() {
	$sp  = new App_Db_Sp_UserCellphoneIsConfirmed();
	$res = $sp->getSimpleResponse(array('MOBILEID' => $this->mobileid));
	return $res['@res'];
  }

  public function pinMatches($p) {
    if (Atlasp_Utils::inst()->encryptPassword($p) === $this->pin) {
      return true;
    } else {
      return false;
    }
  }

  public function resetSuspendCount() {
      $sp = new App_Db_Sp_ResetMobileSuspend();
      $res = $sp->getSimpleResponse(array('MOBILEID'=>$this->mobileid));
  }

  public function increaseSuspendCount() {
      $sp = new App_Db_Sp_IncreaseMobileSuspend();
      $res = $sp->getSimpleResponse(array('MOBILEID'=>$this->mobileid));
  }

  public function getNewCode() {
        $code = $this->getRandConf();
        $sp  = new App_Db_Sp_SetUserMobileCode();
        $res = $sp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'CODE' => $code));
        return $code;
  }

  public function addQuestion($question,$answer) {
        $sp  = new App_Db_Sp_AddQuestion();
        $res = $sp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'QUESTION' => $question, 'ANSWER' => $answer, 'USERID' => $this->cellphone));
  }

  public function removeQuestion($id) {
        $sp  = new App_Db_Sp_RemoveQuestion();
        $res = $sp->getSimpleResponse(array('ID' => $id));
  }

  public function questionMatches($question,$answer) {
        $sp  = new App_Db_Sp_QuestionMatches();
        $res = $sp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'QUESTION' => $question, 'ANSWER' => $answer));
        return $res['@p_res'];
  }

  public function getScheduledPayments() {
     $t = new App_Models_Db_Wigi_Order();
     $rows = $t->fetchAll(
     $t->select()
        ->where('consumer_mobile_id = ?', $this->mobileid)->where('processed = ?', '0')
    );

    $result = array();

    foreach ($rows as $row) {
        $res["price"]       = $row["question"];
        $res["answer"]      = $row["answer"];
        $res["question_id"] = $row["question_id"];
        array_push($result,$res);
    }

    if (count($result) == 0) {
                throw new App_Exception_WsException("No questions on file");
                return false;
    }

    return $result;

  }

  public function getQuestions() {

    $t = new App_Models_Db_Wigi_Question();

    $rows = $t->fetchAll(
      $t->select()
        ->where('mobile_id = ?', $this->mobileid)->where('status = ?', 'active')
    );

    $result = array();

    foreach ($rows as $row) {
        $res["question"]    = $row["question"];
        $res["answer"]      = $row["answer"];
        $res["question_id"] = $row["question_id"];
        array_push($result,$res);
    }

    if (count($result) == 0) {
                throw new App_Exception_WsException("No questions on file");
                return false;
    }

    return $result;

  }

  public function getRandQuestion() {
      $a = $this->getQuestions();
      $rand = rand(0, (count($a)-1) );
      return $a[$rand]["question"]; 
  }

  public function getPredefQuestions() {
    $q = new App_Question();
    $predefQuestions = $q->getPredefQuestions();
    $userQuestions = $this->getQuestions();
    foreach($userQuestions as $val) {
      $predefQuestions = App_DataUtils::removeFromArrayByValue($predefQuestions,$val["question"]);
    }
    return $predefQuestions;
  } 

  public function getRealAndFakeQuestions() {
      $q = new App_Question();
      $a = $q->getPredefQuestions();
      $b = $this->getQuestions();
      $finalquestions = array();
      foreach ($a as $predefquestion) {
          $match = false;
          foreach ($b as $userquestion) {
              if ($predefquestion === $userquestion["question"]) {
                  $match = true;
              }
          }
          if ($match == false) {
              array_push($finalquestions,$predefquestion);
          }
      }

      $rand1 = rand(0, (count($finalquestions)-1) );
      $rand2 = "-1";

      do {
         $rand2 = rand(0, (count($finalquestions)-1) );
      } while ($rand1 == $rand2);

      $res = array();
      $res[0] = $finalquestions[$rand1];
      $res[1] = $finalquestions[$rand2];
      $res[2] = $this->getRandQuestion();

      $result = array();
      $a = App_DataUtils::generateUniqueRandoms(0,2,3); 
      $result["question1"] = $res[$a[0]];
      $result["question2"] = $res[$a[1]];
      $result["question3"] = $res[$a[2]];

      return $result;
  }

  public function getNoActiveCodes() {
    $w = new App_WigiEngine();
    $res = $w->getActiveWigiCodes($this->mobileid,'0');
    $total = count($res);
    return $total;
  }


  /*MARKED FOR DELETION
    public function isValidOSID() {

    $stm = $this->dbh->query("call sp_os_id_is_set('" . $this->mobileid . "', @res)");
    while ($stm->nextRowset()) { }

    $stm = $this->dbh->prepare("select @res as res");
    $stm->execute();
    $result = $stm->fetchAll();

    return $result[0]['res'];
  }*/

  public function suspend() {
        $sp  = new App_Db_Sp_MobileSuspend();
        $res = $sp->getSimpleResponse(array('MOBILEID' => $this->mobileid));
        //loop through all cellphones with this user_id
            //lock()
  }

  public function lock() {

	$error = 0;
	$msg = "Can not lock cellphone. ";
	/*	
	if ($this->balance > 0 || $this->temp_balance > 0) {
		$msg .= "Balance is greater than 0. ";
		$error = 1;
	}

	if ($this->getNoActiveCodes() > 0) {
		$msg .= "There are currently active WiGi codes. ";
		$error = 1;
	}
	*/
	if ($error == true) {
		throw new App_Exception_WsException($msg);
		return false;
	}

        $sp  = new App_Db_Sp_MobileLock();
        $res = $sp->getSimpleResponse(array('MOBILEID' => $this->mobileid));
        //loop through all cellphones with this user_id
            //lock()
  }


  public function isLocked() {
    if ($this->status === "locked") {
      return true;
    } else {
      return false;
    }
  }

  public function isSuspended() {
    if ($this->status === "suspended") {
      return true;
    } else {
      return false;
    }
  }

  
  public function isActive() {
    if ($this->status === "active") {
      return true;
    } else {
      return false;
    }
  }


  public function setDefault() {
    
	//check to see if cellphone is actually activated
	/*if (!$this->isActivated()) { 
	  error_log("Cellphone Not Activated ". $this->mobileid); 
	  return false; 
	}*/

	$sp = new App_Db_Sp_UserSetDefaultCellphone();
	$sp->getSimpleResponse(array('MOBILEID'=>$this->mobileid));
        return true;
  }

  public function hasEnoughMoney($amount,$type="temp") {
    //use temp balance instead of real balance
    //because that's how much money they really have
    //if all their wigi codes are redeemed (worst case)
    if ($type === "temp") {
      if ( ($this->getTempBalance() - $amount) >= 0) {
        return true;
      } else {
        return false;
      }
    } else if ($type === "real") {
      if ( ($this->getBalance() - $amount) >= 0) {
        return true;
      } else {
        return false;
      }
   } 
  }

  public function resetPin($oldpin,$newpin) {
    $a = new App_Auth();
    if ($a->mobileAuthCheck($this->mobileid,$oldpin)) {
      $csp = new App_Db_Sp_ResetPin();
      $r = $csp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'PIN' => $newpin));
      return true;
    } else {
      throw new App_Exception_WsException('Invalid Pin');
      return false;
    }

  }

  public function forgotPin($question,$answer,$pin) {
    $userid = $this->getUserId();
    $u = new App_User($userid);
    if ( $this->questionMatches($question,$answer) ) {
        $sp = new App_Db_Sp_ResetPin();
        $sp->getSimpleResponse(array( 'MOBILEID'=> $this->mobileid, 'PIN'=> $pin));
    } else {
      throw new App_Exception_WsException('Wrong answer to secret question');
      return false;
    }
      return true;
  }

  public function confirm($code,$phone_brand) {
      $sp = new App_Db_Sp_UserConfirmCellphone();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$this->mobileid , 'CODE'=> $code, 'PHONE_BRAND'=>$phone_brand ));
      if( $res['@p_result'] == false){
          throw new App_Exception_WsException("Failed to confirm or code expired");
      }
      return true;
  }


  public function addToBalance($amount) {
      $sp = new App_Db_Sp_IncreaseBalance();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$this->mobileid , 'AMOUNT'=> $amount ));
      return $res['@p_res'];
  }

  public function addToTempBalance($amount) {

      $sp = new App_Db_Sp_IncreaseTempBalance();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$this->mobileid , 'AMOUNT'=> $amount ));
      return $res['@p_res'];
  }

  public function reduceFromBalance($amount) {
      $sp = new App_Db_Sp_ReduceBalance();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$this->mobileid , 'AMOUNT'=> $amount ));
      return $res['@p_res'];
  }

  public function reduceFromTempBalance($amount) {
      $sp = new App_Db_Sp_ReduceTempBalance();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$this->mobileid , 'AMOUNT'=> $amount ));
      return $res['@p_res'];
  }

  public function sendMessage($message) {
    $m = new App_Messenger();
    if ($this->prefs["notification"]["alert"] === "SMS") {
      $m->sendMessage($message,$this->getCellphone(),'2');
    } else {
      $u = new App_User($this->getUserId());
      $m->sendMessage($message,$u->getEmail(),'1');
    }
  }

  public function getLinkedCards() {
    $t = new App_Models_Db_Wigi_ViewLinkedCreditCards();

    $rows = $t->fetchAll(
      $t->select()
        ->where('mobile_id = ?', $this->mobileid)
    );

    $res = array();
    foreach ($rows as $row) {
      $a['last4']=$row['last4'];
      $a['description']=$row['description'];
      $a['type']='1';
      $a['id']=$row['id'];
      array_push($res,$a);
    }

    return $res;
  }

  public function getLinkedBankAccounts() {
    $t = new App_Models_Db_Wigi_ViewLinkedBankAccounts();

    $rows = $t->fetchAll(
      $t->select()
        ->where('mobile_id = ?', $this->mobileid)
    );

    $res = array();
    foreach ($rows as $row) {
      $a['last4']=$row['last4'];
      $a['description']=$row['description'];
      $a['type']='2';
      $a['id']=$row['id'];
      array_push($res,$a);
    }

    return $res;
  }

  public function updateLogin($application,$ip) {
    $u = new App_User($this->getUserId());
    App_DataUtils::updateLogin($u->getCountryCode() . $this->getCellphone() ,$application,$ip,"","cellphone");
  }

  public function updateExtInfo($phone_brand,$last_ip,$osid,$os_version,$app_version) {

      $sp = new App_Db_Sp_SetUserMobileExtInfo();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$this->mobileid , 'PHONE_BRAND'=> $phone_brand,
                                           'LAST_IP'=>$last_ip,'OSID'=>$osid,'OS_VERSION'=>$os_version,
                                           'APP_VERSION'=>$app_version ));
      return $res['@p_res'];

  }

  public function getMessage() {
    $t = new App_Models_Db_Wigi_ViewGetMessages();

    $rows = $t->fetchAll(
      $t->select()
        ->where('mobile_id = ?', $this->mobileid)
    );

    $res = array();
    foreach ($rows as $row) {

      $a['message']=$row['message'];
      $a['subject']=$row['subject'];
      $a['status']= $row['status'];
      $a['id']=$row['id'];

      array_push($res,$a);
    }

    return $res;
  }

  public function deleteMessage($id) {
      $docmodel = new App_Models_Db_Wigi_UserMobileMessage();

      $docmodel->delete(
                             $docmodel->getAdapter()->quoteInto('user_mobile_message_id = ?', $id)
                      );

  }


  public static function setMessageViewed($id) {
	$sp  = new App_Db_Sp_SetMessageViewed();
	$res = $sp->getSimpleResponse(array('MESSAGEID' => $id));
  }
  
  public function isAuthorized($osid) {
      $csp = new App_Db_Sp_MobileOsIdIsAuthorized();
      $r = $csp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'OS_ID' => $osid));
      return $r['@p_result'];
  }
  
  public function authorize($osid) { error_log("CHRIS calling authorize $osid");
      $sp = new App_Db_Sp_MobileAuthorizeOsId();
      $sp->getSimpleResponse(array('MOBILEID'=>$this->mobileid, 'OS_ID'=>$osid));
  }

  public function hasPrefs() {

    $t = new App_Models_Db_Wigi_ViewMobilePrefs();

    $rows = $t->fetchAll(
      $t->select()
        ->where('mobile_id = ?', $this->mobileid)
    );

    return count($rows);

  }

  public function addDocument($id,$doctype,$version,$description,$keyver,$expires) {

            $docmodel = new App_Models_Db_Wigi_DocInfo();
            $keyval = array(
               'key_version'     => $keyver,
               'current_version' => $version,
               'expiration'      => $expires,
               'description'     => $description,
               'doc_type'        => $doctype,
               'doc_info_id'     => $id,
               'mobile_id'       => $this->mobileid,
               'user_id'         => $this->userid,
            );
            $docmodel->insert($keyval);
  }

  public function updateDocument($id,$doctype,$version,$description,$keyver,$expires) {
      $docmodel = new App_Models_Db_Wigi_DocInfo();

      $docmodel->update(
                       array(
                              'doc_type' => $doctype,
                              'current_version' => $version,
                              'description' => $description,
                              'expiration' => $expires
                             ),
                             $docmodel->getAdapter()->quoteInto('doc_info_id = ?', $id)
                      );

  }

  public function deleteDocument($id) {
      $docmodel = new App_Models_Db_Wigi_DocInfo();

      $docmodel->delete(
                             $docmodel->getAdapter()->quoteInto('doc_info_id = ?', $id)
                      );

  }


  public function getDocument($id) {

    $docmodel = new App_Models_Db_Wigi_DocInfo();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('doc_info_id = ?', $id)
    );

    return $row;


  }

  public function getDocuments() {

    $docmodel = new App_Models_Db_Wigi_DocInfo();

    $rows = $docmodel->fetchAll(
      $docmodel->select()
        ->where('mobile_id = ?', $this->mobileid)
    );

    return $rows;


  }


  /*public function setExt($key,$val,$cat) {

      $csp = new App_Db_Sp_SetMobileExt();
      $r = $csp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'CATEGORY' => $cat, 'KEY' => $key,'VAL' => $val));
      return $r['@p_val'];

  }

  public function getExt($key,$cat) {

      $csp = new App_Db_Sp_GetMobileExt();
      $r = $csp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'CATEGORY' => $cat, 'KEY' => $key));
      return $r['@p_val'];

  }*/

  public function checkConstraint($amount,$type,$reduces = true, $sendmessage = false) {
    //type is 1 - send money, 2 - wigi transaction
   $t = new App_Transaction_Transaction();
/*
    if ($reduces == true && 0 > ($this->getTempBalance() - $amount)) {
      throw new App_Exception_WsException('Insufficient funds.');
      return false;
    }

    if (($type == 1) && ($this->prefs["gift"]['max_per_trans'] <= $amount)  ) {
      throw new App_Exception_WsException('Can not send more than US$' . $this->prefs["gift"]['max_per_trans']);
      return false;
    }

    if (($type == 2) && ($this->prefs["wigi"]['max_per_trans'] <= $amount)  ) {
      throw new App_Exception_WsException('Can not spend more than US$' . $this->prefs["wigi"]['max_per_trans']);
      return false;
    }

    if (($type == 3) && ($this->prefs["gift"]['max_per_day'] <= $t->getLastDaySendGiftAmt($this->mobileid))  ) {
      throw new App_Exception_WsException('Can not send more than ' . $this->prefs["gift"]['max_per_day'] . ' per day');
      return false;
    }

    if (($type == 4) && ($this->prefs["wigi"]['max_per_day'] <= $t->getLastDayWigiAmt($this->mobileid))  ) {
      throw new App_Exception_WsException('Can not create more than ' . $this->prefs["wigi"]['max_per_day'] . ' WGC\'s per day');
      return false;
    }


    if (($type == 5) && ($this->prefs["funding"]['max_per_trans'] <= $amount)  ) {
      throw new App_Exception_WsException('Can not fund more than US$' . $this->prefs["funding"]['max_per_day'] . " per day");
      return false;
    }

    if (($type == 6) && ($this->prefs["funding"]['max_per_day'] <= $t->getLastDayFundingAmt($this->mobileid))  ) {
      throw new App_Exception_WsException('Can not fund more than ' . $this->prefs["funding"]['max_per_day'] . ' times per day');
      return false;
    }

    if (($type == 7) && ($this->prefs["gift"]['max_get_per_day'] <= $t->getLastDayReceiveGiftAmt($this->mobileid))  ) {
      throw new App_Exception_WsException('User has reached their receive money limit for today.');
      return false;
    }
*/

    /*if ($reduces == true && $sendmessage == true && $this->prefs["wigi"]["minbal"] > ($this->getTempBalance() - $amount)) {
      //throw new App_Exception_WsException('Account can not go below minumum balance of US$' . $this->prefs["wigi"]["minbal"]);
      $this->sendMessage('Warning, account has gone below minumum balance of US$' . $this->prefs["wigi"]["minbal"]);
    }*/


    return true;

  }

  public static function bulkUnsuspend() {

      $sp  = new App_Db_Sp_MobileBulkUnsuspend();
      $res = $sp->getSimpleResponse(array());

  }



}

?>
