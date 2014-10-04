<?php
include(__DIR__ . '/WebController.php');

class Cw_LoginController extends Cw_WebController {
	
    public function homeAction(){
    	if ($this->ns->logged_in) {
    		$this->redirect('home','dashboard','cw');
    	}
    }
    
    public function sendtokenAction(){
            $evt = new App_Event_Cw_LoginController_sendtoken( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
    }
    
    public function authAction(){
            $evt = new App_Event_Cw_LoginController_auth( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
    }


    public function forgotpasswdAction(){
          try {
            $evt = new App_Event_Cw_LoginController_forgotpasswd( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }    	
    }
    
    public function lostcellAction(){
    	
    }
    
    public function loggedoutAction(){
    	
    }
    
}
?>
