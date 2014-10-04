<?php
include(__DIR__ . '/RestController.php');

class Mobws_IndexController extends Mobws_RestController{
    
    public function whatsmyipAction(){
        #throw new App_Exception_WsException();
        $r = array('status' => 'success', 'data' => $_SERVER['REMOTE_ADDR']);
        $this->sendResponse($r);    
    }   

    public function indexAction(){
        #throw new App_Exception_WsException();
        $r = array('status' => 'success', 'data' => "site is up");
        $this->sendResponse($r);    
    }   
    
}
