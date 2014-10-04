<?php
include(__DIR__ . '/WebController.php');

class Aw_ProfileController extends Aw_WebController {
	public function adduserAction(){
		try {
			$evt = new App_Event_Aw_ProfileController_adduser( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	
	public function edituserAction(){
		try {
			$evt = new App_Event_Aw_ProfileController_edituser( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	public function edituserstatusAction(){
		try {
			$evt = new App_Event_Aw_ProfileController_edituserstatus( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	
	public function edituserpasswordAction(){
		try {
			$evt = new App_Event_Aw_ProfileController_edituserpassword( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	public function deleteuserAction(){
		try {
			$evt = new App_Event_Aw_ProfileController_deleteuser( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	
}
?>