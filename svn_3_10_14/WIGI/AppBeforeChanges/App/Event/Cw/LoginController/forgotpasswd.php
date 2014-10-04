<?php

class App_Event_Cw_LoginController_forgotpasswd extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'LOGIN'  => array('generic', 125, 0, App_Constants::getFormLabel('LOGIN')),
                'QUESTION' => array('generic', 125, 0, App_Constants::getFormLabel('QUESTION')),
                'ANSWER' => array('generic', 125, 0, App_Constants::getFormLabel('ANSWER')),
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

        try {
        App_DataUtils::beginTransaction();

        $pview->showcontent = "form";
        
        if ($this->_request->getParam('doaction') != null && $this->_request->getParam('ANSWER') == null) {

        $email = $this->_request->getParam('LOGIN');
        $uid = App_User::getUserIdFromEmail($email);

        $a = new App_Auth();
        $a->userConstraintCheck('consumer',$uid,'',false,false);
        $user = new App_User($uid);
        $mid = $user->getDefaultCellphone();
        $status = $user->getStatus();

        $cell = new App_Cellphone($mid);
        $pview->question = $cell->getRandQuestion();

        $pview->LOGIN = $email;
        $pview->showcontent = "form2";

        } else if ($this->_request->getParam('doaction') != null && $this->_request->getParam('ANSWER') != null) {

        $email = $this->_request->getParam('LOGIN');
        $uid = App_User::getUserIdFromEmail($email);
        $question = $this->_request->getParam('QUESTION');
        $answer = $this->_request->getParam('ANSWER');


        $a = new App_Auth();
        $a->userConstraintCheck('consumer',$uid,'',false,false);
        $user = new App_User($uid);
        $mid = $user->getDefaultCellphone();
        $status = $user->getStatus();

        $cell = new App_Cellphone($mid);
        $pview->question = $cell->getRandQuestion();

        $m = new App_Messenger();

        $pview->LOGIN = $email;

        $pview->showcontent = "form2";

        $checkanswer = $cell->questionMatches($question, $answer);

        if ($checkanswer) {

            $temp_pass = $user->getRandPassword();
            $user->setPassword($temp_pass);
            $user->setPasswordNeedsChanging(true);
            $m->sendMessage("Your temporary password is $temp_pass", $user->getEmail(), 1);
            $user->resetSuspendCount();
            $pview->showcontent = "success";


        } else {
            $user->increaseSuspendCount();
            $pview->showcontent = "error";
        }

        App_DataUtils::commit();

        }

        } catch (Exception $e) { $pview->showcontent = "error"; }
    }
}
