<?php

class App_Event_Posws_PaymentController_cash extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'AMOUNT' => array('generic', 50, 0, App_Constants::getFormLabel('AMOUNT')),
                'SALESTAX' => array('generic', 50, 0, App_Constants::getFormLabel('SALESTAX')),
                'TIP' => array('generic', 50, 0, App_Constants::getFormLabel('TIP')),
                'ORIG_CHARGE' => array('generic', 50, 0, App_Constants::getFormLabel('ORIG_CHARGE')),
                'LATLONG' => array('generic', 50, 0, App_Constants::getFormLabel('LATLONG')),
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
        $amount        = preg_replace("/[^\d\.]/","",$this->_request->getParam('AMOUNT'));
        $tax           = preg_replace("/[^\d\.]/","",$this->_request->getParam('SALESTAX'));
        $tip           = preg_replace("/[^\d\.]/","",$this->_request->getParam('TIP'));
        $raw_amount    = preg_replace("/[^\d\.]/","",$this->_request->getParam('ORIG_CHARGE'));
        $gps           = $this->_request->getParam('LATLONG');

        $extinfo               = $ns->extinfo;
        $extinfo["tax"]        = $tax;
        $extinfo["tip"]        = $tip;
        $extinfo["raw_amount"] = $raw_amount;
        $extinfo["gps"]        = $gps;

        $prefs = $ns->prefs;

        if ( ($prefs['accept']['cash'] === "false") || ($prefs['accept']['pos'] === "false") ) {
                throw new App_Exception_WsException('You are not setup to take cash payments');
        }

        error_log($ns->userid. " -- ". $ns->mobileid );
        $b = new App_Bank();
        $id = $b->merchantCashSale($extinfo,$ns->userid,$ns->mobileid,$amount);

        $u_merchant = new App_User($ns->userid);
        $c_merchant = new App_Cellphone($ns->mobileid);
        App_Order::pos('1',$ns->mobileid,'1',$ns->userid,$amount,'','','','','cash');

        $result = array();
        $result['result']['data']   = $id;
        $result['result']['status'] = 'success';

        App_DataUtils::commit();

        return $result;
    }
}
