<?php

class App_Event_Mw_ProfileController_confirmmoney extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'ITEM' => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
				'CONFIRMAMOUNT' => array('generic', 100, 0, App_Constants::getFormLabel('AMOUNT')),
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
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$uid = $session_data->identity['userid'];
		
		$item = $this->_request->getParam("ITEM");
		$itemtype = substr($item, 0, 2); // ba: bankaccount, cc: creditcard
		$itemid = substr($item, 2);
		
		if ($itemtype != false && is_numeric($itemid)) {
			
			$pview->ITEM = $item;
			
			if ($this->_request->getParam('doaction') != null) {
				
				if ($itemtype == "ba") {
					
					$uba = new App_BankAccount($itemid);
					
					if ($uba->getUserId() != $uid) {
        				throw new App_Exception_WsException('You do not own this bank account.');
    				}
					
					/*if ($uba->getConfAmt() == $this->_request->getParam("CONFIRMAMOUNT") && $uba->getConfAmt2() == $this->_request->getParam("CONFIRMAMOUNT2")) {
						
						$uba = new App_Models_Db_Wigi_UserBankAccount();
						$ubstat = $uba->update(
							array('status' => 'active'),
							$uba->getAdapter()->quoteInto('user_bank_account_id = ?', $itemid)
						);
						
						$pview->showcontent = "success";
						
					} else {
						
						$pview->showcontent = "error";
						
					}*/
					
					
					$uba = new App_BankAccount($itemid);
					$uba->confirm($this->_request->getParam("CONFIRMAMOUNT"),$this->_request->getParam("CONFIRMAMOUNT2"));

					$pview->showcontent = "success";
				}
				
			}
			
		} else {
		
			$pview->ITEM = "";
		}
		

                App_DataUtils::commit();

	}
	
}

?>
