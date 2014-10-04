<?php

class App_Event_Mobws_CellphoneController_sendtransaction extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'WIGICODE' => array('wigicode', 15, 1, App_Constants::getFormLabel('WIGICODE')),
                'MERCHANTID' => array('merchantid', 15, 1, App_Constants::getFormLabel('MERCHANTID')),
                'AMOUNT' => array('amount', 12, 1, App_Constants::getFormLabel('AMOUNT')),
                'REASON' => array('generic', 50, 0, App_Constants::getFormLabel('REASON')),
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
                App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Send WigiCode');

                $amount     = $this->_request->getParam("AMOUNT");
                $merchantid = $this->_request->getParam("MERCHANTID");
                $wigicode   = $this->_request->getParam("WIGICODE");
                $reason     = $this->_request->getParam("REASON");

                $userid = App_User::getUserIdFromMerchantId($merchantid);
                try {
                $u = new App_User($userid);
                } catch(App_Exception_WsException $e) {
                        throw new App_Exception_WsException("Merchant ID does not exist");
                }
		if ($u->getStatus() === "locked") {
			throw new App_Exception_WsException("Can not send to this merchant at this time. Please try again later.");
		}

                $dstmobileid = $u->getDefaultCellphone();
		$dstcell = new App_Cellphone($dstmobileid);

                if ($dstcell->getStatus() === "locked") {
                        throw new App_Exception_WsException("Can not send to this merchant at this time. Please try again later.");
                }

                $w = new App_WigiEngine();

                $wigicode = str_replace('-','',$wigicode);

                $w->redeemTransaction($ns->extinfo,$dstmobileid,$wigicode,$ns->mobileid,$amount,true,$reason,App_Transaction_Type::SEND_IMPC,App_Transaction_Type::RECEIVE_IMPC);
          
                App_Order::receive($ns->mobileid,$dstmobileid,$ns->userid,$userid,$amount,$wigicode,$reason,'','');


                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';


                App_DataUtils::commit();
                return $result;
    }
}
