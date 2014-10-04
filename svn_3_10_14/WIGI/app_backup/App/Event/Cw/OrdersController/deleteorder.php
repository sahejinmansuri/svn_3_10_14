<?php

class App_Event_Cw_OrdersController_deleteorder extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ITEM'  => array('int', 25, 1, App_Constants::getFormLabel('ITEM')),
                'T' => array('generic', 25, 1, App_Constants::getFormLabel('TYPE')),
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

        $uid = $session_data->identity['userid'];
        $item = $this->_request->getParam('ITEM');
        $type = $this->_request->getParam('T');
        App_Resource::consumerIsAuthorized ("ORDER_CONSUMER",$uid,$item);

        $pview->pageid = "orders";
        $pview->showcontent = "form";

        $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));

        $pview->ITEM = $item;
        $pview->ordertype = $type;

        $o = new App_Order($item);

        $wgc = $o->getWigiCode();
        $wgc = str_replace("-", "", $wgc);
        $o->setStatus('cancelled');
        $w = new App_WigiEngine();
        $w->deleteCode($ns->extinfo, $wgc, $o->getConsumerMobileId());

        $pview->showcontent = "success";

        App_DataUtils::commit();

    }
}
