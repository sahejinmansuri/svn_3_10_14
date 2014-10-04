<?php

class App_Event_Mw_MenuController_home extends App_Event_WsEventAbstract  {
	
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
		$pview->pageid = 'menu';
		$menu = new App_Menu();
		$data = array('user' => $session_data->identity['userid']); 
		$pview->parents = $menu->getParentItems($data);
		$pview->result = $menu->getAllItems($data);
		$pview->message = $this->_request->getParam('MESSAGE');
	}
	
}

?>
