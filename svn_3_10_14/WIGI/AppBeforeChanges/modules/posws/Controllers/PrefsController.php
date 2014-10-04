<?php
include(__DIR__ . '/RestController.php');

class Posws_PrefsController extends Posws_RestController{

    public function saveAction(){
          $evt = new App_Event_Posws_PrefsController_save( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

}


