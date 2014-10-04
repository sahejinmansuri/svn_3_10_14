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
  private $middle_init;
  private $nationality;
  private $gender;
  private $marital_status;
  private $spouse_name;
  private $occupation;
  private $annual_income;
  private $resident;
  private $pan_no;
  private $aadhar_id;
  private $submitted_id_proof;
  private $birthdate;
  private $country_code;
  private $landline_home;
  private $landline_office;
  private $pt_address;
  private $pt_city;
  private $pt_state;
  private $pt_country;
  private $pt_zip;
  private $address1;
  private $address2;
  private $country;
  private $email_address;
  private $address_proof;
  private $signature;
  private $kyc;
  private $subscribed_user;
  private $subscribtion_count;
  private $image_path;
  private $image_path2;
  private $app_suite;
  private $pt_app_suite;
  private $pt_address2;
  private $alternate_email;
  private $pt_landline_home1;
  private $pt_landline_home2;
  
  

  public function passwordMatches($p) {
$password = Atlasp_Utils::inst()->encryptPassword($p);



    if (Atlasp_Utils::inst()->encryptPassword($p) === $this->password) {
    	
      return true;
    } 
    else {
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
  public function getMiddleInit() {
      return $this->middle_init;
  }
  public function getNationality() {
      return $this->nationality;
  }
   public function getGender() {
      return $this->gender;
  }
   public function getMaritalStatus() {
      return $this->marital_status;
  }
   public function getSpouseName() {
      return $this->spouse_name;
  }
  public function getOccupation() {
      return $this->occupation;
  }
   public function getAnnualIncome() {
      return $this->annual_income;
  }
   public function getResident() {
      return $this->resident;
  }
   public function getPanNo() {
      return $this->pan_no;
  }
   public function getAadharId() {
      return $this->aadhar_id;
  }
   public function getSubmittedIdProof() {
      return $this->submitted_id_proof;
  }
  public function getBirthdate() {
      return $this->birthdate;
  }
  public function getAddress1() {
      return $this->address1;
  }
  public function getAddress2() {
      return $this->address2;
  }
  public function getCountry() {
      return $this->country;
  }
  public function getImagePath() {
      return $this->image_path;
  }
  public function getImagePath2() {
      return $this->image_path2;
  }
  public function getAppSuite() {
      return $this->app_suite;
  }
  public function getPtAppSuite() {
      return $this->pt_app_suite;
  }
  public function getPtAddress2() {
      return $this->pt_address2;
  }
  public function getPtLandlineHome1() {
      return $this->pt_landline_home1;
  }
  public function getPtLandlineHome2() {
      return $this->pt_landline_home2;
  }
  
  public function getLandlineHome() {
      return $this->landline_home;
  }
  public function getLandlineOffice() {
      return $this->landline_office;
  }
  public function getPtAddress() {
      return $this->pt_address;
  }
  public function getPtCity() {
      return $this->pt_city;
  }
  public function getPtState() {
      return $this->pt_state;
  }
  public function getPtCountry() {
      return $this->pt_country;
  }
  public function getPtZip() {
      return $this->pt_zip;
  }
  public function getAddressProof() {
      return $this->address_proof;
  }
  public function getEmailAddress() {
      return $this->alternate_email;
  }
   public function getSignature() {
      return $this->signature;
  }
  
  public function getSystemAdmin() {
    return $this->systemadmin;
  }
  public function getKYC() {
      return $this->kyc;
  }
  public function getSubscribedUser() {
      return $this->subscribed_user;
  }
  public function getSubscribedCount() {
      return $this->subscribtion_count;
  }

  public function getMerchant2Id() {
      return $this->merchantid;
  }

  public function getMerchantId() {
   return sprintf("%s-%03s-%07s",$this->business_type,$this->country_code,$this->userid); 
  }
  public function getMemberId() {
   return sprintf("%s-%07s",$this->country_code,$this->userid); 
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
    $this->systemadmin          	= $result->systemadmin;
    $this->merchantid          		= $result->merchantid;
    $this->middle_init          	= $result->middle_init;
	$this->nationality				= $result->nationality;
	$this->gender					= $result->gender;
	$this->marital_status			= $result->marital_status;
	$this->spouse_name				= $result->spouse_name;
	$this->occupation				= $result->occupation;
	$this->annual_income			= $result->annual_income;
	$this->resident					= $result->resident;
	$this->pan_no					= $result->pan_no;
	$this->aadhar_id				= $result->aadhar_id;
	$this->kyc						= $result->kyc;
	$this->subscribed_user			= $result->subscription_paid;
	$this->subscribtion_count		= $result->subscribtion_count;
	$this->image_path				= $result->image_path;
	$this->image_path2				= $result->image_path2;
	$this->submitted_id_proof		= $result->submitted_id_proof;
	$this->alternate_email			= $result->alternate_email;
	
	$this->birthdate				= $result->birthdate;
	$this->country_code				= $result->country_code;
   
    if (count($raddr) > 0) {
      $this->city                    = $raddr->city;
      $this->state                   = $raddr->state;
      $this->zip                     = $raddr->zip;
      $this->address                 = $raddr->addr_line1 . " " . $raddr->addr_line2 . " " . $raddr->addr_line3 . " " . $raddr->addr_line4;
	  
		$this->address1                 = $raddr->addr_line1;
		$this->address2                 = $raddr->addr_line2;
		$this->country                 = $raddr->country;
		$this->landline_home			= $raddr->landline_home;
		$this->address_proof			= $raddr->address_proof;
		$this->email_address			= $raddr->email_address;
		$this->landline_office			= $raddr->landline_office;
		$this->pt_address				= $raddr->pt_address;
		$this->pt_city					= $raddr->pt_city;
		$this->pt_state					= $raddr->pt_state;
		$this->pt_country				= $raddr->pt_country;
		$this->pt_zip					= $raddr->pt_zip;
		$this->signature				= $raddr->signature;
		$this->app_suite				= $raddr->app_suite;
		$this->pt_app_suite				= $raddr->pt_app_suite;
		$this->pt_address2				= $raddr->pt_address2;
		$this->pt_landline_home1		= $raddr->pt_landline_home1;
		$this->pt_landline_home2		= $raddr->pt_landline_home2;
	
	
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
                'NATIONALITY' => 'Indian',
                'GENDER' => '',
                'MARITAL_STATUS' => '',
                'SPOUSE_NAME' => '',
                'OCCUPATION' => '',
                'ANNUAL_INCOME' => '',
                'RESIDENT' => '',
                'PAN_NO' => '',
                'AADHAR_ID' => '',
                'SUBMITTED_ID_PROOF' => '',
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
		$user_id = $res['@p_user_id'];
		$uinfo = new App_Models_Db_Wigi_User();
		$uinfof = $uinfo->update(
			array(
				'parent_user_id' => $parent_user_id,
            ),
			$uinfo->getAdapter()->quoteInto('user_id = ?', $user_id)
        );
		

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

  public function addAddress($address,$address2,$city,$state,$zip,$country_code,$country,$pt_country,$pt_address,$pt_city,$pt_state,$pt_zip,$landline_home1,$landline_home2,$email_address,$address_proof,$signature,$app_suite,$pt_app_suite,$pt_address2,$pt_landline_home1,$pt_landline_home2) {
      $sp = new App_Db_Sp_UserAddAddress();
		$sp->getSimpleResponse(array( 
						'USERID' => $this->userid, 
						'ADDRESS_TYPE' => 1, 
						'ADDR_LINE1' => $address, 
						'ADDR_LINE2' => $address2,
						'ADDR_LINE3' => '', 
						'ADDR_LINE4' => '',
						'CITY' => $city,
						'STATE' => $state,
						'ZIP' => $zip,
						'COUNTRY_CODE' => $country,
						'DATE_ADDED' => date("Y-m-d H:i:s"),
						'USER_ADDED' => $this->email,
						'DATE_CHANGED' => date("Y-m-d H:i:s"),
						'USER_CHANGED' => $this->email,
						'COUNTRY' => $country,
						'PT_COUNTRY' => $pt_country,
						'PT_ADDRESS' => $pt_address,
						'PT_CITY' => $pt_city,
						'PT_STATE' => $pt_state,
						'PT_ZIP' => $pt_zip,
						'LANDLINE_HOME1' => $landline_home1,
						'LANDLINE_HOME2' => $landline_home2,
						'EMAIL_ADDRESS' => $email_address,
						'ADDRESS_PROOF' => $address_proof,
						'SIGNATURE' => $signature,
						'APP_SUITE' => $app_suite,
						'PT_APP_SUITE' => $pt_app_suite,
						'PT_ADDRESS2' => $pt_address2,
						'PT_LANDLINE_HOME1' => $pt_landline_home1,
						'PT_LANDLINE_HOME2' => $pt_landline_home2
					));
	}
	/*'DATE_OF_INCORPORATION' => "",
						'PLACE_OF_INCORPORATION' => "",
						'VATTIN' => "",
						'CSTTIN' => "",
						'SERVICE_TAX' => "",
						'LEGAL_NAME' => "",
						'DOING_BUSINESS' => "",
						'INVOLVED_PROVIDING' => "",
						'FOREIGN_EXCHANGE' => "",
						'GAMING' => "",
						'MONEY_LENDING' => ""*/
  public function addDoc($type,$desc,$mobile_id){
		$sp = new App_Db_Sp_UserAddDoc();
		$sp->getSimpleResponse(array( 
									'KEY_VERSION' => '1', 
									'MOBILE_ID' => $mobile_id, 
									'USERID' => $this->userid, 
									'DOC_TYPE' => $type, 
									'DOC_DESCRIPTION' => $desc
								));
  }

  public function addCellphone($cellphone,$pin,$alias,$type,$lastname="") {
      $sp  = new App_Db_Sp_UserAddMobile();
      //error_log("--$cellphone-- --$pin-- in");
      $res = $sp->getSimpleResponse(array( 'USERID' => $this->userid, 
                                    'MOBILE_TYPE' => $type, 'CELLPHONE' => $cellphone,
                                    'PIN' => $pin,
                                    'DATE_ADDED' => date("Y-m-d H:i:s"),'USER_ADDED' => $this->email,
                                    'USER_CHANGED' => $this->email,'DATE_CHANGED' => date("Y-m-d H:i:s"), 
                                    'ALIAS' => $alias,
                                    'LAST_NAME' => $lastname,
									'IP'=>getenv('REMOTE_ADDR')));

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
$find_str = 'USD ';
						
						$strpos1 = strpos($conf_amt,'USD ');
						if($strpos1 === FALSE){
						
						}else{
							$pos = $strpos1 + 4;
							$conf_amt = substr($conf_amt,$pos);
						}
						
						$strpos2 = strpos($conf_amt2,'USD ');
						if($strpos2 === FALSE){
						
						}else{
							$pos2 = $strpos2 + 4;
							$conf_amt2 = substr($conf_amt2,$pos2);
						}

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
        ->where('user_id = ? ', $this->userid)
    );

    return $result;


  }
  
  public function getUserCellphones() {
    //get all cellphones that have this as a parent account
    
    $t = new App_Models_Db_Wigi_UserMobile();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ? ', $this->userid)->where('status != ?',"deleted")
    );

    return $result;


  }
  public function getUserCell() {
    //get all cellphones that have this as a parent account
    
    $t = new App_Models_Db_Wigi_UserMobile();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ? ', $this->userid)->where('status != ?',"deleted")->where('status != ?',"unconfirmed")
    );

    return $result;


  }
  public function getUserCell1($mobile) {
    //get all cellphones that have this as a parent account
    
    $t = new App_Models_Db_Wigi_UserMobile();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ? ', $this->userid)->where('status = ?',"unconfirmed")->where('mobile_id = ?',$mobile)
    );

    return $result;


  }
  
  
  public function getUserCellphones1() {
    //get all cellphones that have this as a parent account
    $t = new App_Models_Db_Wigi_UserMobile();

    $result = $t->fetchAll(
      $t->select()
        ->where('user_id = ? ', $this->userid)->where('status = ?',"active")
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
      $r['image_path']  = $u->getImagePath();

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
    $t_user_address = new App_Models_Db_Wigi_UserAddress();
	$zd = new Zend_Date();
	$zd->sub(1, Zend_Date::HOUR);
	$a = $zd->toArray();
	$date = $a["month"] . "-" . $a["day"] . "-" . $a["year"] . " " . $a["hour"] . ":" . $a["minute"] . ":" . $a["minute"];

	$rows = $t_user->fetchAll(
	$test = $t_user->select()->where('cellphone_confirmed = ?', '0')->where('status = ?','unconfirmed')->where('date_added < ?',$date)
    );
	echo $date;
	foreach ($rows as $row) {
		
		error_log("Deleting " . $row['user_id']);
        $where_u  = $t_user->getAdapter()->quoteInto('user_id = ?', $row['user_id']);
        $where_um = $t_user_mobile->getAdapter()->quoteInto('user_id = ?', $row['user_id']);
        $where_ua = $t_user_address->getAdapter()->quoteInto('user_id = ?', $row['user_id']);
		
		print_r($row['user_id']);
		echo "\n";
		$t_user->delete($where_u);
		$t_user_mobile->delete($where_um);
		$t_user_address->delete($where_ua);
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
	public static function searchAllConsumerInfo($params) {

        $t = new App_Models_Db_Wigi_ViewUserInfo();
        $select = $t->select()->from(array('t' => 'view_consumer_info'), array('user_id','mobile_id'));
        //$select = $t->select();

		
		$select->where("user_type = ?", 'consumer');
		$select->where("status = ?", 'active');

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
	public static function subscribe_user() {
		$conf = new App_Models_Db_Wigi_Configuration();
		
		$raw = $conf->fetchAll(
		  $conf->select()
			->where('`key` = ?', 'yearly_subscription_charge')
		);
		foreach($raw as $key=>$val){
			$sub_charge = $val['value'];
		}
		
		$amount = $sub_charge;
		$subscribtion_amount = $amount;
		$m = new App_Messenger();
		$u = new App_Models_Db_Wigi_User();
		
		
		
		$select_paid = $u->select($u->_name, array('user_id'));
		$select_paid->where('`status` = ?',"active");
		$select_paid->where('`subscription_paid` = ?',"1");
		$select_paid->where('`user_type` = ?',"consumer");
		//echo $select_paid;
		
		$result_paid = $u->fetchAll($select_paid);
		//$result = (array)$result;
		foreach($result_paid as $key2=>$val2){
			$user_id = $val2['user_id'];
			$user = new App_User($user_id);
			
			$email = $user->getEmail();
			$count = $val2['subscribtion_count'];
			$subscription_date = $val2['subscription_date'];
			$date_added = $val2['date_added'];
			
			$date_compare = strtotime($date_added.' + '.$count.' year');
			$date_compare1 = strtotime($subscription_date.' + 1 year');
			$date_compare_date = date('d M Y H:i:s',$date_compare1);
			
			$date_compare_one_month = strtotime($date_compare_date.' - 1 month');
			$date_compare_one_month_day = $date_compare_one_month + (24*60*60);
			$time_now = time();
			
			if(($date_compare_one_month < $time_now) && ($time_now < $date_compare_one_month_day)){
				$m->sendMessage("InCashMe&trade;: Your subscription will be end with InCashMe&trade; within a month. \nYou have to pay INR ".$amount." to subscribe again in InCashMe&trade;.",$email,'1','InCashMe : Wallet Rental'); 
			}
			
			$date_compare_one_week = strtotime($date_compare_date.' - 1 week');
			$date_compare_one_week_day = $date_compare_one_week + (24*60*60);
			$time_now = time();
			
			//echo $user_id."=".$date_compare_one_week."==".$time_now."==".$date_compare_one_week_day."\n";
			if(($date_compare_one_week < $time_now) && ($time_now < $date_compare_one_week_day)){
				$m->sendMessage("InCashMe&trade;: Your subscription will be end with InCashMe&trade; within a week. \nYou have to pay INR ".$amount." to subscribe again in InCashMe&trade;.",$email,'1','InCashMe : Wallet Rental'); 
			}

			
			if($time_now >= $date_compare1){
				//echo $time_now."=".$date_compare."===";
				//echo $user_id;
				//echo "\n";
				$u->update(
					array(
						'subscription_paid' => '0',
					),
					$u->getAdapter()->quoteInto('user_id = ?', $user_id)
				);
				$m->sendMessage("InCashMe&trade;: Your subscription is ended with InCashMe&trade;. So you are un-subscribed from InCashMe&trade;. \nYou have to pay INR ".$amount." to subscribe again in InCashMe&trade;.",$email,'1','InCashMe : Wallet Rental'); 
			}
		}
		$select = $u->select($u->_name, array('user_id'));
		$select->where('`status` = ?',"active");
		$select->where('`subscription_paid` = ?',"0");
		$select->where('`user_type` = ?',"consumer");
		//echo $select;
		
		$result = $u->fetchAll($select);
		//$result = (array)$result;
		foreach($result as $key=>$val){
			$user_id = $val['user_id'];
			$s_count = $val['subscribtion_count'];
			
			$user = new App_User($user_id);
			
			$t = new App_Models_Db_Wigi_UserMobile();
			$select1 = $t->select();
			$select1->where('`status` = ?',"active");
			$select1->where('`user_id` = ?',$user_id);
			$select1->where('`is_default` = ?',"1");

			$result1 = $t->fetchAll($select1);
			
			foreach($result1 as $key1=>$val1){
				$mobile_id = $val1['mobile_id'];
				$user_balance = $val1['balance'];
				if($user_balance > $amount){
					$email = $user->getEmail();
					$c = new App_Cellphone($mobile_id);
					$uinfo = new App_Models_Db_Wigi_User();
					$s_count_final = $s_count + 1;
					$date = date('m/d/Y H:i:s', time());	
					
					
					$from_balance      = $c->getBalance() - $amount;
					$from_temp_balance = $c->getTempBalance() - $amount;
					$from_detail = 'Wallet Rental charge';
					$from_user_detail = $c->getFmtCellphone();
					//$extinfo = $ns->extinfo;
					$extinfo = array();
					$extinfo["ip_address"] = "";
					$extinfo["gps"] = "";
					$extinfo["server_datetime"] = "";
					$extinfo["client_datetime"] = "";
					$extinfo["appname"] = "";
					$extinfo["appversion"] = "";
					$extinfo["devicemodel"] = "";
					$extinfo["systemname"] = "";
					$extinfo["systemversion"] = "";
					$extinfo["os"] = "";
					$extinfo["browser_string"] = "";
					$extinfo["language"] = "";
					$extinfo["osid"] = "";
					$extinfo["processor_transaction_id"] = "";
					$extinfo["user_description"] = "";
					$extinfo["tax"] = "";
					$extinfo["tip"] = "";
					$extinfo["raw_amount"] = "";
					$extinfo["pos_name"] = "";
					$extinfo["order_id"] = "";
					
					$c->reduceFromBalance($amount);
					$c->reduceFromTempBalance($amount);
					
                    $u->update(
						array(
							'subscription_paid' => '1',
							'subscribtion_count' => $s_count_final,
							'subscription_date' => $date,
						),
						$u->getAdapter()->quoteInto('user_id = ?', $user_id)
					);
					//echo $email."\n";	
					$m->sendMessage("InCashMe&trade;: You have charged INR ".$amount." from " . $c->getCellphone()."\nYou are now subscribed in InCashMe&trade; Wallet Rental.",$email,'1','InCashMe : Wallet Rental'); 
					
					$csp = new App_Db_Sp_LogTransaction();
	 
					$res = $csp->getSimpleResponse(array(
						'TYPE' => 500,
						'DIRECTION' => 'Debit', 
						'AMOUNT' => $amount,
						'BILLING_AMOUNT' => 0, 
						'BALANCE' => $from_balance,
						'TEMP_BALANCE' => $from_temp_balance,
						'FROM' => $mobile_id, 
						'TO' => "",
						'FROM_DESCRIPTION' => $from_user_detail,
						'TO_DESCRIPTION' => "",
						'DESCRIPTION' => $from_detail,
						'FROM_USER_ID' => $user_id,
						'TO_USER_ID' => "",
						'FROM_USER_ID_DESCRIPTION' => $user_id,
						'TO_USER_ID_DESCRIPTION' => "",
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
						'WIGI_CODE_ID' => "",
						'ORDER_ID' => $extinfo["order_id"],
                    ));
					$settled = 'Yes';
					$uinfo = new App_Models_Db_Wigilog_Transaction();
					$uinfof = $uinfo->update(
						array(
							'settled' => $settled
						),
						$uinfo->getAdapter()->quoteInto('transaction_id = ?', $res['@res'])
					);
				}
			}
		}
	}
	public static function subscribe_userbyid($user_id, $s_count) {
			
		$conf = new App_Models_Db_Wigi_Configuration();
		
		$raw = $conf->fetchAll(
		  $conf->select()
			->where('`key` = ?', 'yearly_subscription_charge')
		);
		foreach($raw as $key=>$val){
			$sub_charge = $val['value'];
		}
		
		$amount = $sub_charge;
		$subscribtion_amount = $amount;
		$m = new App_Messenger();
		$u = new App_Models_Db_Wigi_User();
			
			
			$user = new App_User($user_id);
			
			$t = new App_Models_Db_Wigi_UserMobile();
			$select1 = $t->select();
			$select1->where('`status` = ?',"active");
			$select1->where('`user_id` = ?',$user_id);
			$select1->where('`is_default` = ?',"1");

			$result1 = $t->fetchAll($select1);
			
			foreach($result1 as $key1=>$val1){
				$mobile_id = $val1['mobile_id'];
				$user_balance = $val1['balance'];
				if($user_balance > $amount){
				
					$email = $user->getEmail();
					$c = new App_Cellphone($mobile_id);
					$uinfo = new App_Models_Db_Wigi_User();
					$s_count_final = $s_count + 1;
					$date = date('m/d/Y H:i:s', time());	
					
					
					$from_balance      = $c->getBalance() - $amount;
					$from_temp_balance = $c->getTempBalance() - $amount;
					$from_detail = 'Wallet Rental charge';
					$from_user_detail = $c->getFmtCellphone();
					//$extinfo = $ns->extinfo;
					$extinfo = array();
					$extinfo["ip_address"] = "";
					$extinfo["gps"] = "";
					$extinfo["server_datetime"] = "";
					$extinfo["client_datetime"] = "";
					$extinfo["appname"] = "";
					$extinfo["appversion"] = "";
					$extinfo["devicemodel"] = "";
					$extinfo["systemname"] = "";
					$extinfo["systemversion"] = "";
					$extinfo["os"] = "";
					$extinfo["browser_string"] = "";
					$extinfo["language"] = "";
					$extinfo["osid"] = "";
					$extinfo["processor_transaction_id"] = "";
					$extinfo["user_description"] = "";
					$extinfo["tax"] = "";
					$extinfo["tip"] = "";
					$extinfo["raw_amount"] = "";
					$extinfo["pos_name"] = "";
					$extinfo["order_id"] = "";
					
					$c->reduceFromBalance($amount);
					$c->reduceFromTempBalance($amount);
					
                    $u->update(
						array(
							'subscription_paid' => '1',
							'subscribtion_count' => $s_count_final,
							'subscription_date' => $date,
						),
						$u->getAdapter()->quoteInto('user_id = ?', $user_id)
					);
					//echo $email."\n";	
					//$m->sendMessage("InCashMe&trade;: You have charged INR ".$amount." from " . $c->getCellphone()."\nYou are now subscribed in InCashMe&trade; Wallet Rental.",$email,'1','InCashMe : Wallet Rental'); 
					
					$csp = new App_Db_Sp_LogTransaction();
	 
					$res = $csp->getSimpleResponse(array(
						'TYPE' => 500,
						'DIRECTION' => 'Debit', 
						'AMOUNT' => $amount,
						'BILLING_AMOUNT' => 0, 
						'BALANCE' => $from_balance,
						'TEMP_BALANCE' => $from_temp_balance,
						'FROM' => $mobile_id, 
						'TO' => "",
						'FROM_DESCRIPTION' => $from_user_detail,
						'TO_DESCRIPTION' => "",
						'DESCRIPTION' => $from_detail,
						'FROM_USER_ID' => $user_id,
						'TO_USER_ID' => "",
						'FROM_USER_ID_DESCRIPTION' => $user_id,
						'TO_USER_ID_DESCRIPTION' => "",
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
						'WIGI_CODE_ID' => "N/A",
						'ORDER_ID' => $extinfo["order_id"],
                    ));
					$settled = 'Yes';
					$uinfo = new App_Models_Db_Wigilog_Transaction();
					$uinfof = $uinfo->update(
						array(
							'settled' => $settled
						),
						$uinfo->getAdapter()->quoteInto('transaction_id = ?', $res['@res'])
					);
				}
			}
	}
}

?>
