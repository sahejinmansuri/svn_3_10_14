<?php
include(__DIR__ . '/WebController.php');

class Mw_HowItWorksController extends Mw_WebController {
	
    public function indexAction(){
		$this->view->pageid='howitworks';	
	}

    
}
