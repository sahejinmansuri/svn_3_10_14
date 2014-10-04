<?php

class App_Event_Posws_MiscController_placeorder extends App_Event_WsEventAbstract {

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

        sleep(5);

        $p = new App_Prefs();
        $prefs = $p->getWebUserPrefs( $session_data->merchantuid, 'mw');

        if (($prefs['accept']['scanandbuy'] === "false")) {
                throw new App_Exception_WsException('Merchant not setup for Scan & Buy');
        }


        $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
        $amount = $this->_request->getParam('AMOUNT');

        $c = new App_Cellphone($ns->mobileid);
        $u = new App_User($c->getUserId());

        $dst_u = new App_User($session_data->merchantuid);
        $dst_c = new App_Cellphone( $dst_u->getDefaultCellphone() );

        $balance = $c->getBalance();
        $temp_balance = $c->getTempBalance() - $amount;

        $w = new App_WigiEngine();
        $r = $w->createTransaction( $ns->extinfo, $ns->mobileid ,$amount,$balance,$temp_balance, (60*48), $ns->prefs["system"]["timezone"] ,false );

        $s = $this->_request->getParam('SKU');
        $qty = $this->_request->getParam('QTY');
        $str = "";
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $length=10;
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        $data = array(
            'oid'   => $s.'2477',
            #'ship'  => strtoupper($str),
            'ship'  => $str,
            'qty'   => $qty
        );

        $data['order_no'] = App_Order::scanAndBuy($ns->mobileid, $dst_u->getDefaultCellphone() ,$c->getUserId(),$dst_c->getUserId(),$s,$amount,$r['wigicode'],'','');

        $wgc = new App_WigiCode($r["wigicode"],$ns->mobileid);
        $wgc->setPending( $dst_u->getDefaultCellphone() );


        $extinfo = $ns->extinfo;

        App_Transaction_Transaction::log(App_Transaction_Type::WIGI_CODE_PENDING,'Info',$amount,$dst_c->getBalance(),$dst_c->getTempBalance(),$dst_u->getDefaultCellphone(), $ns->mobileid  ,App_Transaction_Type::getConstName(App_Transaction_Type::WIGI_CODE_PENDING) . " " . App_DataUtils::fmtCode($r["wigicode"]),$dst_u->getBusinessName(),$c->getFmtCellphone(),$dst_c->getUserId(),$c->getUserId(),$dst_u->getBusinessName(),$u->getEmail(),$r["wigicode"],$extinfo);
        App_Transaction_Transaction::blankPersonal($extinfo);

        App_Transaction_Transaction::log(App_Transaction_Type::WIGI_CODE_PENDING,'Info',$amount,$balance,$temp_balance,$ns->mobileid, $dst_u->getDefaultCellphone()  ,App_Transaction_Type::getConstName(App_Transaction_Type::WIGI_CODE_PENDING)  . " " . App_DataUtils::fmtCode($r["wigicode"]),$c->getFmtCellphone(), $dst_u->getBusinessName() ,$c->getUserId(),$dst_c->getUserId(),$u->getEmail(),$dst_u->getBusinessName(),$r["wigicode"],$extinfo);


        App_Transaction_Transaction::log(App_Transaction_Type::SCAN_AND_BUY,'Info',$amount,$balance,$temp_balance,$ns->mobileid, $dst_u->getDefaultCellphone()  ,App_Transaction_Type::getConstName(App_Transaction_Type::SCAN_AND_BUY) . " " . App_DataUtils::fmtCode($r["wigicode"]),$c->getFmtCellphone(), $dst_u->getBusinessName() ,$c->getUserId(),$dst_c->getUserId(),$u->getEmail(),$dst_u->getBusinessName(),$r["wigicode"],$ns->extinfo);

        $c->sendMessage("Thank you for your order from " . $dst_u->getBusinessName() . " of " . $session_data->prodtitle . " for ₹" . $amount . ".");

        //($from_mobile_id,$to_mobile_id,$sku,$price,$wigicode,$description,$merchant_order_id)
        $res = array();
        $res['result']['status'] = 'success';
        $res['result']['value'] = '';
        $res['result']['data']   = $data;

        App_DataUtils::commit();

        return $res;

    }
}
