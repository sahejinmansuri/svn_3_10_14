<?php

class App_Event_Aw_AdminController_deletemessage extends App_Event_WsEventAbstract  {
	
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

		$doaction = $this->_request->getParam('doaction');
		$message_id = $this->_request->getParam('MSGID');
		
		$t = new App_Models_Db_Wigi_Message();
		
		$pview->message_id = $message_id;
		if(isset($doaction)){
			$t = new App_Models_Db_Wigi_Message();
			$t->delete($t->getAdapter()->quoteInto('message_id = ?', $message_id));
			$cthis->redirect('home','admin','aw');
		}
		/*$pview->pageid = "admin";
		$pview->tzpref = $session_data->prefs["system"]["timezone"];

		$uid = $session_data->identity['userid'];
		$pview->user = $session_data->identity;

		$permissions = App_Perm::getAdminWigiFeatures();
		$pview->permissions = $permissions;

		$wigi_admin_settings = $cthis->getWigiAdminSettings();

		$rolestr='';
		$rolename = $this->_request->getParam('rolename');

		$rolestr = $cthis->getPermissionStringFromInputs();		
		$r=array();
		$r['category']='Admin Roles '.$rolename;
		$r['value']=$rolestr;
		$cthis->insertWigiAdminSettings($r);
	
		//$cthis->redirect('home','admin','aw');*/
	}
	
}

?>
