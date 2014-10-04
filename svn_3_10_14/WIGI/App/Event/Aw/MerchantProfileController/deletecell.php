<?php

class App_Event_Aw_ProfileController_deletecell extends App_Event_WsEventAbstract  {
	
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
	
	public function execute(&$uid,&$pview,&$cthis){
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$user = new App_User($uid);
		
		$item = $this->_request->getParam("ITEM");
		if ($item != null && is_numeric($item)) {
			
			$pview->ITEM = $item;
			
			$cellobj = new App_Cellphone($item);
			if ($uid != $cellobj->getUserId()) {
				throw new App_Exception_WsException('You do not own this device.');
			}
			
			if ($this->_request->getParam('doaction') != null) {
				
				$ucell = new App_Models_Db_Wigi_UserMobile();
				$ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $item));
				
				$pin = $this->_request->getParam('PIN');
				$password = $this->_request->getParam('PASSWORD');
				
				$defaultcellitem = $user->getDefaultCellphone();
				$defaultcell = new App_Cellphone($defaultcellitem);
				
				$checkfields = ($user->passwordMatches($password) && $defaultcell->pinMatches($pin)) ? true : false;
				
				if ($ucget['is_default'] != 0 || !$checkfields) {
					
					$pview->showcontent = "error";
					
				} else {
					
					$ucdel = $ucell->update(
						array('status' => 'deleted'),
						$ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
					);
					
					$country_code = $user->getCountryCode();
					$cellphone = $countrycode . $ucget['cellphone'];
					
					$m = new App_Messenger();
					$m->sendMessage("Your cell phone, $cellphone, has been successfully deleted from your account.",$user->getEmail(),'1',"InCashMe : Delete Cellphone");
					
					$pview->showcontent = "success";
					
				}
				
			}
			
		} else {
			
			$pview->ITEM = "";
			
		}
		
	}
	
}

?>
