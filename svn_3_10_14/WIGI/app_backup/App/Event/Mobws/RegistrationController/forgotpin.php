<?php

class App_Event_Mobws_RegistrationController_forgotpin extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CELLPHONE' => array('generic', 50, 1, App_Constants::getFormLabel('CELLPHONE')),
                'COUNTRY' => array('generic', 50, 1, App_Constants::getFormLabel('COUNTRY')),
                'QUESTION' => array('generic', 50, 1, App_Constants::getFormLabel('QUESTION')),
                'ANSWER' => array('generic', 50, 1, App_Constants::getFormLabel('ANSWER')),
                'OSID' => array('generic', 50, 1, App_Constants::getFormLabel('OSID')),
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
                $answer = $this->_request->getParam("ANSWER");
                $question = $this->_request->getParam("QUESTION");
                $osid = $this->_request->getParam("OSID");
                $result = array();

                $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country);

                if (!($mobileid > 0)) {
                        throw new App_Exception_WsException('Cellphone is not a registered InCashMe account');
                }


                $c = new App_Cellphone($mobileid);

                if (!($c->isAuthorized($osid))) {
                        throw new App_Exception_WsException('Cellphone is not authorized');
                }

                if (!($c->isActive($osid))) {
                        throw new App_Exception_WsException('Cellphone is not active');
                }

                $clearpin = rand(1000000,9999999);
                $newpin = Atlasp_Utils::inst()->encryptPassword($clearpin);

                if( $c->forgotPin($question,$answer,$newpin) == false) {
                    $result['result']['status'] = 'failure';
                } else {
                    $c->sendMessage("Your pin has been reset. Your new pin is $clearpin");
                    $result['result']['status'] = 'success';
                }

                $result['result']['value']  = '';
                $result['result']['data']   = '';


                App_DataUtils::commit();

                return $result;

    }
}
