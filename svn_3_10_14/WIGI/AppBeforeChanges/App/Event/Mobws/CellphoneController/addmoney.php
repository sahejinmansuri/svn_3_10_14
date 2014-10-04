<?php

class App_Event_Mobws_CellphoneController_addmoney extends App_Event_WsEventAbstract {

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
    
    public function execute(){


                    $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));

                    App_DataUtils::beginTransaction();

                    $uid = $ns->userid;
                    $mid = $ns->mobileid;
                    $user = new App_User($uid);

                    if ($this->_request->getParam('TYPE') == "1") {

                        $type         = $this->_request->getParam('CARDTYPE');
                        $creditcard   = $this->_request->getParam('CARDNUMBER');
                        $expire_month = $this->_request->getParam('CARDEXPIRATION_MONTH');
                        $expire_year  = $this->_request->getParam('CARDEXPIRATION_YEAR');
                        $description  = $this->_request->getParam('CARDDESC');
                        $name_on_card = $this->_request->getParam('CARDHOLDERNAME');
                        $cvv2         = $this->_request->getParam('CVV2');
                        $zip          = $this->_request->getParam('ZIP');

//                        if (count($user->getCreditCards()) >= 1) {
//                                throw new App_Exception_WsException('You may only have one credit card registered.');
//                        }

                        $b = new App_Bank();
                        $conf_amt = App_DataUtils::getRandAmt();

                        //Do test transaction
                        $b->testCreditCard($uid,$creditcard,'0.02',$user->getFirstName(),$user->getLastName(),$name_on_card,$expire_month,$expire_year,$cvv2,$user->getZip(),$user->getAddress(),$user->getState(),$type,'1');

                        $id = $b->addCreditCard($uid,$type,$creditcard,'',$expire_month,$expire_year,$description,$name_on_card,$conf_amt);
                        $user->linkCreditCardToCellphone($mid, $id);

                    } else {

                        $type                  = $this->_request->getParam('BANKTYPE');
                        $bankaccount           = $this->_request->getParam('BANKACCOUNT');
                        $conf_number           = $this->_request->getParam('CONF_NUMBER');
                        $routing               = $this->_request->getParam('BANKROUTE');
                        $description           = $this->_request->getParam('BANKDESC');
                        $dl_no                 = $this->_request->getParam('DRIVERS_LICENSE_NUMBER');
                        $dl_state              = $this->_request->getParam('DRIVERS_LICENSE_STATE');
                        $dl_expiration_month   = $this->_request->getParam('DRIVERS_LICENSE_EXPIRATION_MONTH');
                        $dl_expiration_year    = $this->_request->getParam('DRIVERS_LICENSE_EXPIRATION_YEAR');

                        if (count($user->getBankAccounts()) >= 1) {
                                throw new App_Exception_WsException('You may only have one bank account registered');
                        }

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
                        $m->sendMessage("The confirmation amount for your bank account ending in $last4 is \$$conf_amt", $user->getEmail(), '1');

                        //Do test transaction
                        $b->testBankAccount($uid,$bankaccount,$conf_amt,$conf_amt2,$user->getFirstName(),$user->getLastName(),$routing,$user->getZip(),$user->getAddress(),$user->getState(),$type,'1');

                        $id = $b->addBankAccount($uid,$type,$bankaccount,$conf_number,$routing,$description,$conf_amt,$conf_amt2);
                        $user->linkBankAccountToCellphone($mid, $id);

                    }

                    App_DataUtils::commit();


                    $result = array();
                    $result['result']['status'] = 'success';
                    $result['result']['value']  = '';
                    $result['result']['data']   = '';

                    return $result;                    

    }
}
