<?php

class App_Event_Posws_MenuController_index extends App_Event_WsEventAbstract {

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

		$result = array();
		$c = new App_Cellphone($ns->mobileid);
		$u = new App_User($c->getUserId());

		$merchantid = $u->getMerchantId();
		$menu = new App_Menu();

		$user = intval(substr($merchantid, -3));
		$result['product_menu'] = $menu->fullMenu(array('user' => $user));
		$result["merchant_id"] = $merchantid;
		$result['result']['status'] = 'success';
		$result['result']['value'] = '';
		$result['result']['data']   = '';
        
		App_DataUtils::commit();

		return $result;
    }

}
