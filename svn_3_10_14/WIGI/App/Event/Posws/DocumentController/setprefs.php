<?php

class App_Event_Posws_DocumentController_setprefs extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
              //  'PIN' => array('pin', 12, 1, App_Constants::getFormLabel('PIN')),

                 'ALERT_METHOD' => array('generic', 12, 1, App_Constants::getFormLabel('ALERT_METHOD')),
                 'WIGICODE_TIMEOUT' => array('int', 12, 1, App_Constants::getFormLabel('WIGICODE_TIMEOUT')),
                
                'SESSION_TIMEOUT' => array('int', 12, 1, App_Constants::getFormLabel('SESSION_TIMEOUT')),
                'TIMEZONE' => array('generic', 12, 1, App_Constants::getFormLabel('TIMEZONE')),
                'INTERNATIONAL_TRANS' => array('generic', 12, 1, App_Constants::getFormLabel('INTERNATIONAL_TRANS')),
                'MAX_TRAN_AMT_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_TRAN_AMT_DAY')),
                'INTERNATIONAL_INVOICE' => array('generic', 12, 1, App_Constants::getFormLabel('INTERNATIONAL_TRANS')),
                'GPS_LOCK' => array('generic', 12, 1, App_Constants::getFormLabel('GPS_LOCK')),
                'INVOICE_CURRANCY' => array('generic', 12, 1, App_Constants::getFormLabel('INVOICE_CURRANCY')),
                'TIME_DUE' => array('generic', 12, 1, App_Constants::getFormLabel('TIME_DUE')),
                'RECIEPT' => array('generic', 12, 1, App_Constants::getFormLabel('RECIEPT')),
                'REFUND_POLICY' => array('generic', 12, 1, App_Constants::getFormLabel('REFUND_POLICY')),
                'VATE_SALESTAX' => array('generic', 12, 1, App_Constants::getFormLabel('VATE_SALESTAX')),
                'VATE_SALESTAX_PERCENT' => array('generic', 12, 1, App_Constants::getFormLabel('VATE_SALESTAX_PERCENT')),
                'SALESTAX' => array('generic', 12, 1, App_Constants::getFormLabel('SALESTAX')),
                'SALESTAX_PERCENT' => array('generic', 12, 1, App_Constants::getFormLabel('SALESTAX_PERCENT')),
                'SERVICETAX' => array('generic', 12, 1, App_Constants::getFormLabel('SERVICETAX')),
                'SERVICETAX_PERCENT' => array('generic', 12, 1, App_Constants::getFormLabel('SERVICETAX_PERCENT')),
                'TIPS' => array('generic', 12, 1, App_Constants::getFormLabel('TIPS')),
                'TIPS_PERCENT' => array('generic', 12, 1, App_Constants::getFormLabel('TIPS_PERCENT')),
                'CSTTAX' => array('generic', 12, 1, App_Constants::getFormLabel('CSTTAX')),
                'CSTTAX_PERCENT' => array('generic', 12, 1, App_Constants::getFormLabel('CSTTAX_PERCENT')),
                'MENU' => array('generic', 12, 1, App_Constants::getFormLabel('MENU')),
                'MAX_AMT_TRAN' => array('int', 12, 0, App_Constants::getFormLabel('MAX_AMT_TRAN')),
                 'MAX_TRAN_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_AMT_TRAN')),
                 'USERID' => array('int', 25, 1, App_Constants::getFormLabel('USERID')),
                 'PASSWD' => array('generic', 25, 1, App_Constants::getFormLabel('PASSWD')),
                 'LONGITUDE' => array('int', 12, 0, App_Constants::getFormLabel('LONGITUDE')),
                 'LATTITUDE' => array('int', 12, 0, App_Constants::getFormLabel('LATTITUDE')),
                
                //~ 'MAX_WIGI_AMT_TXN' => array('amount', 12, 1, App_Constants::getFormLabel('MAX_WIGI_AMT_TXN')),
                //~ 'MAX_WIGI_AMT_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_WIGI_AMT_DAY')),
                //~ 
                //~ 'MAX_GIFT_AMT_TXN' => array('amount', 12, 1, App_Constants::getFormLabel('MAX_GIFT_AMT_TXN')),
                //~ 'MAX_GIFT_AMT_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_GIFT_AMT_DAY')),
                //~ 'MAX_FUND_AMT_TXN' => array('amount', 12, 1, App_Constants::getFormLabel('MAX_FUND_AMT_TXN')),
                //~ 'MAX_FUND_AMT_DAY' => array('int', 12, 0, App_Constants::getFormLabel('MAX_FUND_AMT_DAY')),

                
                
                
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
                //App_DataUtils::userlogp('Update',$ns->mobileid,'user_mobile','Update Preferences');

                /*$pin = $this->_request->getParam("PIN");
                $epin = Atlasp_Utils::inst()->encryptPassword($pin);*/

                //$minbal = $this->_request->getParam("MINBAL");
                //$statement_method = $this->_request->getParam("STATEMENT_METHOD");
                
                //~ $international_trans = $this->_request->getParam("INTERNATIONAL_TRANS");
					 $alert_method = $this->_request->getParam("ALERT_METHOD");
                $wigicode_timeout = $this->_request->getParam("WIGICODE_TIMEOUT");
                $session_timeout  = $this->_request->getParam("SESSION_TIMEOUT");
                $timezone         = $this->_request->getParam("TIMEZONE");
                $INTERNATIONAL_TRANS         = $this->_request->getParam("INTERNATIONAL_TRANS");
                $MAX_TRAN_AMT_DAY         = $this->_request->getParam("MAX_TRAN_AMT_DAY");
                $INTERNATIONAL_INVOICE         = $this->_request->getParam("INTERNATIONAL_INVOICE");
                $GPS_LOCK         = $this->_request->getParam("GPS_LOCK");
                $INVOICE_CURRANCY         = $this->_request->getParam("INVOICE_CURRANCY");
                $TIME_DUE         = $this->_request->getParam("TIME_DUE");
                $RECIEPT         = $this->_request->getParam("RECIEPT");
                $REFUND_POLICY         = $this->_request->getParam("REFUND_POLICY");
                $VATE_SALESTAX         = $this->_request->getParam("VATE_SALESTAX");
                $VATE_SALESTAX_PERCENT         = $this->_request->getParam("VATE_SALESTAX_PERCENT");
                $SALESTAX         = $this->_request->getParam("SALESTAX");
                $SALESTAX_PERCENT         = $this->_request->getParam("SALESTAX_PERCENT");
                $SERVICETAX         = $this->_request->getParam("SERVICETAX");
                $SERVICETAX_PERCENT         = $this->_request->getParam("SERVICETAX_PERCENT");
                $TIPS         = $this->_request->getParam("TIPS");
                $TIPS_PERCENT         = $this->_request->getParam("TIPS_PERCENT");
                $CSTTAX         = $this->_request->getParam("CSTTAX");
                $CSTTAX_PERCENT         = $this->_request->getParam("CSTTAX_PERCENT");

                $MENU         = $this->_request->getParam("MENU");
                $MAX_AMT_TRAN         = $this->_request->getParam("MAX_AMT_TRAN");
                $MAX_TRAN_DAY         = $this->_request->getParam("MAX_TRAN_DAY");
                $LONGITUDE         = $this->_request->getParam("LONGITUDE");
                $LATTITUDE        = $this->_request->getParam("LATTITUDE");
                $userid       = $this->_request->getParam("USERID");
    			    $passwd       = $this->_request->getParam("PASSWD");
               
               if($wigicode_timeout=="") {
               	$wigicode_timeout=0;

						}		
  if($session_timeout=="") {
               	$session_timeout=300;

						}  if($timezone=="") {
               	$timezone='-5.0';

						}
