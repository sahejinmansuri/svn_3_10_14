<?php

class App_Event_Posws_MiscController_paymentdetails extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CODE' => array('generic', 350, 0, App_Constants::getFormLabel('CODE')),
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

        $code = $this->_request->getParam('CODE');
        $rawcode = substr($code,7);
        $check = substr($code,0,7);
        if ($check !== "wigime ") {
                throw new App_Exception_WsException('Code is not a valid Scan & Pay code.');
        }

        $s = App_DataUtils::unobfuscate($rawcode);

        $data = array();
        $parts = explode('&',$s);
        foreach ($parts as $part) {
          list($var,$val) = explode('=',$part);
          $data[$var] = $val;
        }

        $u = "";

        try {
                $u = new App_User(App_User::getUserIdFromMerchantId($data["MERCHANT_ID"]));
        } catch (Exception $e) { 
                throw new App_Exception_WsException('Merchant not part of the InCashMe network.');
        }


        $data["MERCHANT_NAME"]  = $u->getBusinessName();

        $res = array();
        $res['result']['status'] = 'success';
        $res['result']['value'] = '';
        $res['result']['data']   = $data;

        App_DataUtils::commit();

        return $res;
    }
}
