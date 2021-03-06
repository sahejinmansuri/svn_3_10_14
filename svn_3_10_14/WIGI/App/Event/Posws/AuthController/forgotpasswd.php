<?php

class App_Event_Posws_AuthController_forgotpasswd extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'LOGIN' => array('generic', 50, 0, App_Constants::getFormLabel('LOGIN')),
                'QUESTION' => array('generic', 50, 0, App_Constants::getFormLabel('QUESTION')),
                'ANSWER' => array('generic', 50, 0, App_Constants::getFormLabel('ANSWER')),
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
    
    $email = $this->_request->getParam('LOGIN');
    $uid = App_User::getUserIdFromEmail($email);
    
    $question = $this->_request->getParam('QUESTION');
     $answer = $this->_request->getParam('ANSWER');


    $user = new App_User($uid);

    if ($user->getType() !== "merchant") { throw new App_Exception_WsException("Only valid for merchant accounts"); }

    $mid = $user->getDefaultCellphone();
    $status = $user->getStatus();
    
    $cell = new App_Cellphone($mid);

    $m = new App_Messenger();

    $checkanswer = $cell->questionMatches($question, $answer);
   
    if (!$checkanswer) { throw new App_Exception_WsException("Incorrect question or answer"); }

    $temp_pass = $user->getRandPassword();
    $user->setPassword($temp_pass);
    $user->setPasswordNeedsChanging(true);
    $m->sendMessage("Your temporary password is $temp_pass", $user->getEmail(), 1);

    $result['result']['data'] = 'Mail has been send your email address.';
    $result['result']['status'] = 'success';
    App_DataUtils::commit();
    return $result; 

  }

}
