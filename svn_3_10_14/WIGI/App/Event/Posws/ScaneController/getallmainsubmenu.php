<?php

class App_Event_Posws_MainmenuController_getallmainsubmenu extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
//                'PIN' => array('pin', 25, 1, App_Constants::getFormLabel('PIN')),
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
                $c = new App_Cellphone($ns->mobileid);

                $de = new App_MainmenuEngine();
               
                $res = $de->getallmainsubmenu($ns->mobileid, $ns->userid);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $res;

                App_DataUtils::commit();
                return $result;
    }
}
