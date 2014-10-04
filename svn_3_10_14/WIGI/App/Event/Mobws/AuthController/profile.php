<?php

class App_Event_Mobws_AuthController_profile extends App_Event_WsEventAbstract {

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
		
		
       /* $login = new App_Login_Mobws();
        $login->doLogin(array('CELL'=>$cellphone, 'CCODE'=> $ccode, 'PIN'=>$pin, 'OSID'=>$osid));
	
            $cthis->getHelper('SessionHopping')->setDeviceIdentifier();
            $login->createSession();*/
            $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
            //$idm = $login->getIdentity();
            //$ns->userid    = $idm['userid'];
			//$ns->mobileid  = $idm['mobileid'];
            $ns->cellphone = $cellphone;
            $ns->pin       = $pin;
            $ns->osid      = $osid;
            $ns->type      = 'cellphone';
            $ns->countrycode   = $this->_request->getParam("CCODE");
            /*$ns->extinfo["osid"]          = $this->_request->getParam("OSID");
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
            $ns->login_type    = "cellphone";*/

            $c = new App_Cellphone($ns->mobileid);
			
            //$c->updateLogin($ns->appversion,getenv('REMOTE_ADDR'));
            $u = new App_User($c->getUserId());
            $ns->email = $u->getEmail();
			$idm['is_default'] = $c->isDefault();
			

            /*$c->updateExtInfo('iPhone',
                              $ns->extinfo["ip_address"],
                              $ns->extinfo["osid"],
                              $ns->extinfo["systemversion"],
                              $ns->extinfo["appversion"]);*/

            list($name,$domain) = explode('@',$u->getEmail());
            $mname = preg_replace('/^(.).+(.)$/',"$1****$2",$name) . '@' . preg_replace('/^(.).+(.....)$/',"$1****$2",$domain);

            $result['result']['status']                 = 'success';
            $result['result']['data']                   = "";
            $result['result']['data']['key']            = Zend_Session::getId();
            $result['result']['data']['prefs']          = $c->getPrefs();
            $result['result']['data']['messages']       = App_Message::getNewMessageCount( $ns->mobileid );
            $result['result']['data']['be_version']     = App_DataUtils::getVersion();
            $result['result']['data']['masked_email']   = $mname;
            $result['result']['data']['is_default']   	= $idm['is_default'];
			
			
			
			$getpermission = $cthis->getpermission($ns->mobileid,'');
			$permission_check_arr = explode('|',$getpermission);
			
			$profile_permission = $permission_check_arr[0];
			$document_permission = $permission_check_arr[1];
			$message_permission = $permission_check_arr[2];
			$preferences_permission = $permission_check_arr[3];
			$history_permission = $permission_check_arr[4];
			$statement_permission = $permission_check_arr[5];
			$change_pin_permission = $permission_check_arr[6];
			
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
			
			/*$result['result']['permission']['profile']   = $profile_permission;
			$result['result']['permission']['document']   = $document_permission;
			$result['result']['permission']['message']   = $message_permission;
			$result['result']['permission']['preferences']   = $preferences_permission;
			$result['result']['permission']['history']   = $history_permission;
			$result['result']['permission']['statement']   = $statement_permission;
			$result['result']['permission']['change_pin']   = $change_pin_permission;*/
			
			//added api by attune
			$questions = $c->getQuestions();
			
			$ns->first_name = $u->getFirstName();
			$ns->last_name = $u->getLastName();
			$ns->middle_init = $u->getMiddleInit();
$str = $cellphone;
$str = substr_replace($str, '-', 6, 0);
$str = substr_replace($str, ')', 3, 0);
$str = substr_replace($str, '(', 0, 0);
$cellphone = $str;				
			//cell
			$birthdate = $u->getBirthdate();
			$timestamp = strtotime($birthdate);
			$new_birthdate = date('m/d/Y',$timestamp);
			//first_page
			
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
			
			//third_page
			$result['result']['profile']['email']   = $ns->email;
			$q_count = 0;
			foreach($questions as $question){
				$result['result']['profile']['question'][] = $question['question'];
				$result['result']['profile']['answer'][] = $question['answer'];
				$result['result']['profile']['question_id'][] = $question['question_id'];
				$q_count++;
			}
			$result['result']['profile']['question_count'] = $q_count;
		
			//fourth_page
			//profile_picture
			$result['result']['profile']['signature']   	= $u->getSignature();
			
	 App_DataUtils::commit();

            return $result;

    }
}
