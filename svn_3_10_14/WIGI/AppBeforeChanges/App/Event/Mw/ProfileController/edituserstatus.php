<?php

class App_Event_Mw_ProfileController_edituserstatus extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'ITEM' => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
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
		
		$uid = $session_data->identity['userid'];
		
		$item = $this->_request->getParam("ITEM");
		if ($item != null && is_numeric($item)) {
			
			$userstatus = $this->_request->getParam('POSUSERSTATUS');
			
			$uget = new App_User($item);
			
			if ($uget->getParentUserId() != $uid) {
				throw new App_Exception_WsException('You do not own this user.');
			}
			
			$pview->ITEM = $item;
			
			$pview->POSUSERSTATUS = $uget->getStatus();
			
			if ($this->_request->getParam('doaction') != null) {
				
				if ($userstatus == "active" || $userstatus == "locked") {
					$uget->setStatus($userstatus);
					$pview->showcontent = "success";
				} else {
					$pview->showcontent = "error";
				}
				
			}
			
		} else {
			
			$pview->ITEM = "";
			
		}
		
                App_DataUtils::commit();

	}
	
}

?>
