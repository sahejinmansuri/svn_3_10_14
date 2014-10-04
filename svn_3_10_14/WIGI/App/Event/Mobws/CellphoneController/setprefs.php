<?php

class App_Event_Mobws_CellphoneController_setprefs extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'PIN' => array('pin', 12, 1, App_Constants::getFormLabel('PIN')),

                'ALERT_METHOD' => array('generic', 12, 1, App_Constants::getFormLabel('ALERT_METHOD')),
                'WIGICODE_TIMEOUT' => array('int', 12, 1, App_Constants::getFormLabel('WIGICODE_TIMEOUT')),
                'INTERNATIONAL_TRANS' => array('generic', 12, 1, App_Constants::getFormLabel('INTERNATIONAL_TRANS')),
                'MAX_WIGI_AMT_TXN' => array('amount', 12, 1, App_Constants::getFormLabel('MAX_WIGI_AMT_TXN')),
                'MAX_WIGI_AMT_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_WIGI_AMT_DAY')),
                'MAX_GIFT_AMT_TXN' => array('amount', 12, 1, App_Constants::getFormLabel('MAX_GIFT_AMT_TXN')),
                'MAX_GIFT_AMT_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_GIFT_AMT_DAY')),
				'MAX_SCAN_AMT_TXN' => array('amount', 12, 1, App_Constants::getFormLabel('MAX_SCAN_AMT_TXN')),
                'MAX_SCAN_AMT_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_SCAN_AMT_DAY')),
                'GIFTALERT' => array('int', 12, 0, App_Constants::getFormLabel('GIFTALERT')),
                'SCANALERT' => array('int', 12, 0, App_Constants::getFormLabel('SCANALERT')),
                'ALERTFUND' => array('int', 12, 0, App_Constants::getFormLabel('ALERTFUND')),
                'MAX_FUND_AMT_TXN' => array('amount', 12, 1, App_Constants::getFormLabel('MAX_FUND_AMT_TXN')),
                'MAX_FUND_AMT_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_FUND_AMT_DAY')),
                'SESSION_TIMEOUT' => array('int', 12, 1, App_Constants::getFormLabel('SESSION_TIMEOUT')),
                'TIMEZONE' => array('generic', 12, 1, App_Constants::getFormLabel('TIMEZONE')),
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
                App_DataUtils::userlogp('Update',$ns->mobileid,'user_mobile','Update Preferences');

                $pin = $this->_request->getParam("PIN");
                $epin = Atlasp_Utils::inst()->encryptPassword($pin);

                //$minbal = $this->_request->getParam("MINBAL");
                //$statement_method = $this->_request->getParam("STATEMENT_METHOD");
                $alert_method = $this->_request->getParam("ALERT_METHOD");
                $wigicode_timeout = $this->_request->getParam("WIGICODE_TIMEOUT");
                $international_trans = $this->_request->getParam("INTERNATIONAL_TRANS");
                $max_wigi_amt_txn = $this->_request->getParam("MAX_WIGI_AMT_TXN");
                $max_wigi_amt_day = $this->_request->getParam("MAX_WIGI_AMT_DAY");
                $max_gift_amt_txn = $this->_request->getParam("MAX_GIFT_AMT_TXN");
                $max_gift_amt_day = $this->_request->getParam("MAX_GIFT_AMT_DAY");
                $max_scan_amt_txn = $this->_request->getParam("MAX_SCAN_AMT_TXN");
                $max_scan_amt_day = $this->_request->getParam("MAX_SCAN_AMT_DAY");
										$gift_alert    = $this->_request->getParam('GIFTALERT');
                                        $scan_alert    = $this->_request->getParam('SCANALERT');
                                        $fund_alert    = $this->_request->getParam('ALERTFUND');
                //$max_gift_get_amt_day = $this->_request->getParam("MAX_GIFT_GET_AMT_DAY");
                $max_fund_amt_txn = $this->_request->getParam("MAX_FUND_AMT_TXN");
                $max_fund_amt_day = $this->_request->getParam("MAX_FUND_AMT_DAY");
                $session_timeout  = $this->_request->getParam("SESSION_TIMEOUT");
                $timezone         = $this->_request->getParam("TIMEZONE");
                $result = array();

                $c = new App_Cellphone($ns->mobileid);

                if ($c->getPin() !== $epin) {
                        throw new App_Exception_WsException('Invalid PIN');
                        return false;
                }

                $p = new App_Prefs();
                $prefs = $p->getCellphonePrefs($ns->userid,$ns->mobileid);

                $prefs["system"]["timeout"]           = $session_timeout;
                $prefs["system"]["timezone"]          = $timezone;
                $prefs["wigi"]["timeout"]             = $wigicode_timeout;
                //$prefs["wigi"]["minbal"]              = $minbal;
                $prefs["wigi"]["max_per_trans"]       = $max_wigi_amt_txn;
                $prefs["wigi"]["max_per_day"]         = $max_wigi_amt_day;
                $prefs["wigi"]["international_trans"] = $international_trans;

                $prefs["gift"]["max_per_trans"]       = $max_gift_amt_txn;
                $prefs["gift"]["max_per_day"]         = $max_gift_amt_day;
				
				$prefs["scan"]["max_per_trans"]       = $max_scan_amt_txn;
                $prefs["scan"]["max_per_day"]         = $max_scan_amt_day;
										$prefs["scan"]["alert"]       = $scan_alert;
                                        $prefs["gift"]["alert"]         = $gift_alert;
                                        $prefs["funding"]["alert"]         = $fund_alert;
                //$prefs["gift"]["max_get_per_day"]     = $max_gift_get_amt_day;

                $prefs["funding"]["max_per_trans"]    = $max_fund_amt_txn;
                $prefs["funding"]["max_per_day"]      = $max_fund_amt_day;

                //$prefs["notification"]["statement"]   = $statement_method;
                $prefs["notification"]["alert"]     = $alert_method;


				
								$prefs['wigi']['max_per_trans'] = str_replace(',','',$prefs['wigi']['max_per_trans']);
								$prefs['funding']['max_per_trans'] = str_replace(',','',$prefs['funding']['max_per_trans']);
								$prefs['scan']['max_per_trans'] = str_replace(',','',$prefs['scan']['max_per_trans']);
								$prefs['gift']['max_per_trans'] = str_replace(',','',$prefs['gift']['max_per_trans']);
				
                $userp = new App_Prefs();
                $userprefs = $userp->getWebUserPrefs($ns->userid);

                $userp->checkConstraint($prefs,$userprefs);
                $userp->checkConstraint($prefs,"system");

                $ns->prefs = $prefs;
                $p->saveCellphonePrefs($ns->userid,$ns->mobileid,$prefs);

                $result['result']['status'] = 'success';
                $result['result']['value']  = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;

    }
}
