<?php

class App_Event_Cw_AdminController_addrole extends App_Event_WsEventAbstract  {
	
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

		$uid = $session_data->identity['userid'];
		$pview->user = $session_data->identity;

		$permissions = App_Perm::getUserWigiFeatures();
		$pview->permissions_add = $permissions;

		$wigi_admin_settings = $cthis->getWigiUsersSettings($uid);

		$rolestr='';
		$rolename = $this->_request->getParam('rolename');

		// Check if the a role with the same name does not exist!
		/*if(!$rolename or !App_Perm::checkRoleAvailable($wigi_admin_settings, $rolename))
		{
			// A Role exists with the same name.
			$cthis->redirect('home','admin','cw');
		}*/
		
			// Get the default permissions data
			$permissionsData = App_Perm::setUserSettings('0000000', 0);
			$pview->permissions = $permissionsData;

			$existing_roles = App_Perm::prepareRolesDataUsers($wigi_admin_settings);
			//echo "<pre>"; print_r($existing_roles); die();
			$pview->existing_roles = $existing_roles;
			$pview->is_existing_roles = count($existing_roles);
		
		if($rolename != ""){
			$rolestr = $cthis->getPermissionStringFromInputsUser();		
			$r=array();
			$r['category']='User Roles '.$rolename;
			$r['value']=$rolestr;
			
			$rolename_check = new App_Models_Db_Wigi_WigiUsersSettings();
			$res = $rolename_check->fetchAll($rolename_check->select()->from($rolename_check,array('wigi_users_settings_id'))->where('status = ?','A')->where('useradded = ?',$uid)->where('category = ?',$r['category']));
			$count = count($res);
			if($count == 0){
				$cthis->insertWigiUsersSettings($r);
				$cthis->redirect('home','admin','cw');
			}else{
				$pview->showcontent = 'already';
			}
			
		}
	
	}
	
}

?>
