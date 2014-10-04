<?php

class App_Event_Mobws_CellphoneController_setmessageviewed extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MESSAGEID' => array('int', 25, 1, App_Constants::getFormLabel('MESSAGEID')),
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
                App_DataUtils::userlogp('Set',$ns->mobileid,'user_mobile','Set Message Viewed');

                $messageid = $this->_request->getParam("MESSAGEID");
                $c = new App_Cellphone($ns->mobileid);
                $c->getNewMessage();
                $c->setMessageViewed($messageid);
                $c->unsetNewMessage();

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = ''; //return the number of new messages

                App_DataUtils::commit();
                return $result;
    }
}
