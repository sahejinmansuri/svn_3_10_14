<?php

class App_Event_Mw_ProfileController_addquestion extends App_Event_WsEventAbstract  {
	
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
        $c = new App_Cellphone($item);

        if ($c->getUserId() != $uid) {
        	throw new App_Exception_WsException('You do not own this device.');
        }

        $questions = $c->getPredefQuestions();

        $pview->questions = $questions;

        $pview->ITEM = $item;

        if ($this->_request->getParam('doaction') != null) {

                $q = $this->_request->getParam('QUESTION');
                $a = $this->_request->getParam('ANSWER');

                $c->addQuestion($q, $a);

                $pview->showcontent = "success";

        }
		

        App_DataUtils::commit();

	}
	
}

?>
