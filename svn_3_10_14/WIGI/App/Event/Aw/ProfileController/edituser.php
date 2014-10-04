<?php

class App_Event_Aw_ProfileController_edituser extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'ITEM' => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
				
				'FIRST_NAME' => array('generic', 100, 0, App_Constants::getFormLabel('FIRST_NAME')),
				'LAST_NAME' => array('generic', 100, 0, App_Constants::getFormLabel('LAST_NAME')),
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
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		/*$uid = $session_data->identity['userid'];*/
		$uid = $this->_request->getParam("userid");
		$pview->userid = $uid;
		$item = $this->_request->getParam("ITEM");
		if ($item != null && is_numeric($item)) {
			
			$firstname = $this->_request->getParam('FIRST_NAME');
			$lastname = $this->_request->getParam('LAST_NAME');
			
			$uget = new App_User($item);
			
			if ($uget->getParentUserId() != $uid) {
				throw new App_Exception_WsException('You do not own this user.');
			}
			
			$pview->ITEM = $item;
			
			$pview->FIRST_NAME = $uget->getFirstName();
			$pview->LAST_NAME = $uget->getLastName();
			$pview->USERNAME = $uget->getEmail();
			
			if ($this->_request->getParam('doaction') != null) {
				
				$uget->spupdate($firstname, "", $lastname);
				
				$pview->showcontent = "success";
				
			}
			
		} else {
			
			$pview->ITEM = "";
			
		}
		
                App_DataUtils::commit();

	}
	
}

?>
