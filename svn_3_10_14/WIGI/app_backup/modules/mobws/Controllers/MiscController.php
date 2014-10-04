<?php
include(__DIR__ . '/RestController.php');

class Mobws_MiscController extends Mobws_RestController{

    public function versionAction(){
      $evt = new App_Event_Mobws_MiscController_version( $this->getRequest() );
      $result = $evt->execute();
      $this->sendResponse($result);
    }

    
    public function whatsmyipAction(){
        #throw new App_Exception_WsException();
        $r = array('status' => 'success', 'data' => $_SERVER['REMOTE_ADDR']);
        $this->sendResponse($r);    
    }   

}
