<?php

class App_Event_Mobws_RegistrationController_checkloginid extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'LOGINID' => array('generic', 50, 1, App_Constants::getFormLabel('LOGINID')),
                'PASSWORD' => array('generic', 50, 1, App_Constants::getFormLabel('PASSWORD')),
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

        $loginid = $this->_request->getParam('LOGINID');
        $password = $this->_request->getParam("PASSWORD");

        if(App_User::getUserIdFromEmail($loginid) > 0 ){
            throw new App_Exception_WsException('Email is already registered');
        }

        if (!App_DataUtils::passwordStrength($password)) {
            throw new App_Exception_WsException('Password needs to to be between 8 and 16 characters, one uppercase, one lowercase, and one number');
        }


        $result = array();
        $result['result']['status'] = 'success';
        $result['result']['value']  = '';
        $result['result']['data']   = '';

        App_DataUtils::commit();

        return $result; 
    }
}
