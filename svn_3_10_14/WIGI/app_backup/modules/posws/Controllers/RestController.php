<?php

require_once 'ControllerAbstract.php';

class Posws_RestController extends Posws_ControllerAbstract {


    public function dispatch($action) {
        $isAllowed = true;

        //Place logic here if certain actions are to be disabled for the users based on some criteria. ( for future )
        if ($isAllowed) {
            parent::dispatch($action);
        } else {
            $this->_setResponseAccessNotAllowed();
        }
    }

    public function init() {
        parent::init();
        foreach($_POST as $k =>$v){
            error_log("Input $k => $v");
        }
        //  Set Response Headers
        $this->_response->setHeader('Content-type', 'application/json');
        $this->getHelper('ViewRenderer')->setNoRender();
        
        if($this->cfg->posws->disabled == 1){
            $this->_setResponseSiteDown();
            exit();
        }

        // REST NON-Authentication
        $action = $this->getRequest()->getActionName();
        $cntrl = $this->getRequest()->getControllerName();
        if ($this->freeEvent($cntrl.'/'.$action) == false ) {

            //  If user is not logged in set error and terminate application
            if (!$this->ns->logged_in ) {
                $this->_setResponseLoginRequired();
                exit();
            }
            
            //  Make sure device identifier matches the one used for login
            $helper = $this->getHelper('SessionHopping');
            /* @var $helper Helpers_SessionHopping */
            if (!$helper->isCorrectIdentifier()) {
                $helper->sendInvalidIdentifierNotification();
                $this->_setResponseInvalidDevice();
                exit();
            }

            $u = new App_User($this->ns->userid);
            if (!($u->isActive())) {
                $this->_setResponseLoginRequired();
                exit();
            }

            $this->reInitializeDbs( $this->ns->userid);

        }
    }

    /**
     * Destroy session
     */
    public function logoutAction()
    {
        // Logout and destroy session
        $this->login->logout();
        Zend_Session::destroy();
        
        // Set response
        $response = new App_Ws_Types_Response();
        $response->setCount(1);
        $response->setResult(array('success' =>  (int)Zend_Session::isDestroyed()));  
        
        // Send the response
        $this->_response->setBody($response->toJson());
        $this->_response->sendResponse();
        exit();
    }



    /**
     * 
     * This method handles all REST responses.
     */
    protected function sendResponse($r, $inputParams=array()) {
        
        $request = $this->getRequest();
	    $json = Zend_Json::encode($r);
        $this->_response->setBody($json);
    }

    /**
     * 
     * This method generates a checksum based on the URL parameters passed.
     * 
     * @param Zend_Controller_Request_Abstract $request Request object
     * @param array $cacheParams Parameter names
     * @return string md5-checksum
     */
    protected function generateCacheCheckSum($cacheParams)
    {
        $request = $this->getRequest();
        $cacheParams = array_merge( $cacheParams, array($request->getControllerKey(), $request->getActionKey()));
        asort($cacheParams);
        $arr = array();
        foreach ($cacheParams as $key) {
            $arr[] = $key . '=' . $request->getParam($key);
        }
        return md5(strtolower(implode('&', $arr))); // md5 of key1=val1&key2=val2
    }
    
    public function freeEvent($evt){
        $free = array(
            'misc/whatsmyip'                           => 1,
            'misc/test'                                => 1,
            'misc/test2'                                => 1,
            #'misc/prodimage'                                => 1,
            'misc/proddetails'                                => 1,
            'misc/placeorder'                                => 1,
            'registration/register'                             => 1,
            'registration/addpos'                               => 1,
            'auth/auth'                                 => 1,
            'auth/forgotpasswd'                                 => 1,
            'auth/getquestions'                                 => 1,
            'auth/setactive'                                    => 1,
            'registration/getquestion'                          => 1,
            'zip/getstatefromzip'                               => 1,
        );    
        return (isset( $free[$evt] ))?true:false;
    }
    

    #Get Handles based on userid // for later optimization
    public function reInitializeDbs($userid){
        
    }
    
}
