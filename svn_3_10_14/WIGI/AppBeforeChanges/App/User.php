<?php
 
class App_User  extends App_Models_Db_Wigi_User{

  private $userid;
  private $loginid;
  private $email;
  private $user_type;
  private $status;
  private $password;
  private $first_name;
  private $last_name;
  private $message_method;
  private $email_confirmed;
  private $email_confirmation_code;
  private $cellphone_confirmed;
  private $suspend_count;
  private $login_code;
  private $tosid;
  private $business_name;
  public  $lastlogin;
  public  $lastip;
  private $address;
  private $city;
  private $state;
  private $zip;

  public function passwordMatches($p) {
    if (Atlasp_Utils::inst()->encryptPassword($p) === $this->password) {
      return true;
    } else {
      return false;
    }
  }

  public function getEmailConfirmationCode() {
    return $this->email_confirmation_code;
  }

  public function getType() {
    return $this->user_type;
  }

  public function getParentUserId() {
    return $this->parent_user_id;
  }

  public function getBusinessType() {
    return $this->business_type;
  }

  public function getSuspendCount() {
    return $this->suspend_count;
  }

  public function getBusinessName() {
    return $this->business_name;
  }

  public function getBusinessDBAName() {
    return $this->business_dba_name;
  }

  public function getBusinessTaxId() {
    return $this->business_tax_id;
  }

  public function getBusinessPhone() {
    return $this->business_phone;
  }


