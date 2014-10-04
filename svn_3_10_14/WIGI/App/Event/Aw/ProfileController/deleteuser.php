<?php

class App_Event_Aw_ProfileController_deleteuser extends App_Event_WsEventAbstract  {
	
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

                App_DataUtils::beginTransaction();
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		//$uid = $session_data->identity['userid'];
		$uid = $this->_request->getParam('userid');
		$pview->userid = $uid;
		$user = new App_User($uid);
		
		$item = $this->_request->getParam("ITEM");
		if ($item != null && is_numeric($item)) {
			
			$uget = new App_User($item);
			
			if ($uget->getParentUserId() != $uid) {
				throw new App_Exception_WsException('You do not own this user.');
			}
			
			$pview->ITEM = $item;
			
			if ($this->_request->getParam('doaction') != null) {
				
				$password = $this->_request->getParam('PASSWORD');
				$checkfields = ($user->passwordMatches($password)) ? true : false;
				
				if (!$checkfields) {
					$pview->showcontent = "error";
					
				} else {
					$uget->spdelete();

					//$m = new App_Messenger();
					//$m->sendMessage("A user has been successfully deleted from your account.",$user->getEmail(),'1');
					
					$pview->showcontent = "success";
					
				}
				
			}
			
		} else {
			
			$pview->ITEM = "";
			
		}
		

                App_DataUtils::commit();

	}
	
}

?>
