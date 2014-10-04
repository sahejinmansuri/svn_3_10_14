<?php

class App_Event_Cw_DashboardController_showquestions extends App_Event_WsEventAbstract  {
	
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
                $questions = new App_Question();
                $pview->questions = $questions->getPredefQuestions();
		
				$uid = $session_data->identity['userid'];
				$securityQuestions = $cthis->getActiveSecurityQuestions($uid);

				if(count($securityQuestions) == 3) { $cthis->redirect('home','dashboard','cw'); }

				$questionsArr=array();
				$cnt=0;
				for($i=0;$i<3;$i++)
				{
					$tmpQues = array();

					if(isset($securityQuestions[$i]))
					{
						$tmpQues['question'] = $securityQuestions[$i]['question'];
						$tmpQues['answer'] = $securityQuestions[$i]['answer'];
						$tmpQues['rec_num']=++$cnt;
					}else
					{
						$tmpQues['question']='';
						$tmpQues['answer']='';
						$tmpQues['rec_num']=++$cnt;
					}
					
					$questionsArr[] = $tmpQues;
				}
				
				$pview->questionsArr = $questionsArr;	
	
	}
	
}

?>
