<?php

class App_Event_Mobws_AuthController_logout extends App_Event_WsEventAbstract {

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
        try {
			$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
			App_DataUtils::userlogp('Logout',$ns->mobileid,'user_mobile','Logout');
            Zend_Session::destroy();
        } catch (Exception $e) {}
		exit();
	}
}