  public function getUid() {
    return $this->userid;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getLoginId() {
    return $this->loginid;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getMessageMethod() {
    return $this->message_method;
  }

  public function getFirstName() {
    return $this->first_name;
  }

  public function getLastName() {
    return $this->last_name;
  }

  public function getAcceptedTos() {
      return $this->tosid;
  }

  public function getCountryCode() {
      return $this->country_code;
  }

  public function getStatus() {
      return $this->status;
  }

  public function getUserId() {
      return $this->userid;
  }

  public function getAddress() {
      return $this->address;
  }

  public function getCity() {
      return $this->city;
  }

  public function getState() {
      return $this->state;
  }

  public function getZip() {
      return $this->zip;
  }

  public function getSystemAdmin() {
      return $this->systemadmin;
  }

  public function getMerchant2Id() {
      return $this->merchantid;
  }

  public function getMerchantId() {
   return sprintf("%s-%03s-%07s",$this->business_type,$this->country_code,$this->userid); 
  }

  public function __construct($userid) {
    parent::__construct();

    $this->userid = $userid;
    $result = $this->find($userid)->current();
    if(!$result){
	    error_log("userid $userid does not exist");
        throw new App_Exception_WsException('User ID does not exist');
    	return false;
    }	
    #Zend_Debug::dump($result);	

    $t = new App_Models_Db_Wigi_UserAddress();

    $raddr = $t->fetchRow(
      $t->select()
        ->where('user_id = ?', $userid)
    );


    $this->email                   = $result->email;
    //$this->loginid                 = $result->login_id;
    $this->user_type               = $result->user_type;
    $this->status                  = $result->status;
    $this->password                = $result->password;
    $this->first_name              = $result->first_name;
    $this->last_name               = $result->last_name;
    $this->message_method          = $result->message_method;
    $this->email_confirmed         = $result->email_confirmed;
    $this->email_confirmation_code = $result->email_confirmation_code;
    $this->cellphone_confirmed     = $result->cellphone_confirmed;
    $this->suspend_count           = $result->suspend_count;
    $this->login_code              = $result->login_code;
    $this->tosid                   = $result->tos_id;
    $this->country_code            = $result->country_code;
    $this->lastlogin               = $result->last_login_date;
    $this->lastip                  = $result->last_login_ip;
    $this->business_name           = $result->business_name;
    $this->business_dba_name       = $result->business_dba_name;
    $this->password_needs_changing = $result->password_needs_changing;
    $this->business_name           = $result->business_name;
    $this->business_tax_id         = $result->business_tax_id;
    $this->business_phone          = $result->business_phone;
    $this->business_type           = $result->business_type;
    $this->parent_user_id          = $result->parent_user_id;
    $this->systemadmin          = $result->systemadmin;
    $this->merchantid          = $result->merchantid;
   
    if (count($raddr) > 0) {
      $this->city                    = $raddr->city;
      $this->state                   = $raddr->state;
      $this->zip                     = $raddr->zip;
      $this->address                 = $raddr->addr_line1 . " " . $raddr->addr_line2 . " " . $raddr->addr_line3 . " " . $raddr->addr_line4;
    }

  }

  public static function getUserIdFromMerchantId($merchantid) {
    $merchant = preg_replace("/-/","",$merchantid);
    preg_match("/(\d)(\d\d\d)(\d\d\d\d\d\d\d)/",$merchant,$matches);
    return $matches[3];
  }

  public static function getUserIdFromHost($host) {

    $t = new App_Models_Db_Wigi_User();

    $result = $t->fetchRow(
      $t->select()
        ->where('business_url = ?', $host)
    );
    return $result["user_id"];

  }

  public static function getHostname($url) {
    $host = preg_replace("/^.*?:\/\//i","",$url);
    $host = preg_replace("/\/.*$/","",$host);
    $parts = explode('.',$host);
    $tld = $parts[count($parts)-1];
    $hostname = $parts[count($parts)-2];
    $host = $hostname . "." . $tld;
    return $host;
  }


  public static function urlRegistered($url) {

    $host = App_User::getHostname($url);

    $t = new App_Models_Db_Wigi_User();

    $result = $t->fetchRow(
      $t->select()
        ->where('business_url = ?', $host)
    );
    return count($result);

  }

  public static function getUserIdFromEmail($email) {
	$sp  = new App_Db_Sp_UserGetId();
	$res = $sp->getSimpleResponse(array('EMAIL' => $email));
	return $res['@p_user_id'];
  }

  public static function getUserIdFromEmailAndParentId($email,$parentid) {
        $sp  = new App_Db_Sp_UserGetIdFromEmailAndParentId();
        $res = $sp->getSimpleResponse(array('EMAIL' => $email,'PARENTID' => $parentid));
        return $res['@p_user_id'];
  }


  public static function userExists($userid) {
	$sp  = new App_Db_Sp_UserIdExists();
	$res = $sp->getSimpleResponse();
	return $res['@p_res'];
  }

  public static function createPosUser($firstname,$lastname,$email,$password,$parent_user_id) {

	$a = array (

                'USER_TYPE' => 'posuser',
                'PASSWORD'  => Atlasp_Utils::inst()->encryptPassword($password),
                'STATUS'    => 'inactive',
                'MIDDLE_INIT' => '',
                'DATE_ADDED' => date("Y-m-d H:i:s"),
                'USER_ADDED' => $email,
                'USER_CHANGED' => $email,
                'IP' => getenv('REMOTE_ADDR'),
                'BIRTHDATE' => '',
                'PARENT_USER_ID' => $parent_user_id,
                'EMAIL' => $email,
                'FIRST_NAME' => $firstname,
                'LAST_NAME' => $lastname,
                'COUNTRY_CODE' => '',
                'BIRTHDATE' => '',
                'CREATED_VIA' => 'POS'

	);
        $sp = new App_Db_Sp_UserCreate();
        $res = $sp->getSimpleResponse($a);

  }

  public function movePosFundsToVirtual() {
        $sp  = new App_Db_Sp_MovePosFundsToVirtual();
        $res = $sp->getSimpleResponse(array('USERID' => $this->userid));
  }


  public function resetPosSecret($prefs) {
        $prefs['possecret']    = '';
        $p       = new App_Prefs();
        $p->saveWebUserPrefs( $this->userid, $prefs  ,'mw');
  }

  public function suspend() {
        $sp  = new App_Db_Sp_UserSuspend();
        $res = $sp->getSimpleResponse(array('USERID' => $this->userid));
  }

  public function lock() {
        $sp  = new App_Db_Sp_UserLock();
        $res = $sp->getSimpleResponse(array('USERID' => $this->userid));
  }

  public function getRandPassword() {
    
    $length = 8;
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $chars_length = (strlen($chars) - 1);
    $string = $chars{rand(0, $chars_length)};
    
    for ($i = 1; $i < $length; $i = strlen($string)) {
        $r = $chars{rand(0, $chars_length)};
        if ($r != $string{$i - 1}) $string .=  $r;
    }
    
    return $string;
  }

  public function setPassword($password) {
        $epassword = Atlasp_Utils::inst()->encryptPassword($password);

        $sp  = new App_Db_Sp_SetUserPassword();
        $res = $sp->getSimpleResponse(array('USERID' => $this->userid,'PASSWORD' => $epassword));
  }

  public function setPasswordNeedsChanging($val) {

        $sp  = new App_Db_Sp_SetPasswordNeedsChanging();
        $res = $sp->getSimpleResponse(array('USERID' => $this->userid,'VAL' => $val));
  }

  public function getPasswordNeedsChanging() {
    return $this->password_needs_changing;
  }

  public function isEmailConfirmed() {
    if ($this->email_confirmed) {
      return true;
    } else {
      return false;
    }
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

  public function isPending() {
    if ($this->status === "pending") {
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

  public function spupdate($first,$middle,$last) {
    //$sp  = new App_Db_Sp_UserUpdate();
    //$res = $sp->getSimpleResponse(array( 'FIRST_NAME' =>$first, 'LAST_NAME'=>$last, 'MIDDLE_INIT'=> $middle));
                                $uinfo = new App_Models_Db_Wigi_User();
                                $uinfo->update(
                                        array(
                                                'first_name' => $first,
                                                'last_name' => $last,
                                        ),
                                        $uinfo->getAdapter()->quoteInto('user_id = ?', $this->userid)
                                );

  }

  public function spdelete() {
    //$sp  = new App_Db_Sp_UserUpdate();
    //$res = $sp->getSimpleResponse(array( 'FIRST_NAME' =>$first, 'LAST_NAME'=>$last, 'MIDDLE_INIT'=> $middle));
                                $uinfo = new App_Models_Db_Wigi_User();
                                $uinfo->update(
                                        array(
                                                'status' => 'deleted',
                                        ),
                                        $uinfo->getAdapter()->quoteInto('user_id = ?', $this->userid)
                                );

  }

  public function setStatus($status) {
                                $this->update(
                                        array(
                                                'status' => $status,
                                        ),
                                        $this->getAdapter()->quoteInto('user_id = ?', $this->userid)
                                );

  }

  public function addPosToUser($osid,$description) {
           $uinfo = new App_Models_Db_Wigi_AuthorizedDevice();

            $data = array(
               'os_id'  => $osid,
               'user_id' => $this->userid,
               'device_type'  => 'merchant',
               'description' => $description
            );
            return $uinfo->insert($data);
  }

  public function posAuthorized($osid) {

    $t = new App_Models_Db_Wigi_AuthorizedDevice();

    $result = $t->fetchRow(
      $t->select()
        ->where('os_id = ?', $osid)->where('user_id = ?', $this->userid)->where('device_type = ?', 'merchant')
    );

    return count($result);
  }


  public function resetAccountLinks($id,$type) {

    //TODO check to see if id exists first and user is id owner etc etc

    if ($type === "ba") {
      $sp  = new App_Db_Sp_ResetBankAccountLinks();
      $res = $sp->getSimpleResponse(array( 'ID' =>$id));
    } else if ($type === "cc") {
      $sp  = new App_Db_Sp_ResetCreditCardLinks();
      $res = $sp->getSimpleResponse(array( 'ID' =>$id));
    }

  }

  public function addAddress($address,$address2,$city,$state,$zip,$country) {
      $sp = new App_Db_Sp_UserAddAddress();
      $sp->getSimpleResponse(array( 'USERID' => $this->userid, 
                                    'ADDRESS_TYPE' => 1, 'ADDR_LINE1' => $address, 'ADDR_LINE2' => $address2,
                                    'ADDR_LINE3' => '', 'ADDR_LINE4' => '',
                                    'CITY' => $city,'STATE' => $state,'ZIP' => $zip,'COUNTRY_CODE' => $country,
                                    'DATE_ADDED' => date("Y-m-d H:i:s"),'USER_ADDED' => $this->email,
                                    'USER_CHANGED' => $this->email,'DATE_CHANGED' => date("Y-m-d H:i:s")));
  }

  public function addCellphone($cellphone,$pin,$alias,$type) {
      $sp  = new App_Db_Sp_UserAddMobile();
      error_log("--$cellphone-- --$pin-- in");
      $res = $sp->getSimpleResponse(array( 'USERID' => $this->userid, 
                                    'MOBILE_TYPE' => $type, 'CELLPHONE' => $cellphone,
                                    'PIN' => $pin,
                                    'ALIAS' => $alias,
                                    'DATE_ADDED' => date("Y-m-d H:i:s"),'USER_ADDED' => $this->email,
                                    'USER_CHANGED' => $this->email,'DATE_CHANGED' => date("Y-m-d H:i:s"), 'IP'=>getenv('REMOTE_ADDR')));

      return $res['@p_id'];
  }

  public static function getIdFromOSId($osid) {

      $sp  = new App_Db_Sp_UserIdFromOsId();
      $res = $sp->getSimpleResponse(array( 'OS_ID' => $osid ));

      return $res['@p_user_id'];
  }

  public function addCreditCard($id,$name_on_card,$last4,$description,$keyver,$type,$expire_month,$expire_year,$conf_amt) {

      $sp = new App_Db_Sp_AddCreditCard();
      $res = $sp->getSimpleResponse(array( 
                        'USER_CREDIT_CARD_ID'=>$id,
                        'KEY_VERSION'=>$keyver,
                        'LAST4'=>$last4,
                        'DESCRIPTION'=>$description,
                        'TYPE'=>$type,
                        'EXPIRE_MONTH'=>$expire_month,
                        'EXPIRE_YEAR'=>$expire_year,
                        'NAME_ON_CARD'=>$name_on_card,
                        'CONF_AMT'=>$conf_amt
                         ));
      return $res['@p_res'];

  }

  public function addBankAccount($id,$routing,$last4,$description,$keyver,$type,$conf_amt,$conf_amt2) {

      $sp = new App_Db_Sp_AddBankAccount();
      $res = $sp->getSimpleResponse(array( 
                        'USER_BANK_ACCOUNT_ID'=>$id,
                        'KEY_VERSION'=>$keyver,
                        'LAST4'=>$last4,
                        'DESCRIPTION'=>$description,
                        'TYPE'=>$type,
                        'ROUTING'=>$routing,
                        'CONF_AMT'=>$conf_amt,
                        'CONF_AMT2'=>$conf_amt2,
                         ));
      return $res['@p_res'];

  }

  public function getCreditCard($ccid) {

    $t = new App_Models_Db_Wigi_UserCreditCard();

    $result = $t->fetchRow(
      $t->select()
        ->where('user_credit_card_id = ?', $ccid)
    );

    $r = array();
    $r['last4']       = $result['last4'];
    $r['description'] = $result['description'];
    return $r;
  }

  public function getBankAccount($baid) {
    $t = new App_Models_Db_Wigi_UserBankAccount();

    $result = $t->fetchRow(
      $t->select()
        ->where('user_bank_account_id = ?', $baid)
    );

    $r = array();
    $r['last4']       = $result['last4'];
    $r['description'] = $result['description'];
    return $r;
  }

  public function confirmBankAccount($id,$amt) {
    $ba = new App_BankAccount($id);
    if ($ba->getConfAmt() == $amt) {
      $sp = new App_Db_Sp_ConfirmBankAccount();
      $res = $sp->getSimpleResponse(array('ID'=>$id));
    } else {
      new App_Exception_WsException('Incorrect amount');
    }
  }

  public function confirmCreditCard($id,$amt) {
    $cc = new App_CreditCard($id);
    if ($cc->getConfAmt() == $amt) {
      $sp = new App_Db_Sp_ConfirmCreditCard();
      $res = $sp->getSimpleResponse(array('ID'=>$id));
    } else {
      new App_Exception_WsException('Incorrect amount');
    }
  }

  public function isLastCellphone() {

    $sp  = new App_Db_Sp_UserNoCellphones();
    $res = $sp->getSimpleResponse(array( ));
    $num = $res['@p_count'];

    if ($num == 1) {
      return true;
    } else { 
      return false;
    }
  }

  public function resetSuspendCount() {
      $sp = new App_Db_Sp_ResetUserSuspend();
      $res = $sp->getSimpleResponse(array('USERID'=>$this->userid));
  }

  public function increaseSuspendCount() {
      $sp = new App_Db_Sp_IncreaseUserSuspend();
      $res = $sp->getSimpleResponse(array('USERID'=>$this->userid));
  }

  public function removeCellphone($mobileid) {
    //make sure this isnt the last cellphone
    if ($this->isLastCellphone()) {
      throw new App_Exception_WsException('Must always have at least one cellphone registered');
      return false;
    }

    $sp  = new App_Db_Sp_UserCellphoneRemove();
    $res = $sp->getSimpleResponse(array('MOBILEID'=>$mobileid ));

  } 

  public function getCellphones() {
    //get all cellphones that have this as a parent account
    $t = new App_Models_Db_Wigi_ViewUserCellphones();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ?', $this->userid)
    );

    return $result;


  }

  public static function searchMerchant($val,$type="") {
    //get all cellphones that have this as a parent account
    $t = new App_Models_Db_Wigi_User();
    $select = $t->select();

    if (preg_match('/^a{0,1}\d-\d\d\d-\d\d\d\d\d\d\d$/',$val)) {
        $val = str_replace("a","",$val);
         $userid = App_User::getUserIdFromMerchantId($val);
        $select->where('user_id = ?',$userid)->where('user_type = ?',"merchant")->where('`status` = ?',"active");
    } else {
        $select->where('(business_phone LIKE ? or business_name LIKE ? or business_dba_name LIKE ? or user_id LIKE ?)', "%$val%")->where('`user_type` = ?',"merchant")->where('`status` = ?',"active");
    }
    if ($type === "DONATE") {
      $select->where('`business_type` = ?','5');
    }

    $result = $t->fetchAll($select);

    $res = array();

    foreach ($result as $row) {

      if (is_file("/u/data/logos/$row->user_id/logo")) {
        $r['has_logo'] = "true";
      } else {
        $r['has_logo'] = "false";
      }


      $u = new App_User($row->user_id);
      $r['dbaname']   = $u->getBusinessDBAName();
      $r['name']   = $u->getBusinessName();
      $r['user_id'] = $u->getUid();
      $r['phone']  = App_DataUtils::fmtphone($u->getBusinessPhone());
      $r['id']     = $u->getMerchantId();
      $r['city']   = $u->getCity();
      $r['state']  = $u->getState();

      array_push($res,$r);

    }
    return $res;

  }


  public function getFmtCellphones() {
    $result = array();
    $a = $this->getCellphones();
    foreach ($a as $val) {
      $val->cellphone = preg_replace("/(\d\d\d)(\d\d\d)(\d\d\d\d)/", $this->getCountryCode() . "($1)$2-$3",$val->cellphone);
      array_push($result,$val);
    }
    return $result;
  }

  public function getPosUsers() {
    //get all cellphones that have this as a parent account
    $t = new App_Models_Db_Wigi_User();

    $result = $t->fetchAll(
      $t->select()
        ->where('parent_user_id = ?', $this->userid)->where('status != ?','deleted')
    );

    return $result;


  }


  public function getPosDevices() {
    //get all cellphones that have this as a parent account
    $t = new App_Models_Db_Wigi_AuthorizedDevice();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ?', $this->userid)
    );

    return $result;


  }


  public function getNoActiveCodes() {
    $total = 0;
    $phones = $this->getCellphones();
    foreach ($phones as $phone) {
      $w = new App_WigiEngine();
      $res = $w->getActiveWigiCodes($phone->mobile_id,'0');
      $total += count($res);
    }
    return $total;
  }
 
  public function hasDefaultCellphone() {
    if ($this->getDefaultCellphone() == 0) {
      return false;
    } else {
      return true;
    }
  } 

  public function getDefaultCellphone() {
      $sp  = new App_Db_Sp_UserGetDefaultCellphone();
      $res = $sp->getSimpleResponse(array( 'USERID' => $this->userid));
      return $res['@p_mobile_id'];
  }

  public function updateLogin($application,$ip,$browser) {
    App_DataUtils::updateLogin($this->getEmail(),$application,$ip,$browser,"website");
  }


  public function getBalance() {

      $sp  = new App_Db_Sp_GetUserBalance();
      $res = $sp->getSimpleResponse(array( ));
      return $res['@p_res'];

  }

  public function getTempBalance() {

      $sp  = new App_Db_Sp_GetUserTempBalance();
      $res = $sp->getSimpleResponse(array( ));
      return $res['@p_res'];

  }

  public function confirmEmail($code) {

    $sp  = new App_Db_Sp_UserConfirmEmail();
    $res = $sp->getSimpleResponse(array('USERID'=>$this->userid, 'CODE' => $code ));
    $result = $res['@p_result'];

    if ($result != 1) {
      throw new App_Exception_WsException('Invalid Confirmation Code');
      return false;
    }

  }

  public function getCreditCards() {
   
    $t = new App_Models_Db_Wigi_ViewCreditCards();
  
    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ?', $this->userid)
    );

 
    /*if (count($result) == 0) { 
      throw new App_Exception_WsException("No credit cards on file");
      return false;
    }*/

    return $result;


  }

  public function getBankAccounts() {
    $t = new App_Models_Db_Wigi_ViewBankAccounts();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ?', $this->userid)
    );


    /*if (count($result) == 0) {
      throw new App_Exception_WsException("No bank accounts on file");
      return false;
    }*/

    return $result;

  }

  public function getAccountSummary() {

    $t = new App_Models_Db_Wigi_ViewAccountSummary();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ?', $this->userid)
    );

    return $result;


  }

