<?php

class App_Event_Mobws_CellphoneController_resetpin extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'OLDPIN' => array('pin', 12, 1, App_Constants::getFormLabel('OLDPIN')),
                'NEWPIN' => array('pin', 12, 1, App_Constants::getFormLabel('NEWPIN')),
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
                App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $oldpin = $this->_request->getParam("OLDPIN");
                $newpin = $this->_request->getParam("NEWPIN");
                $eoldpin = Atlasp_Utils::inst()->encryptPassword($oldpin);
                $enewpin = Atlasp_Utils::inst()->encryptPassword($newpin);

                $result = array();

                $c = new App_Cellphone($ns->mobileid);
                $c->resetPin($eoldpin,$enewpin);

                $ns->pin = $newpin;

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value']  = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;
    }
}
