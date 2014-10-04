<?php
include(__DIR__ . '/WebController.php');

class Mw_ReportController extends Mw_WebController {
	
	public function homeAction(){
		try {
			$evt = new App_Event_Mw_ReportController_home( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}

        public function downloadAction(){
                try {
                        $this->_helper->viewRenderer->setNoRender(true);
                        $evt = new App_Event_Mw_ReportController_download( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }  

        }

}
?>
