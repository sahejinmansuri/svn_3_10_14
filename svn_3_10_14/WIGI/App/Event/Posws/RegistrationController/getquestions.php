<?php

class App_Event_Posws_RegistrationController_getquestions extends App_Event_WsEventAbstract {

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
                $q = new App_Question();

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value']  = '';
                $result['result']['data']   = $q->getPredefQuestions();


                App_DataUtils::commit();
                return $result; 
    }
}
