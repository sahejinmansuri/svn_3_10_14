<?php

class App_Event_Mw_MenuController_doadd extends App_Event_WsEventAbstract  {
	
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
		$a['type'] = ($a['parent'] == '0') ? 'PARENT' : 'CHILD';
        $a['status']=$this->_request->getParam('status');
        $menu = new App_Menu();	
        $exists = $menu->checkExists($a); 
		if ($exists)
		{
			$msg["MESSAGE"] = 'Menu item already exists.';
			$cthis->redirect('home','menu','mw',$msg);
		}

		$menu_id = $menu->insertItem($a);
		$msg["MESSAGE"] = 'Menu item '.$menu_id.' added to your account.';
		$cthis->redirect('home','menu','mw',$msg);
	}
	
}

?>
