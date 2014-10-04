<?php

require_once 'ControllerAbstract.php';

class Mobws_RestController extends Mobws_ControllerAbstract {


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
            //error_log("Input $k => $v");
        }
        
        //  Set Response Headers
        $this->_response->setHeader('Content-type', 'application/json');
        $this->getHelper('ViewRenderer')->setNoRender();
        
        if($this->cfg->mobws->disabled == 1){
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

            /*$u = new App_User($this->ns->userid);
            if (!($u->isActive())) {
                $this->_setResponseLoginRequired();
                exit();
            }*/


            $c = new App_Cellphone($this->ns->mobileid);
            if (!($c->isActive())) {
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
            'registration/register'                    => 1,
            'registration/resendcellphoneconfirmation' => 1,
            'registration/confirmcellphoneandsetosid'  => 1,
            'registration/getquestionfrompin'          => 1,
            'registration/getquestionfromosid'         => 1,
            'registration/getquestion'                 => 1,
            'registration/forgotpin'                   => 1,
            'registration/setosid'                     => 1,
            'registration/sendtos'                     => 1,
	    'registration/getcurrenttos'               => 1,
            'registration/confirmcellphone'            => 1,
            'registration/checkcellphone'              => 1,
            'registration/checkloginid'                => 1,
            'registration/getquestions'                => 1,
            'auth/auth'                                => 1,
            'auth/auth1'                               => 1,
            'auth/consolidatedauth'                    => 1,
	    'auth/settosandauth'                       => 1,
	    'wigi/addcreditcard'                       => 1,
	    'wigi/addbankaccount'                      => 1,
            'wigi/fromcreditcardtowigi'                => 1,
            'wigi/fromwigitocreditcard'                => 1,
            'wigi/frombankaccounttowigi'               => 1,
            'wigi/fromwigitobankaccount'               => 1,
            'wigi/testcreditcard'                      => 1,
            'wigi/testbankaccount'                     => 1,
            'wigi/creditcardsale'                      => 1,
            'wigi/adddocument'                         => 1,
            'wigi/getdocument'                         => 1,
            'wigi/getdocumentdata'                     => 1,
            'wigi/updatedocument'                      => 1,
            'wigi/getcreditcardconfnumber'             => 1,
            'wigi/getbankaccountconfnumber'            => 1,
            'misc/test'                                => 1,
            'misc/version'                             => 1,
            'test/testlock'                            => 1,
            'zip/getstatefromzip'                      => 1,
            'index/index'                              => 1,
            'cellphone/processtxt'                     => 1,
            'registration/passwordstrength'            => 1
        );    
        return (isset( $free[$evt] ))?true:false;
    }
    

    #Get Handles based on userid // for later optimization
    public function reInitializeDbs($userid){
        
    }

}
