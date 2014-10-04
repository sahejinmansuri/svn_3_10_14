<?php

class App_Event_Posws_PaymentController_creditreceipt extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'EMAIL' => array('generic', 50, 0, App_Constants::getFormLabel('EMAIL')),
                'PHONE' => array('generic', 50, 0, App_Constants::getFormLabel('PHONE')),
                'TRANS_ID' => array('generic', 50, 0, App_Constants::getFormLabel('TRANS_ID')),
                'AMOUNT' => array('generic', 50, 0, App_Constants::getFormLabel('AMOUNT')),
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

        $email         = $this->_request->getParam('EMAIL');
        $phone         = $this->_request->getParam('PHONE');
        $transaction_id = $this->_request->getParam('TRANS_ID');
        $phone = preg_replace("/^1/","",$phone);
        $amount        = preg_replace("/[^\d\.]/","",$this->_request->getParam('AMOUNT'));
        if(preg_match("/^Send/i", $email)) $email = '';
        if(preg_match("/^Send/i", $phone)) $phone = '';

        $messages = new App_Messages();
        $m = new App_Messenger();

        $t = new App_Models_Db_Wigilog_Transaction();

        $row = $t->fetchRow(
          $t->select()
          ->where('transaction_id = ?', $transaction_id)
        );

        $c = new App_Cellphone($ns->mobileid);
        $u = new App_User($ns->userid);

        if ($phone === "") {
            $m->sendMessage($messages->getEmailReceipt($row['amount'],$u->getBusinessName(),"credit card"),$email,"1");
        } else {
            $m->sendMessage($messages->getTxtReceipt($row['amount'],$u->getBusinessName(),"credit card"),$phone,"2");
        }




        $result = array();
        $result['result']['data']   = '';
        $result['result']['status'] = 'success';

        App_DataUtils::commit();

        return $result;
    }
}
