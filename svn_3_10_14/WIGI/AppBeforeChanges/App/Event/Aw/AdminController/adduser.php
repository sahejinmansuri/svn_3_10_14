<?php

class App_Event_Aw_AdminController_adduser extends App_Event_WsEventAbstract  {
	
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

		$a['login_id'] = $this->_request->getParam('login_id');
		$a['email_address'] = $this->_request->getParam('email');
		$email2 = $this->_request->getParam('email2');
		$a['password'] = $this->_request->getParam('password');
		$password2 = $this->_request->getParam('password2');
		$a['first_name'] = $this->_request->getParam('firstname');
		$a['last_name'] = $this->_request->getParam('lastname');
		$a['permissions'] = $this->_request->getParam('permissions');
		//$a['phone'] = $this->_request->getParam('phone');

		if(!$a['email_address'] or $a['email_address']!=$email2)
		{
			//die('Email invalid');
			$a["MESSAGE"] = 'Email Address is Invalid.';
			$cthis->redirect('home','admin','aw',$a);
		}

		if(!$a['password'] or $a['password']!=$password2)
		{
			$a["MESSAGE"] = 'Passwords do not match.';
			$cthis->redirect('home','admin','aw',$a);
			//$cthis->redirect('home','admin','aw');
		}

		$a['password'] = Atlasp_Utils::inst()->encryptPassword($a['password']);

		try {
			$user_id = $cthis->insertUser($a);
		} catch (Exception $e) {
				die($e->getMessage());
				$a["MESSAGE"] = $e->getMessage();
				$this->redirect('usererror','usererror','mw',$a);
		}	


		$cthis->redirect('home','admin','aw');
	}
	
}

?>
