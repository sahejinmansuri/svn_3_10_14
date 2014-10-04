<?php

class App_Event_Mobws_CellphoneController_updatescanandpay extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ID' => array('int', 15, 1, App_Constants::getFormLabel('ID')),
                'DATE' => array('generic', 15, 1, App_Constants::getFormLabel('DATE')),
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
                //App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Send Money');

                $date =  App_DataUtils::fmttime_datetime($this->_request->getParam("DATE"));
                $id = $this->_request->getParam("ID");
                App_Order::updateScanAndPay($id,$date);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;
    }
}
