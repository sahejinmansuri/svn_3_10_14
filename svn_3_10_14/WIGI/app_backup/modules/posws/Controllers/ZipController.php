<?php

include(__DIR__ . '/RestController.php');

class Posws_ZipController extends Posws_RestController
{
	
	public function getstatefromzipAction(){
          $evt = new App_Event_Posws_ZipController_getstatefromzip( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	

}
