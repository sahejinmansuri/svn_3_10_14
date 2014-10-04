<?php

class App_Event_Mobws_RegistrationController_confirmcellphoneandsetosid extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CELLPHONE' => array('generic', 50, 0, App_Constants::getFormLabel('CELLPHONE')),
                'COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY')),
                'PIN' => array('generic', 50, 0, App_Constants::getFormLabel('PIN')),
                'CODE' => array('generic', 50, 0, App_Constants::getFormLabel('CODE')),
                'OSID' => array('generic', 50, 0, App_Constants::getFormLabel('OSID')),
                'PHONE_BRAND' => array('generic', 50, 0, App_Constants::getFormLabel('PHONE_BRAND')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(){
                App_DataUtils::beginTransaction();

                $cellphone = $this->_request->getParam("CELLPHONE");
                $country = $this->_request->getParam("COUNTRY");
                $pin = $this->_request->getParam("PIN");
                $code = $this->_request->getParam("CODE");
                $osid = $this->_request->getParam("OSID");
                $phone_brand = $this->_request->getParam("PHONE_BRAND");

                $result = array();

	
                $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country);
	
                $c = new App_Cellphone($mobileid);

                $u = new App_User( $c->getUserId() );

                //$c = new App_Cellphone($mobileid);
                //$u = new App_User($c->getUserId());
                $c->confirm($code,$phone_brand);
				
                $dataRes=array('title'=>'Congratulations','message'=>'Your cellphone has been verified.');
				
				//set for os_id start
				$um = new App_Models_Db_Wigi_UserMobileOsId();
				$keyval = array(
				   'user_id'     => $c->getUserId(),
				   'mobile_id' => $mobileid,
				   'os_id'      => $osid
				);
				
				$um->insert($keyval);
				//set for os_id end
				
                if (! $u->isEmailConfirmed() ) {
					if (!$u->hasDefaultCellphone()) {
					  $c->setDefault($cellphone);
					}
					$c->authorize($osid);
                                $m = new App_Messenger();
                                $msg = new App_Messages();
                                $emailMsg = $msg->getConsumerRegister($u->getFirstName(), $u->getLastName(),$u->getEmail(),$u->getEmailConfirmationCode(),$u->getUserId());
                                $m->sendMessage($emailMsg,$u->getEmail(),'1'); //email
								$dataRes=array('title'=>'Congratulations','message'=>'Your cellphone has been verified. One more step to go! We will now send you an email to verify the address and complete the Account setup. Check your SPAM folder as the activation email MAY go there. Follow the instruction in the email we are sending you.');
                }

				
                $result['result']['status'] = 'success';
                $result['result']['value']  = '';
                $result['result']['data']   = $dataRes;



                App_DataUtils::commit();

                return $result;
 
    }
}
