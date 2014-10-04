<?php

include(__DIR__ . '/RestController.php');

class Posws_ProfileController extends Posws_RestController 
{


	public function indexAction(){
		  $evt = new App_Event_Posws_ProfileController_index( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

}
