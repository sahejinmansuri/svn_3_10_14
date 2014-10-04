<?php

class App_Event_Mobws_CellphoneController_getbankaccounts extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => 0
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
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Bank Accounts');

                $c = new App_Cellphone($ns->mobileid);
                $banks = $c->getLinkedBankAccounts();

                if (count($banks) == 0) {
                        throw new App_Exception_WsException('This cellphone has no linked bank accounts. Please go online for bank account management.');
                }

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $banks;

                App_DataUtils::commit();

                return $result;
    }
}
