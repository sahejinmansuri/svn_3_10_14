<?php

class App_Event_Aw_ProfileController_editquestion extends App_Event_WsEventAbstract  {
	
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
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$uid = $session_data->identity['userid'];

        //$getitems = explode(".", $this->_request->getParam("ITEM"));
        //$item = $getitems[0];
        //$questionid = $getitems[1];
        $questionid = $this->_request->getParam("ITEM");

        $user = new App_User($uid);
        $item = $user->getDefaultCellphone();
        $c = new App_Cellphone($item);

        if ($c->getUserId() != $uid) {
        	throw new App_Exception_WsException('You do not own this device.');
        }

        $pview->ITEM = $item;
        $pview->QUESTION_ID = $questionid;

        $q = new App_Question($questionid);
        
        if ($q->getMobileId() != $item) {
           throw new App_Exception_WsException('You do not own this question.');
        }

        $pview->selectedq = $q->getQuestion();
        $pview->selecteda = $q->getAnswer();

        $questions = $c->getPredefQuestions();
        $questions[] = $q->getQuestion();

        $pview->questions = $questions;

        if ($this->_request->getParam('doaction') != null) {

            $q = $this->_request->getParam('QUESTION');
            $a = $this->_request->getParam('ANSWER');

            $c->removeQuestion($questionid);
            $c->addQuestion($q, $a);

            $pview->showcontent = "success";

        }
		
	}
	
}

?>
