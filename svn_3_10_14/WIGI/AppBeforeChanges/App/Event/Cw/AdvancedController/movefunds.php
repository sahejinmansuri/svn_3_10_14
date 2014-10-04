<?php

class App_Event_Cw_AdvancedController_movefunds extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'amount'  => array('amount', 25, 1, App_Constants::getFormLabel('AMOUNT')),
                'cellphone_list'  => array('int', 25, 1, App_Constants::getFormLabel('CELLPHONE')),
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
             $amount = $this->_request->getParam("amount");
             $movefrom = $this->_request->getParam("cellphone_list");
             $uid = $session_data->identity['userid'];
             App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$movefrom); 

             $pview->pageid = "advanced";

             $u = new App_User($uid);

             $moveto = $u->getDefaultCellphone();

             $w = new App_WigiEngine();
             $w->sendMoney($session_data->extinfo,$movefrom,$moveto,$amount,'Move');
             App_DataUtils::commit();

    }
}
