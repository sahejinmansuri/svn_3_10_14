<?php

include(__DIR__ . '/RestController.php');

class Mobws_ZipController extends Mobws_RestController
{
	
	public function getstatefromzipAction(){
          $evt = new App_Event_Mobws_ZipController_getstatefromzip( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);

	}

	

}
