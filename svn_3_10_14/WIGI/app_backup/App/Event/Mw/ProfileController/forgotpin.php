<?php

class App_Event_Mw_ProfileController_forgotpin extends App_Event_WsEventAbstract  {
	
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
		
		$uid = $session_data->identity['userid'];
		$user = new App_User($uid);
		$item = $user->getDefaultCellphone();
		
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
				$m->sendMessage("Your PIN number has been reset. Your new PIN number on your account is $newpin.",$user->getEmail(),'1');
				
				$pview->showcontent = "success";
				
			} else {
				
				$pview->showcontent = "error";
				
			}
			
		}
		

              App_DataUtils::commit();

	}
	
}

?>
