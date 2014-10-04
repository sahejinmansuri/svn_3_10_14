<?php

class App_Event_Mw_ProfileController_addmoney extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'CARDTYPE' => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
				'CARDNUMBER' => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
				'CARDEXPIRATION_MONTH' => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
				'CARDEXPIRATION_YEAR' => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
				'CARDDESC' => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
				'CARDHOLDERNAME' => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
				'CVV2' => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
				
				'BANKTYPE' => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
				'BANKACCOUNT' => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
				'BANKROUTE' => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
				'BANKDESC' => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
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
		
		$pview->states = array (
 'AP' => 'Andhra Pradesh',
 'AR' => 'Arunachal Pradesh',
 'AS' => 'Assam',
 'BR' => 'Bihar',
 'CT' => 'Chhattisgarh',
 'GA' => 'Goa',
 'GJ' => 'Gujarat',
 'HR' => 'Haryana',
 'HP' => 'Himachal Pradesh',
 'JK' => 'Jammu & Kashmir',
 'JH' => 'Jharkhand',
 'KA' => 'Karnataka',
 'KL' => 'Kerala',
 'MP' => 'Madhya Pradesh',
 'MH' => 'Maharashtra',
 'MN' => 'Manipur',
 'ML' => 'Meghalaya',
 'MZ' => 'Mizoram',
 'NL' => 'Nagaland',
 'OR' => 'Odisha',
 'PB' => 'Punjab',
 'RJ' => 'Rajasthan',
 'SK' => 'Sikkim',
 'TN' => 'Tamil Nadu',
 'TR' => 'Tripura',
 'UK' => 'Uttarakhand',
 'UP' => 'Uttar Pradesh',
 'WB' => 'West Bengal',
 'AN' => 'Andaman & Nicobar',
 'CH' => 'Chandigarh',
 'DN' => 'Dadra and Nagar Haveli',
 'DD' => 'Daman & Diu',
 'DL' => 'Delhi',
 'LD' => 'Lakshadweep',
 'PY' => 'Puducherry',
);
		
		$uid = $session_data->identity['userid'];
		$user = new App_User($uid);

		$ucc = new App_Models_Db_Wigi_UserCreditCard();
        $creditcards = $ucc->fetchAll($ucc->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
        $pview->credit_cards = count($creditcards);
		
		$uba = new App_Models_Db_Wigi_UserBankAccount();
        $bankaccounts = $uba->fetchAll($uba->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
        $pview->bank_accounts = count($bankaccounts);
		
		$pview->cellphones = $user->getCellphones();
		
		if ($this->_request->getParam('doaction') != null) {
			
            if ($this->_request->getParam('TYPE') == "CreditCard") {
                
                $type         = $this->_request->getParam('CARDTYPE');
                $creditcard   = $this->_request->getParam('CARDNUMBER');
                $expire_month = $this->_request->getParam('CARDEXPIRATION_MONTH');
                $expire_year  = $this->_request->getParam('CARDEXPIRATION_YEAR');
                $description  = $this->_request->getParam('CARDDESC');
                $name_on_card = $this->_request->getParam('CARDHOLDERNAME');
                $cvv2         = $this->_request->getParam('CVV2');
                $zip          = $this->_request->getParam('ZIP');
                
                if (count($user->getCreditCards()) >= 1) {
					throw new App_Exception_WsException('You may only have one credit card registered.');
				}
                
                $b = new App_Bank();
                $conf_amt = App_DataUtils::getRandAmt();

				//Do test transaction
				$b->testCreditCard($uid,$creditcard,'0.02',$user->getFirstName(),$user->getLastName(),$name_on_card,$expire_month,$expire_year,$cvv2,$user->getZip(),$user->getAddress(),$user->getState(),$type,'1');

                $id = $b->addCreditCard($uid,$type,$creditcard,'',$expire_month,$expire_year,$description,$name_on_card,$conf_amt,$zip);
				$last4 = $new_card = "XXXX-XXXX-XXXX-" . substr($creditcard,-4,4);
				$messages = new App_Messages();
				$messages->sendCreditCardAdd($user->getEmail(), $user->getFirstName(), $user->getLastName(), $last4);

                $pview->moneytype = "creditcard";
                
            } else {
                
                $type         = $this->_request->getParam('BANKTYPE');
                $bankaccount  = $this->_request->getParam('BANKACCOUNT');
                $conf_number  = "";
                $routing      = $this->_request->getParam('BANKROUTE');
                $description  = $this->_request->getParam('BANKDESC');
                
                if (count($user->getBankAccounts()) >= 1) {
                    throw new App_Exception_WsException('You may only have one bank account registered');
	            }
                
                $last4 = substr($bankaccount, -4);
                 
                $b = new App_Bank();
                $user = new App_User($uid);
                $conf_amt = App_DataUtils::getRandAmt();
                $conf_amt2 = App_DataUtils::getRandAmt();
                $m = new App_Messenger();

				//Do test transaction
               // $b->testBankAccount($uid,$bankaccount,$conf_amt,$conf_amt2,$user->getFirstName(),$user->getLastName(),$routing,$user->getZip(),$user->getAddress(),$user->getState(),$type,'1');
				
				$id = $b->addBankAccount($uid,$type,$bankaccount,$conf_number,$routing,$description,$conf_amt,$conf_amt2);
                
                $pview->ITEM = "ba" . $id;
                
                $pview->moneytype = "bankaccount";
                // Send the email now
				$messages = new App_Messages();
				$messages->sendBankAccountAdd($user->getEmail(), $user->getFirstName(), $user->getLastName(), $bankaccount, $routing);
            }
			
			$pview->showcontent = "success";
			
		}
		
                App_DataUtils::commit();


	}
	
}

?>
