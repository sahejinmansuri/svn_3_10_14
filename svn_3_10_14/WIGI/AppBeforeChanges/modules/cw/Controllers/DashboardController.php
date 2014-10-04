<?php
include(__DIR__ . '/WebController.php');

class Cw_DashboardController extends Cw_WebController {
	
	public function homeAction(){
		$this->checkUserSetUp();

		  try {
            $evt = new App_Event_Cw_DashboardController_home( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	}


	protected function checkUserSetUp()
	{
		if(!isset($this->ns->remind_questions_later) and !$this->ns->remind_questions_later)
		{
			$this->checkQuestionsSetUp();
		}
	}


	protected function checkQuestionsSetUp()
	{
		$uid  = $this->ns->identity['userid'];

		$securityQuestions = $this->getActiveSecurityQuestions($uid);

		if(count($securityQuestions) < 3)
		{
			$this->redirect('showquestions','dashboard','cw');
		}

	}

	public function getActiveSecurityQuestions($uid)
	{
		$default_mobile_id = $this->getDefaultMobileId($uid);

		$questions = new App_Models_Db_Wigi_Question();
	    $select = $questions->select();
		$select->where('`mobile_id` = ?',$default_mobile_id)->where('`status` = ?',"active");
		$result = $questions->fetchAll($select);
		$securityQuestions=array();

		if($result)
		{
			$securityQuestions=$result->toArray();
		}

		return $securityQuestions;
	}

	public function getDefaultMobileId($uid)
	{
		$user = new App_User($uid);
		// Check for Security Questions
		$default_mobile_id='';
		//Get the default Phone
		foreach($user->getCellphones() as $cellrow)
		{
			if($cellrow->is_default)
			{
				$a = $cellrow->toArray();
				$default_mobile_id = $a['mobile_id'];
			}
		}
		
		return $default_mobile_id;
	}


   public function showquestionsAction(){
			try {
					$evt = new App_Event_Cw_DashboardController_showquestions( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}
	}

	public function questionslaterAction(){
		$this->ns->remind_questions_later=1;
		$this->redirect('home','dashboard','cw');
	}

	public function savequestionsAction(){
			try {
					$evt = new App_Event_Cw_DashboardController_savequestions( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','cw',$a);
			}
	}
	


}
?>
