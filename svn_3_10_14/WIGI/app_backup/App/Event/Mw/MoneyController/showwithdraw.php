<?php

class App_Event_Mw_MoneyController_showwithdraw extends App_Event_WsEventAbstract  {
	
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
		
		$pview->pageid = "withdraw";
		
        $uid  = $session_data->identity['userid'];
        $user = new App_User($uid);
        $e = $this->_request->getParam('E');
        if($e == 1){
            $pview->error = array("Unable to withdraw from this cell phone");
        }
        
        $pview->credit_cards  = $user->getCreditCards();
        $pview->bank_accounts = $user->getBankAccounts();
        $pview->cellphones    = $user->getCellphones();
        
        App_DataUtils::commit();


	}
	
}

?>
