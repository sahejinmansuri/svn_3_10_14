<?php
include(__DIR__ . '/WebController.php');

class Cw_MiscController extends Cw_WebController {

  public function signupdirectionsAction() {

  }

  public function usererrorAction() {

      $message = $this->getRequest()->getParam('MESSAGE');
      $this->view->message = "TEST";//$message;

  }

}
?>