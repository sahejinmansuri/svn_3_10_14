<?php
include(__DIR__ . '/WebController.php');

class Cw_RegistrationController extends Cw_WebController {
	
	public function homeAction(){
          

	}
	
	public function verifyAction(){
          try {
            $evt = new App_Event_Cw_RegistrationController_verify( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	}

}
?>
