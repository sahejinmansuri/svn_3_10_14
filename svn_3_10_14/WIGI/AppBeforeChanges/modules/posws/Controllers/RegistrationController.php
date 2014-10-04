<?php

include(__DIR__ . '/RestController.php');

class Posws_RegistrationController extends Posws_RestController
{

	public function registerAction(){
		$evt = new App_Event_Mobws_RegistrationController_registermerchant($this->getRequest());
		$evt->execute($this->ns,$this->view,$this);

                $result = array();
                $result['result']['data']   = '';
                $result['result']['status'] = 'success';

                $this->sendResponse($result);


	}

       public function getquestionAction(){
          $evt = new App_Event_Posws_RegistrationController_getquestion( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);       
       }

}
