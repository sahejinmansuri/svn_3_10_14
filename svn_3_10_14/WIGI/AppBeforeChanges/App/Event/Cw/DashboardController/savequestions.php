<?php

class App_Event_Cw_DashboardController_savequestions extends App_Event_WsEventAbstract  {
	
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
		
				$uid = $session_data->identity['userid'];
				$securityQuestions = $cthis->getActiveSecurityQuestions($uid);

				$questionsArr=array();
				$cnt=1;
				for($i=0;$i<3;$i++)
				{
					$cnt;
					if(!isset($securityQuestions[$i]))
					{
						$cnt=$i+1;
						$ques=array();

						//Insert the question/answer here
						$ques['question'] = $this->_request->getParam('question_'.$cnt);
						$ques['answer'] = $this->_request->getParam('answer_'.$cnt);
						$ques['mobile_id'] = $cthis->getDefaultMobileId($uid);
						$ques['user_added']=$uid;
						$ques['date_added']=new Zend_Db_Expr('NOW()');
						$ques['status']='active';

						if(isset($ques['question']) and $ques['question'] and isset($ques['answer']))
						{
							$questions = new App_Models_Db_Wigi_Question();
							$questions->insert($ques);
						}

					}
					
				}
			//$a['message']='Security Questions and Answers required';
			$cthis->redirect('home','dashboard','cw');
	}
	
}

?>
