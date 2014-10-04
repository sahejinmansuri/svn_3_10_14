<?php

class App_Event_Cw_MoneyController_withdraw extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'cellphone_list'  => array('int', 25, 1, App_Constants::getFormLabel('PHONE')),
                'account_list'  => array('generic', 25, 1, App_Constants::getFormLabel('ACCOUNT')),
                'amount'  => array('amount', 25, 1, App_Constants::getFormLabel('AMOUNT')),
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
        
        $pview->pageid = "withdraw";

        $uid  = $session_data->identity['userid'];
        list($id,$type) = explode(",",$this->_request->getParam('account_list'));
        $mobileid  = $this->_request->getParam('cellphone_list');
        $amount    = $this->_request->getParam('amount');
        App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$mobileid);
        if ($type == 1) {
          App_Resource::consumerIsAuthorized("CREDIT_CARD",$uid,$id);
        } else {
          App_Resource::consumerIsAuthorized("BANK_ACCOUNT",$uid,$id);
        }


        $u = new App_User($uid);
        $b = new App_Bank();

        if ($type == 1) {
            try{
            $cc = new App_CreditCard($id);
            $b->fundToCreditCard($session_data->extinfo,$uid,$mobileid,$id,$amount,$u->getFirstName(),$u->getLastName(),$cc->getNameOnCard(),$cc->getExpireMonth(),$cc->getExpireYear(),$u->getZip(),$u->getAddress(),$u->getState(),$cc->getCardType(),'1',false);
            }catch(Exception $e){
                $params = array('E'=>1);
                $cthis->_helper->redirector->goto('showwithdraw', 'money', 'cw', $params);
            }
        } else if ($type == 2) {
            $ba = new App_BankAccount($id);
            $b->fundToBankAccount($session_data->extinfo,$uid,$mobileid,$id,$amount,$u->getFirstName(),$u->getLastName(),$ba->getRouting(),$u->getZip(),$u->getAddress(),$u->getState(),$ba->getBankType(),'1',false);
        }
        App_DataUtils::commit();
    }
}
