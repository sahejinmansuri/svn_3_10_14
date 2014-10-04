<?php

include(__DIR__ . '/RestController.php');

class Posws_MainmenuController extends Posws_RestController
{

       
    public function addmainmenuAction() {
    	$evt = new App_Event_Posws_MainmenuController_addmainmenu( $this->getRequest() );
      $result = $evt->execute();
      $this->sendResponse($result);
    }

    public function getmainmenuAction() {

          $evt = new App_Event_Posws_MainmenuController_getmainmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

	public function updatemainmenuAction() {
          $evt = new App_Event_Posws_MainmenuController_updatemainmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }
   public function getallmainmenuAction() {

          $evt = new App_Event_Posws_MainmenuController_getallmainmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);

    }
	public function getmainmenudataAction() {

          $evt = new App_Event_Posws_MainmenuController_getmainmenudata( $this->getRequest() );
          $evt->execute();
			//$this->sendResponse($result);

    }
	public function deletemainmenuAction() {
          $evt = new App_Event_Posws_MainmenuController_deletemainmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }
 	public function addsubmenuAction() {
    	$evt = new App_Event_Posws_MainmenuController_addsubmenu( $this->getRequest() );
      $result = $evt->execute();
      $this->sendResponse($result);
    }
  
  public function getallsubmenuAction() {

          $evt = new App_Event_Posws_MainmenuController_getallsubmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);

    }
	public function updatesubmenuAction() {
          $evt = new App_Event_Posws_MainmenuController_updatesubmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }
   public function getsubmenuAction() {

          $evt = new App_Event_Posws_MainmenuController_getsubmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }
	public function getsubmenudataAction() {

          $evt = new App_Event_Posws_MainmenuController_getsubmenudata( $this->getRequest() );
          $evt->execute();
			//$this->sendResponse($result);

    }
	public function deletesubmenuAction() {
          $evt = new App_Event_Posws_MainmenuController_deletesubmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }
   public function getallmainsubmenuAction() {

          $evt = new App_Event_Posws_MainmenuController_getallmainsubmenu( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);

    }
}
