<?php
include(__DIR__ . '/WebController.php');

class Mw_UsererrorController extends Mw_WebController {

  public function usererrorAction() {
      $message = $this->getRequest()->getParam('MESSAGE');
      $this->view->message = $message;
  }


}
