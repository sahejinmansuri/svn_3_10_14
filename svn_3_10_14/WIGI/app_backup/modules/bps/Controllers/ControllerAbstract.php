<?php

abstract class Bps_ControllerAbstract extends Atlasp_ControllerAction
{

    /**
     * @var Zend_Log
     */
    protected $log = null;
    /**
     * @var Zend_Session_Namespace
     */
    protected $ns = null;
    /**
     * @var Zend_Config_Ini
     */
    protected $cfg = null;

    /**
     * Default constructor
     * 
     * @param Zend_Controller_Request_Abstract $request
     * @param Zend_Controller_Response_Abstract $response
     * @param array $invokeArgs 
     */
    public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
    {
        //  Initialize properties before constructor is called,
        //  this way properties will exist in init() method
        $this->cfg = Zend_Registry::get('config');
        $this->log = Zend_Registry::get('log');
        $this->ns = new Zend_Session_Namespace(Zend_Registry::get('name'));

        //  
        parent::__construct($request, $response, $invokeArgs);

        //
        $this->view->addHelperPath('Helpers');
    }
    
    /**
     * Initialize object
     */
    public function init()
    {
        //  Make sure request is allowed to be executed
        $this->_checkRequestType();
    }

    /**
     *  NOTE: We do not need to call parent::preDispatch
     */
    public function preDispatch()
    {
        
    }

    /**
     * Checks request type
     */
    protected function _checkRequestType()
    {
        //
        $allowGetRequests = (bool) $this->cfg->security->request->allow_get;
        $request = $this->getRequest();
        /* @var $request Zend_Controller_Request_Http */

        //  If Get request is not allowed 
        if ($request->isGet() && !$allowGetRequests) {
            //
            $this->log->debug(__METHOD__ . '() GET requests are not allowed');
            $this->_setResponseError(App_Ws_Types_Response::ERRNO_INVALID_REQUEST);
            exit();
        }
    }

    /**
     * Sets response to NOT_ALLOWED error message 
     */
    protected function _setResponseAccessNotAllowed()
    {
        $controller = $this->getRequest()->getControllerName();
        $action = $this->getRequest()->getActionName();
        $this->log->debug(__METHOD__ . "() User not allowed to access $controller/$action");

        //
        $this->_setResponseError(App_Ws_Types_Response::ERRNO_NOT_ALLOWED);
    }

    /**
     * Sets response to LOGIN_REQUIRED error message
     */
    protected function _setResponseLoginRequired()
    {
        $this->_setResponseError(App_Ws_Types_Response::ERRNO_LOGIN_REQUIRED);
    }

    /**
     * Sets response to ERRNO_INVALID_DEVICE_IDENTIFIER error message
     */
    protected function _setResponseInvalidDevice()
    {
        $this->_setResponseError(App_Ws_Types_Response::ERRNO_INVALID_DEVICE_IDENTIFIER);
    }

    /**
     * Sets error message in response
     * 
     * @see App_Ws_Types_Response
     * @param int $error constant error code from App_Ws_Types_Response
     */
    protected function _setResponseError($error)
    {
        $response = new App_Ws_Types_Response();
        $response->setError($error);
        $this->_response->setBody($response->toJson());
        $this->_response->sendResponse();
    }

}