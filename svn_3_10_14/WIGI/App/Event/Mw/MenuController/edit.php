<?php

class App_Event_Mw_MenuController_edit extends App_Event_WsEventAbstract  {
	
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
		$id = $this->_request->getParam('id');
		$user = $session_data->identity['userid'];
		$pview->pageid = 'menu';
		$menu = new App_Menu();
		$data = array('user' => $user, 'id' => $id); 
		$pview->result = $menu->getItem($data);
		$pview->id = $id;
		$pview->parents = $menu->getParentItems($data);
		$pview->action = 'menu/doedit';
	}
	
}

?>
