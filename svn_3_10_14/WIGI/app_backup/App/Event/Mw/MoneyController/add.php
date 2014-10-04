<?php

class App_Event_Mw_MoneyController_add extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'account_list' => array('generic', 25, 1, App_Constants::getFormLabel('ACCOUNT')),
				'amount' => array('amount', 25, 1, App_Constants::getFormLabel('AMOUNT')),
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
		
		$pview->pageid = "addfunds";
		
        $doaction = $this->_request->getParam('doaction');
			
		if ($doaction == null) {
			$amount = $this->_request->getParam('amount');
			$account_list = $this->_request->getParam('account_list');
			$pview->amount = $amount;
			$pview->account_list = $account_list;
			$pview->showpage = "confirm";
		} else {
        
	        $uid  = $session_data->identity['userid'];
	        list($id,$type) = explode(",",$this->_request->getParam('account_list'));
	        $amount    = $this->_request->getParam('amount');
	
	        $u = new App_User($uid);
	        $mobileid = $u->getDefaultCellphone();
	        $b = new App_Bank();
	
			$c = new App_Cellphone($mobileid);
	        $c->checkConstraint($amount,'5',false);
	        $c->checkConstraint($amount,'6',false);
			
	        //if ($type == 1) {
	        //    $cc = new App_CreditCard($id);
	        //    try{
	        //    $b->fundFromCreditCard($session_data->extinfo,$uid,$mobileid,$id,$amount,$u->getFirstName(),$u->getLastName(),$cc->getNameOnCard(),$cc->getExpireMonth(),$cc->getExpireYear(),$cc->getCardType(),'1',false);
	        //    }catch(Exception $e){
	        //        $params = array('E'=>1);
	        //        $this->_helper->redirector->goto('showadd', 'money', 'mw', $params);
	        //    }
	        //} else if ($type == 2) {
	            $ba = new App_BankAccount($id);
	            $b->fundFromBankAccount($session_data->extinfo,$uid,$mobileid,$id,$amount,$u->getFirstName(),$u->getLastName(),$ba->getRouting(),$u->getZip(),$u->getAddress(),$u->getState(),$ba->getBankType(),'1',false);
	        //}
	        
      	  $cthis->initTplData();
      	  $pview->showpage = "success";
      	
      	}
        

        App_DataUtils::commit();

	}
	
}

?>
