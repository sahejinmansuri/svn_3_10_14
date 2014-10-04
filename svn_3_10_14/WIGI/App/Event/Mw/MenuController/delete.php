<?php

class App_Event_Mw_MenuController_delete extends App_Event_WsEventAbstract  {
	
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
		$a['id'] = $this->_request->getParam('id');
		$a['user'] = $session_data->identity['userid'];
        $menu = new App_Menu();	 
		if($menu->deleteItem($a)) {
			$msg["MESSAGE"] = 'Menu deleted successfully.';
		}
		else {
			$msg["MESSAGE"] = 'There was an error deleting the data.';
		}
		$cthis->redirect('home','menu','mw',$msg);
	}
	
}

?>
