<?php
include(__DIR__ . '/WebController.php');

class Mw_MenuController extends Mw_WebController {
	
	public function homeAction(){
		try {
			$evt = new App_Event_Mw_MenuController_home( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}

	public function addAction(){
		try {
			$evt = new App_Event_Mw_MenuController_add( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}

	public function doaddAction(){
		try {
			$evt = new App_Event_Mw_MenuController_doadd( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}

	public function editAction(){
		try {
			$evt = new App_Event_Mw_MenuController_edit( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}

	public function doeditAction(){
		try {
			$evt = new App_Event_Mw_MenuController_doedit( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function deleteAction(){
		try {
			$evt = new App_Event_Mw_MenuController_delete( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
}
?>
