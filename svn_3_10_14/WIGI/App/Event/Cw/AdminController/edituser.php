<?php

class App_Event_Aw_AdminController_edituser extends App_Event_WsEventAbstract  {
	
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
	
/**	public function execute(&$session_data,&$pview,&$cthis){
*		$pview->pageid = "admin";
*		$pview->tzpref = $session_data->prefs["system"]["timezone"];
*
*		$suspend_user = $this->_request->getParam('suspend_user');
*		$rolename = $this->_request->getParam('rolename');
*		$adminuser_id = $this->_request->getParam('adminuser_id');
*
*        if(!$suspend_user and !$rolename)
*        {
*            // Not updated message
*    		$cthis->redirect('home','admin','aw');
*        }
*
*        if($suspend_user){ $rolename='';}
*        if($rolename){ $suspend_user='';}
*
*		$r=array();
*		if($suspend_user) { $r['status']=$suspend_user; }
*		if($rolename) { $r['permissions']=$rolename; }
*
*		try {
*			$user_id = $cthis->updateAdminUser($r, $adminuser_id);
*		} catch (Exception $e) {
*				die($e->getMessage());
*				$a["MESSAGE"] = $e->getMessage();
*				$this->redirect('usererror','usererror','mw',$a);
*		}	
*
*		$cthis->redirect('home','admin','aw');
*	}
*
**/

public function execute(&$session_data,&$pview,&$cthis){
		$pview->pageid = "admin";
		$pview->tzpref = $session_data->prefs["system"]["timezone"];

		$suspend_user = $this->_request->getParam('suspend_user');
		$rolename = $this->_request->getParam('rolename');
		$adminuser_id = $this->_request->getParam('adminuser_id');
		$r=array();
        if(!$suspend_user and !$rolename)
        {
            // Not updated message
    		$cthis->redirect('home','admin','aw');
        }
		  if($suspend_user!="") {
		  		if($suspend_user == "Y")
		  			$status = 1;
		  			else
		  			$status = 0;
		  			
	  $au = new App_AdminUser();
	  $result = $au->select()->where('adminuser_id = ?',$adminuser_id)->query()->fetchAll();
	  $status1 = intval($result[0]['status']);
	  	if($status1==0) {
	  	if($status==1) {$status=0;}
	  else if($status==0) {$status=1;}
}

	  	if($status==1) $inv_status=0; else $inv_status=1;
		  	$r['suspended']=$status;
		  	$r['status']=$inv_status; 
		  	
		 	}
		  if($rolename!="")
		  		$r['permissions']=$rolename;

		  	
		try {
			$user_id = $cthis->updateAdminUser($r, $adminuser_id);
		} catch (Exception $e) {
				die($e->getMessage());
				$a["MESSAGE"] = $e->getMessage();
				$this->redirect('usererror','usererror','mw',$a);
		}	

		$cthis->redirect('home','admin','aw');
	}
	
}

?>
