<?php
include(__DIR__ . '/WebController.php');

class Cw_StatementController extends Cw_WebController {
	
	public function homeAction(){
          try {
            $evt = new App_Event_Cw_StatementController_home( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function viewAction(){
          try {
            $evt = new App_Event_Cw_StatementController_view( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
	public function downloadAction(){
          try {
            $evt = new App_Event_Cw_StatementController_download( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	
	}
	
}
?>
