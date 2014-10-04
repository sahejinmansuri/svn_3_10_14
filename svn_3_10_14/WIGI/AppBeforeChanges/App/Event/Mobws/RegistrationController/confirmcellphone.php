<?php

class App_Event_Mobws_RegistrationController_confirmcellphone extends App_Event_WsEventAbstract {

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
                'CODE' => array('generic', 50, 0, App_Constants::getFormLabel('CODE')),
                'PIN' => array('generic', 50, 0, App_Constants::getFormLabel('PIN')),
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
    
    public function execute(&$cthis){

                App_DataUtils::beginTransaction();

                $cellphone = $this->_request->getParam("CELLPHONE");
                $country = $this->_request->getParam("COUNTRY");
                $code = $this->_request->getParam("CODE");
                $pin = $this->_request->getParam("PIN");
                $osid = $this->_request->getParam("OSID");
                $phone_brand = $this->_request->getParam("PHONE_BRAND");
                $allparams = $this->_request->getParams();

                $result = array('status' => 'failure');

                $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country);
                $c = new App_Cellphone($mobileid);

                $u = new App_User( $c->getUserId() );
                if (! $u->isEmailConfirmed() ) {
                                $m = new App_Messenger();
                                $msg = new App_Messages();
                                $emailMsg = $msg->getConsumerRegister($u->getFirstName(), $u->getLastName(),$u->getEmail(),$u->getEmailConfirmationCode(),$u->getUserId());
                                $m->sendMessage($emailMsg,$u->getEmail(),'1'); //email
                }

                if($c->confirm($code,$phone_brand)){
                  $u = new App_User($c->getUserId());
                  if (!$u->hasDefaultCellphone()) {
                    $c->setDefault($cellphone);
                  }

                  $result['result']['status'] = 'success';
                }

                App_DataUtils::commit();

                $params = array('CELLPHONE' => $cellphone, 'CCODE' => $country,'PIN' => $pin,'OSID' => $osid, 'IDENTIFIER' => $osid, $allparams);
                $cthis->getHelper('redirector')->goto('consolidatedauth','auth','mobws',$params);
 
    }
}
