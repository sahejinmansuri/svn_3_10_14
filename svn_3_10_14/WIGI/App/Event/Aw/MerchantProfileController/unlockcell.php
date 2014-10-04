<?php

class App_Event_Aw_ProfileController_unlockcell extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'ITEM' => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
				
				'PIN' => array('generic', 100, 0, App_Constants::getFormLabel('PIN')),
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
	
	public function execute(&$session_data,&$pview,&$cthis){
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$uid = $session_data->identity['userid'];
		$user = new App_User($uid);
		
		$item = $this->_request->getParam("ITEM");
		
		$c = new App_Cellphone($item);
		if ($uid != $c->getUserId()) {
			throw new App_Exception_WsException('You do not own this device.');
		}
		
		$country_code = $user->getCountryCode();
		$cellphones = $user->getCellphones();
		$pview->selectedcellphone = "";
		
		if ($item != null && is_numeric($item)) {
			
			$pview->ITEM = $item;
			
			foreach ($cellphones as $cell) {
				if ($cell['mobile_id'] == $item) {
					$pview->selectedcellphone = $country_code.$cell['cellphone'];
				}
			}
			
			if ($this->_request->getParam('doaction') != null) {
				
				$pin = $this->_request->getParam('PIN');
				$password = $this->_request->getParam('PASSWORD');
				
				if ($user->passwordMatches($password) && $c->pinMatches($pin)) {
					
					$ucell = new App_Models_Db_Wigi_UserMobile();
					$ucdel = $ucell->update(
						array('status' => 'active'),
						$ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
					);
					
					$pview->showcontent = "success";
					
				} else {
					
					$pview->showcontent = "error";
					
				}
				
			}
			
		} else {
			
			$pview->ITEM = "";
			
		}
		
	}
	
}

?>
