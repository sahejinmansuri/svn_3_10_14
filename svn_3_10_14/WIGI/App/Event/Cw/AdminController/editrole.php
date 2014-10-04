<?php

class App_Event_Cw_AdminController_editrole extends App_Event_WsEventAbstract  {
	
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
		$pview->pageid = "admin";
		$pview->tzpref = $session_data->prefs["system"]["timezone"];

		$rolename = $this->_request->getParam('rolename');

		$uid = $session_data->identity['userid'];
		$pview->user = $session_data->identity;

		$permissions = App_Perm::getUserWigiFeatures();
		$pview->permissions = $permissions;

		$wigi_admin_settings = $cthis->getWigiUsersSettings($uid);
		$rolestr='';

		if(!$rolename)
		{
			$cthis->redirect('home','admin','cw');
		}

		$rolestr = $cthis->getPermissionStringFromInputs();		

		$r=array();
		$r['category']='User Roles '.$rolename;
		$r['value']=$rolestr;
		$cthis->updateWigiUsersSettings($r); //Mark Current record as Inactive
		$cthis->insertWigiUsersSettings($r);
	
		$cthis->redirect('home','admin','cw');
	}
	
}

?>
