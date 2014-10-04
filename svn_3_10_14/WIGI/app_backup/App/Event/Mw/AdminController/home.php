<?php

class App_Event_Mw_AdminController_home extends App_Event_WsEventAbstract  {
	
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
		$pview->system_message='';
		$message = $this->_request->getParam('MESSAGE');
		
		if($message)
		{
			$pview->system_message=$message;
		}

		$pview->pageid = "admin";
		$pview->tzpref = $session_data->prefs["system"]["timezone"];

		$uid = $session_data->identity['userid'];
		$pview->user = $session_data->identity;

		$categories = App_MwPerm::getMerchantWigiFeatures();
		$pview->categories = $categories;

		// Check and prepare existing roles
		$existing_roles = App_MwPerm::prepareRolesData($session_data->wigi_merchant_settings);
		$pview->existing_roles = $existing_roles;
		$pview->is_existing_roles = count($existing_roles);
		
		$users = new App_Users();
		$usersData = $users->getUsers($uid);
		$pview->existing_users = $usersData;
	}
	
}

?>
