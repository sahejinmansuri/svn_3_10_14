<?php

class App_Event_Posws_RegistrationController_getquestion extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'LOGIN' => array('generic', 50, 1, App_Constants::getFormLabel('LOGIN')),
                'PASSWD' => array('generic', 50, 1, App_Constants::getFormLabel('PASSWD')),
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

                $username         = $this->_request->getParam('LOGIN');
                $passwd           = $this->_request->getParam('PASSWD');

                $uid = App_User::getUserIdFromEmail($username);
                $user = new App_User($uid);

                $result = array();
                $c = new App_Cellphone( $user->getDefaultCellphone() );

                if( $user->passwordMatches($passwd) ){

                    $result['result']['data'] =  $c->getRealAndFakeQuestions();
                    $result['result']['status'] = 'success';

                } else {
                    $result['result']['status'] ='failure';
                }

                App_DataUtils::commit();

                return $result;
    }
}
