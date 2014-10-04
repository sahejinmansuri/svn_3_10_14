<?php

class App_Event_Cw_ProfileController_editpassword extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'OLDPASSWORD'  => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
                'NEWPASSWORD'    => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
                'NEWPASSWORD_CONFIRM'   => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
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

                App_DataUtils::beginTransaction();

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";

                        $uid = $session_data->identity['userid'];
                        $user = new App_User($uid);

                        if ($this->_request->getParam('doaction') != null) {

                                $oldpassword = $this->_request->getParam('OLDPASSWORD');
                                $newpassword1 = $this->_request->getParam('NEWPASSWORD');
                                $newpassword2 = $this->_request->getParam('NEWPASSWORD_CONFIRM');

                                if ($newpassword1 == $newpassword2 && strlen($newpassword1) >= 8 && $user->passwordMatches($oldpassword)) {

                                        $uinfo = new App_Models_Db_Wigi_User();
                                        $uinfof = $uinfo->update(
                                                array(
                                                        'password' => Atlasp_Utils::inst()->encryptPassword($newpassword1)
                                                ),
                                                $uinfo->getAdapter()->quoteInto('user_id = ?', $uid)
                                        );

                                        $pview->showcontent = "success";

                                } else {

                                        $pview->showcontent = "error";

                                }

                        }

                        App_DataUtils::commit();

    }
}
