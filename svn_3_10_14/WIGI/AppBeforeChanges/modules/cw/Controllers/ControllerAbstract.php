<?php

abstract class Cw_ControllerAbstract extends Atlasp_ControllerAction
{

    /**
     * @var Zend_Log
     */
    protected $log = null;
    /**
     * @var Zend_Session_Namespace
     */
    public $ns = null;
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
	parent::init();
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
    protected function _setResponseError($error) {
        $response = new App_Ws_Types_Response();
        $response->setError($error);
        $this->_response->setBody($response->toJson());
        $this->_response->sendResponse();
    }

    public function set_default_tpls() {
        /*
         * This piece of code prevents this function
         * from running twice when the _forward method is called.
         * Calling this method twoice causes the module name
         * to be appended to the basehref path (cfg-paths->basehref)
         * 
         */

        static $i = 0;
        $i++;
        if ($i > 1) { return; }

        parent::set_default_tpls();

        $cfg = $this->cfg;

        // Adjust paths and template dir for modules
        $tplSearchPaths = array( $cfg->paths->coderoot . 'views/web/tpl' );
        $moduleName = $this->getRequest()->getModuleName();
        if ($moduleName != 'default') {
            $orig_basehref = $cfg->paths->basehref;
	        $ver = $cfg->version;
            $basehref = $orig_basehref . $moduleName.'/';

            $cfg->paths->basehref = $basehref;
            $this->view->basehref = $basehref;
            #$this->view->appBasehref =  $this->ns->appBasehref;
            $this->view->formbase = $orig_basehref.$cfg->version.'/cw/';

            $this->view->csspath = $orig_basehref .$ver .'/m/'. $moduleName . '/css';
            array_unshift($tplSearchPaths, $cfg->paths->coderoot . 'modules/'.$moduleName.'/views/web/tpl' );
        }
		
		if($this->ns->logged_in){
			$this->view->logged_in=1;
		}else{
			$this->view->logged_in=0;
		}
		#var_dump($this->ns->logged_in);
        /*
	 * add smarty plugin to search for templates under module
	 * directories first, then use the global template
	 *
	 */
        /*
        $engine = $this->view->getEngine();
        $engine->compile_id = $moduleName;   // identifier for compiler files. differentiates all the compiled files with same names
	var_dump($tplSearchPaths);
        $plugin = new Atlasp_SmartyMultipathPlugin($tplSearchPaths);
        $engine->registerResource('mpath', array(
                    array($plugin, 'smarty_resource_mpath_source'),
                    array($plugin, 'smarty_resource_mpath_timestamp'),
                    array($plugin, 'smarty_resource_mpath_secure'),
                    array($plugin, 'smarty_resource_mpath_trusted')
               )
        );
        $engine->default_resource_type = 'mpath';
        */
    }
 
}
?>