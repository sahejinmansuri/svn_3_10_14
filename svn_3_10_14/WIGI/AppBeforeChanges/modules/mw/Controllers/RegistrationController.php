<?php

include(__DIR__ . '/WebController.php');

class Mw_RegistrationController extends Mw_WebController
{
	
	public function homeAction(){
                try {
                        $evt = new App_Event_Mw_RegistrationController_home( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }		
	}
	
	public function registerAction(){
		$this->view->states = array("AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas", "CA" => "California", "CO" => "Colorado", "CT" => "Connecticut", "DE" => "Delaware", "FL" => "Florida", "GA" => "Georgia", "HI" => "Hawaii", "ID" => "Idaho", "IL" => "Illinois", "IN" => "Indiana", "IA" => "Iowa", "KS" => "Kansas", "KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine", "MD" => "Maryland", "MA" => "Massachusetts", "MI" => "Michigan", "MN" => "Minnesota", "MS" => "Mississippi", "MO" => "Missouri", "MT" => "Montana", "NE" => "Nebraska", "NV" => "Nevada", "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico", "NY" => "New York", "NC" => "North Carolina", "ND" => "North Dakota", "OH" => "Ohio", "OK" => "Oklahoma", "OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island", "SC" => "South Carolina", "SD" => "South Dakota", "TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah", "VT" => "Vermont", "VA" => "Virginia", "WA" => "Washington", "WV" => "West Virginia", "WI" => "Wisconsin", "WY" => "Wyoming");
		
		$evt = new App_Event_Mobws_RegistrationController_registermerchant($this->getRequest());
        try{
            $evt->execute($this->ns,$this->view,$this);
        }catch(Exception $e){
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','mw',$a);
        }

      }

    public function verifyAction(){
                try {
                        $evt = new App_Event_Mw_RegistrationController_verify( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
 
    }
}
