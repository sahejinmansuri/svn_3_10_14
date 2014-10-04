<?php

class App_Event_Cw_ProfileController_addmoney extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CARDTYPE'  => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
                'CARDNUMBER'  => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
                'CARDEXPIRATION_MONTH'  => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
                'CARDEXPIRATION_YEAR'  => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
                'CARDDESC'  => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
                'CARDHOLDERNAME'  => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
                'CVV2'  => array('generic', 100, 0, App_Constants::getFormLabel('CREDITCARD')),
                'ZIP'  => array('generic', 100, 0, App_Constants::getFormLabel('ZIP')),

                'BANKTYPE'  => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
                'BANKACCOUNT'  => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
                'BANKROUTE'  => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
                'BANKDESC'  => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
                'DRIVERS_LICENSE_STATE'  => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
                'DRIVERS_LICENSE_EXPIRATION_MONTH'  => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
                'DRIVERS_LICENSE_EXPIRATION_YEAR'  => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),
                'DRIVERS_LICENSE_NUMBER'  => array('generic', 100, 0, App_Constants::getFormLabel('BANK')),

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

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";

                        $uid = $session_data->identity['userid'];
                        $user = new App_User($uid);

						$ucc = new App_Models_Db_Wigi_UserCreditCard();
                        $creditcards = $ucc->fetchAll($ucc->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
                        $pview->credit_cards = count($creditcards);

                        $uba = new App_Models_Db_Wigi_UserBankAccount();
                        $bankaccounts = $uba->fetchAll($uba->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
                        $pview->bank_accounts = count($bankaccounts);
		
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
						$pview->cellphones = $user->getFmtCellphones();

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
			if (count($user->getCreditCards()) >= 2) {
				throw new App_Exception_WsException('You may only have two credit card registered.');
			}

                        $b = new App_Bank();
                        $conf_amt = App_DataUtils::getRandAmt();

                        //Do test transaction
                        $b->testCreditCard($uid,$creditcard,'0.02',$user->getFirstName(),$user->getLastName(),$name_on_card,$expire_month,$expire_year,$cvv2,$user->getZip(),$user->getAddress(),$user->getState(),$type,'1');

                        $id = $b->addCreditCard($uid,$type,$creditcard,'',$expire_month,$expire_year,$description,$name_on_card,$conf_amt);

                        $pview->moneytype = "creditcard";

                    } else {

                        $type                  = $this->_request->getParam('BANKTYPE');
                        $bankaccount           = $this->_request->getParam('BANKACCOUNT');
                        $conf_number           = $this->_request->getParam('CONF_NUMBER');
                        $description           = $this->_request->getParam('BANKDESC');
                       /* $routing               = $this->_request->getParam('BANKROUTE');
                        $dl_no                 = $this->_request->getParam('DRIVERS_LICENSE_NUMBER');
                        $dl_state              = $this->_request->getParam('DRIVERS_LICENSE_STATE');
                        $dl_expiration_month   = $this->_request->getParam('DRIVERS_LICENSE_EXPIRATION_MONTH');
                        $dl_expiration_year    = $this->_request->getParam('DRIVERS_LICENSE_EXPIRATION_YEAR');*/

                        if (count($user->getBankAccounts()) >= 1) {
                                throw new App_Exception_WsException('You may only have one bank account registered');
                        }
						$routing = '768767566';

						$dl_no = 'BHT675678HNJ8';
						$dl_state = 'GJ';
						$dl_expiration_month = '06';
						$dl_expiration_year = '2020';
						
			$r['dl_no']               = $dl_no; 
			$r['dl_state']            = $dl_state; 
			$r['dl_expiration_month'] = $dl_expiration_month;
			$r['dl_expiration_year']  = $dl_expiration_year;

			$conf_number = Zend_Json::encode($r);

                        $last4 = substr($bankaccount, -4);

                        $b = new App_Bank();
                        $user = new App_User($uid);
                        $conf_amt = App_DataUtils::getRandAmt();
                        $conf_amt2 = App_DataUtils::getRandAmt();
                        $m = new App_Messenger();
						
                        //Do test transaction
              /*          try {
                        $b->testBankAccount($uid,$bankaccount,$conf_amt,$conf_amt2,$user->getFirstName(),$user->getLastName(),$routing,$user->getZip(),$user->getAddress(),$user->getState(),$type,'1');
                        } catch (Exception $e) {
                          throw new App_Exception_WsException("Can not add this bank account");
                        }
              */

                        $id = $b->addBankAccount($uid,$type,$bankaccount,$conf_number,$routing,$description,$conf_amt,$conf_amt2);
						
						$pview->ITEM = "ba" . $id;
						
                        $pview->moneytype = "bankaccount";

                    }

                                $pview->showcontent = "success";
                        }

                    App_DataUtils::commit();
    }
}
