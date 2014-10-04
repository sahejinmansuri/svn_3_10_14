<?php

class App_Event_Mobws_CellphoneController_selffund extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'AMOUNT' => array('amount', 15, 1, App_Constants::getFormLabel('AMOUNT')),
                'TYPE' => array('int', 1, 1, App_Constants::getFormLabel('TYPE')),
                'MOBILE' => array('generic', 60, 1, App_Constants::getFormLabel('MOBILE')),
                'USER' => array('generic', 12, 1, App_Constants::getFormLabel('USER')),
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
                $type = $this->_request->getParam("TYPE");
                $amount = $this->_request->getParam("AMOUNT");
				$mobileid = $this->_request->getParam("MOBILE");
				$userid = $this->_request->getParam("USER");
				
                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Transaction',$mobileid,'user_mobile','Self Fund');

                $u = new App_User($userid);
                $c = new App_Cellphone($mobileid);
                $c->checkConstraint($amount,'5',false);
                $c->checkConstraint($amount,'6',false);

                $b = new App_Bank();

                if ($type == 1) {
                  $cc = new App_CreditCard($userid);
                  $b->fundFromCreditCard($ns->extinfo,$userid,$mobileid,$userid,$amount,$u->getFirstName(),$u->getLastName(),$cc->getNameOnCard(),$cc->getExpireMonth(),$cc->getExpireYear(),$u->getZip(),$u->getAddress(),$u->getState(),$cc->getCardType(),'1');
                } else if ($type == 2) {
                  $cc = new App_BankAccount($userid);
                  $b->fundFromBankAccount($ns->extinfo,$userid,$mobileid,$userid,$amount,$u->getFirstName(),$u->getLastName(),$cc->getRouting(),$u->getZip(),$u->getAddress(),$u->getState(),$cc->getBankType(),'1','','App');
                }
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;

    }
}
