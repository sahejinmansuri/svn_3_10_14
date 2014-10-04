<?php

class App_Event_Mobws_CellphoneController_lockaccount extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'PIN' => array('pin', 12, 1, App_Constants::getFormLabel('PIN')),
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
                App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Lock Account');

                $pin = $this->_request->getParam("PIN");
                $c = new App_Cellphone($ns->mobileid);
                if ($c->getPin() !== Atlasp_Utils::inst()->encryptPassword($pin)) {
                        throw new App_Exception_WsException('Invalid Pin');
                        return false;
                }
                $c->lock();

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = ''; //return the number of new messages

                App_DataUtils::commit();
                return $result;
    }
}
