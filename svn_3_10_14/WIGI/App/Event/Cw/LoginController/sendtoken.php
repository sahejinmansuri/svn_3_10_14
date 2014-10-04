<?php

class App_Event_Cw_LoginController_sendtoken extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'LOGIN'  => array('generic', 25, 1, App_Constants::getFormLabel('LOGIN')),
                'PASSWD' => array('generic', 25, 1, App_Constants::getFormLabel('PASSWD')),
                'MSGTYPE' => array('generic', 25, 1, App_Constants::getFormLabel('MSGTYPE')),
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

//            App_DataUtils::beginTransaction();

            $u = $this->_request->getParam('LOGIN');
            $passwd = $this->_request->getParam('PASSWD');
            $msgtype = $this->_request->getParam('MSGTYPE');

            $userid = App_User::getUserIdFromEmail($u);
            $a = new App_Auth();
            $code = $a->auth1('consumer',$userid,$passwd);

            $u = new App_User($userid);
            $user = $u;
			$mobiles = $u->getCellphones();
            //$mobile_id = $u->getDefaultCellphone(); //comment by attune
            $mobile_id = $mobiles[0]['mobile_id'];
            $c = new App_Cellphone($mobile_id);

            if ($c->isLocked() && $msgtype !== "email") {
                throw new App_Exception_WsException('Default cellphone is locked. Please use the link below to login.');
                return false;
            }

            $cellphone = $c->getCellphone();

            $m = new App_Messenger();

            //send OTP Code
            if ($msgtype === "email") {
                $m->sendMessage("Your Authentication Code is $code. This code will expire in 10 minutes.",$u->getEmail(),'1');
            } else {
                $m->sendMessage("Your Authentication Code is $code. This code will expire in 10 minutes.",$c->getCellphone(),'2');
            }
                $cthis->getHelper('ViewRenderer')->setNoRender();

  //          App_DataUtils::commit();

    }
}
