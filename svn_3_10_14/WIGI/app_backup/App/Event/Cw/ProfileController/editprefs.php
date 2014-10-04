<?php

class App_Event_Cw_ProfileController_editprefs extends App_Event_WsEventAbstract  {

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
    
    public function execute(&$session_data,&$pview,&$cthis){


                App_DataUtils::beginTransaction();

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";

                        $uid = $session_data->identity['userid'];
                        $user = new App_User($uid);

                        $uprefs = new App_Prefs();
                        $preferences = $uprefs->getWebUserPrefs($uid);
                        $pview->preferences = $preferences;

                        if ($this->_request->getParam('doaction') != null) {

                                $minbal              = $this->_request->getParam('MINBALANCE');
                                $receipt_method      = $this->_request->getParam('RECEIPTMETHOD');
                                $statement_method    = $this->_request->getParam('STATEMENTMETHOD');
                                $wigicode_timeout    = $this->_request->getParam('WIGITIMEOUT');
                                $international_trans = $this->_request->getParam('INTERNATIONALTRANS');
                                $max_wigi_amt_txn    = $this->_request->getParam('MAXAMOUNT');
                                $max_wigi_amt_day    = $this->_request->getParam('MAXDAY');
                                $max_gift_amt_txn    = $this->_request->getParam('MAXGIFTAMOUNT');
                                $max_gift_amt_day    = $this->_request->getParam('MAXGIFTDAY');
                                $max_fund_amt_txn    = $this->_request->getParam('MAXFUNDAMOUNT');
                                $max_fund_amt_day    = $this->_request->getParam('MAXFUNDDAY');
                                $session_timeout     = $this->_request->getParam('APPTIMEOUT');
                                $timezone            = $this->_request->getParam('TIMEZONE');

                                $p = new App_Prefs();
                                $prefs = $p->getWebUserPrefs($uid);

                                $prefs["wigi"]["timeout"]             = $wigicode_timeout;
                                //$prefs["wigi"]["minbal"]              = $minbal;
                                $prefs["wigi"]["max_per_trans"]       = $max_wigi_amt_txn;
                                $prefs["wigi"]["max_per_day"]         = $max_wigi_amt_day;
                                $prefs["wigi"]["international_trans"] = $international_trans;

                                $prefs["funding"]["max_per_trans"]    = $max_fund_amt_txn;
                                $prefs["funding"]["max_per_day"]      = $max_fund_amt_day;

                                $prefs["gift"]["max_per_trans"]       = $max_gift_amt_txn;
                                $prefs["gift"]["max_per_day"]         = $max_gift_amt_day;

                                $prefs["notification"]["alert"]       = $receipt_method;
                                //$prefs["notification"]["statement"]   = $statement_method;

                                $prefs["system"]["timeout"]           = $session_timeout;
                                $prefs["system"]["timezone"]          = $timezone;

                                $p->checkConstraint($prefs,"system");

                $session_data->identity['prefs'] = $prefs;
                $p->saveWebUserPrefs($uid, $prefs);

                                //check all the cellphones for constraint violations
                                foreach ($user->getFmtCellphones() as $cellphone) {

                                        $cellprefs = $p->getCellphonePrefs($uid,$cellphone["mobile_id"]);
                                        $newprefs = $p->checkConstraint($cellprefs,$prefs,false);
                                        if ( $newprefs != null) { //there was a constraint violation
                                                $p->saveCellphonePrefs($uid,$cellphone["mobile_id"],$newprefs);
                                        }

                                }

                                $pview->showcontent = "success";

                        }

                 App_DataUtils::commit();

    }
}
