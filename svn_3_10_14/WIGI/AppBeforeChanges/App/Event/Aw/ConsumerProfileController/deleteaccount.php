<?php

class App_Event_Aw_ConsumerProfileController_deleteaccount extends App_Event_WsEventAbstract  {

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

                                if ($user->passwordMatches($this->_request->getParam('PASSWORD')) && !($user->getBalance() > 0) && !($user->getNoActiveCodes() > 0)) {
                                        $user_obj = new App_User($uid);
                                        $messenger = new App_Messenger();
                                        $messages = new App_Messages();
                                        $message = $messages->getConsumerDelete($user_obj->getFirstName(), $user_obj->getLastName(), $user_obj->getEmail(), "All cellphones");
                                        $messenger->sendMessage($message,$user_obj->getEmail(),'1');
                                        $u = new App_Models_Db_Wigi_User();
                                        $udel = $u->update(
                                                array('status' => 'deleted'),
                                                $u->getAdapter()->quoteInto('user_id = ?', $uid)
                                        );
                                        $uc = new App_Models_Db_Wigi_UserMobile();
                                        $ucdel = $uc->update(
                                                array('status' => 'deleted'),
                                                $uc->getAdapter()->quoteInto('user_id = ?', $uid)
                                        );

                                        $m = new App_Messenger();
                                        $m->sendMessage("Your account has been successfully deleted.",$user->getEmail(),'1');

                                        // placeholder: for bye-bye message

                                        $login = new App_Login_Cw();
                                        $login->logout();
                                        Zend_Session::destroy();

                                        $sessmod = new App_Models_Db_Wigisession_Sessions();
                                        $sesswhere = $sessmod->getAdapter()->quoteInto('login_id = ?', $user->getEmail());
                                        $sessmod->delete($sesswhere);


                                        $cthis->redirect('loggedout','login','cw');

                                } else {

                                        if (! $user->passwordMatches($this->_request->getParam('PASSWORD'))) {
                                                $errno = "error1";
                                        } elseif ($user->getBalance() > 0) {
                                                $errno = "error2";
                                        } elseif ($user->getNoActiveCodes() > 0) {
                                                $errno = "error3";
                                        }
                                        $showcontent = $errno;

                                }

                        }

    }
}
