<?php

include(__DIR__ . '/RestController.php');

class Posws_MenuController extends Posws_RestController 
{

	public function indexAction(){
		  $evt = new App_Event_Posws_MenuController_index( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function addAction(){
		  $evt = new App_Event_Posws_MenuController_add( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function editAction(){
		  $evt = new App_Event_Posws_MenuController_edit( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function deleteAction(){
		  $evt = new App_Event_Posws_MenuController_delete( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

}
