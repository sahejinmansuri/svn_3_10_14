<?php

include(__DIR__ . '/RestController.php');

class Posws_RegistrationController extends Posws_RestController
{
	
	public function registerAction(){
		$evt = new App_Event_Posws_RegistrationController_registermerchant($this->getRequest());
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
   
     public function pinAction(){
          $evt = new App_Event_Posws_RegistrationController_pin( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);       
       }
   	public function addroleAction(){
			try {
					$evt = new App_Event_Posws_RegistrationController_addrole( $this->getRequest());
					$result= $evt->execute($this->ns,$this->view,$this);
					 $this->sendResponse($result);
					 
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','Pos',$a);
			}	
	}
	public function editroleAction(){
			try {
					$evt = new App_Event_Posws_RegistrationController_editrole( $this->getRequest());
						$result= $evt->execute($this->ns,$this->view,$this);
					 $this->sendResponse($result);
					
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','Pos',$a);
			}	
	}
	public function rolelistAction(){
			try {
					$evt = new App_Event_Posws_RegistrationController_rolelist( $this->getRequest());
						$result= $evt->execute($this->ns,$this->view,$this);
					 $this->sendResponse($result);
					
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','Pos',$a);
			}	
	}
	public function deleteroleAction(){
			try {
					$evt = new App_Event_Posws_RegistrationController_deleterole( $this->getRequest() );
	
					$result= $evt->execute($this->ns,$this->view,$this);
					
					 $this->sendResponse($result);
					 
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','mw',$a);
			}	
	}

public function signupAction(){ 
			
          $evt = new App_Event_Posws_RegistrationController_signup( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}
public function resendcellphoneconfirmationAction(){
          $evt = new App_Event_Posws_RegistrationController_resendcellphoneconfirmation( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

   public function checkcellphoneAction(){
          $evt = new App_Event_Posws_RegistrationController_checkcellphone( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);       
       }
   public function checkloginidAction(){
          $evt = new App_Event_Posws_RegistrationController_checkloginid( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);       
       }
   public function getquestionsAction(){
          $evt = new App_Event_Posws_RegistrationController_getquestions( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);       
       }
   public function confirmcellphoneandsetosidAction(){
          $evt = new App_Event_Posws_RegistrationController_confirmcellphoneandsetosid( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);	
        }
    public function getcurrenttosAction() {
          $evt = new App_Event_Posws_RegistrationController_getcurrenttos( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}
public function sendtosAction() {
          $evt = new App_Event_Posws_RegistrationController_sendtos( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}


}