if($INTERNATIONAL_TRANS=="") {
               	$INTERNATIONAL_TRANS='false';

						}if($MAX_TRAN_AMT_DAY=="") {
               	$MAX_TRAN_AMT_DAY=0.000000;

						}
					if($INTERNATIONAL_INVOICE=="") {
               	$INTERNATIONAL_INVOICE='NO';

						}
					if($GPS_LOCK =="") {
               	$GPS_LOCK =0;

						}
if($INVOICE_CURRANCY =="") {
               	$INVOICE_CURRANCY ='INR';

						}
					if($TIME_DUE =="") {
               	$TIME_DUE ='Immediately';

						}
if($RECIEPT =="") {
               	$RECIEPT ='Email';

						}
if($REFUND_POLICY =="") {
               	$REFUND_POLICY ='Non Refundable';

						}
					if($VATE_SALESTAX =="") {
               	$VATE_SALESTAX =0;

						}
					if($VATE_SALESTAX_PERCENT =="") {
               	$VATE_SALESTAX_PERCENT ='Not Applicable';

						}
if($SALESTAX =="") {
               	$SALESTAX =0;

						}
					if($SALESTAX_PERCENT  =="") {
               	$SALESTAX_PERCENT  ='Not Applicable';

						}
if($SERVICETAX =="") {
               	$SERVICETAX =0;

						}
					if($SERVICETAX_PERCENT  =="") {
               	$SERVICETAX_PERCENT  ='Not Applicable';

						}
					if($TIPS =="") {
               	$TIPS =0;

						}
					if($TIPS_PERCENT  =="") {
               	$TIPS_PERCENT  ='Not Applicable';

						}

					if($CSTTAX =="") {
               	$CSTTAX =0;

						}
					if($CSTTAX_PERCENT  =="") {
               	$CSTTAX_PERCENT  ='Not Applicable';

						}

           if($MENU =="") {
               	$MENU =0;

						}
					if($MAX_AMT_TRAN  =="") {
               	$MAX_AMT_TRAN  =0.000000;

						}
					 
					if($MAX_TRAN_DAY  =="") {
               	$MAX_TRAN_DAY  =1;

						}
					if($LONGITUDE =="") {
               	$LONGITUDE =0.0;

						}
					if($LATTITUDE =="") {
               	$LATTITUDE =0.0;

						}

                     
                
                
                
                
 
               
                

                $user = new App_User($userid);
    //  $user->passwordMatches($oldpassword);

                
              
                                //~ $max_wigi_amt_txn = $this->_request->getParam("MAX_WIGI_AMT_TXN");
                //~ $max_wigi_amt_day = $this->_request->getParam("MAX_WIGI_AMT_DAY");
                //~ $max_gift_amt_txn = $this->_request->getParam("MAX_GIFT_AMT_TXN");
                //~ $max_gift_amt_day = $this->_request->getParam("MAX_GIFT_AMT_DAY");
                //~ //$max_gift_get_amt_day = $this->_request->getParam("MAX_GIFT_GET_AMT_DAY");
                //~ $max_fund_amt_txn = $this->_request->getParam("MAX_FUND_AMT_TXN");
                //~ $max_fund_amt_day = $this->_request->getParam("MAX_FUND_AMT_DAY");
                
                
                $result = array();
     
