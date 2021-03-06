<?php

class App_Event_Mobws_CellphoneController_setdonation extends App_Event_WsEventAbstract {

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
                $ns->setdonation = true;
                session_write_close();

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = ''; //return the number of new messages


                App_DataUtils::commit();
                return $result;
    }
}
