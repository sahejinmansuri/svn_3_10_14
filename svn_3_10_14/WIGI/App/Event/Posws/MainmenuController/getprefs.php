<?php

class App_Event_Posws_DocumentController_getprefs extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => 0
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
               // App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Preferences');

                $c = new App_Cellphone($ns->mobileid);
                $data = array();

                $uid = $ns->userid;
                $mid = $ns->mobileid;

                $p = new App_Prefs();
                $prefs = $p->getCellphonePrefs($uid,$mid);

                $result["session_timeout"] = $prefs["system"]["timeout"];
                $result["timezone"]        = $prefs["system"]["timezone"];

                $result["wigicode_timeout"] = $prefs["wigi"]["timeout"];
                //$result["minimum_balance"] = $prefs["wigi"]["minbal"];
                $result["max_wigi_amt_txn"] = $prefs["wigi"]["max_per_trans"];
                $result["max_wigi_amt_day"] = $prefs["wigi"]["max_per_day"];
                $result["international_trans"] = $prefs["wigi"]["international_trans"];

                $result["max_gift_amt_txn"] = $prefs["gift"]["max_per_trans"];
                $result["max_gift_amt_day"] = $prefs["gift"]["max_per_day"];
                $result["max_gift_get_amt_day"] = $prefs["gift"]["max_get_per_day"];

                $result["max_fund_amt_txn"] = $prefs["funding"]["max_per_trans"];
                $result["max_fund_amt_day"] = $prefs["funding"]["max_per_day"];

                //$result["statement_method"] = $prefs["notification"]["statement"];
                $result["alert_method"] = $prefs["notification"]["alert"];


                $result['result']['status'] = 'success';
                $result['result']['value']  = '';
                $result['result']['data']   = $result;

                App_DataUtils::commit();

                return $result;
    }
}
