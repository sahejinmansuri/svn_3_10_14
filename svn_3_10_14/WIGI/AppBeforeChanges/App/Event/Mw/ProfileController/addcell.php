<?php

class App_Event_Mw_ProfileController_addcell extends App_Event_WsEventAbstract  {
	
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
		
		$questions = new App_Question();
		$pview->questions = $questions->getPredefQuestions();
		
		if ($this->_request->getParam('doaction') != null) {
			
			$alias = $this->_request->getParam('CELLDESC');
			$country_code = $user->getCountryCode();
			$cellphone = $this->_request->getParam('CELLPHONE');
			$pin = $this->_request->getParam('PIN');
			$question = $this->_request->getParam('QUESTION');
			$answer = $this->_request->getParam('ANSWER');
			
			$ucell = new App_Models_Db_Wigi_UserMobile();
			$ucget = $ucell->fetchAll($ucell->select()->where('cellphone = ?', $cellphone)->where('status != ?', 'deleted'));
			
			if (count($ucget) > 0) {
				
				$pview->showcontent = "error";
				
			} else {
				
				$cellid = $user->addCellphone($cellphone, Atlasp_Utils::inst()->encryptPassword($pin), $alias, "cellphone");
				
				$mobileid = App_Cellphone::getIdFromCellphone($cellphone, $country_code);
				
				$c = new App_Cellphone($mobileid);
				$defSettings = new App_DefSettings();
				$defSettings->createMobileSettings($c->getUserId(), $mobileid);
				
				$c->addQuestion($question, $answer);
				
				/*$c->setExt('minimum_balance','1.00','1');
				$c->setExt('statement_method','email','1');
				$c->setExt('receipt_method','sms','1');
				$c->setExt('wigicode_timeout','15','1');
				$c->setExt('international_trans','true','1');
				$c->setExt('max_wigi_amt_txn','50','1');
				$c->setExt('max_wigi_amt_day','10','1');
				$c->setExt('max_gift_amt_txn','50','1');
				$c->setExt('max_gift_amt_day','10','1');
				$c->setExt('session_timeout','90','1');
				*/
				
				$m = new App_Messenger();
				$m->sendMessage("Your confirmation code is $cellid",$cellphone,'2'); //SMS
				
				$pview->showcontent = "success";
				
			}
			
		}
		
                App_DataUtils::commit();


	}
	
}

?>