  public function linkCreditCardToCellphone($mobileid,$ccid) {
    //make sure the two aren't already linked
    //make sure that user is the owner of the ccid
    //make sure mobile has parent of userid
    //link
    if ($this->isCreditCardLinked($mobileid,$ccid)) {
      throw new App_Exception_WsException('Credit card is already linked to this phone');
      return false;
    }
 
    $c = new App_Cellphone($mobileid);
    if ($this->userid != $c->getUserId()) {
      throw new App_Exception_WsException('User does not own this cellphone');
      return false;
    }

    $cc = new App_CreditCard($ccid);
    if ($this->userid != $cc->getUserId()) {
      throw new App_Exception_WsException('User does not own this credit card');
      return false;
    }

 
    $sp = new App_Db_Sp_LinkCreditCard();
    $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'USER_CREDIT_CARD_ID'=> $ccid ));
     
  }

  public function linkBankAccountToCellphone($mobileid,$baid) {
    //make sure the two aren't already linked
    //make sure that user is the owner of the baid
    //make sure mobile has parent of userid
    //link
    if ($this->isBankAccountLinked($mobileid,$baid)) {
      throw new App_Exception_WsException('Bank account is already linked to this phone');
      return false;
    }
    $c = new App_Cellphone($mobileid);
    if ($this->userid != $c->getUserId()) {
      throw new App_Exception_WsException('User does not own this cellphone');
      return false;
    }

    $ba = new App_BankAccount($baid);
    if ($this->userid != $ba->getUserId()) {
      throw new App_Exception_WsException('User does not own this bank account');
      return false;
    }

    $sp = new App_Db_Sp_LinkBankAccount();
    $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'USER_BANK_ACCOUNT_ID'=> $baid ));
  }

  public function isCreditCardLinked($mobileid,$ccid) {

      $sp = new App_Db_Sp_CreditCardIsLinked();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'USER_CREDIT_CARD_ID'=> $ccid ));
      return $res['@p_res'];
  }

  public function isBankAccountLinked($mobileid,$baid) {

      $sp = new App_Db_Sp_BankAccountIsLinked();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid , 'USER_BANK_ACCOUNT_ID'=> $baid ));
      return $res['@p_res'];
  }

  public function isCreditCardOwner($ccid) {
  
      $sp = new App_Db_Sp_UserIsCreditCardOwner();
      $res = $sp->getSimpleResponse(array( 'USER_CREDIT_CARD_ID'=>$ccid  ));
      return $res['@p_res'];

  }

  public function isBankAccountOwner($baid) {
  
      $sp = new App_Db_Sp_UserIsBankAccountOwner();
      $res = $sp->getSimpleResponse(array( 'USER_BANK_ACCOUNT_ID'=>$baid  ));
      return $res['@p_res'];

  }


  public function isCellphoneOwner($mobileid) {

      $sp = new App_Db_Sp_UserIsCellphoneOwner();
      $res = $sp->getSimpleResponse(array( 'MOBILEID'=>$mobileid  ));
      return $res['@p_res'];

  }

  public function getUnconfirmedBankAccounts() {

    $t = new App_Models_Db_Wigi_ViewUnconfirmedBankAccounts();
    
    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ?', $this->userid)
    );
    
    return $result;
  }

  public function getUnconfirmedCreditCards() {

    $t = new App_Models_Db_Wigi_ViewUnconfirmedCreditCards();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ?', $this->userid)
    );

    return $result;
  }

  public function getLastLogin() {
                $um = new App_Models_Db_Wigi_LoginHistory();
                $rows = $um->fetchAll($um->select()->where('email = ?', $this->email)->order('stamp DESC')->limit(2));
                $result = array();
                if (count($rows) < 1)  {
                  throw new App_Exception_WsException('Never logged in before'); 
                }
                $result["email"]       = $rows[1]->email;
                $result["application"] = $rows[1]->application;
                $result["ip"]          = $rows[1]->ip;
                $result["browser"]     = $rows[1]->browser;
                $result["stamp"]       = $rows[1]->stamp;
                $result["client_type"] = $rows[1]->client_type;

                return $result;

  }
  
  public function setAcceptedTos($tosid) {
      $sp = new App_Db_Sp_SetAcceptedTos();
      $sp->getSimpleResponse(array( 'USERID'=>$this->userid, 'TOSID'=> $tosid));
  }

  public function tosIsCurrent() {
      $tos = App_Tos::getCurrentTos();
      return ($tos['tos_id'] == $this->getAcceptedTos())?true:false;  
  }

  public function getIdentity(){
    return array(
       'userid'    => $this->userid,
       'loginid'   => $this->email,
       'email'     => $this->email,
       'status'    => $this->status,       
       'firstname' => $this->first_name,
       'lastname'  => $this->last_name,
       'lastlogin' => $this->lastlogin,
       'lastip'    => $this->lastip,
       'parent_user_id'    => $this->parent_user_id,
       'systemadmin'    => $this->systemadmin,
       'merchantid'    => $this->merchantid,
    );    
  }
  public static function encryptPassword($password) {
    return md5(sha1($password) . $password);
  }
  
  public static function deleteUnconfirmedUsers() {
	$t_user        = new App_Models_Db_Wigi_User();
        $t_user_mobile = new App_Models_Db_Wigi_UserMobile();
	$zd = new Zend_Date();
	$zd->sub(6, Zend_Date::HOUR);
	$a = $zd->toArray();
	$date = $a["month"] . "-" . $a["day"] . "-" . $a["year"] . " " . $a["hour"] . ":" . $a["minute"] . ":" . $a["minute"];

	$rows = $t_user->fetchAll(
	$t_user->select()->where('cellphone_confirmed = ?', '0')->where('status = ?','unconfirmed')->where('date_added < ?',$date)
    );
	
	foreach ($rows as $row) {
          error_log("Deleting " . $row['user_id']);
          $where_u  = $t_user->getAdapter()->quoteInto('user_id = ?', $row['user_id']);
          $where_um = $t_user_mobile->getAdapter()->quoteInto('user_id = ?', $row['user_id']);
          $t_user->delete($where_u);
          $t_user_mobile->delete($where_um);
 	  //$sp  = new App_Db_Sp_DeleteUnconfirmedUser();
	  //$res = $sp->getSimpleResponse(array('USERID' => $row['user_id']));
	  //Send message that account was deleted due to not confirming
	}
  }

  public static function bulkUnsuspend() {

      $sp  = new App_Db_Sp_UserBulkUnsuspend();
      $res = $sp->getSimpleResponse(array());

  }

  public function save($id, $data) {
        $this->update($data,
            $this->getAdapter()->quoteInto('user_id = ?', $id )
        );
  }

  public static function getRecentlyAddedUsers($usertype, $max_results) {

    $t = new App_Models_Db_Wigi_RecentlyAddedUser();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_type = ?', $usertype)
        ->order('date_added DESC')
        ->limit($max_results)
    );
    return $result;
  }

    /**
     * Search takes an array of params.
     * Possible fields for params are:
     * USER_ID(integer), EMAIL(string), USER_TYPE FIRST_NAME(string), LAST_NAME(string),
     * MESSAGE_METHOD EMAIL_CONFIRMED CELLPHONE_CONFIRMED SUSPEND_ACCOUNT
     * LAST_LOGIN_IP(string), BUSINESS_TYPE BUSINESS_NAME(string),
     * DATE_ADDED_FROM(date), DATE_ADDED_TO(date), LAST_LOGIN_DATE_FROM(date),
     * LAST_LOGIN_DATE_TO(date), RPP(integer), PAGE(integer)
     * @param array $params
     * @param boolean $count
     * @return array of raw rows representing a user
     */
    public static function search($params, $count=false) {

        $t = new App_Models_Db_Wigi_User();
        $select = $t->select();

         if (array_key_exists("USER_ID", $params)) {
            $select->where("user_id LIKE ?", '%' . $params["USER_ID"] . '%');
        }

        if (array_key_exists("EMAIL", $params)) {
            $select->where("email LIKE ?", '%' . $params["EMAIL"] . '%');
        }

        if (array_key_exists("USER_TYPE", $params)) {
            $select->where("user_type LIKE ?", '%' . $params["USER_TYPE"] . '%');
        }

        if (array_key_exists("FIRST_NAME", $params)) {
            $select->where("first_name LIKE ?", '%' . $params["FIRST_NAME"] . '%');
        }

        if (array_key_exists("LAST_NAME", $params)) {
            $select->where("last_name LIKE ?", '%' . $params["LAST_NAME"] . '%');
        }

        if (array_key_exists("MESSAGE_METHOD", $params)) {
            $select->where("message_method LIKE ?", '%' . $params["MESSAGE_METHOD"] . '%');
        }

        if (array_key_exists("EMAIL_CONFIRMED", $params)) {
            $select->where("email_confirmed LIKE ?", '%' . $params["EMAIL_CONFIRMED"] . '%');
        }

        if (array_key_exists("CELLPHONE_CONFIRMED", $params)) {
            $select->where("cellphone_confirmed LIKE ?", '%' . $params["CELLPHONE_CONFIRMED"] . '%');
        }

        if (array_key_exists("SUSPEND_ACCOUNT", $params)) {
            $select->where("suspend_account LIKE ?", '%' . $params["SUSPEND_ACCOUNT"] . '%');
        }

        if (array_key_exists("LAST_LOGIN_IP", $params)) {
            $select->where("last_login_ip LIKE ?", '%' . $params["LAST_LOGIN_IP"] . '%');
        }

        if (array_key_exists("BUSINESS_TYPE", $params)) {
            $select->where("business_type LIKE ?", '%' . $params["BUSINESS_TYPE"] . '%');
        }

        if (array_key_exists("BUSINESS_NAME", $params)) {
            $select->where("business_name LIKE ?", '%' . $params["BUSINESS_NAME"] . '%');
        }

        if (array_key_exists("DATE_ADDED_FROM", $params)) {
            $select->where("date_added >= ?", $params["DATE_ADDED_FROM"]);
        }

        if (array_key_exists("DATE_ADDED_TO", $params)) {
            $select->where("date_added <= ?", $params["DATE_ADDED_TO"]);
        }

        if (array_key_exists("LAST_LOGIN_DATE_FROM", $params)) {
            $select->where("last_login_date >= ?", $params["LAST_LOGIN_DATE_FROM"]);
        }

        if (array_key_exists("LAST_LOGIN_DATE_TO", $params)) {
            $select->where("last_login_date <= ?", $params["LAST_LOGIN_DATE_TO"]);
        }

        $rpp = 20;
        if (array_key_exists("RPP", $params)) {
            $rpp = $p["RPP"];
        }

        if (array_key_exists("PAGE", $params) && $count == false) {
            $select->limit($rpp, $params["PAGE"] * $rpp);
        }

        if ($count) {
            $select->from($t->_name, 'COUNT(*) AS num');
            $raw = $t->fetchRow($select)->num;
            return $raw;
        } else {
            $raw = $t->fetchAll($select);
        }


        $finalraw = array();

        foreach ($raw as $row) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            array_push($finalraw, $r);
        }

        return $finalraw;
    }
    
    /**
     * Search takes an array of params and gets consumers only.
     * Possible fields for params are:
     * USER_ID(integer), EMAIL(string), FIRST_NAME(string), LAST_NAME(string),
     * CELLPHONE, ZIP
     * @param array $params
     * @param boolean $count
     * @return array of raw rows representing a user
     */
    public static function searchConsumerInfo($params) {

        $t = new App_Models_Db_Wigi_ViewUserInfo();
        $select = $t->select();

         if (array_key_exists("USER_ID", $params)) {
            $select->where("user_id LIKE ?", '%' . $params["USER_ID"] . '%');
        }

        if (array_key_exists("EMAIL", $params)) {
            $select->where("email LIKE ?", '%' . $params["EMAIL"] . '%');
        }

        if (array_key_exists("FIRST_NAME", $params)) {
            $select->where("first_name LIKE ?", '%' . $params["FIRST_NAME"] . '%');
        }

        if (array_key_exists("LAST_NAME", $params)) {
            $select->where("last_name LIKE ?", '%' . $params["LAST_NAME"] . '%');
        }
        
        if (array_key_exists("CELLPHONE", $params)) {
            $select->where("cellphone LIKE ?", '%' . $params["CELLPHONE"] . '%');
        }
        
        if (array_key_exists("ZIP", $params)) {
            $select->where("zip LIKE ?", '%' . $params["ZIP"] . '%');
        }

        $rpp = 20;
        if (array_key_exists("RPP", $params)) {
            $rpp = $p["RPP"];
        }

        if (array_key_exists("PAGE", $params) && $count == false) {
            $select->limit($rpp, $params["PAGE"] * $rpp);
        }

        
        $raw = $t->fetchAll($select);


        $finalraw = array();

        foreach ($raw as $row) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            array_push($finalraw, $r);
        }

        return $finalraw;
    }
    
    /**
     * Search takes an array of params and gets consumers only.
     * Possible fields for params are:
     * USER_ID(integer), BUSNAME(string), FIRST_NAME(string), LAST_NAME(string),
     * BUSPHONE, ZIP
     * @param array $params
     * @param boolean $count
     * @return array of raw rows representing a user
     */
    public static function searchMerchantInfo($params) {

        $t = new App_Models_Db_Wigi_ViewMerchantInfo();
        $select = $t->select();

         if (array_key_exists("USER_ID", $params)) {
            $select->where("user_id LIKE ?", '%' . $params["USER_ID"] . '%');
        }

        if (array_key_exists("BUSNAME", $params)) {
            $select->where("name LIKE ?", '%' . $params["BUSNAME"] . '%');
        }

        if (array_key_exists("FIRST_NAME", $params)) {
            $select->where("first_name LIKE ?", '%' . $params["FIRST_NAME"] . '%');
        }

        if (array_key_exists("LAST_NAME", $params)) {
            $select->where("last_name LIKE ?", '%' . $params["LAST_NAME"] . '%');
        }
        
        if (array_key_exists("BUSPHONE", $params)) {
            $select->where("business_phone LIKE ?", '%' . $params["BUSPHONE"] . '%');
        }
        
        if (array_key_exists("ZIP", $params)) {
            $select->where("zip LIKE ?", '%' . $params["ZIP"] . '%');
        }
        
        if (array_key_exists("STATUS", $params)) {
            $select->where("status LIKE ?", $params["STATUS"] );
        }

        $rpp = 20;
        if (array_key_exists("RPP", $params)) {
            $rpp = $p["RPP"];
        }

        if (array_key_exists("PAGE", $params) && $count == false) {
            $select->limit($rpp, $params["PAGE"] * $rpp);
        }

        
        $raw = $t->fetchAll($select);


        $finalraw = array();

        foreach ($raw as $row) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            array_push($finalraw, $r);
        }

        return $finalraw;
    }

    /**
     * For Dashboard
     **/
    public static function getUserCount($usertype, $fromdate="2006-12-31 00:00:00") {

        $userdb = new App_Models_Db_Wigi_User();
        $select = $userdb->select();
        $userCount = 0;

        $select->from($userdb->_name, 'COUNT(*) AS num');
        $select->where("user_type = ?", $usertype );
        $select->where("date_added >= ?", $fromdate);

        $userCount = $userdb->fetchRow($select)->num;
        return $userCount;
    }


    public static function getUserCounts($fromdate="2006-12-31 00:00:00") {

        $txdb = new App_Models_Db_Wigi_User();
        $select = $txdb->select();
        $txCount = 0;

        $select->from($txdb->_name, array('COUNT(user_type) AS counts', 'user_type'));
        $select->where("date_added >= ?", $fromdate);
        $select->group("user_type");
		//return $select;

		$result = $txdb->fetchAll($select);
		return $result->toArray();
    }


  public static function searchMerchantLoginId($businessname,$ein) {
    $t = new App_Models_Db_Wigi_User();
    $select = $t->select();
	$select->from($t->_name, array('user_id as uid', 'business_name as bname', 'email as email'));

	$select->where('(business_name LIKE ?)', "%$businessname%")->where('`user_type` = ?',"merchant")->where('`business_tax_id` = ?',$ein)->where('`status` = ?',"active");
    $result = $t->fetchRow($select);

    $res = array();

	if($result)
	  {
		foreach ($result as $row) {
			$res[]=$row;
		}
	  }
    return $res;

  }

}

?>