if(!$user->passwordMatches($passwd)){
									$result = array(
										'error'  => array( 'code' => '-32000', 'message' => 'Password is wrong', 'data' => ''),
									);
									$result['result']['status'] = 'failure';
									$result['result']['value']  = '';
									$result['result']['data']   = 'Password is wrong';
								}
                else {
                $c = new App_Cellphone($ns->mobileid);

              /* if ($c->getPin() !== $epin) {
                        throw new App_Exception_WsException('Invalid PIN');
                        return false;
                }*/

                $p = new App_Prefs();
                $prefs = $p->getCellphonePrefs($ns->userid,$ns->mobileid);

                $prefs["system"]["timeout"]           = $session_timeout;
                $prefs["system"]["timezone"]          = $timezone;
                $prefs["international_trans"] = $INTERNATIONAL_TRANS;
                $prefs["wigi"]["timeout"]             = $wigicode_timeout;
                $prefs["max_tran_amt_day"] = $MAX_TRAN_AMT_DAY;
                $prefs["international_invoice"] = $INTERNATIONAL_INVOICE;
                $prefs["gps_lock"] = $GPS_LOCK;
                $prefs["invoice_currancy"] = $INVOICE_CURRANCY;
                $prefs["time_due"] = $TIME_DUE;
                $prefs["receipt"] = $RECIEPT;
                $prefs["refund_policy"] = $REFUND_POLICY;
                $prefs["vate_salestax"] = $VATE_SALESTAX;
                $prefs["vate_salestax_percent"] = $VATE_SALESTAX_PERCENT;
                $prefs["salestax"] = $SALESTAX;
                $prefs["salestax_percent"] = $SALESTAX_PERCENT;
                $prefs["servicetax"] = $SERVICETAX;
                $prefs["servicetax_percent"] = $SERVICETAX_PERCENT;
                $prefs["tips"] = $TIPS;
                $prefs["tips_percent"] = $TIPS_PERCENT;
                $prefs["csttax"] = $CSTTAX;
                $prefs["csttax_percent"] = $CSTTAX_PERCENT;
                $prefs["menu"] = $MENU;
                $prefs["max_amt_tran"] = $MAX_AMT_TRAN;
                $prefs["max_tran_day"] = $MAX_TRAN_DAY;
                $prefs["longtitude"] = $LONGITUDE;
                $prefs["lattitude"] = $LATTITUDE;
                
                
                
              
               
         
                
                //$prefs["wigi"]["minbal"]              = $minbal;
                //~ $prefs["wigi"]["max_per_trans"]       = $max_wigi_amt_txn;
                //~ $prefs["wigi"]["max_per_day"]         = $max_wigi_amt_day;

                //~ $prefs["wigi"]["international_trans"] = $international_trans;

                //~ $prefs["gift"]["max_per_trans"]       = $max_gift_amt_txn;
                //~ $prefs["gift"]["max_per_day"]         = $max_gift_amt_day;
                //$prefs["gift"]["max_get_per_day"]     = $max_gift_get_amt_day;

                //~ $prefs["funding"]["max_per_trans"]    = $max_fund_amt_txn;
                //~ $prefs["funding"]["max_per_day"]      = $max_fund_amt_day;

                //$prefs["notification"]["statement"]   = $statement_method;
                //~ $prefs["notification"]["alert"]     = $alert_method;


                $userp = new App_Prefs();
                $userprefs = $userp->getWebUserPrefs($ns->userid);

                $userp->checkConstraint($prefs,$userprefs);
                $userp->checkConstraint($prefs,"system");

                $ns->prefs = $prefs;
                $p->saveCellphonePrefs($ns->userid,$ns->mobileid,$prefs);

                $result['result']['status'] = 'success';
                $result['result']['value']  = '';
                $result['result']['data']   = '';
			}
                App_DataUtils::commit();
                return $result;

    }
}
