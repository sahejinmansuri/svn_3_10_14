<?php

class App_Event_Aw_ConsumerProfileController_lockcell extends App_Event_WsEventAbstract  {

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

                        $c = new App_Cellphone($item);
                        if ($uid != $c->getUserId()) {
                          throw new App_Exception_WsException('You do not own this cellphone');
                        }


                        $country_code = $user->getCountryCode();
                        $cellphones = $user->getFmtCellphones();
                        $pview->cellphones = $cellphones;
                        $pview->isdefaultcell = 0;
                        $pview->selectedcellphone = "";

                        if ($item != null && is_numeric($item)) {

                                $pview->ITEM = $item;

                                foreach ($cellphones as $cell) {
                                        if ($cell['mobile_id'] == $item) {
                                                if ($cell['is_default'] != 0) {
                                                        $pview->isdefaultcell = 1;
                                                }
                                                $pview->selectedcellphone = $country_code.$cell['cellphone'];
                                        }
                                }

                                if ($this->_request->getParam('doaction') != null) {

                                        $pin = $this->_request->getParam('PIN');
                                        $setdefault = $this->_request->getParam('SETDEFAULT');

                                        if ($c->pinMatches($pin)) {

                                                $c->lock();

                                                if ($setdefault != null && is_numeric($setdefault)) {
                                                        $cellphone = new App_Cellphone($setdefault);
                                                        $setdefault = $cellphone->setDefault();
                                                }

                                                $countrycode = $user->getCountryCode();
                                                $cellphone = $countrycode . $c->getCellphone();

                                                $m = new App_Messenger();
                                                $m->sendMessage("Your cell phone, $cellphone, has been successfully locked on your account.",$user->getEmail(),'1');

                                                $pview->showcontent = "success";

                                        } else {

                                                $pview->showcontent = "error";

                                        }

                                }

                        } else {

                                $pview->ITEM = "";

                        }



    }
}
