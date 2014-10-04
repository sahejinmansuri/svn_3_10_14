<?php

class App_Event_Aw_ConsumerProfileController_forgotpin extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
                'ITEM'  => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
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
		$item = $this->_request->getParam('ITEM');
		
		if ($item != null && is_numeric($item)) {

            $c = new App_Cellphone($item);

            if ($c->getUserId() != $uid) {
                   throw new App_Exception_WsException('You do not own this cellphone'); 
            }
			
			$pview->ITEM = $item;
			
			if ($this->_request->getParam('doaction') != null) {
				
				$password = $this->_request->getParam('PASSWORD');
				
				if (strlen($password) >= 8 && $user->passwordMatches($password)) {
					
					$newpin = "";
					for ($p=1; $p<=7; $p++) {
						$newpin .= rand(0, 9);
					}
					
					$ucell = new App_Models_Db_Wigi_UserMobile();
					$ucedit = $ucell->update(
						array(
							'pin' => Atlasp_Utils::inst()->encryptPassword($newpin)
						),
						$ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
					);
					
					$m = new App_Messenger();
					$m->sendMessage("Your PIN number has been reset. Your new PIN number on your account is $newpin.",$user->getEmail(),'1','InCashMe : Reset Pin');
					
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
