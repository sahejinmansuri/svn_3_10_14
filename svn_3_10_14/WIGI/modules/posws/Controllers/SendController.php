<?php

include(__DIR__ . '/RestController.php');

class Posws_SendController extends Posws_RestController 
{

	public function inviteAction(){
          $evt = new App_Event_Posws_SendController_invite( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function supportAction(){
	  $evt = new App_Event_Posws_SendController_support( $this->getRequest() );
	  $result = $evt->execute();
	  $this->sendResponse($result);
	}


}
