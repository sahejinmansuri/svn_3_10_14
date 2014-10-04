<?php

class App_Event_Posws_ZipController_getstatefromzip extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ZIP' => array('generic', 50, 1, App_Constants::getFormLabel('ZIP')),
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

                $zip = $this->_request->getParam("ZIP");

                $state = App_DataUtils::getStateFromZip($zip);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value']  = '';
                $result['result']['data']   = $state;

                App_DataUtils::commit();

                return $result;
    }
}
