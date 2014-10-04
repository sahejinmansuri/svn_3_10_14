<?php
include(__DIR__ . '/WebController.php');

class Cw_HistoryController extends Cw_WebController {

	public function homeAction(){

          try {
            $evt = new App_Event_Cw_HistoryController_home( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	}
	
	public function setviewedAction(){
      

          try {
            $evt = new App_Event_Cw_HistoryController_setviewed( $this->getRequest() );
            $$evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	
	}


}
?>
