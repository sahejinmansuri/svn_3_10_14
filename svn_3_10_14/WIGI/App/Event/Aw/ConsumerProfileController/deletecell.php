<?php

class App_Event_Aw_ConsumerProfileController_deletecell extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ITEM'  => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
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

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";


                        $uid = $session_data->identity['userid'];
                        $user = new App_User($uid);

                        $item = $this->_request->getParam("ITEM");

                        $cellobj = new App_Cellphone($item);
                        if ($uid != $cellobj->getUserId()) {
                          throw new App_Exception_WsException('You do not own this cellphone.');
                        }


                        if ($item != null && is_numeric($item)) {

                                $pview->ITEM = $item;

                                if ($this->_request->getParam('doaction') != null) {

                                        $ucell = new App_Models_Db_Wigi_UserMobile();
                                        $ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $item));

                                        $pin = $this->_request->getParam('PIN');
                                        $password = $this->_request->getParam('PASSWORD');
                                        $checkfields = ($user->passwordMatches($password) && $cellobj->pinMatches($pin));

                                        if ($ucget['is_default'] == 1 || $ucget['balance'] > 0 || $cellobj->getNoActiveCodes() > 0 || !$checkfields) {

                                                if (!$checkfields) {
                                                        $errno = "error1";
                                                } elseif ($ucget['is_default'] == 1) {
                                                        $errno = "error2";
                                                } elseif ($ucget['balance'] > 0) {
                                                        $errno = "error3";
                                                } elseif ($cellobj->getNoActiveCodes() > 0) {
                                                        $errno = "error4";
                                                }
                                                $pview->showcontent = $errno;

                                        } else {

                                                $ucdel = $ucell->update(
                                                        array('status' => 'deleted'),
                                                        $ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
                                                );

                                                $country_code = $user->getCountryCode();
                                                $cellphone = $countrycode . $ucget['cellphone'];

                                                $m = new App_Messenger();
                                                $m->sendMessage("Your cell phone $cellphone has been successfully deleted from your account.",$user->getEmail(),'1',"InCashMe : Delete Cellphone");

                                                $pview->showcontent = "success";

                                        }

                                }

                        } else {

                                $pview->ITEM = "";

                        }


    }
}
