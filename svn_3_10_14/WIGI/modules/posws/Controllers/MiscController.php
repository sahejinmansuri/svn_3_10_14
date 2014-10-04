<?php
include(__DIR__ . '/RestController.php');

class Posws_MiscController extends Posws_RestController{

    public function testAction(){
        #$link = $this->getRequest()->getParam('I');
        $link = $_SERVER['REQUEST_URI'];

        error_log($link);
        $this->_helper->viewRenderer->setNoRender();

        preg_match( '/test\/I\/(.*)/', $link,$match);
        $od = urldecode($match[1]);

            $code_params = array('text'            => $od,
            'backgroundColor' => '#FFFFFF',
            'foreColor' => '#000000',
            'padding' => 4,  //array(10,5,10,5),
            'moduleSize' => 8);

        $renderer_params = array('imageType' => 'png');
        Zend_Matrixcode::render('qrcode', $code_params, 'image', $renderer_params);
        exit;

    }

    
    public function whatsmyipAction(){
        #throw new App_Exception_WsException();
        $r = array('status' => 'success', 'data' => $_SERVER['REMOTE_ADDR']);
        $this->sendResponse($r);    
    }   

    public function proddetailsAction(){
          $evt = new App_Event_Posws_MiscController_proddetails( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);
    }

    public function paymentdetailsAction() {
          $evt = new App_Event_Posws_MiscController_paymentdetails( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);
    }

    public function prodimageAction(){
          $evt = new App_Event_Posws_MiscController_prodimage( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result); 
    }

    public function placeorderAction(){
          $evt = new App_Event_Posws_MiscController_placeorder( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result); 
    }
   
    public function placepaymentAction() {
          $evt = new App_Event_Posws_MiscController_placepayment( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);
    } 
}
