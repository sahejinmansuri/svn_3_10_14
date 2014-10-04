<?php

class App_Event_Posws_MiscController_placepayment extends App_Event_WsEventAbstract {

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

        $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
        $amount = $this->_request->getParam('AMOUNT');
        $merchant_id = $this->_request->getParam('MERCHANT_ID');
        $user_acct_no = $this->_request->getParam('ACCT_NO');
        $merchant_order_id = $this->_request->getParam('INVOICE_NO');
        $date =  $this->_request->getParam('DATE');

        $p = new App_Prefs();
        $prefs = $p->getWebUserPrefs( $merchant_id, 'mw');

        if (($prefs['accept']['scanandpay'] === "false")) {
                throw new App_Exception_WsException('Merchant not setup to take Scan & Pay');
        }


        $to_user_id = App_User::getUserIdFromMerchantId($merchant_id);
        $u_to = new App_User($to_user_id);
        $to_mobile_id = $u_to->getDefaultCellphone();
        $c_to = new App_Cellphone($to_mobile_id);

        $c_from = new App_Cellphone($ns->mobileid);
        $u_from = new App_User($c_from->getUserId());

        $data = array(); 

        if ($date === "") {

          $balance = $c_from->getBalance();
          $temp_balance = $c_from->getTempBalance() - $amount;

          $w = new App_WigiEngine();
          $r = $w->createTransaction( $ns->extinfo, $ns->mobileid ,$amount,$balance,$temp_balance, (60*48), $ns->prefs["system"]["timezone"] ,false );
          //App_Transaction_Transaction::log(App_Transaction_Type::SCAN_AND_PAY,'Info',$amount,$balance,$temp_balance,$ns->mobileid,$to_mobile_id,App_Transaction_Type::getConstName(App_Transaction_Type::SCAN_AND_PAY)  . " " . App_DataUtils::fmtCode($r["wigicode"]),$c_from->getFmtCellphone(),$u_to->getBusinessName(),$c_from->getUserId(),$c_to->getUserId(),$u_from->getEmail(),$u_to->getEmail(),$r["wigicode"],$ns->extinfo);

          $data = App_Order::scanAndPay($ns->mobileid,$to_mobile_id,$c_from->getUserId(),$to_user_id,$amount,$r['wigicode'],'',$merchant_order_id,$user_acct_no,'completed','');

          $wgc = new App_WigiCode($r["wigicode"],$ns->mobileid);

          $extinfo = $ns->extinfo;

          $w->redeemTransaction($ns->extinfo,$to_mobile_id,$r['wigicode'],$ns->mobileid,$amount,true,"",App_Transaction_Type::SCAN_AND_PAY_CONSUMER,App_Transaction_Type::SCAN_AND_PAY_MERCHANT);

        } else {
          $date = App_DataUtils::fmttime_datetime($date);
          $data = App_Order::scanAndPay($ns->mobileid,$to_mobile_id,$c_from->getUserId(),$to_user_id,$amount,'','',$merchant_order_id,$user_acct_no,'scheduled',$date);
        }

        $res = array();
        $res['result']['status'] = 'success';
        $res['result']['value'] = '';
        $res['result']['data']   = $data;

        App_DataUtils::commit();

        return $res;

    }
}
