<?php

class App_Event_Aw_ProfileController_editpin extends App_Event_WsEventAbstract  {
	
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
	
	public function execute(&$uid,&$pview,&$cthis){
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$u = new App_User($uid);
		$item = $u->getDefaultCellphone();

		if ($item != null && is_numeric($item)) {
			
			$c = new App_Cellphone($item);
			
			if ($c->getUserId() != $uid) {
				throw new App_Exception_WsException('You do not own this device.');
			}
				
			$pview->ITEM = $item;
			
			if ($this->_request->getParam('doaction') != null) {
				
				$oldpin = $this->_request->getParam('OLDPIN');
				$newpin1 = $this->_request->getParam('NEWPIN');
				$newpin2 = $this->_request->getParam('NEWPIN_CONFIRM');
				
				if ($newpin1 == $newpin2 && strlen($newpin1) >= 7 && $c->pinMatches($oldpin)) {
					
					$ucell = new App_Models_Db_Wigi_UserMobile();
					$ucedit = $ucell->update(
						array(
							'pin' => Atlasp_Utils::inst()->encryptPassword($newpin1)
						),
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
