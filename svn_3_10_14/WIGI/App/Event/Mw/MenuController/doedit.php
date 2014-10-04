<?php

class App_Event_Mw_MenuController_doedit extends App_Event_WsEventAbstract  {
	
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
	
	public function execute(&$session_data,&$pview,&$cthis){
		$a=array();
		$a['user'] = $session_data->identity['userid'];
		$a['parent'] = $this->_request->getParam('parent');
		$a['name'] = $this->_request->getParam('name');
		$a['price'] = $this->_request->getParam('price');
		$a['id'] = $this->_request->getParam('id');
        $a['status'] = $this->_request->getParam('status');
        $a['type'] = ($a['parent'] == '0') ? 'PARENT' : 'CHILD';
        $menu = new App_Menu();	 
		if($menu->updateItem($a)) {
			$msg["MESSAGE"] = 'Menu item edited successfully.';
		}
		else {
			$msg["MESSAGE"] = 'There was an error saving the data.';
		}
		$cthis->redirect('home','menu','mw',$msg);
	}
	
}

?>
