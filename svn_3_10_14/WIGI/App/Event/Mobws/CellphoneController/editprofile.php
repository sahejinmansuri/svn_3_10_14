<?php

class App_Event_Mobws_CellphoneController_editprofile extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('generic', 100, 1, App_Constants::getFormLabel('USER')),
                /*'FIRST_NAME'  => array('generic', 100, 0, App_Constants::getFormLabel('FIRST_NAME')),
                'LAST_NAME' => array('generic', 100, 0, App_Constants::getFormLabel('LAST_NAME')),
                'NATIONALITY' => array('generic', 100, 0, App_Constants::getFormLabel('NATIONALITY')),
                'COUNTRY_CODE' => array('generic', 100, 0, App_Constants::getFormLabel('COUNTRY_CODE')),
                'CELLPHONE' => array('generic', 100, 0, App_Constants::getFormLabel('CELLPHONE')),
                'ALTEMAIL' => array('email', 100, 0, App_Constants::getFormLabel('EMAIL')),
                'BIRTHDATE'  => array('int', 5, 0, App_Constants::getFormLabel('BIRTHDATE')),
                //'BIRTH_DAY'    => array('int', 5, 0, App_Constants::getFormLabel('DAY')),
                //'BIRTH_YEAR'   => array('int', 5, 0, App_Constants::getFormLabel('YEAR')),
                'GENDER'   => array('int', 5, 0, App_Constants::getFormLabel('GENDER')),
                'MARITAL_STATUS'   => array('int', 5, 0, App_Constants::getFormLabel('MARITAL_STATUS')),
				'SPOUSE_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('SPOUSE_NAME')),
                'OCCUPATION'   => array('int', 5, 0, App_Constants::getFormLabel('OCCUPATION')),
				
				'MIDDLE_INIT' => array('generic', 50, 0, App_Constants::getFormLabel('MIDDLE_INIT')),
				'STATUS' => array('generic', 50, 0, App_Constants::getFormLabel('STATUS')),
				'PAN_NO' => array('generic', 50, 0, App_Constants::getFormLabel('PAN_NO')),
				'AADHAR_ID' => array('generic', 50, 0, App_Constants::getFormLabel('AADHAR_ID')),
				'ANNUAL_INCOME' => array('generic', 50, 0, App_Constants::getFormLabel('ANNUAL_INCOME')),
				'SUBMITTED_ID_PROOF' => array('generic', 50, 0, App_Constants::getFormLabel('SUBMITTED_ID_PROOF')),
				'KYC' => array('generic', 50, 0, App_Constants::getFormLabel('KYC')),
				
				'APP_SUITE' => array('generic', 50, 0, App_Constants::getFormLabel('APP_SUITE')),
                'ADDRESS' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS')), //Address
                'ADDRESS2' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS2')), //Appt
                'CITY' => array('generic', 50, 0, App_Constants::getFormLabel('CITY')),
                'STATE' => array('generic', 50, 0, App_Constants::getFormLabel('STATE')),
                'ZIP' => array('generic', 50, 0, App_Constants::getFormLabel('ZIP')),
				'COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY')),
				'LANDLINE_HOME1' => array('generic', 50, 0, App_Constants::getFormLabel('LANDLINE_HOME1')),
				'LANDLINE_HOME2' => array('generic', 50, 0, App_Constants::getFormLabel('LANDLINE_HOME2')),
				'ADDRESS_PROOF' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS_PROOF')),
				
				'PT_APP_SUITE' => array('generic', 50, 0, App_Constants::getFormLabel('PT_APP_SUITE')),
				'PT_COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('PT_COUNTRY')),
				'PT_ADDRESS' => array('generic', 50, 0, App_Constants::getFormLabel('PT_ADDRESS')),
				'PT_ADDRESS2' => array('generic', 50, 0, App_Constants::getFormLabel('PT_ADDRESS2')),
				'PT_CITY' => array('generic', 50, 0, App_Constants::getFormLabel('PT_CITY')),
				'PT_STATE' => array('generic', 50, 0, App_Constants::getFormLabel('PT_STATE')),
				'PT_ZIP' => array('generic', 50, 0, App_Constants::getFormLabel('PT_ZIP')),
				'PT_LANDLINE_HOME1' => array('generic', 50, 0, App_Constants::getFormLabel('PT_LANDLINE_HOME1')),
				'PT_LANDLINE_HOME2' => array('generic', 50, 0, App_Constants::getFormLabel('PT_LANDLINE_HOME2')),*/
				
				//'PIN' => array('generic', 50, 0, App_Constants::getFormLabel('PIN')),
            )

        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$session_data,&$pview,&$cthis){


                App_DataUtils::beginTransaction();
                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     
                $pview->pageid = "profile";


                        $uid = $this->_request->getParam("USER");
						
                        $uinfo = new App_Models_Db_Wigi_User();
                        
						
$upload = new Zend_File_Transfer_Adapter_Http();
$upload->setDestination("/var/www/html/incash/tmp");
$upload->receive();
$filename = $upload->getFileName('PROFILEIMG');

$extension = explode('.', $filename);	
$timestamp = time();			
$target_path = '/var/www/html/incash/public_html/u/profile/'.$uid.'_'.$timestamp.'.'.$extension[1];
$image_name = $uid.'_'.$timestamp.'.'.$extension[1];
	


//move_uploaded_file($filename, $target_path);
 $data12  = file_get_contents($filename);
file_put_contents($target_path,$data12);


$uinfof = $uinfo->update(
                                        array(
												'image_path' => $image_name
                                        ),
                                        $uinfo->getAdapter()->quoteInto('user_id = ?', $uid)
                                );


						/*$pview->states = array (
 'AP' => 'Andhra Pradesh',
 'AR' => 'Arunachal Pradesh',
 'AS' => 'Assam',
 'BR' => 'Bihar',
 'CT' => 'Chhattisgarh',
 'GA' => 'Goa',
 'GJ' => 'Gujarat',
 'HR' => 'Haryana',
 'HP' => 'Himachal Pradesh',
 'JK' => 'Jammu & Kashmir',
 'JH' => 'Jharkhand',
 'KA' => 'Karnataka',
 'KL' => 'Kerala',
 'MP' => 'Madhya Pradesh',
 'MH' => 'Maharashtra',
 'MN' => 'Manipur',
 'ML' => 'Meghalaya',
 'MZ' => 'Mizoram',
 'NL' => 'Nagaland',
 'OR' => 'Odisha',
 'PB' => 'Punjab',
 'RJ' => 'Rajasthan',
 'SK' => 'Sikkim',
 'TN' => 'Tamil Nadu',
 'TR' => 'Tripura',
 'UK' => 'Uttarakhand',
 'UP' => 'Uttar Pradesh',
 'WB' => 'West Bengal',
 'AN' => 'Andaman & Nicobar',
 'CH' => 'Chandigarh',
 'DN' => 'Dadra and Nagar Haveli',
 'DD' => 'Daman & Diu',
 'DL' => 'Delhi',
 'LD' => 'Lakshadweep',
 'PY' => 'Puducherry',
);
                        $pview->birthdatedays = 31;
                        $pview->birthdatemonths = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
                        $pview->birthdateyears = date("Y");
						
                        $birthdate = $uinfo->fetchRow($uinfo->select()->where('user_id = ?', $uid));
                        $pview->birthdate_day = date("j", strtotime($birthdate['birthdate']));
                        $pview->birthdate_month = date("n", strtotime($birthdate['birthdate']));
                        $pview->birthdate_year = date("Y", strtotime($birthdate['birthdate']));

                        $uinfof = $uinfo->fetchRow($uinfo->select()->from($uinfo,
                                array('alternate_email', 'alternate_phone')
                        )->where('user_id = ?', $uid));

                        $pview->ALTEMAIL = $uinfof['alternate_email'];
                        $pview->ALTPHONE = $uinfof['alternate_phone'];

                        $uaddr = new App_Models_Db_Wigi_UserAddress();
                        $uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
                                array('addr_line1', 'addr_line2', 'city', 'state', 'zip')
                        )->where('user_id = ?', $uid));

                        $pview->ZIP      = $uaddrf['zip'];
                        $pview->ADDRESS  = $uaddrf['addr_line1'];
                        $pview->ADDRESS2 = $uaddrf['addr_line2'];
                        $pview->CITY     = $uaddrf['city'];
                        $pview->STATE    = $uaddrf['state'];

                        $pview->showcontent = "form";

                                $birthm = $this->_request->getParam("BIRTH_MONTH");
                                $birthd = $this->_request->getParam("BIRTH_DAY");
                                $birthy = $this->_request->getParam("BIRTH_YEAR");
                                $birthdate = $birthy . "-" . $birthm . "-" . $birthd;


							//print $this->_request->getParam('BIRTHDATE');
//exit();					
			$birthdate = $this->_request->getParam('BIRTHDATE');
			$timestamp = strtotime($birthdate);
			$new_birthdate = date('Y-m-d',$timestamp);	

                                

                                                //'nationality' => $this->_request->getParam('NATIONALITY'),
                                                //'country_code' => $this->_request->getParam('COUNTRY_CODE'),
                                $uaddrf = $uaddr->update(
                                        array(
												'app_suite' => $this->_request->getParam('APP_SUITE'),
                                                'addr_line1' => $this->_request->getParam('ADDRESS'),
                                                'addr_line2' => $this->_request->getParam('ADDRESS2'),
                                                'city' => $this->_request->getParam('CITY'),
                                                'state' => $this->_request->getParam('STATE'),
                                                'zip' => $this->_request->getParam('ZIP'),
                                                'country' => $this->_request->getParam('COUNTRY'),
                                                'address_proof' => $this->_request->getParam('ADDRESS_PROOF'),
                                                'landline_home' => $this->_request->getParam('LANDLINE_HOME1'),
                                                'landline_office' => $this->_request->getParam('LANDLINE_HOME2'),
												
                                                'pt_app_suite' => $this->_request->getParam('PT_APP_SUITE'),
                                                'pt_address' => $this->_request->getParam('PT_ADDRESS'),
                                                'pt_address2' => $this->_request->getParam('PT_ADDRESS2'),
                                                'pt_city' => $this->_request->getParam('PT_CITY'),
                                                'pt_state' => $this->_request->getParam('PT_STATE'),
                                                'pt_zip' => $this->_request->getParam('PT_ZIP'),
                                                'pt_country' => $this->_request->getParam('PT_COUNTRY'),
                                                'pt_landline_home1' => $this->_request->getParam('PT_LANDLINE_HOME1'),
                                                'pt_landline_home2' => $this->_request->getParam('PT_LANDLINE_HOME2'),
                                                'date_changed' => date('y-m-d G:i:s')
                                        ),
                                        $uaddr->getAdapter()->quoteInto('user_id = ?', $uid)
                                );*/
								
								$dataRes=array('title'=>'Success','message'=>'Your profile has been updated.');
								$result['result']['status'] = 'success';
								$result['result']['value']  = '';
								$result['result']['data']   = $dataRes;
                       


                        App_DataUtils::commit();
						
		return $result;
    }
}
