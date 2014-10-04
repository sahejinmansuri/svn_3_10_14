<?php

class App_Event_Mobws_CellphoneController_getmerchantname extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MERCHANTID' => array('merchantid', 15, 1, App_Constants::getFormLabel('MERCHANTID')),
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
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Merchant Name');

                $merchantid = $this->_request->getParam("MERCHANTID");

                $userid = App_User::getUserIdFromMerchantId($merchantid);
                try {
                $u = new App_User($userid);
                } catch(App_Exception_WsException $e) {
                        throw new App_Exception_WsException("Merchant ID does not exist");
                }

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value']  = '';
                $result['result']['data']   = $u->getBusinessName();


                App_DataUtils::commit();
                return $result;

    }
}
