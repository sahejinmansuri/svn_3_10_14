<?php

include(__DIR__ . '/RestController.php');

class Posws_MessageController extends Posws_RestController 
{


	public function getmessageAction() {
          $evt = new App_Event_Posws_MessageController_getmessage( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function getnewmessageAction() {
          $evt = new App_Event_Posws_MessageController_getnewmessage( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function setmessageviewedAction() {
          $evt = new App_Event_Posws_MessageController_setmessageviewed( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}


}
