<?php

class App_Event_Cw_ProfileController_confirmcell extends App_Event_WsEventAbstract  {

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

                 App_DataUtils::beginTransaction();

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";

                $uid = $session_data->identity['userid'];

                $item = $this->_request->getParam("ITEM");
                App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$item);

                        if (is_numeric($item)) {

                                $pview->ITEM = $item;

                                if ($this->_request->getParam('doaction') != null) {

                                        $code = $this->_request->getParam("CONFIRMCODE");

                                        $ucell = new App_Cellphone($item);
                                        $ucell->confirm($code, "");
                                        $m = new App_Messenger();
                                        $m->sendMessage("Download the iPhone app at http://itunes.apple.com/app/wigime/id473512570?mt=8",$ucell->getCellphone(),'2');
                                        $pview->showcontent = "success";

                                }

                        } else {

                                $pview->ITEM = "";
                        }
                        App_DataUtils::commit();

    }
}
