<?php

class App_Event_Mobws_CellphoneController_createtransaction extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'AMOUNT' => array('amount', 12, 1, App_Constants::getFormLabel('AMOUNT')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(){
                App_DataUtils::beginTransaction();
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Create WigiCode');

                $amount = $this->_request->getParam("AMOUNT");
                $result = array();

                $c = new App_Cellphone($ns->mobileid);
                $c->checkConstraint($amount,'2',true,true);
                $c->checkConstraint($amount,'4',true,false);

                $w = new App_WigiEngine();
                $r = $w->createTransaction( $ns->extinfo ,$ns->mobileid ,$amount,$ns->prefs["wigi"]['timeout'],$ns->prefs["system"]["timezone"]);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $r;

                App_DataUtils::commit();
                return $result;
    }
}
