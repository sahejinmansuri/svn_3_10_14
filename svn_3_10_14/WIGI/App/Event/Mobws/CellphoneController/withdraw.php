<?php

class App_Event_Mobws_CellphoneController_withdraw extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'AMOUNT' => array('amount', 15, 1, App_Constants::getFormLabel('AMOUNT')),
                'ID' => array('int', 25, 1, App_Constants::getFormLabel('ID')),
                'TYPE' => array('int', 1, 1, App_Constants::getFormLabel('TYPE')),
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
                App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Withdraw');

                $type = $this->_request->getParam("TYPE");
                $id = $this->_request->getParam("ID");
                $amount = $this->_request->getParam("AMOUNT");

                $u = new App_User($ns->userid);
                $c = new App_Cellphone($ns->mobileid);
                $b = new App_Bank();

                if ($type == 1) {
                  $cc = new App_CreditCard($id);
                  $b->fundToCreditCard($ns->extinfo,$ns->userid,$ns->mobileid,$id,$amount,$u->getFirstName(),$u->getLastName(),$cc->getNameOnCard(),$cc->getExpireMonth(),$cc->getExpireYear(),$cc->getCardType(),'1');
                } else if ($type == 2) {
                  $cc = new App_BankAccount($id);
                  $b->fundToBankAccount($ns->extinfo,$ns->userid,$ns->mobileid,$id,$amount,$u->getFirstName(),$u->getLastName(),$cc->getRouting(),$cc->getBankType(),'1');
                }
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result; 


    }
}
