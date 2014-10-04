<?php

class App_Event_Mw_AdminController_edituser extends App_Event_WsEventAbstract  {
	
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

		$action_user = $this->_request->getParam('action_user');
		$new_role = $this->_request->getParam('role');
		$users_id = $this->_request->getParam('users_id');

        if(!$action_user and !$new_role)
        {
            // Not updated message
    		$cthis->redirect('home','admin','mw');
        }

        if($action_user){ $new_role='';}
        if($new_role){ $action_user='';}
		
		$r=array();
		if($action_user) { $r['status']=$action_user; }
		if($new_role) { $r['role']=$new_role; }
		$r['user_changed']=$session_data->identity['mw_user_id'];
		$r['date_changed']=new Zend_Db_Expr('NOW()');

		$users = new App_Users();
		$users->updateUser($r, $users_id, $uid);

		$cthis->redirect('home','admin','mw');
	}
	
}

?>
