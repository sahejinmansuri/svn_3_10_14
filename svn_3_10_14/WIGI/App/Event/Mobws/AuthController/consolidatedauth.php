<?php

class App_Event_Mobws_AuthController_consolidatedauth extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CELLPHONE' => array('phone', 15, 1, App_Constants::getFormLabel('CELLPHONE')),
                'CCODE' => array('countrycode', 3, 1, App_Constants::getFormLabel('CCODE')),
                'PIN' => array('pin', 10, 1, App_Constants::getFormLabel('PIN')),
                'OSID' => array('generic', 100, 1, App_Constants::getFormLabel('OSID')),
                'DEVICETOD' => array('generic', 100, 1, App_Constants::getFormLabel('DEVICETOD')),
                'APPVERSION' => array('generic', 100, 1, App_Constants::getFormLabel('APPVERSION')),
                'DEVICEMODEL' => array('generic', 100, 1, App_Constants::getFormLabel('DEVICEMODEL')),
                'SYSTEMNAME' => array('generic', 100, 1, App_Constants::getFormLabel('SYSTEMNAME')),
                'SYSTEMVERSION' => array('generic', 100, 1, App_Constants::getFormLabel('SYSTEMVERSION')),
                'GPS' => array('generic', 100, 1, App_Constants::getFormLabel('GPS')),
                'APPNAME' => array('generic', 100, 0, App_Constants::getFormLabel('APPNAME')),
                'LANGUAGE' => array('generic', 100, 0, App_Constants::getFormLabel('LANGUAGE')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$cthis){

        App_DataUtils::beginTransaction();

        $cellphone = $this->_request->getParam('CELLPHONE');
        $ccode     = $this->_request->getParam('CCODE');
        $pin       = $this->_request->getParam('PIN');
        $osid      = $this->_request->getParam('OSID');


        $login = new App_Login_Mobws();
        $login->doLogin(array('CELL'=>$cellphone, 'CCODE'=> $ccode, 'PIN'=>$pin, 'OSID'=>$osid));
	
            $cthis->getHelper('SessionHopping')->setDeviceIdentifier();
            $login->createSession();
            $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
            $idm = $login->getIdentity();
            $ns->userid    = $idm['userid'];
            $ns->mobileid  = $idm['mobileid'];
            $ns->cellphone = $cellphone;
			
			error_log("user id =======================".$idm['userid']."==".$idm["mobileid"]);

            $ns->pin       = $pin;
            $ns->osid      = $osid;
            $ns->type      = 'cellphone';
            $ns->countrycode   = $this->_request->getParam("CCODE");
            $ns->extinfo["osid"]          = $this->_request->getParam("OSID");
            $ns->extinfo["devicetod"]     = $this->_request->getParam("DEVICETOD");
            $ns->extinfo["appversion"]    = $this->_request->getParam("APPVERSION");
            $ns->extinfo["devicemodel"]   = $this->_request->getParam("DEVICEMODEL");
            $ns->extinfo["systemname"]    = $this->_request->getParam("SYSTEMNAME");
            $ns->extinfo["systemversion"] = $this->_request->getParam("SYSTEMVERSION");
            $ns->extinfo["gps"]           = $this->_request->getParam("GPS");
            $ns->extinfo["appname"]       = "";//$this->_request->getParam("APPNAME");
            $ns->extinfo["language"]      = "English";//$this->_request->getParam("LANGUAGE");
            $ns->extinfo["ip_address"]    = getenv("REMOTE_ADDR");

            $ns->extinfo["server_datetime"]    = "";
            $ns->extinfo["client_datetime"]    = "";
            $ns->extinfo["os"]    = "";
            $ns->extinfo["browser_string"]    = "";
            $ns->login_type    = "cellphone";

            $c = new App_Cellphone($idm["mobileid"]);
            $c->updateLogin($ns->extinfo["appversion"],getenv('REMOTE_ADDR'));
            $u = new App_User($c->getUserId());
            $ns->email = $u->getEmail();
			

            $c->updateExtInfo('iPhone',
                              $ns->extinfo["ip_address"],
                              $ns->extinfo["osid"],
                              $ns->extinfo["systemversion"],
                              $ns->extinfo["appversion"]);

            list($name,$domain) = explode('@',$u->getEmail());
            $mname = preg_replace('/^(.).+(.)$/',"$1****$2",$name) . '@' . preg_replace('/^(.).+(.....)$/',"$1****$2",$domain);

            $result['result']['status']                 = 'success';
            $result['result']['data']                   = "";
            $result['result']['data']['key']            = Zend_Session::getId();
            $result['result']['data']['prefs']          = $c->getPrefs();
            $result['result']['data']['messages']       = App_Message::getNewMessageCount( $idm['mobileid'] );
            $result['result']['data']['be_version']     = App_DataUtils::getVersion();
            $result['result']['data']['masked_email']   = $mname;
            $result['result']['data']['is_default']   = $idm['is_default'];
			
			$um = new App_Models_Db_Wigi_UserMobileOsId();
			$rows = $um->fetchAll(
				$um->select()->where('mobile_id = ?', $idm['mobileid'])->where('user_id = ?', $c->getUserId())
			);
			$os_id_mobile = "";
			foreach ($rows as $row) {
				$os_id_mobile       = $row["os_id"];
			}
			
			if($os_id_mobile == $osid){	
				$result['result']['data']['os_id_match'] = 1;
			}else{
				$result['result']['data']['os_id_match'] = 0;
			}
			
			/*$test = print_r($result['result']['data'],true);
			error_log($test);*/
			
			$getpermission = $cthis->getpermission($ns->mobileid,'');
			
			$permission_check_arr = explode('|',$getpermission);
			
			$profile_permission = $permission_check_arr[0];
			$document_permission = $permission_check_arr[1];
			$message_permission = $permission_check_arr[2];
			$preferences_permission = $permission_check_arr[3];
			$history_permission = $permission_check_arr[4];
			$statement_permission = $permission_check_arr[5];
			$change_pin_permission = $permission_check_arr[6];
			
			$add_money_permission = @$permission_check_arr[7];
			$withdraw_money_permission = @$permission_check_arr[8];
			$money_sources_permission = @$permission_check_arr[9];
			$change_question_permission = @$permission_check_arr[10];
			$lock_Account_permission = @$permission_check_arr[11];
			
			
			/*if($profile_permission = "" || $profile_permission == NULL || $profile_permission == false){
				$profile_permission = 0;
			}
			if($document_permission = "" || $document_permission == NULL){
				$document_permission = 0;
			}
			if($message_permission = "" || $message_permission == NULL){
				$message_permission = 0;
			}
			if($preferences_permission = "" || $preferences_permission == NULL){
				$preferences_permission = 0;
			}
			if($history_permission = "" || $history_permission == NULL){
				$history_permission = 0;
			}
			if($statement_permission = "" || $statement_permission == NULL){
				$statement_permission = 0;
			}
			if($change_pin_permission = "" || $change_pin_permission == NULL){
				$change_pin_permission = 0;
			}
			if($add_money_permission = "" || $add_money_permission == NULL){
				$add_money_permission = 0;
			}
			if($withdraw_money_permission = "" || $withdraw_money_permission == NULL){
				$withdraw_money_permission = 0;
			}
			if($money_sources_permission = "" || $money_sources_permission == NULL){
				$money_sources_permission = 0;
			}
			if($change_question_permission = "" || $change_question_permission == NULL){
				$change_question_permission = 0;
			}
			if($lock_Account_permission = "" || $lock_Account_permission == NULL){
				$lock_Account_permission = 0;
			}*/
			
			/*$result['result']['permission']['profile']   = $profile_permission;
			$result['result']['permission']['document']   = $document_permission;
			$result['result']['permission']['message']   = $message_permission;
			$result['result']['permission']['preferences']   = $preferences_permission;
			$result['result']['permission']['history']   = $history_permission;
			$result['result']['permission']['statement']   = $statement_permission;
			$result['result']['permission']['change_pin']   = $change_pin_permission;
			
			$result['result']['permission']['add_money']   = $add_money_permission?1:0;
			$result['result']['permission']['withdraw_money']   = $withdraw_money_permission?1:0;
			$result['result']['permission']['money_sources']   = $money_sources_permission?1:0;
			$result['result']['permission']['change_question']   = $change_question_permission?1:0;
			$result['result']['permission']['lock_Account']   = $lock_Account_permission?1:0;*/
			
			$permissions_cellphone = $c->getPermission();
			$perm_array = explode('|',$permissions_cellphone);
			
			
			if($idm['is_default'] == 0){
				$result['result']['permission']['statement'] = 0;
				$result['result']['permission']['cellphone_access'] = "0";
				$result['result']['permission']['manage_cellphone'] = "0"; 
				$result['result']['permission']['change_password'] = "0"; 
				$result['result']['permission']['money_sources'] = "0"; 
				
				$result['result']['permission']['document']   = 1;
				$result['result']['permission']['message']   = 1;
				$result['result']['permission']['preferences']   = 1;
				$result['result']['permission']['history']   = 1;
				
				$result['result']['permission']['profile']   = $perm_array[0];
				$result['result']['permission']['change_pin']   = $perm_array[1];
				$result['result']['permission']['add_money'] = $perm_array[2]; 
				$result['result']['permission']['withdraw_money'] = $perm_array[3];
				$result['result']['permission']['change_question'] = $perm_array[4];
				$result['result']['permission']['lock_Account'] = $perm_array[5];
			}else{
				
				$result['result']['permission']['statement'] = 1;
				$result['result']['permission']['cellphone_access'] = "1";
				$result['result']['permission']['manage_cellphone'] = "1"; 
				$result['result']['permission']['change_password'] = "1"; 
				$result['result']['permission']['money_sources'] = "1"; 
				
				
				$result['result']['permission']['document']   = 1;
				$result['result']['permission']['message']   = 1;
				$result['result']['permission']['preferences']   = 1;
				$result['result']['permission']['history']   = 1;
				
				
				$result['result']['permission']['profile']   = 1;
				$result['result']['permission']['change_pin']   = 1;
				$result['result']['permission']['add_money'] = "1"; 
				$result['result']['permission']['withdraw_money'] = "1"; 
				$result['result']['permission']['change_question'] = "1"; 
				$result['result']['permission']['lock_Account'] = "1"; 
			}
			$billing_settings_a = new App_WigiAdminSettings();
			$billing_settings = $billing_settings_a->getAdminSetting();
			$a = App_Transaction_WigiCharges::_convertDefaultValStrtoArr($billing_settings['wigi_default_billing']);
			$minamount = @$a['minamt']['type'];
			$amount = $minamount + 10;
			
			if($minamount == null){
				$minamount = 0;
			}
			$result['result']['billing_charge']['minimum_amount'] = $minamount; 
			
			$billing_amount_send_money = $this->billing_check_user($ns->mobileid, $amount, 100);
			$billing_amount_receive_money = $this->billing_check_user($ns->mobileid, $amount, 101);
			$billing_amount_send_donation = $this->billing_check_user($ns->mobileid, $amount, 102);
			$billing_amount_receive_donation = $this->billing_check_user($ns->mobileid, $amount, 103);
			$billing_amount_send_internal_money = $this->billing_check_user($ns->mobileid, $amount, 104);
			$billing_amount_receive_internal_money = $this->billing_check_user($ns->mobileid, $amount, 105);
			$billing_amount_send_payment = $this->billing_check_user($ns->mobileid, $amount, 106);
			$billing_amount_receive_payment = $this->billing_check_user($ns->mobileid, $amount, 107);
			
			$billing_amount_impc_created = $this->billing_check_user($ns->mobileid, $amount, 200);
			$billing_amount_impc_expired = $this->billing_check_user($ns->mobileid, $amount, 201);
			$billing_amount_impc_redeemed_merchant = $this->billing_check_user($ns->mobileid, $amount, 202);
			$billing_amount_impc_redeemed_consumer = $this->billing_check_user($ns->mobileid, $amount, 203);
			$billing_amount_impc_pending = $this->billing_check_user($ns->mobileid, $amount, 211);
			$billing_amount_impc_refund = $this->billing_check_user($ns->mobileid, $amount, 212);
			$billing_amount_send_impc = $this->billing_check_user($ns->mobileid, $amount, 207);
			$billing_amount_receive_impc = $this->billing_check_user($ns->mobileid, $amount, 208);
			$billing_amount_delete_impc = $this->billing_check_user($ns->mobileid, $amount, 204);
			
			$billing_amount_scan_pay_merchant = $this->billing_check_user($ns->mobileid, $amount, 213);
			$billing_amount_scan_pay_consumenr = $this->billing_check_user($ns->mobileid, $amount, 214);
			$billing_amount_scan_buy_merchant = $this->billing_check_user($ns->mobileid, $amount, 215);
			$billing_amount_scan_buy_consumenr = $this->billing_check_user($ns->mobileid, $amount, 216);
			
			$billing_amount_fund_from_creditcard = $this->billing_check_user($ns->mobileid, $amount, 300);
			$billing_amount_withdraw_to_creditcard = $this->billing_check_user($ns->mobileid, $amount, 301);
			$billing_amount_fund_from_bank = $this->billing_check_user($ns->mobileid, $amount, 302);
			$billing_amount_withdraw_to_bank = $this->billing_check_user($ns->mobileid, $amount, 303);
			$billing_amount_fund_from_credit_pending = $this->billing_check_user($ns->mobileid, $amount, 304);
			$billing_amount_fund_from_bank_pending = $this->billing_check_user($ns->mobileid, $amount, 305);
			
			
			$result['result']['billing_charge']['send_money'] = $billing_amount_send_money; 
			$result['result']['billing_charge']['receive_money'] = $billing_amount_receive_money; 
			$result['result']['billing_charge']['send_donation'] = $billing_amount_send_donation; 
			$result['result']['billing_charge']['receive_donation'] = $billing_amount_receive_donation; 
			$result['result']['billing_charge']['send_internal_money'] = $billing_amount_send_internal_money; 
			$result['result']['billing_charge']['receive_internal_money'] = $billing_amount_receive_internal_money; 
			$result['result']['billing_charge']['send_payment'] = $billing_amount_send_payment; 
			$result['result']['billing_charge']['receive_payment'] = $billing_amount_receive_payment; 
			$result['result']['billing_charge']['impc_created'] = $billing_amount_impc_created; 
			$result['result']['billing_charge']['impc_expired'] = $billing_amount_impc_expired; 
			$result['result']['billing_charge']['impc_redeemed_merchant'] = $billing_amount_impc_redeemed_merchant; 
			$result['result']['billing_charge']['impc_redeemed_consumer'] = $billing_amount_impc_redeemed_consumer; 
			$result['result']['billing_charge']['impc_pending'] = $billing_amount_impc_pending; 
			$result['result']['billing_charge']['impc_refund'] = $billing_amount_impc_refund; 
			$result['result']['billing_charge']['send_impc'] = $billing_amount_send_impc; 
			$result['result']['billing_charge']['receive_impc'] = $billing_amount_receive_impc; 
			$result['result']['billing_charge']['delete_impc'] = $billing_amount_delete_impc; 
			$result['result']['billing_charge']['scan_pay_merchant'] = $billing_amount_scan_pay_merchant; 
			$result['result']['billing_charge']['scan_pay_consumenr'] = $billing_amount_scan_buy_consumenr; 
			$result['result']['billing_charge']['scan_buy_merchant'] = $billing_amount_scan_buy_merchant; 
			$result['result']['billing_charge']['scan_buy_consumenr'] = $billing_amount_scan_buy_consumenr; 
			$result['result']['billing_charge']['fund_from_creditcard'] = $billing_amount_fund_from_creditcard; 
			$result['result']['billing_charge']['withdraw_to_creditcard'] = $billing_amount_withdraw_to_creditcard; 
			$result['result']['billing_charge']['fund_from_bank'] = $billing_amount_fund_from_bank; 
			$result['result']['billing_charge']['withdraw_to_bank'] = $billing_amount_withdraw_to_bank; 
			$result['result']['billing_charge']['fund_from_creditcard_pending'] = $billing_amount_fund_from_credit_pending; 
			$result['result']['billing_charge']['fund_from_bank_pending'] = $billing_amount_fund_from_bank_pending; 
			
			
			 
			//added api by attune
			$questions = $c->getQuestions();
			
			$ns->first_name = $u->getFirstName();
			$ns->last_name = $u->getLastName();
			$ns->middle_init = $u->getMiddleInit();
			
			$birthdate = $u->getBirthdate();
			$timestamp = strtotime($birthdate);
			$new_birthdate = date('m/d/Y',$timestamp);
$str = $cellphone;
$str = substr_replace($str, '-', 6, 0);
$str = substr_replace($str, ')', 3, 0);
$str = substr_replace($str, '(', 0, 0);
$cellphone = $str;
			$result['result']['profile']['user_id'] = $c->getUserId();
			$result['result']['profile']['mobile_id'] = $ns->mobileid; 
			$result['result']['profile']['first_name']   = $ns->first_name;
			$result['result']['profile']['last_name']   = $ns->last_name;
			$result['result']['profile']['nationality']   = $u->getNationality();
			$result['result']['profile']['country_code']   = $u->getCountryCode();
			$result['result']['profile']['cellphone']   = $cellphone;
			$result['result']['profile']['email']   = $ns->email;
			$result['result']['profile']['birthdate']   = $new_birthdate;
			$result['result']['profile']['gender']   = $u->getGender();
			$result['result']['profile']['marital_status']   = $u->getMaritalStatus();
			$result['result']['profile']['spouse_name']   = $u->getSpouseName();
			$result['result']['profile']['occupation']   = $u->getOccupation();
			$result['result']['profile']['member_id']   = $c->getMobileMemberId();
			$result['result']['profile']['member_since']   = $c->getDateAdded();
			
			$result['result']['profile']['middle_init']   = $ns->middle_init;
			$result['result']['profile']['status']   = $u->getResident();
			$result['result']['profile']['pan_no']   = $u->getPanNo();
			$result['result']['profile']['aadhar_id']   = $u->getAadharId();
			$result['result']['profile']['submitted_id_proof']   = $u->getSubmittedIdProof();
			$result['result']['profile']['kyc'] = $u->getKYC();
			$result['result']['profile']['subscribed'] = $u->getSubscribedUser();
			
			
			$result['result']['profile']['appt_suite']   = $u->getAppSuite();
			$result['result']['profile']['address']   = $u->getAddress1();
			$result['result']['profile']['address2']   = $u->getAddress2();
			$result['result']['profile']['city']   = $u->getCity();
			$result['result']['profile']['zip']   = $u->getZip();
			$result['result']['profile']['state']   = $u->getState();
			$result['result']['profile']['country']   = $u->getCountry();
			$result['result']['profile']['landline_home1']   = $u->getLandlineHome();
			$result['result']['profile']['landline_home2']   = $u->getLandlineOffice();
			$result['result']['profile']['address_proof']   	= $u->getAddressProof();
			
			$result['result']['profile']['pt_appt_suite']   = $u->getPtAppSuite();
			$result['result']['profile']['pt_address']   = $u->getPtAddress();
			$result['result']['profile']['pt_address2']   = $u->getPtAddress2();
			$result['result']['profile']['pt_city']   = $u->getPtCity();
			$result['result']['profile']['pt_zip']   = $u->getPtZip();
			$result['result']['profile']['pt_state']   = $u->getPtState();
			$result['result']['profile']['pt_country']   = $u->getPtCountry();
			$result['result']['profile']['pt_landline_home1']   = $u->getPtLandlineHome1();
			$result['result']['profile']['pt_landline_home2']   = $u->getPtLandlineHome2();
			
			$result['result']['profile']['annual_income']   = $u->getAnnualIncome();
			$result['result']['profile']['resident']   = $u->getResident();
			$result['result']['profile']['email_address']   	= $u->getEmailAddress();
			$result['result']['profile']['role']   	= $c->getRole();
			
			$cfg = Zend_Registry::get('config');
			$basepath = $cfg->paths->baseurl;
					
			$image_path = $u->getImagePath();
			$image_path2 = $u->getImagePath2();
			
			if($image_path == ""){
				$image_name = "";
			}else{
				$image_name = $basepath.'u/profile/'.$image_path;
			}
			if($image_path2 == ""){
				$image_name2 = "";
			}else{
				$image_name2 = $basepath.'u/profile/'.$image_path2;
			}
			$result['result']['profile']['image_path'] = $image_name;
			$result['result']['profile']['image_path2'] = $image_name2;
			//print_r($questions);
			$q_count = 0;
			foreach($questions as $question){
				$result['result']['profile']['question'][] = $question['question'];
				$result['result']['profile']['answer'][] = $question['answer'];
				$result['result']['profile']['question_id'][] = $question['question_id'];
				$q_count++;
			}
			$result['result']['profile']['question_count'] = $q_count;
			$result['result']['profile']['signature']   	= $u->getSignature();
			foreach($result['result']['profile'] as $key=>$val){
				if($val == '<null>'){
					$result['result']['profile'][$key] = " ";
				}
			}
			
	 App_DataUtils::commit();

            return $result;

    }
	
	public function billing_check_user($mobileid, $amount, $type){
		return @App_Billing::billing_check($mobileid, $amount, $type);
	}
}
