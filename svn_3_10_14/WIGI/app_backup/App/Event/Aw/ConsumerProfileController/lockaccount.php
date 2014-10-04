<?php

class App_Event_Aw_ConsumerProfileController_lockaccount extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => 0

        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$session_data,&$pview,&$cthis){

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";

                        $uid = $session_data->identity['userid'];
                        $user = new App_User($uid);

                        if ($this->_request->getParam('doaction') != null) {

                                if ($user->passwordMatches($this->_request->getParam('PASSWORD'))) {

                                        $u = new App_Models_Db_Wigi_User();
                                        $udel = $u->update(
                                                array('status' => 'locked'),
                                                $u->getAdapter()->quoteInto('user_id = ?', $uid)
                                        );
                                        $uc = new App_Models_Db_Wigi_UserMobile();
                                        $uclock = $uc->update(
                                                array('status' => 'locked'),
                                                array(
                                                        $uc->getAdapter()->quoteInto('user_id = ?', $uid),
                                                        $uc->getAdapter()->quoteInto('status != ?', 'deleted')
                                                )
                                        );

                                        $m = new App_Messenger();
                                        $m->sendMessage("Your account has been successfully locked.",$user->getEmail(),'1');

                                        // placeholder: for bye-bye message

                                        $login = new App_Login_Cw();
                                        $login->logout();
                                        Zend_Session::destroy();
                                        $cthis->redirect('loggedout','login','cw');

                                } else {

                                        $pview->showcontent = "error";

                                }

                        }

    }
}
