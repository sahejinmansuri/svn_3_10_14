<?php
include(__DIR__ . '/WebController.php');

class Mw_HistoryController extends Mw_WebController {
	
	public function homeAction(){
		try {
			$evt = new App_Event_Mw_HistoryController_home( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function setviewedAction(){
		try {
			$evt = new App_Event_Mw_HistoryController_setviewed( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
}
?>