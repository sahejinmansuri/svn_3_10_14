<?php

class App_Event_Mobws_CellphoneController_getmessage extends App_Event_WsEventAbstract {

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
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Message');

                $c = new App_Cellphone($ns->mobileid);
                $data = $c->getMessage();

                if (count($data) == 0) {
                        throw new App_Exception_WsException('You have no messages in your Inbox');
                        return false;
                }


                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $data;

                App_DataUtils::commit();
                return $result;
    }
}
