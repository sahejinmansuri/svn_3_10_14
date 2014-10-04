<?php
include(__DIR__ . '/WebController.php');

class Aw_SecurityController extends Aw_WebController {
	
    public function homeAction(){
    	$this->view->pageid = "security";
        $this->view->adminusers = App_AdminUser::findAll();
        $this->view->adminroles = App_AdminRole::findAll();
    }
    
    public function createadminAction(){
    	$newadmin = new App_AdminUser();
        
    }
}
