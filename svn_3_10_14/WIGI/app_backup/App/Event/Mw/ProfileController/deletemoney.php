<?php

class App_Event_Mw_ProfileController_deletemoney extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'ITEM' => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
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
		$user = new App_User($uid);

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
    				//print_r($uba);exit;
					$uba = new App_Models_Db_Wigi_UserBankAccount();
					$ubdel = $uba->update(
						array(
							'status' => 'deleted',
							'user_changed'=>$session_data->identity['mw_user_id']
						),
						$uba->getAdapter()->quoteInto('user_bank_account_id = ?', $itemid)
					);

				$messages = new App_Messages();
				$messages->sendBankAccountDelete($user->getEmail(), $user->getFirstName(), $user->getLastName());
					
				} elseif ($itemtype == "cc") {
					
					$uba = new App_CreditCard($itemid);
					if ($uba->getUserId() != $uid) {
        				throw new App_Exception_WsException('You do not own this credit card.');
    				}
					
					$ucc = new App_Models_Db_Wigi_UserCreditCard();
					$ucdel = $ucc->update(
						array(
							'status' => 'deleted',
							'user_changed'=>$session_data->identity['mw_user_id']
						),
						$ucc->getAdapter()->quoteInto('user_credit_card_id = ?', $itemid)
					);

					$messages->sendCreditCardDelete($user->getEmail(), $user->getFirstName(), $user->getLastName());
				}
				
				$pview->showcontent = "success";
				
			}
			
		} else {
			
			$pview->ITEM = "";
			
		}
		
                App_DataUtils::commit();

	}
	
}

?>
