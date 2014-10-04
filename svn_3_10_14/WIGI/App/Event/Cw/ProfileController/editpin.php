<?php

class App_Event_Cw_ProfileController_editpin extends App_Event_WsEventAbstract  {

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
    
    public function execute(&$session_data,&$pview,&$c){


                App_DataUtils::beginTransaction();

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";

                                $uid = $session_data->identity['userid'];
                                $u = new App_User($uid);
                                $item = $this->_request->getParam("ITEM");
                                App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$item);

                                if ($item != null && is_numeric($item)) {

                                        $pview->ITEM = $item;

                                        if ($this->_request->getParam('doaction') != null) {

                                                $oldpin = $this->_request->getParam('OLDPIN');
                                                $newpin1 = $this->_request->getParam('NEWPIN');
                                                $newpin2 = $this->_request->getParam('NEWPIN_CONFIRM');

                                                if ($newpin1 == $newpin2 && strlen($newpin1) >= 7 && $c->pinMatches($oldpin)) {

                                                        $ucell = new App_Models_Db_Wigi_UserMobile();
                                                        $ucedit = $ucell->update(
                                                                array(
                                                                        'pin' => Atlasp_Utils::inst()->encryptPassword($newpin1)
                                                                ),
                                                                $ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
                                                        );

                                                        $pview->showcontent = "success";

                                                } else {

                                                        $pview->showcontent = "error";


                                                }

                                        }

                                } else {

                                $pview->ITEM = "";

                        }


                        App_DataUtils::commit();

    }
}
