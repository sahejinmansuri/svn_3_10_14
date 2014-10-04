<?php

class App_Event_Mobws_CellphoneController_applicationsession extends App_Event_WsEventAbstract  {

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
        $result = array();
		$result['result']['status'] 	= 'success';
		$result['result']['data']   	= '';
        $result['result']['value'] 		= '';
		return $result;

    }
}
