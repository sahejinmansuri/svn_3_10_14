<?php
include(__DIR__ . '/WebController.php');

class Cw_HowItWorksController extends Cw_WebController {
	
    public function indexAction(){
		$this->view->pageid='howitworks';	
	}

    
}
