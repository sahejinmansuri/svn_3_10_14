<?php

include(__DIR__ . '/WebController.php');

class Aw_IndexController extends Aw_WebController {
	
    public function indexAction(){
        $this->redirect('home','login','aw');    
    }
    public function logoutAction(){
        $login = new App_Login_Aw();
        $login->logout();
        Zend_Session::destroy();
        $this->redirect('home','login','aw');
    }
    public function unavailableAction(){
		//die('GG');
		
    }

}
