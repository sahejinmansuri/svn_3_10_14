<?php

class App_Event_Posws_RegistrationController_signup extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
				//personal information
                'FIRST_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('FIRST_NAME')),
                'LAST_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('LAST_NAME')),
				'NATIONALITY' => array('generic', 50, 0, App_Constants::getFormLabel('NATIONALITY')),
                'COUNTRY_CODE' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY_CODE')),
                'CELLPHONE' => array('generic', 50, 0, App_Constants::getFormLabel('CELLPHONE')),
				'EMAIL_ADDRESS' => array('generic', 50, 0, App_Constants::getFormLabel('EMAIL_ADDRESS')),
                'BIRTHDATE' => (array('generic', 50, 0, App_Constants::getFormLabel('BIRTHDATE'))),
				'GENDER' => array('generic', 50, 0, App_Constants::getFormLabel('GENDER')),
				'MARITAL_STATUS' => array('generic', 50, 0, App_Constants::getFormLabel('MARITAL_STATUS')),
				'SPOUSE_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('SPOUSE_NAME')),
				'OCCUPATION' => array('generic', 50, 0, App_Constants::getFormLabel('OCCUPATION')),
				
				//Legal information
				'MIDDLE_INIT' => array('generic', 50, 0, App_Constants::getFormLabel('MIDDLE_INIT')),
				'ANNUAL_INCOME' => array('generic', 50, 0, App_Constants::getFormLabel('ANNUAL_INCOME')),
				'STATUS' => array('generic', 50, 0, App_Constants::getFormLabel('STATUS')),
				'PAN_NO' => array('generic', 50, 0, App_Constants::getFormLabel('PAN_NO')),
				'AADHAR_ID' => array('generic', 50, 0, App_Constants::getFormLabel('AADHAR_ID')),
				'SUBMITTED_ID_PROOF' => array('generic', 50, 0, App_Constants::getFormLabel('SUBMITTED_ID_PROOF')),
				
                //shipping Address
				//'APP_SUITE' => array('generic', 50, 0, App_Constants::getFormLabel('APP_SUITE')),
                'ADDRESS' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS')),
                'ADDRESS2' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS2')),
                'CITY' => array('generic', 50, 0, App_Constants::getFormLabel('CITY')),
                'ZIP' => array('generic', 50, 0, App_Constants::getFormLabel('ZIP')),
                'STATE' => array('generic', 50, 0, App_Constants::getFormLabel('STATE')),
				'COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY')),
				'LANDLINE_HOME1' => array('generic', 50, 0, App_Constants::getFormLabel('LANDLINE_HOME1')),
				'LANDLINE_HOME2' => array('generic', 50, 0, App_Constants::getFormLabel('LANDLINE_HOME2')),
				
				//permanent address
				//'PT_APP_SUITE' => array('generic', 50, 0, App_Constants::getFormLabel('PT_APP_SUITE')),
				'PT_ADDRESS' => array('generic', 50, 0, App_Constants::getFormLabel('PT_ADDRESS')),
				//'PT_ADDRESS2' => array('generic', 50, 0, App_Constants::getFormLabel('PT_ADDRESS2')),
				'PT_CITY' => array('generic', 50, 0, App_Constants::getFormLabel('PT_CITY')),
				'PT_ZIP' => array('generic', 50, 0, App_Constants::getFormLabel('PT_ZIP')),
				'PT_STATE' => array('generic', 50, 0, App_Constants::getFormLabel('PT_STATE')),
				'PT_COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('PT_COUNTRY')),
				//'PT_LANDLINE_HOME1' => array('generic', 50, 0, App_Constants::getFormLabel('PT_LANDLINE_HOME1')),
				//'PT_LANDLINE_HOME2' => array('generic', 50, 0, App_Constants::getFormLabel('PT_LANDLINE_HOME2')),
				'ADDRESS_PROOF' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS_PROOF')),
				
				'EMAIL' => array('generic', 50, 0, App_Constants::getFormLabel('EMAIL')),
                'PASSWORD' => array('generic', 50, 0, App_Constants::getFormLabel('PASSWORD')),
                'PIN' => array('generic', 50, 0, App_Constants::getFormLabel('PIN')),
                'QUESTION' => array('generic', 50, 0, App_Constants::getFormLabel('QUESTION')),
                'ANSWER' => array('generic', 50, 0, App_Constants::getFormLabel('ANSWER')),
				
				'SIGNATURE' => array('generic', 50, 0, App_Constants::getFormLabel('SIGNATURE')),
			
			
			
			//	'BUSINESS_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('BUSINESS_NAME')),
				
				'DATE_OF_INCORPORATION' => array('generic', 50, 0, App_Constants::getFormLabel('DATE_OF_INCORPORATION')),
				'PLACE_OF_INCORPORATION' => array('generic', 50, 0, App_Constants::getFormLabel('PLACE_OF_INCORPORATION')),
				'VATTIN' => array('generic', 50, 0, App_Constants::getFormLabel('VATTIN')),
				'CSTTIN' => array('generic', 50, 0, App_Constants::getFormLabel('CSTTIN')),
				'SERVICE_TAX' => array('generic', 50, 0, App_Constants::getFormLabel('SERVICE_TAX')),
				'LEGAL_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('LEGAL_NAME')),
				'DOING_BUSINESS' => array('generic', 50, 0, App_Constants::getFormLabel('DOING_BUSINESS')),
				'INVOLVED_PROVIDING' => array('generic', 50, 0, App_Constants::getFormLabel('INVOLVED_PROVIDING')),
				'FOREIGN_EXCHANGE' => array('generic', 50, 0, App_Constants::getFormLabel('FOREIGN_EXCHANGE')),
				'GAMING' => array('generic', 50, 0, App_Constants::getFormLabel('GAMING')),
				'MONEY_LENDING' => array('generic', 50, 0, App_Constants::getFormLabel('MONEY_LENDING'))
				
				/*'RESIDENT' => array('generic', 50, 0, App_Constants::getFormLabel('RESIDENT')),
				'LANDLINE_HOME' => array('generic', 50, 0, App_Constants::getFormLabel('LANDLINE_HOME')),
				'LANDLINE_OFFICE' => array('generic', 50, 0, App_Constants::getFormLabel('LANDLINE_OFFICE')),*/
            )
        );
		
    }
	
		
  
    
    public function execute(){
               App_DataUtils::beginTransaction();
 
				
		$first_name = $this->_request->getParam("FIRST_NAME");
		$last_name = $this->_request->getParam("LAST_NAME");
		$nationality = $this->_request->getParam("NATIONALITY");	
		$country_code = $this->_request->getParam("COUNTRY_CODE");
		$cellphone = $this->_request->getParam("CELLPHONE");
		$email_address = $this->_request->getParam("EMAIL_ADDRESS");
        $birthdate = $this->_request->getParam("BIRTHDATE");
		$gender = $this->_request->getParam("GENDER");		
		$marital_status = $this->_request->getParam("MARITAL_STATUS");		
		$spouse_name = $this->_request->getParam("SPOUSE_NAME");		
		$occupation = $this->_request->getParam("OCCUPATION");	

		$miidle_init = $this->_request->getParam("MIDDLE_INIT");
		$annual_income = $this->_request->getParam("ANNUAL_INCOME");
		$status = $this->_request->getParam("STATUS"); //new	
		$pan_no = $this->_request->getParam("PAN_NO");		
		$aadhar_id = $this->_request->getParam("AADHAR_ID");		
		$submitted_id_proof = $this->_request->getParam("SUBMITTED_ID_PROOF");	
		
		$app_suite = $this->_request->getParam("APP_SUITE"); //new
		$address = $this->_request->getParam("ADDRESS");
        $address2 = $this->_request->getParam("ADDRESS2");
		$city = $this->_request->getParam("CITY");
		$zip = $this->_request->getParam("ZIP");
		$state = $this->_request->getParam("STATE");
		$country = $this->_request->getParam("COUNTRY");
		$landline_home1 = $this->_request->getParam("LANDLINE_HOME1"); //new
		$landline_home2 = $this->_request->getParam("LANDLINE_HOME2"); //new
		
		$pt_app_suite = $this->_request->getParam("PT_APP_SUITE"); //new
		$pt_address = $this->_request->getParam("PT_ADDRESS");
		$pt_address2 = $this->_request->getParam("PT_ADDRESS2"); //new
		$pt_city = $this->_request->getParam("PT_CITY");
		$pt_zip = $this->_request->getParam("PT_ZIP");
		$pt_state = $this->_request->getParam("PT_STATE");
		$pt_country = $this->_request->getParam("PT_COUNTRY");
		$pt_landline_home1 = $this->_request->getParam("PT_LANDLINE_HOME1"); //new
		$pt_landline_home2 = $this->_request->getParam("PT_LANDLINE_HOME2"); //new
		$address_proof = $this->_request->getParam("ADDRESS_PROOF");
		
		
		
		//$business_name = $this->_request->getParam("BUSINESS_NAME");
		
		$date_of_incorporation = $this->_request->getParam("DATE_OF_INCORPORATION");
		$place_of_incorporation = $this->_request->getParam("PLACE_OF_INCORPORATION");
		$vattin = $this->_request->getParam("VATTIN");
		$csttin = $this->_request->getParam("CSTTIN");
		$service_tax = $this->_request->getParam("SERVICE_TAX");
		$legal_name = $this->_request->getParam("LEGAL_NAME");
		$doing_business = $this->_request->getParam("DOING_BUSINESS");
		$involved_providing = $this->_request->getParam("INVOLVED_PROVIDING");
		$foreign_exchange = $this->_request->getParam("FOREIGN_EXCHANGE");
		$gaming = $this->_request->getParam("GAMING");
		$money_lending = $this->_request->getParam("MONEY_LENDING");
		
		
		
		/*$status= '';
		
		$country = '';
		$pt_country = '';
	$pt_address = '';
	$pt_city = '';
	$pt_state = '';
	$pt_zip = '';
	$email_address = '';
	$address_proof = '';
	$landline_home = '';
	$landline_office = '';
	$signature = '';*/
		
		$email = $this->_request->getParam("EMAIL");
		$password = $this->_request->getParam("PASSWORD");
		$pin = $this->_request->getParam("PIN");
		$question = $this->_request->getParam("QUESTION");
		$answer = $this->_request->getParam("ANSWER");
		$signature = $this->_request->getParam("SIGNATURE");
		
		
		$resident = $this->_request->getParam("RESIDENT");	
		$landline_office = $this->_request->getParam("LANDLINE_OFFICE");
		
if(!isset($country)){
	$country = '';
}
if(!isset($pt_country)){
	$pt_country = '';
}
if(!isset($pt_address)){
	$pt_address = '';
}
if(!isset($pt_city)){
	$pt_city = '';
}
if(!isset($pt_state)){
	$pt_state = '';
}
if(!isset($pt_zip)){
	$pt_zip = '';
}
if(!isset($email_address)){
	$email_address = '';
}
if(!isset($address_proof)){
	$address_proof = '';
}
if(!isset($landline_home)){
	$landline_home = '';
}
if(!isset($landline_office)){
	$landline_office = '';
}
if(!isset($signature)){
	$signature = '';
}
if(!isset($status)){
	$status = '';
}
if(!isset($app_suite)){
	$app_suite = '';
}
if(!isset($pt_app_suite)){
	$pt_app_suite = '';
}
if(!isset($pt_address2)){
	$pt_address2 = '';
}
if(!isset($pt_landline_home1)){
	$pt_landline_home1 = '';
}
if(!isset($pt_landline_home2)){
	$pt_landline_home2 = '';
}
if(!isset($landline_home1)){
	$landline_home1 = '';
}
if(!isset($landline_home2)){
	$landline_home2 = '';
}	


if(!isset($date_of_incorporation)){
	$date_of_incorporation = '';
}	
if(!isset($place_of_incorporation)){
	$place_of_incorporation = '';
}
if(!isset($vattin)){
	$vattin = '';
}
if(!isset($csttin)){
	$csttin = '';
}
if(!isset($service_tax)){
	$service_tax = '';
}
if(!isset($legal_name)){
	$legal_name = '';
}
if(!isset($doing_business)){
	$doing_business = '';
}
if(!isset($involved_providing)){
	$involved_providing = '';
}
if(!isset($foreign_exchange)){
	$foreign_exchange = '';
}
if(!isset($gaming)){
	$gaming = '';
}
if(!isset($money_lending)){
	$money_lending = '';
}


        if(App_User::getUserIdFromEmail($email_address) > 0 ){
            throw new App_Exception_WsException('Email is already registered');
        }

        $testmobileid = App_Cellphone::getIdFromCellphone($cellphone,$country_code);

        if ($testmobileid > 0) {
            throw new App_Exception_WsException('Cellphone is already registered');
        }

			if ( preg_match('/\d\d\d\d-\d\d-\d\d/',$birthdate) ) {
			}
			else {
            $birthdate = App_DataUtils::fmtdate_human2db($birthdate);
        	}


/*
if(!isset($first_name)){
	$first_name = '';
}
if(!isset($last_name)){
	$last_name = '';
}
if(!isset($miidle_init)){
	$miidle_init = '';
}
if(!isset($email)){
	$email = '';
}
if(!isset($nationality)){
	$nationality = '';
}
if(!isset($gender)){
	$gender = '';
}
if(!isset($marital_status)){
	$marital_status = '';
}
if(!isset($spouse_name)){
	$spouse_name = '';
}
if(!isset($occupation)){
	$occupation = '';
}
if(!isset($annual_income)){
	$annual_income = '';
}
if(!isset($status)){
	$status = '';
}
if(!isset($pan_no)){
	$pan_no = '';
}
if(!isset($aadhar_id)){
	$aadhar_id = '';
}
if(!isset($submitted_id_proof)){
	$submitted_id_proof = '';
}
if(!isset($password)){
	$password = '';
}
if(!isset($email_address)){
	$email_address = '';
}
if(!isset($birthdate)){
	$birthdate = '';
}*/
  
        $sp = new App_Db_Sp_UserCreate($this->_request);
        $res = $sp->getSimpleResponse(array(
			'EMAIL' => $email_address,
            'USER_TYPE' => 'merchant',
            'PASSWORD'  => Atlasp_Utils::inst()->encryptPassword($password),
            'STATUS'    => 'unconfirmed',
			'FIRST_NAME' => $first_name,
			'LAST_NAME' => $last_name,
            'MIDDLE_INIT' => $miidle_init,
            'COUNTRY_CODE' => '91',
			'BIRTHDATE' => $birthdate,
            'DATE_ADDED' => date("Y-m-d H:i:s"),
            'USER_ADDED' => $email,
            'USER_CHANGED' => $email,
			'NATIONALITY' => $nationality,
			'GENDER' => $gender,
			'MARITAL_STATUS' => $marital_status,
			'SPOUSE_NAME' => $spouse_name,
			'OCCUPATION' => $occupation,
			'ANNUAL_INCOME' => $annual_income,
			'RESIDENT' => $status,
			'PAN_NO' => $pan_no,
			'AADHAR_ID' => $aadhar_id,
			//'BUSINESS_NAME' => $business_name,
			'SUBMITTED_ID_PROOF' => $submitted_id_proof
			
			
			
			/*'DATE_OF_INCORPORATION' => $date_of_incorporation,
			'PLACE_OF_INCORPORATION' => $place_of_incorporation,
			'VATTIN' => $vattin,
			'CSTTIN' => $csttin,
			'SERVICE_TAX' => $service_tax,
			'LEGAL_NAME' => $legal_name,
			'DOING_BUSINESS' => $doing_business,
			'INVOLVED_PROVIDING' => $involved_providing,
			'FOREIGN_EXCHANGE' => $foreign_exchange,
			'GAMING' => $gaming,
			'MONEY_LENDING' => $money_lending*/
        ));
        
        $userid = $res['@p_user_id'];
        $ecode  = $res['@p_email_code'];
		
//profile image code
$upload = new Zend_File_Transfer_Adapter_Http();
$upload->setDestination("/var/www/html/incash/tmp");
$upload->receive();
$filename = $upload->getFileName('PROFILEIMG');

$extension = explode('.', $filename);	
$timestamp = time();		
$target_path = '/var/www/html/incash/public_html/u/profile/'.$userid.'_'.$timestamp.'.'.$extension[1];
$image_name = $userid.'_'.$timestamp.'.'.$extension[1];
//move_uploaded_file($filename, $target_path);
 $data12  = file_get_contents($filename);
    file_put_contents($target_path,$data12);
 
	$uinfo = new App_Models_Db_Wigi_User();
								$uinfof = $uinfo->update(
                                        array(
                                                'image_path' => $image_name
                                        ),
                                        $uinfo->getAdapter()->quoteInto('user_id = ?', $userid)
                                );
	
//profile image code

        $u = new App_PoswsUser($userid);
        $t = App_Tos::getCurrentTos();
        //$u->addAddress($address,$address2,$city,$state,$zip,$country_code,$country,$pt_country,$pt_address,$pt_city,$pt_state,$pt_zip,$landline_home, $landline_office,$email_address,$address_proof,$signature);
		$u->addAddress($address,$address2,$city,$state,$zip,$country_code,$country,$pt_country,$pt_address,$pt_city,$pt_state,$pt_zip,$landline_home1,$landline_home2,$email_address,$address_proof,$signature,$app_suite,$pt_app_suite,$pt_address2,$pt_landline_home1,$pt_landline_home2 );
/*		echo "hi";
 exit;*/
		$u->addAddress1($date_of_incorporation,$place_of_incorporation, $vattin, $csttin, $service_tax, $legal_name, $doing_business, $involved_providing,$foreign_exchange, $gaming, $money_lending);
		
        $u->setAcceptedTos($t->tos_id);

		$mobile_alias = $first_name." ".$last_name;
        $cellid = $u->addCellphone($cellphone,Atlasp_Utils::inst()->encryptPassword($pin),$mobile_alias,'cellphone' ); 

        $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country_code);

        $cellobj = new App_Cellphone($mobileid);
        $cellobj->setDefault();

	$cellobj->addQuestion($question,$answer);
	
		$uminfo = new App_Models_Db_Wigi_UserMobile();
								$uminfof = $uminfo->update(
                                        array(
                                                'is_default' => '1'
                                        ),
                                        $uinfo->getAdapter()->quoteInto('mobile_id = ?', $mobileid)
                                );

        $defSettings = new App_DefSettings();
        $defSettings->createUserSettings( $userid );
        $defSettings->createMobileSettings( $userid , $mobileid );

        $mobileid = App_Cellphone::getIdFromCellphone($cellphone, $country_code);
        $c = new App_Cellphone($mobileid);
        $u = new App_User($c->getUserId());
		
		/*$pan_no = 'pan_no';
		$aadhar_id = 'aadhar_no';*/
		$data = $data2 = "";
		$number = '';
		//$expires = date('Y-m-d', time());
		$expires = '';
		$de = new App_DocumentEngine();
		if($pan_no != ''){
            $pan_id = $de->addDocument($mobileid,'Other','1',$pan_no,$data,$data2,$pan_no,$expires);
		}
		if($aadhar_id != ''){
			$adh_id = $de->addDocument($mobileid,'Other','1',$aadhar_id,$data,$data2,$aadhar_id,$expires);
		}

        $result = array();
        $result['result']['status'] = 'success';
        $result['result']['value']  = '';
        $result['result']['data']   = '';


        App_DataUtils::commit();
		if($pan_id != ""){
			$uinfo = new App_Models_Db_Wigi_DocInfo();
			$uinfof = $uinfo->update(
                array(
					'number' => $pan_no
				),
				$uinfo->getAdapter()->quoteInto('doc_info_id = ?', $pan_id)
			);
		}
		if($adh_id != ""){
			$uinfo = new App_Models_Db_Wigi_DocInfo();
			$uinfof = $uinfo->update(
                array(
					'number' => $aadhar_id
				),
				$uinfo->getAdapter()->quoteInto('doc_info_id = ?', $adh_id)
			);
		}
	/*print_r($resutl);
	exit;*/
        return $result;

        
    }
}
