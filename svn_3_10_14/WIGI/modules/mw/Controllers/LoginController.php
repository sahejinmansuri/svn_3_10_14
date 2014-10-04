<?php
include(__DIR__ . '/WebController.php');

class Mw_LoginController extends Mw_WebController {
	
    public function homeAction(){
                try {
                        $evt = new App_Event_Mw_LoginController_home( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
    }
    
    public function forgotpasswdAction(){
                try {
                        $evt = new App_Event_Mw_LoginController_forgotpasswd( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }	
    }
    
    public function forgotloginidAction(){
                try {
                        $evt = new App_Event_Mw_LoginController_forgotloginid( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }	
    }

    public function authAction(){
                        $evt = new App_Event_Mw_LoginController_auth( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
    }
    
    public function loggedoutAction(){
    	
    }
    
}
