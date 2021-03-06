<?php

class App_Cellphone extends App_Models_Db_Wigi_UserMobile{

  private $mobileid;
  private $userid;
  private $cellphone;
  private $permission;
  private $balance;
  private $temp_balance;
  private $pin;
  private $status;
  private $suspend_count;
  private $codeExpires;
  private $date_added;
  private $role;

  public function __construct($mid=null, $cellno = null) {

    parent::__construct();
	$result = '';
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
            //error_log("cellnumber $cellno does not exist");
            return false;
        }	
    }

    $this->mobileid                = @$result->mobile_id;
    $this->userid                  = @$result->user_id;
    $this->cellphone               = @$result->cellphone;
    $this->balance                 = @$result->balance;
    $this->permission              = @$result->permission;
    $this->temp_balance            = @$result->temp_balance;
    $this->confirmationCode        = @$result->mobile_confirmation_code;
    $this->codeExpires             = @$result->code_expires;
    $this->pin                     = @$result->pin;
    $this->status                  = @$result->status;
    $this->new_message             = @$result->has_message;
    $this->suspend_count           = @$result->suspend_count;
    $this->question                = @$result->question;
    $this->answer                  = @$result->answer;
    $this->alias                   = @$result->alias;
    $this->last_name               = @$result->last_name;
    $this->date_added              = @$result->date_added;
    $this->role              		= @$result->role;
    $this->mobile_type             = @$result->mobile_type;
    $this->is_default              = @$result->is_default;

    $p = new App_Prefs();
    $this->prefs = $p->getCellphonePrefs($this->userid,$this->mobileid);

  }

  public function getPrefs() {
                $prefs = $this->prefs;

                $result["session_timeout"] = $prefs["system"]["timeout"];
                $result["timezone"]        = $prefs["system"]["timezone"];

                $result["wigicode_timeout"] = $prefs["wigi"]["timeout"];
                $result["minimum_balance"] = $prefs["wigi"]["minbal"];
                $result["max_wigi_amt_txn"] = $prefs["wigi"]["max_per_trans"];
                $result["max_wigi_amt_day"] = $prefs["wigi"]["max_per_day"];
                $result["international_trans"] = $prefs["wigi"]["international_trans"];

                $result["max_gift_amt_txn"] = $prefs["gift"]["max_per_trans"];
                $result["max_gift_amt_day"] = $prefs["gift"]["max_per_day"];
				
				$result["max_scan_amt_txn"] = $prefs["scan"]["max_per_trans"];
                $result["max_scan_amt_day"] = $prefs["scan"]["max_per_day"];
				
                $result["max_gift_get_amt_day"] = $prefs["gift"]["max_get_per_day"];

                $result["max_fund_amt_txn"] = $prefs["funding"]["max_per_trans"];
                $result["max_fund_amt_day"] = $prefs["funding"]["max_per_day"];

                $result["statement_method"] = $prefs["notification"]["statement"];
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
  
  public function getDateAdded() {
    return $this->date_added;
  }
  public function getRole() {
    return $this->role;
  }
  
  
  public function getMobileMemberId() {
	$userid = $this->getUserId();
    $u = new App_User($userid);
   return sprintf("%4s-%03s-%07s",$userid,$u->getCountryCode(),$this->getMobileId()); 
  }

  public function getAlias() {
    return $this->alias;
  }
  public function getLastname() {
    return $this->last_name;
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
  public function getPermission() {
    return $this->permission;
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
	
	$countrycode = $countrycode ? $countrycode : "91";
	
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
	  $test = print_r($res, true);
	  error_log($test);
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
      $rand = rand(0,(count($a)-1) );
      
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
     
	  $a0 = $a[0];
	  $a1 = $a[1];
	  $a2 = $a[2];
  
  
      $result["question1"] = $res[$a0];
      $result["question2"] = $res[$a1];
      $result["question3"] = $res[$a2];
  
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
		
	if ($this->balance > 0 || $this->temp_balance > 0) {
		$msg .= "Balance is greater than 0. ";
		$error = 1;
	}

	if ($this->getNoActiveCodes() > 0) {
		$msg .= "There are currently active InCashMe Money Payment codes. ";
		$error = 1;
	}
	
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
	if (!$this->isActivated()) { 
	  //error_log("Cellphone Not Activated ". $this->mobileid); 
	  return false; 
	}

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
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$this->mobileid , 'CODE'=> $code, 'BRAND'=>$phone_brand ));
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

  public function sendMessage($message,$subject,$type=0) {
  
    $m = new App_Messenger();
	if($type == 1){
		$prefs_match = $this->prefs["gift"]["alert"];
	}else if($type == 2){
		$prefs_match = $this->prefs["notification"]["alert"];
	}else if($type == 3){
		$prefs_match = $this->prefs["scan"]["alert"];
	} else if($type == 4){
		$prefs_match = $this->prefs["funding"]["alert"];
	}else{
		$prefs_match = $this->prefs["notification"]["alert"];
	}
	
    if ($prefs_match == "Both") { 
      $u = new App_User($this->getUserId());
      $m->sendMessage($message,$u->getEmail(),'1',$subject);
      $m->sendMessage($message,$this->getCellphone(),'2');
    } 
    else if ($prefs_match == "SMS") {
      $m->sendMessage($message,$this->getCellphone(),'2');
    } 
    else {
      $u = new App_User($this->getUserId());
      $m->sendMessage($message,$u->getEmail(),'1',$subject);
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
        ->where('mobile_id = ?', $this->mobileid)->order('id desc')
    );

    $res = array();
    foreach ($rows as $row) {

      $a['message']=$row['message'];
      $a['subject']=$row['subject'];
      $a['status']= $row['status'];
      $a['id']=$row['id'];

	  $t1 = new App_Models_Db_Wigi_UserMobileMessage();

		$rows1 = $t1->fetchAll(
		  $t1->select()
			->where('user_mobile_message_id = ?', $row['id'])
		);
		foreach ($rows1 as $row1) {
			$a['message_id']=$row1['message_id'];
		}
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
	  //return 1; //comment by attune
      return $r['@p_result'];
  }
  
  public function authorize($osid) { //error_log("CHRIS calling authorize $osid");
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
  public function addmainmenu($userid, $mobileid,$title,$description,$data) {
            $docmodel = new App_Models_Db_Wigi_tblmainmenu();
            $keyval = array(
               'login_id'     => $userid,
               'mobile_id'     => $mobileid,
               'title'     => $title,
               'description' => $description,
               'menuimage'      => $data,
               
            );
            
             $docid = $docmodel->insert($keyval);
            return $docid;
  }
	public function addsubmenu($menuid,$title,$description,$data, $rate, $quantity) {
	
            $docmodel = new App_Models_Db_Wigi_tblsubmenu();
            $keyval = array(
               'main_menu_id'     => $menuid,
               'title'     => $title,
               'description' => $description,
               'submenuimg'      => $data,
               'rate'      => $rate,
               'max_quantity'      => $quantity,
               
            );
            
             $docid = $docmodel->insert($keyval);
            return $docid;
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
public function updatemainmenu($id,$title,$description,$data) {
      $docmodel = new App_Models_Db_Wigi_tblmainmenu();
if($data ==""){
	
 $docmodel->update(
                       array(
                              'title' => $title,
                              'description' => $description,
                             
                             ),
                             $docmodel->getAdapter()->quoteInto('main_menu_id = ?', $id)
                      );

}

else {
      $docmodel->update(
                       array(
                              'title' => $title,
                              'description' => $description,
                              'menuimage' => $data
                             ),
                             $docmodel->getAdapter()->quoteInto('main_menu_id = ?', $id)
                      );
                      
}
  }
  
  public function updatesubmenu($id,$menuid, $title,$description,$data, $rate, $quantity) {
      $docmodel = new App_Models_Db_Wigi_tblsubmenu();
		if($data =="") {
      $docmodel->update(
                       array(
                              'main_menu_id' => $menuid,
                              'title' => $title,
                              'description' => $description,      
                              'rate' => $rate,
                              'max_quantity' => $quantity
                             ),
                             $docmodel->getAdapter()->quoteInto('sub_menu_id = ?', $id)
                      );
			}
			else {
	
	 		$docmodel->update(
                       array(
                              'main_menu_id' => $menuid,
                              'title' => $title,
                              'description' => $description, 
                              'submenuimg' => $data,     
                              'rate' => $rate,
                              'max_quantity' => $quantity
                             ),
                             $docmodel->getAdapter()->quoteInto('sub_menu_id = ?', $id)
                      );
	
	
			}
  }
  public function deleteDocument($id) {
      $docmodel = new App_Models_Db_Wigi_DocInfo();

      $docmodel->delete(
                             $docmodel->getAdapter()->quoteInto('doc_info_id = ?', $id)
                      );

  }
public function deletemainmenu($id) {
      $docmodel = new App_Models_Db_Wigi_tblmainmenu();

      $docmodel->delete(
                             $docmodel->getAdapter()->quoteInto('main_menu_id = ?', $id)
                      );

  }
public function deletesubmenu($id) {
      $docmodel = new App_Models_Db_Wigi_tblsubmenu();

      $docmodel->delete(
                             $docmodel->getAdapter()->quoteInto('sub_menu_id = ?', $id)
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
public function getmainmenu($mobileid, $id) {

    $docmodel = new App_Models_Db_Wigi_tblmainmenu();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('login_id = ?', $id)
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

public function getallmainmenu($mobileid) {

    $docmodel = new App_Models_Db_Wigi_tblmainmenu();

    $rows = $docmodel->fetchAll(
      $docmodel->select()
      ->where('mobile_id = ?', $mobileid)
    );

    return $rows;


  }
 
  
  public function getallsubmenu() {

    $docmodel = new App_Models_Db_Wigi_tblsubmenu();

    $rows = $docmodel->fetchAll(
      $docmodel->select()
    );

    return $rows;


  }
  public function getallmainsubmenu($mobileid, $userid) {

    $docmodel = new App_Models_Db_Wigi_tblmainmenu();
   // $docmodel = new App_Models_Db_Wigi_tblsubmenu();

    $rows = $docmodel->fetchAll(
      $docmodel->select() 
       ->where('login_id = ?', $userid)
    );

    return $rows;


  }
  public function getsubmenu($id) {

    $docmodel = new App_Models_Db_Wigi_tblsubmenu();

    $row = $docmodel->fetchAll(
      $docmodel->select()
        ->where('main_menu_id = ?', $id)
    );

    return $row;


  }
   public function getmainmenudata($menuid) {
    $docmodel = new App_Models_Db_Wigi_tblmainmenu();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('main_menu_id = ?', $menuid)
    );
    $docdata = $row['menuimage']; 
    
    $result = $docdata;
    

    return $result;

  }
  public function getsubmenudata($submenuid) {
    $docmodel = new App_Models_Db_Wigi_tblsubmenu();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('sub_menu_id = ?', $submenuid)
    );
    $docdata = $row['submenuimg']; 
    
    $result = $docdata;
    

    return $result;

  }
  public function setExt($key,$val,$cat) {

      $csp = new App_Db_Sp_SetMobileExt();
      $r = $csp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'CATEGORY' => $cat, 'KEY' => $key,'VAL' => $val));
      return $r['@p_val'];

  }

  public function getExt($key,$cat) {

      $csp = new App_Db_Sp_GetMobileExt();
      $r = $csp->getSimpleResponse(array('MOBILEID' => $this->mobileid, 'CATEGORY' => $cat, 'KEY' => $key));
      return $r['@p_val'];

  }

  public function checkConstraint($amount,$type,$reduces = true, $sendmessage = false) {
    //type is 1 - send money, 2 - wigi transaction
   $t = new App_Transaction_Transaction();

    if ($reduces == true && 0 > ($this->getTempBalance() - $amount)) {
      throw new App_Exception_WsException('Insufficient funds.');
      return false;
    }
//error_log($this->prefs["gift"]['max_per_trans']."=================================".$amount);

    if (($type == 1) && ($this->prefs["gift"]['max_per_trans'] < $amount)  ) {
      throw new App_Exception_WsException('Can not send more than ₹' . $this->prefs["gift"]['max_per_trans']);
      return false;
    }

//error_log($this->prefs["wigi"]['max_per_trans']."=================================".$amount);
    if (($type == 2) && ($this->prefs["wigi"]['max_per_trans'] < $amount)  ) {
      throw new App_Exception_WsException('Can not send more than ₹' . $this->prefs["wigi"]['max_per_trans']);
      return false;
    }
	
	//daily limit start
		$conf = new App_Models_Db_Wigi_Configuration();
		$raw = $conf->fetchAll(
		  $conf->select()
			->where('`key` = ?', 'daily_transaction_limit')
		);
		foreach($raw as $key=>$val){
			$daily_transaction_limit = $val['value'];
		}
		//$daily_transaction_limit = $this->prefs["gift"]['max_get_per_day'];
	$daily_limit = $daily_transaction_limit;
	
	$total_gift_today = $t->getLastDaySendGiftAmtTotal($this->mobileid);
	$new_amount = $total_gift_today + $amount; 

	if (($type == 1 || $type == 2) && ($daily_limit < $total_gift_today)  ) { //only put type here
      throw new App_Exception_WsException('Can not send more than ₹' . $this->prefs["gift"]['max_get_per_day'].' per day');
      return false;
    }
	
	if (($type == 1 || $type == 2) && ($daily_limit < $new_amount)  ) { //only put type here
      throw new App_Exception_WsException('Can not send more than ₹' . $this->prefs["gift"]['max_get_per_day'].' per day');
      return false;
    }
	//daily limit finish
	
    
	if (($type == 3) && ($daily_limit <= $t->getLastDaySendGiftAmt($this->mobileid))  ) {
      throw new App_Exception_WsException('Can not send more than ' . $this->prefs["gift"]['max_per_day'] . ' per day');
      return false;
    }
	
    if (($type == 4) && ($this->prefs["wigi"]['max_per_day'] <= $t->getLastDayWigiAmt($this->mobileid))  ) {
      throw new App_Exception_WsException('Can not create more than ' . $this->prefs["wigi"]['max_per_day'] . ' IMPC™\'s per day');
      return false;
    }


    if (($type == 5) && ($this->prefs["funding"]['max_per_trans'] < $amount)  ) {
      throw new App_Exception_WsException('Can not fund more than ₹' . $this->prefs["funding"]['max_per_day'] . " per day");
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


    if ($reduces == true && $sendmessage == true && $this->prefs["wigi"]["minbal"] > ($this->getTempBalance() - $amount)) {
      //throw new App_Exception_WsException('Account can not go below minumum balance of ₹' . $this->prefs["wigi"]["minbal"]);
      $this->sendMessage('Warning, account has gone below minumum balance of ₹' . $this->prefs["wigi"]["minbal"],'InCashMe : Reached Minimum balance',4);
    }


    return true;

  }

  public static function bulkUnsuspend() {

      $sp  = new App_Db_Sp_MobileBulkUnsuspend();
      $res = $sp->getSimpleResponse(array());

  }




public function addscane($userid, $mobileid,$moneyvalue, $timeperiod, $acceptedcurrency, $maxnoscan) {
            $docmodel = new App_Models_Db_Wigi_scanedonate();
            $keyval = array(
               'money_value'     => $moneyvalue,
               'time_period'     => $timeperiod,
               'accepted_currency'     => $acceptedcurrency,
               'max_no_of _scan' => $maxnoscan,
              
               
            );
            
             $docid = $docmodel->insert($keyval);
            return $docid;
  }
  public function getqrcode($id) {

    $docmodel = new App_Models_Db_Wigi_scanedonate();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('scaneid = ?', $id)
    );

    return $row;


  }
  
  public function lockmerchant($userid,$mobileid,$status)
  {
		$docmodel = new App_Models_Db_Wigi_User();
		$docmodel->update(
      							array(
                           		'status' => $status
                              	
                             		),
                             		$docmodel->getAdapter()->quoteInto('user_id = ?', $userid)
                      );
                      

  }
  public function lockpos($usermobid,$mobileid,$status)
  {
  	
  	 
		$docmodel = new App_Models_Db_Wigi_UserMobile();
		$docmodel->update(
      							array(
                           		'status' => $status
                              	
                             		),
                             		$docmodel->getAdapter()->quoteInto('mobile_id = ?', $usermobid)
                      );
                      

  }
  
    public function getinvoice($id) {

    $docmodel = new App_Models_Db_Wigi_Order();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('price = ?', $id)
    );

    return $row;


  }
}

?>
