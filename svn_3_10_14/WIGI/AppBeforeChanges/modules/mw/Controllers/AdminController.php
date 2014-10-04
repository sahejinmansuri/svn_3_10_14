<?php
include(__DIR__ . '/WebController.php');

class Mw_AdminController extends Mw_WebController {

	public function homeAction(){
			try {
					$evt = new App_Event_Mw_AdminController_home( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}	
	}

	public function addroleAction(){
			try {
					$evt = new App_Event_Mw_AdminController_addrole( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}	
	}

	public function adduserAction(){
			try {
					$evt = new App_Event_Mw_AdminController_adduser( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}	
	}	

	public function editroleAction(){
			try {
					$evt = new App_Event_Mw_AdminController_editrole( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}	
	}

	public function deleteroleAction(){
			try {
					$evt = new App_Event_Mw_AdminController_deleterole( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}	
	}

	public function edituserAction(){
			try {
					$evt = new App_Event_Mw_AdminController_edituser( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}	
	}

	public function changeuserpwdAction(){
			try {
					$evt = new App_Event_Mw_AdminController_changeuserpwd( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}	
	}

}
