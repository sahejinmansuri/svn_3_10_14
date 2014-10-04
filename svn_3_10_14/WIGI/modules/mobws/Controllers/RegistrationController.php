<?php

include(__DIR__ . '/RestController.php');

class Mobws_RegistrationController extends Mobws_RestController
{
	
	public function registerAction(){
          $evt = new App_Event_Mobws_RegistrationController_register( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

        public function passwordstrengthAction(){
          $evt = new App_Event_Mobws_RegistrationController_passwordstrength( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

	public function resendcellphoneconfirmationAction(){
          $evt = new App_Event_Mobws_RegistrationController_resendcellphoneconfirmation( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

        public function getquestionsAction() {
          $evt = new App_Event_Mobws_RegistrationController_getquestions( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

	public function confirmcellphoneandsetosidAction(){
          $evt = new App_Event_Mobws_RegistrationController_confirmcellphoneandsetosid( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);	
        }

	public function confirmcellphoneAction(){
          $evt = new App_Event_Mobws_RegistrationController_confirmcellphone( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
	}

	public function setosidAction(){
          $evt = new App_Event_Mobws_RegistrationController_setosid( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
	}

	public function getquestionAction(){
          $evt = new App_Event_Mobws_RegistrationController_getquestion( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
	}

	public function forgotpinAction(){
          $evt = new App_Event_Mobws_RegistrationController_forgotpin( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
	}

	public function checkanswerAction(){
          $evt = new App_Event_Mobws_RegistrationController_checkanswer( $this->getRequest() );
          $result = $evt->execute($this);
          $this->sendResponse($result);
	}

	public function sendtosAction() {
          $evt = new App_Event_Mobws_RegistrationController_sendtos( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}


        public function checkcellphoneAction() {
          $evt = new App_Event_Mobws_RegistrationController_checkcellphone( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }
	
        public function checkloginidAction() {
          $evt = new App_Event_Mobws_RegistrationController_checkloginid( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

	public function getcurrenttosAction() {
          $evt = new App_Event_Mobws_RegistrationController_getcurrenttos( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}


}
