<?php

class App_Event_Mobws_MiscController_version extends App_Event_WsEventAbstract {

    public function __construct(Zend_Controller_Request_Abstract $request = null){
        parent::__construct($request);
        $this->_evt_data = array( 'inputs' => 0);

    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }

    public function execute() {
    
        $version = App_DataUtils::getVersion(); 

        $result = array();
        $result['result']['status'] = 'success';
        $result['result']['value'] = '';
        $result['result']['data']   = $version;

        return $result;
      
    }

}

