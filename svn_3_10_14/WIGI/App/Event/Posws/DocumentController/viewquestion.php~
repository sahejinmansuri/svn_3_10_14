<?php

class App_Event_Posws_DocumentController_viewquestion extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'MOBILE'  => array('generic', 100, 1, App_Constants::getFormLabel('MOBILE'))
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
			$mid = $this->_request->getParam('MOBILE');
			$c = new App_Cellphone($mid);
        $questions = $c->getQuestions();
        $count = 3 - count($questions);
        
        for ($qa=1; $qa<=$count; $qa++) {
            $questions[] = array(
                "question" => "",
                "answer" => ""
            );
        }
			
			$result['result']['status'] = 'success';
			$result['result']['value']  = '';
			$result['result']['data']   = $questions;
			$result['result']['question_count']   = count($questions);
			App_DataUtils::commit();
			return $result;
    }
}
