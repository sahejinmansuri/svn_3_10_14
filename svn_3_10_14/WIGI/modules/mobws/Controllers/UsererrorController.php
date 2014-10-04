<?php
include(__DIR__ . '/WebController.php');

class Mobws_UsererrorController extends Mobws_WebController {

  public function usererrorAction() {
      $message = $this->getRequest()->getParam('MESSAGE');
      $this->view->message = $message;
  }


}
?>