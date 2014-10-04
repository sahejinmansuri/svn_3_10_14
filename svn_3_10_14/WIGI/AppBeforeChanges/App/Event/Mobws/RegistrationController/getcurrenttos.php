<?php

class App_Event_Mobws_RegistrationController_getcurrenttos extends App_Event_WsEventAbstract {

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
      $data = App_Tos::getCurrentTos();
      $d['tos'] = $data['tos'];
      $d['tos_id'] = $data['tos_id'];

      $result = array();
      $result['result']['status'] = 'success';
      $result['result']['value'] = '';
      $result['result']['data']   = $d;

      App_DataUtils::commit();

      return $result;
 
    }
}
