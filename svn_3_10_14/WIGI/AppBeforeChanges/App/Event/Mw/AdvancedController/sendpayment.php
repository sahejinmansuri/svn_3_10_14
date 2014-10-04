<?php

class App_Event_Mw_AdvancedController_sendpayment extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'PAYMENT_TYPE' => array('generic', 100, 1, App_Constants::getFormLabel('PAYMENT_TYPE')),
                                'MERCHANT_NUMBER' => array('generic', 100, 0, App_Constants::getFormLabel('MERCHANT_NUMBER')),
                                'COUNTRYCODE' => array('generic', 100, 0, App_Constants::getFormLabel('COUNTRYCODE')),
                                'CELLPHONE' => array('generic', 100, 0, App_Constants::getFormLabel('CELLPHONE')),
                                'AMOUNT' => array('generic', 100, 1, App_Constants::getFormLabel('AMOUNT')),
                                'REASON' => array('generic', 100, 0, App_Constants::getFormLabel('REASON')),
                                'MESSAGE' => array('generic', 100, 0, App_Constants::getFormLabel('MESSAGE')),
                                'DOCUMENT_NUMBER' => array('generic', 100, 0, App_Constants::getFormLabel('DOCUMENT_NUMBER')),

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

                $payment_type = $this->_request->getParam("PAYMENT_TYPE");
                $merchant_number = $this->_request->getParam("MERCHANT_NUMBER");
                $countrycode = $this->_request->getParam("COUNTRYCODE");
                $cellphone = $this->_request->getParam("CELLPHONE");
                $amount = $this->_request->getParam("AMOUNT");
                $reason = $this->_request->getParam("REASON");
                $message = $this->_request->getParam("MESSAGE");
                $document_number = $this->_request->getParam("DOCUMENT_NUMBER");
                //create wigicode
                //redeem
                //create order
                //put in history

                $extinfo = $session_data->extinfo;

                $cellid = '';
                $cell = '';
                $userid = '';
                $user = '';
                $dst_cell_name = '';
                $dst_user_name = '';

                $src_u = new App_User($session_data->identity['userid']);
                $src_mobileid = $src_u->getDefaultCellphone();
                $src_c = new App_Cellphone($src_mobileid);

                if ($payment_type === "CONSUMER") {
                        error_log("Got here $cellphone, $countrycode");
                        $cellid = App_Cellphone::getIdFromCellphone($cellphone, $countrycode);
                        $cell = new App_Cellphone($cellid);
                        $userid = $cell->getUserId();
                        $user = new App_User($userid);
                        $dst_cell_name = $cell->getFmtCellphone();
                        $dst_user_name = $user->getEmail();
                } else {
                        error_log("CHRIS MERCH NO " . $merchant_number);
                        $userid = App_User::getUserIdFromMerchantId($merchant_number);
                        $user = new App_User($userid);
                        $cellid = $user->getDefaultCellphone();
                        $cell = new App_Cellphone($cellid);
                        $dst_cell_name = $user->getBusinessName();
                        $dst_user_name = $user->getBusinessName();
                }

                $we = new App_WigiEngine();
                $r = $we->createTransaction($extinfo,$src_mobileid,$amount,'2','0',false);

                App_Order::sendPayment($cellid, $src_mobileid ,$userid,$session_data->identity['userid'],$amount,$r['wigicode'],$reason,$message,$document_number,'',$payment_type);

                //sendPayment($consumer_mobile_id,$merchant_mobile_id,$consumer_user_id,$merchant_user_id,$price,$wigicode,$description,$message,$merchant_order_id,$user_acct_no)
error_log("R" . $r["wigicode"] . " " . $cellid);
                $wgc = new App_WigiCode($r["wigicode"],$src_mobileid);
                //$wgc->setPending( $dst_u->getDefaultCellphone() );
                $we->redeemTransaction($extinfo,$cellid,$r['wigicode'],$src_mobileid,$amount,false);


                App_Transaction_Transaction::log(App_Transaction_Type::SEND_PAYMENT,'Debit',$amount,$src_c->getBalance(),$src_c->getTempBalance(),$src_mobileid, $cellid  ,App_Transaction_Type::getConstName(App_Transaction_Type::SEND_PAYMENT) . " " . App_DataUtils::fmtCode($r["wigicode"]),$src_u->getBusinessName(),$dst_cell_name,$session_data->identity['userid'],$userid,$src_u->getBusinessName(),$dst_user_name,$r['wigicode'],$extinfo);
                App_Transaction_Transaction::blankPersonal($extinfo);

                App_Transaction_Transaction::log(App_Transaction_Type::RECEIVE_PAYMENT,'Credit',$amount,$cell->getBalance(),$cell->getTempBalance(),$cellid,$src_mobileid, App_Transaction_Type::getConstName(App_Transaction_Type::RECEIVE_PAYMENT) . " " . App_DataUtils::fmtCode($r["wigicode"]),$dst_cell_name,$src_u->getBusinessName(),$userid,$session_data->identity['userid'],$dst_user_name,$src_u->getBusinessName(),$r['wigicode'],$extinfo);

                $cell->sendMessage("You have received a payment of US $" . $amount . " from " . $src_u->getBusinessName() . ". ");
	
                App_DataUtils::commit();

	}
	
}

?>
