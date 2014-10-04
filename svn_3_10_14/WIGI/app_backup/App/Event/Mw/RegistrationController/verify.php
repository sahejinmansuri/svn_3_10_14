<?php

class App_Event_Mw_RegistrationController_verify extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'CODE' => array('generic', 100, 1, App_Constants::getFormLabel('CODE')),
				'UID' => array('generic', 100, 1, App_Constants::getFormLabel('UID')),
				
			)
		);
	}
	
	public function getEvtData() {
		$data = parent::getEvtData();
		unset($data['inputs']['KEY']);
		unset($data['inputs']['IDENTIFIER']);
		return $data;
	}
	
	public function execute(&$session_data,&$pview,&$cthis){
        App_DataUtils::beginTransaction();
        $code = $this->_request->getParam('CODE');
        $uid  = $this->_request->getParam('UID');
        $u  = new App_User($uid);

		// Only process this if account is unconfirmed
		if($u->getStatus() == 'unconfirmed')
		{
			$userstatus='A';
			$u->confirmEmail($code);
			$pview->message = "";
			if ($u->getBusinessType() == 5) {
			  $pview->message = "However, your account will remain pending until it has been reviewed by InCashMe staff.";
			  $userstatus = 'P';
			}

			// We are here that means account was verified successfully, insert a record in users table now - Might need to move this to class where email address of the accuont is verified in the web!
			$this->insertUsersRecord($uid, $userstatus);
			App_DataUtils::commit();
		}
	}
	
	protected function insertUsersRecord($uid, $userstatus)
	{
		$user = new App_User( $uid );

		$result = $user->fetchRow(
		$user->select()
		  ->where('user_id = ?', $uid)
		);
		$userRecord = $result->toArray();

		$usersRecord['user_id'] = $userRecord['user_id'];
		$usersRecord['email'] = $userRecord['email'];
		$usersRecord['user_type'] = 'merchant';
		$usersRecord['admin'] = 1;
		$usersRecord['status'] = $userstatus;
		$usersRecord['question'] = $userRecord['question'];
		$usersRecord['answer'] = $userRecord['answer'];
		$usersRecord['password'] = $userRecord['password'];
		$usersRecord['ip_added'] = $userRecord['ip_added'];
		$usersRecord['ip_changed'] = $userRecord['ip_changed'];
		$usersRecord['first_name'] = $userRecord['first_name'];
		$usersRecord['last_name'] = $userRecord['last_name'];
		$usersRecord['password_needs_changing'] = $userRecord['password_needs_changing'];
		
		$users = new App_Users();
		$users_id = $users->insertUser($usersRecord);
	}

}

?>
