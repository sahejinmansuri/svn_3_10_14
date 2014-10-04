<?php

include(__DIR__ . '/WebController.php');

class Cw_IndexController extends Cw_WebController {
	
	public function unavailableAction(){}
    
    public function indexAction(){
        $this->redirect('home','login','cw');    
    }
    public function logoutAction(){
        $login = new App_Login_Cw();
        $login->logout();
        Zend_Session::destroy();
        $this->redirect('home','login','cw');
    }

}
?>