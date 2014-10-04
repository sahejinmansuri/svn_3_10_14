<?php

class App_Event_Aw_ProfileController_setdefaultcell extends App_Event_WsEventAbstract  {
	
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
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$uid = $session_data->identity['userid'];
		
		$item = $this->_request->getParam("ITEM");
		
		if ($item != null && is_numeric($item)) {
			$cellphone = new App_Cellphone($item);
			
			if ($uid != $cellphone->getUserId()) {
				throw new App_Exception_WsException('You do not own this device.');
			}
			
			$pview->ITEM = $item;
			
			$code = $cellphone->getNewCode();
			$cellphone->sendMessage("Your cell phone confirmation code is $code. Please enter this on the website to set your default cellphone.");
			
			if ($this->_request->getParam('doaction') != null) {
				
				$code = $this->_request->getParam("code");
				
				$setdefault = false;				

				if ($cellphone->getConfirmationCode() === $code) {
					$setdefault = $cellphone->setDefault();
				}
				
				if ($setdefault == false) {
					$pview->showcontent = "error";
				} else {
					$pview->showcontent = "success";
				}
				
			}
			
		}
		
	}
	
}

?>
