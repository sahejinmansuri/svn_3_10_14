<?php

class Cw_ErrorController extends Atlasp_ErrorController{
    
    public function errorAction(){
        $this->_response->setHeader('Content-type', 'application/json');
        $this->getHelper('ViewRenderer')->setNoRender();
        $r = array(
            'error'  => array( 'code' => '-32000', 'message' => 'There was a problem with the the request', 'data' => ''),
            'result' => array( 'value' => '', 'status' => 'failure', 'data' => '' ),
        );


        $errors = $this->_getParam('error_handler');
        if (!$errors) {
            $json = Zend_Json::encode($r);
            $this->_response->setBody($json);
            return;
        }

        $lastError = $errors->getIterator()->current();
        #var_dump($lastError);
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                $this->getResponse()->setHttpResponseCode(404);
                break;

            default:
                switch ($lastError->getCode()) {
                    case 0:
                    default:if($lastError->getMessage())
                        $r['error']['message'] = $lastError->getMessage();
                }
        }


	    $json = Zend_Json::encode($r);
        $this->_response->setBody($json);
    }

    public function usererrorAction() {
      $message = $this->getRequest()->getParam('MESSAGE');
      $this->view->message = $message;
    }
        
}

?>