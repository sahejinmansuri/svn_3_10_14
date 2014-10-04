<?php

class App_Event_Posws_AuthController_getquestions extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'LOGIN' => array('generic', 50, 0, App_Constants::getFormLabel('LOGIN')),
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
    $email = $this->_request->getParam("LOGIN");
    $result = array();
    $uid = App_User::getUserIdFromEmail($email);
    $u = new App_User($uid);

    if ($u->getType() !== "merchant") { throw new App_Exception_WsException("Only valid for merchant accounts"); }

    $mobileid = $u->getDefaultCellphone();
    $c = new App_Cellphone($mobileid);
    $result['result']['data'] =  $c->getRealAndFakeQuestions(); //$c->getRandQuestion();
    $result['result']['status'] = 'success';
    App_DataUtils::commit();
    return $result; 

  }

}
