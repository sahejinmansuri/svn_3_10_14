<?php

class App_Event_Posws_PaymentController_wigi extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'WIGICODE' => array('generic', 50, 0, App_Constants::getFormLabel('WIGICODE')),
                'COUNTRYCODE' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRYCODE')),
                'CELLPHONE' => array('generic', 50, 0, App_Constants::getFormLabel('CELLPHONE')),
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
        $code         = $this->_request->getParam('WIGICODE');
        $code         = preg_replace("/-/","",$code);
        $countrycode  = $this->_request->getParam('COUNTRYCODE');
        $cellphone    = preg_replace("/\D/","",$this->_request->getParam('CELLPHONE'));
        $cellphone = preg_replace("/^1/","",$cellphone);
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

        if (($prefs['accept']['pos'] === "false")) {
                throw new App_Exception_WsException('You are not setup to take pos payments');
        }


        $to_mobile_id = App_Cellphone::getIdFromCellphone($cellphone,$countrycode);

        if (! ($to_mobile_id > 0)) {
            throw new App_Exception_WsException('Cellphone does not exist');
        }

        $merch_c = new App_Cellphone($ns->mobileid);
        $merch_u = new App_User($merch_c->getUserId());

        //$extinfo['useremail'] = $ns->email;
        //$extinfo['userid']    = $ns->userid;

        $w = new App_WigiEngine();
        $code = str_replace('-','',$code);
        $id = $w->redeemTransaction($extinfo,$ns->mobileid,$code,$to_mobile_id,$amount);

        $messages = new App_Messages();
        $c = new App_Cellphone($to_mobile_id);
        $c->sendMessage($messages->getTxtReceipt($amount,$merch_u->getBusinessName(),"IMPC™"));

        $u_merchant = new App_User($ns->userid);
        $c_merchant = new App_Cellphone($ns->mobileid);
        App_Order::pos($to_mobile_id,$ns->mobileid,$c->getUserId(),$ns->userid,$amount,$code,'','','','wigi');

        $result = array();
        $result['result']['data']   = $id;
        $result['result']['status'] = 'success';

        App_DataUtils::commit();

        return $result;
    }
}
