<?php

include(__DIR__ . '/WebController.php');

class Mw_IndexController extends Mw_WebController {
	
	public function unavailableAction(){}
    
    public function indexAction(){
        $this->redirect('home','login','mw');    
    }
    public function logoutAction(){
        $login = new App_Login_Mw();
        $login->logout();
        Zend_Session::destroy();
        $this->redirect('home','login','mw');
    }

}
