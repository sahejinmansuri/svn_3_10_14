<?php

class App_Event_Aw_ProfileController_adduser extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'FIRST_NAME' => array('generic', 100, 0, App_Constants::getFormLabel('FIRST_NAME')),
				'LAST_NAME' => array('generic', 100, 0, App_Constants::getFormLabel('LAST_NAME')),
				'USERNAME' => array('generic', 100, 0, App_Constants::getFormLabel('USERNAME')),
				'PASSWORD' => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
			)
		);
	}
	
	public function getEvtData() {
		$data = parent::getEvtData();
		unset($data['inputs']['KEY']);
		unset($data['inputs']['IDENTIFIER']);
		return $data;
	}
	
	public function execute(&$uid,&$pview,&$cthis){
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$user = new App_User($uid);
		
		if ($this->_request->getParam('doaction') != null) {
			
			$firstname = $this->_request->getParam('FIRST_NAME');
			$lastname = $this->_request->getParam('LAST_NAME');
			$username = $this->_request->getParam('USERNAME');
			$password = $this->_request->getParam('PASSWORD');
		
			if ($user->getPosUsers() > 9) {
				throw new App_Exception_WsException('You cannot add more than 10 users.');
			}

                        $childid = App_User::getUserIdFromEmail($username);
                        if ($childid > 0) {
                                throw new App_Exception_WsException('User already exists.');
                        }

			$user->createPosUser($firstname, $lastname, $username, $password, $uid);
			
			$pview->showcontent = "success";
			
		}
		
	}
	
}

?>
