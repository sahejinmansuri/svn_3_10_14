<?php

class App_Event_Cw_ProfileController_unlockcell extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ITEM'  => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
                'PIN'  => array('generic', 100, 0, App_Constants::getFormLabel('PIN')),
                'PASSWORD'  => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
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

        $item = $this->_request->getParam("ITEM");

        $cellphones = $user->getFmtCellphones();
        $pview->selectedcellphone = "";

        if ($item != null && is_numeric($item)) {

               $c = new App_Cellphone($item);
               App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$item);

                $pview->ITEM = $item;

                foreach ($cellphones as $cell) {
                        if ($cell['mobile_id'] == $item) {
                                $pview->selectedcellphone = $cell['cellphone'];
                        }
                        echo $cell['cellphone'];
                }

                if ($this->_request->getParam('doaction') != null) {

                        $pin = $this->_request->getParam('PIN');
                        $password = $this->_request->getParam('PASSWORD');

                        if ($user->passwordMatches($password) && $c->pinMatches($pin)) {

                            $ucell = new App_Models_Db_Wigi_UserMobile();
                            $ucdel = $ucell->update(
                                    array('status' => 'active'),
                                    $ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
                            );

							$cellphone = $c->getFmtCellphone();
							
							$m = new App_Messenger();
							$m->sendMessage("Your cell phone, $cellphone, has been successfully unlocked on your account.",$user->getEmail(),'1');

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
