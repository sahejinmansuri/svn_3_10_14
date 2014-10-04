<?php
include(__DIR__ . '/WebController.php');

class Cw_AdvancedController extends Cw_WebController {
	
	public function homeAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_home( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }		
	}
	
	public function movefundsAction() {
          try {
            $evt = new App_Event_Cw_AdvancedController_movefunds( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function mydocumentsAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_mydocuments( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function mydocumentsviewAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_mydocumentsview( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function mydocumentsdataviewAction() {
          try {
            $evt = new App_Event_Cw_AdvancedController_mydocumentsdataview( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	}
	
	public function mydocumentseditAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_mydocumentsedit( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function mydocumentsdeleteAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_mydocumentsdelete( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function messagesAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_messages( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function messagesdeleteAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_messagesdelete( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function supportmessagesAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_supportmessages( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function supportmessagesdeleteAction(){
          try {
            $evt = new App_Event_Cw_AdvancedController_supportmessagesdelete( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}

}
?>
