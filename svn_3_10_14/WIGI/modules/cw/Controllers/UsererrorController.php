<?php
include(__DIR__ . '/WebController.php');

class Cw_UsererrorController extends Cw_WebController {

  public function usererrorAction() {
      $message = $this->getRequest()->getParam('MESSAGE');
      $this->view->message = $message;
  }


}
