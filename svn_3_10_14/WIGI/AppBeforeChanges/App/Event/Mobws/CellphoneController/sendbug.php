<?php

class App_Event_Mobws_CellphoneController_sendbug extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MESSAGE'  => array('generic', 500, 1, App_Constants::getFormLabel('MESSAGE')),
                'CATEGORY' => array('generic', 50, 1, App_Constants::getFormLabel('CATEGORY')),
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
                App_DataUtils::userlogp('User',$ns->mobileid,'support','Support Message');

                $message  = $this->_request->getParam("MESSAGE");
                $category = $this->_request->getParam("CATEGORY");

		App_Support::createSupport($ns->userid,$message,$category);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';


                App_DataUtils::commit();
                return $result;

    }
}
