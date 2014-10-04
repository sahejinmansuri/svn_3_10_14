<?php

class App_Event_Posws_PaymentController_wigireceipt extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'TRANS_ID' => array('generic', 50, 0, App_Constants::getFormLabel('TRANS_ID')),
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

        $transaction_id      = $this->_request->getParam('TRANS_ID');

        $t = new App_Models_Db_Wigilog_Transaction();

        $row = $t->fetchRow(
          $t->select()
          ->where('transaction_id = ?', $transaction_id)
        );

        $messages = new App_Messages();

        $amount = $row->amount;

        $merch_c = new App_Cellphone($row->to);
        $merch_u = new App_User($merch_c->getUserId());

        $c = new App_Cellphone($row->from);
        $c->sendMessage($messages->getTxtReceipt($amount,$merch_u->getBusinessName(),"IMPC™"));


        $result = array();
        $result['result']['data']   = '';
        $result['result']['status'] = 'success';

        App_DataUtils::commit();

        return $result;
    }
}
