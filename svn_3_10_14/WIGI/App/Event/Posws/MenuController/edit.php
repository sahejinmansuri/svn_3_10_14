<?php

class App_Event_Posws_MenuController_edit extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
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
		$user = intval(substr($merchantid, -3));
		if($user != $c->getUserId()) {
			$result['result']['status'] = 'error';
			$result['msg'] = "You cannot change/add any products.";
		}
		else {
			$a=array();
			$a['user'] = $user;
			$a['parent'] = $this->_request->getParam('parent');
			$a['name'] = $this->_request->getParam('name');
			$a['price'] = $this->_request->getParam('price');
			$a['type'] = ($a['parent'] == '0') ? 'PARENT' : 'CHILD';
			$a['status']=$this->_request->getParam('status');
			$a['id'] = $this->_request->getParam('id');
			$menu = new App_Menu();	
			$update = $menu->updateItem($a);
			$result['result']['status'] = 'success';
			$result['msg'] = "Edited successfully";
			$result["merchant_id"] = $merchantid;
			$result['result']['value'] = '';
			$result['result']['data']   = '';
		}
        
		App_DataUtils::commit();

		return $result;
    }

}

?>
