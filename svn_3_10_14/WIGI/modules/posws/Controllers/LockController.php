<?php

include(__DIR__ . '/RestController.php');

class Posws_LockController extends Posws_RestController
{

       
    public function lockmerchantAction() {
    	
    	$evt = new App_Event_Posws_LockController_lockmerchant( $this->getRequest() );
      $result = $evt->execute();
      $this->sendResponse($result);
    }

	public function lockposAction() {
    	
    	$evt = new App_Event_Posws_LockController_lockpos( $this->getRequest() );
      $result = $evt->execute();
      $this->sendResponse($result);
    }
}
