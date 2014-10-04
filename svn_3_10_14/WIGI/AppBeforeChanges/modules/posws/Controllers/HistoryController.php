<?php
include(__DIR__ . '/RestController.php');

class Posws_HistoryController extends Posws_RestController{
    
    public function allAction() {
          $evt = new App_Event_Posws_HistoryController_all( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }
}
