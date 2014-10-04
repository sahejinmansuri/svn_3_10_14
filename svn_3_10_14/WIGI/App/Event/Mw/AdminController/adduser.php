<?php

class App_Event_Mw_AdminController_adduser extends App_Event_WsEventAbstract  {
	
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
		$a=array();

		$a['user_id'] = $session_data->identity['userid'];
		$a['user_added'] = $session_data->identity['mw_user_id'];
		//$pview->user = $session_data->identity;

		$a['phone'] = $this->_request->getParam('phone');
		$a['role'] = $this->_request->getParam('role');
		$a['first_name'] = $this->_request->getParam('first_name');
		$a['last_name'] = $this->_request->getParam('last_name');
		$a['email'] = $this->_request->getParam('email');
		$email2 = $this->_request->getParam('email2');
		$a['password'] = Atlasp_Utils::inst()->encryptPassword($this->_request->getParam('password'));
		$a['user_type'] = 'merchant';
		$a['admin'] = 0;
		$password = $this->_request->getParam('password');
		$password2 = $this->_request->getParam('password2');

		$users = new App_Users();
        $userIdentity = $users->getUserIdFromEmail($a['email']); 

		if (count($userIdentity) > 0)
		{
			$a["MESSAGE"] = 'Email exists in our systems.';
			$cthis->redirect('home','admin','mw',$a);
		}

		// Validation here
		if ($password != $password2)
		{
			$a["MESSAGE"] = 'Passwords do not match.';
			$cthis->redirect('home','admin','mw',$a);
		}

		if ($a['email'] != $email2)
		{
			$a["MESSAGE"] = 'Email address do not match.';
			$cthis->redirect('home','admin','mw',$a);
		}

		$existing_roles = App_MwPerm::prepareRolesData($session_data->wigi_merchant_settings);
		$pview->existing_roles = $existing_roles;

		$a['status']='A';
		$a['date_added']=new Zend_Db_Expr('NOW()');

		$users = new App_Users();
		$users_id = $users->insert($a);

		$a["MESSAGE"] = 'User added to the account.';
		$cthis->redirect('home','admin','mw',$a);
	}
	
}

?>
