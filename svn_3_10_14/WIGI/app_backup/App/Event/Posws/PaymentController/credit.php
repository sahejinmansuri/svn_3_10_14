<?php

class App_Event_Posws_PaymentController_credit extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CREDITCARD' => array('generic', 50, 0, App_Constants::getFormLabel('CREDITCARD')),
                'EXP' => array('generic', 50, 0, App_Constants::getFormLabel('EXP')),
                'CVV2' => array('generic', 50, 0, App_Constants::getFormLabel('CVV2')),
                'TYPE' => array('generic', 50, 0, App_Constants::getFormLabel('TYPE')),
                'NAME' => array('generic', 50, 0, App_Constants::getFormLabel('NAME')),
                'DESC' => array('generic', 50, 0, App_Constants::getFormLabel('DESC')),
                'ADDR' => array('generic', 50, 0, App_Constants::getFormLabel('ADDR')),
                'CITY' => array('generic', 50, 0, App_Constants::getFormLabel('CITY')),
                'STATE' => array('generic', 50, 0, App_Constants::getFormLabel('STATE')),
                'ZIP' => array('generic', 50, 0, App_Constants::getFormLabel('ZIP')),
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
        $amount         = preg_replace("/[^\d\.]/","",$this->_request->getParam('AMOUNT'));
        $creditcard     = $this->_request->getParam('CREDITCARD');
        $exp            = $this->_request->getParam('EXP');
        $cvv2           = $this->_request->getParam('CVV2');
        $type           = $this->_request->getParam('TYPE');
        $name           = $this->_request->getParam('NAME');
        $desc           = $this->_request->getParam('DESC');
        $addr           = $this->_request->getParam('ADDR');
        $city           = $this->_request->getParam('CITY');
        $state          = $this->_request->getParam('STATE');
        $zip            = $this->_request->getParam('ZIP');
        $gps           = $this->_request->getParam('LATLONG');

        list($expire_month,$expire_year) = explode("/",$exp);

        $tax           = preg_replace("/[^\d\.]/","",$this->_request->getParam('SALESTAX'));
        $tip           = preg_replace("/[^\d\.]/","",$this->_request->getParam('TIP'));
        $raw_amount    = preg_replace("/[^\d\.]/","",$this->_request->getParam('ORIG_CHARGE'));

        $extinfo               = $ns->extinfo;
        $extinfo["tax"]        = $tax;
        $extinfo["tip"]        = $tip;
        $extinfo["raw_amount"] = $raw_amount;
        $extinfo["gps"]        = $gps;

        $prefs = $ns->prefs;

        if ( ($prefs['accept']['creditcard'] === "false") || ($prefs['accept']['pos'] === "false") ) {
                throw new App_Exception_WsException('You are not setup to take credit cards');
        }



        $b = new App_Bank();
        //$id = $b->merchantCreditSale($ns->extinfo,$ns->userid,$ns->mobileid,$amount,$creditcard,$expire_month,$expire_year,$cvv2,$type,$name);
        $id = $b->creditCardSale($extinfo,$ns->mobileid,$ns->userid,$creditcard,$amount,$name,$expire_month,$expire_year,$cvv2,$zip,$type,'1');

        $u_merchant = new App_User($ns->userid);
        $c_merchant = new App_Cellphone($ns->mobileid);
        App_Order::pos('1',$ns->mobileid,'1',$ns->userid,$amount,'','','','','credit');

        $result = array();
        $result['result']['data']   = $id;
        $result['result']['status'] = 'success';

        App_DataUtils::commit();

        return $result;
    }
}
