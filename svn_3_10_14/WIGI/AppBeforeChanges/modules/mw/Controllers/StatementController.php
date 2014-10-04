<?php
include(__DIR__ . '/WebController.php');

class Mw_StatementController extends Mw_WebController {
	
	public function homeAction(){
                try {
                        $evt = new App_Event_Mw_StatementController_home( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }	
	}
	
	public function viewAction(){
                try {
                        $evt = new App_Event_Mw_StatementController_view( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
	}
	
	public function downloadAction(){
                try {
                        $evt = new App_Event_Mw_StatementController_download( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }	
	}
	
}
