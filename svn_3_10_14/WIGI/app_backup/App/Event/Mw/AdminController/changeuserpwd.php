<?php

class App_Event_Mw_AdminController_changeuserpwd extends App_Event_WsEventAbstract  {
	
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

		$passwd = $this->_request->getParam('passwd');
		$passwd2 = $this->_request->getParam('passwd2');
		$users_id = $this->_request->getParam('users_id');
		$email = $this->_request->getParam('email');
		$firstname = $this->_request->getParam('fname');

		if ($passwd != $passwd2)
		{
			$a["MESSAGE"] = 'Passwords do not match.';
			$cthis->redirect('home','admin','mw',$a);
		}

		$r=array();
		$r['user_changed']=$session_data->identity['mw_user_id'];
		$r['date_changed']=new Zend_Db_Expr('NOW()');
		$r['password'] = Atlasp_Utils::inst()->encryptPassword($this->_request->getParam('passwd'));

		$users = new App_Users();
		$users->updateUser($r, $users_id, $uid);

		$messages = new App_Messages();
		$messages->sendMerchantWigiPwdReset($email, $firstname, $passwd);

		$a["MESSAGE"] = 'Password updated.';
		$cthis->redirect('home','admin','mw', $a);
	}
	
}

?>
