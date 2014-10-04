<?php

class App_Event_Cw_AdminController_deleterole extends App_Event_WsEventAbstract  {
	
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

		$rolename = $this->_request->getParam('rolename');
		$uid = $session_data->identity['userid'];
		
		if(!$rolename)
		{
			$cthis->redirect('home','admin','cw');
		}

		$rolestr = $cthis->getPermissionStringFromInputs();		
		$role_available = $cthis->getRoleUsers($uid,$rolename);
		
		if($role_available == 0){ 
			$r=array();
			$r['category']='User Roles '.$rolename;
			$r['value']=$rolestr;
			$cthis->updateWigiUsersSettings($r);
			$pview->showcontent = 'success';
			//$cthis->redirect('deleterole','admin','cw');
		}else{
			$pview->showcontent = 'failure';
			//$cthis->redirect('deleterole','admin','cw');
		}
		
		
	}
	
}

?>
