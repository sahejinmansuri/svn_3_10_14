<?php
include(__DIR__ . '/RestController.php');

class Posws_PaymentController extends Posws_RestController{

    public function cashreceiptAction() {
          $evt = new App_Event_Posws_PaymentController_cashreceipt( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }
  
    public function creditreceiptAction() {
          $evt = new App_Event_Posws_PaymentController_creditreceipt( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

 
    public function wigireceiptAction() {
          $evt = new App_Event_Posws_PaymentController_wigireceipt( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }


 
    public function cashAction(){
          $evt = new App_Event_Posws_PaymentController_cash( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

    public function creditAction(){
          $evt = new App_Event_Posws_PaymentController_credit( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

    public function wigiAction() {
          $evt = new App_Event_Posws_PaymentController_wigi( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

    public function ecommerceAction() {
          $evt = new App_Event_Posws_PaymentController_ecommerce( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }


}
