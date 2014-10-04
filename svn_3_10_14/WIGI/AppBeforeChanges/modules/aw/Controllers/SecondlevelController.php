<?php
include(__DIR__ . '/WebController.php');

class Aw_SecondlevelController extends Aw_WebController {
	
    public function homeAction(){
    	$this->view->pageid = "secondlevel";
    }
    
    
}
