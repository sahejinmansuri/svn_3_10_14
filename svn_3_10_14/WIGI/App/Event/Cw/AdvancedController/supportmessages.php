<?php

class App_Event_Cw_AdvancedController_supportmessages extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ITEM'  => array('int', 25, 1, App_Constants::getFormLabel('ITEM')),
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
                        $uid = $session_data->userid;
                        $item = $this->_request->getParam("ITEM");
                        App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$item);


                        $pview->pageid = "advanced";
                        $user = new App_User($uid);

                        $cellphones = $user->getFmtCellphones();
                        
                        $c = new App_Cellphone($item);

                        $messages = array();

                        $pview->selectedcellphone = $c->getCellphone();
                        $pview->selectedcellalias = $c->getAlias()." ".$c->getLastname();
                        $pview->item = $item;
                        
                        $pview->cellphones = $cellphones;

                        $pview->msgs = $messages;
                        App_DataUtils::commit();


    }
}
