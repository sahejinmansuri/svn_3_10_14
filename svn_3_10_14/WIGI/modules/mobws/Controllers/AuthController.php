<?php

include(__DIR__ . '/RestController.php');

class Mobws_AuthController extends Mobws_RestController {
	
    public function consolidatedauthAction(){
          $evt = new App_Event_Mobws_AuthController_consolidatedauth( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
    }

    
    public function settosandauthAction(){
          $evt = new App_Event_Mobws_AuthController_settosandauth( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
    }

    public function logoutAction()
    {
          $evt = new App_Event_Mobws_AuthController_logout( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);

    }
	public function profileAction()
    {
          $evt = new App_Event_Mobws_AuthController_profile( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);

    }

}
