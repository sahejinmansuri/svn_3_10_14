<?php

include(__DIR__ . '/RestController.php');

class Posws_AuthController extends Posws_RestController
{

	public function authAction(){
          $evt = new App_Event_Posws_AuthController_auth( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
	}

  public function forgotpasswdAction() {
          $evt = new App_Event_Posws_AuthController_forgotpasswd( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
  }

  public function getquestionsAction() {
          $evt = new App_Event_Posws_AuthController_getquestions( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
  }

  public function setactiveAction() {
          $evt = new App_Event_Posws_AuthController_setactive( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
  }
public function editpasswordAction()
    {
          $evt = new App_Event_Posws_AuthController_editpassword( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }
 public function logoutAction()
    {
          $evt = new App_Event_Posws_AuthController_logout( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);

    }

}
