<?php

/**
 * Super Class for Plugin
 */
abstract class Atlasp_Plugins_PluginAbstract extends Zend_Controller_Plugin_Abstract
{

    /**
     * Log
     * @var Zend_Log 
     */
    protected $_log = null;
    /**
     * Application Configurations
     * @var Zend_Config_Ini
     */
    protected $_config = null;
    /**
     * Flood Session Space
     * @var Zend_Session_Namespace
     */
    protected $_namespace = null;
    /**
     * Evens Info. Stores all the information for the events. 
     * @var array 
     */
    protected $_eventsInfo = array();

    /**
     * Default Constructor
     */
    public function __construct()
    {
        $this->_log = Zend_Registry::get('log');
        $this->_config = Zend_Registry::get('config');
        $this->_namespace = new Zend_Session_Namespace(Zend_Registry::get('name'));

        $this->_log->info('Initializing Plugin - ' . get_class($this));
    }

    /**
     * Gets path for the class file
     * 
     * @param string $className
     * @return string path to the file on the disk
     */
    protected function _getClassPath($className)
    {
        $pathConfig = $this->_config->paths;
        $classPath = str_replace('_', '/', $className);
        return "{$pathConfig->coderoot}{$classPath}.php";
    }

    /**
     * Get class name for the action
     * 
     * @return string
     */
    protected function _getEventClassName()
    {
        //  Get Module
        $module = $this->_getModuleName();
        //  Prefix module with underscore because is not required parameter
        $module = $module ? '_' . ucfirst($module) : null;

        //  Get Controller and action
        $controller = ucfirst($this->_getControllerName());
        $action = $this->_getActionName();

        //
        return "App_Event{$module}_{$controller}Controller_{$action}";
    }

    /**
     * Gets Event Object
     * 
     * @return mixed
     */
    protected function _getEventObject()
    {
        $className = $this->_getEventClassName();
        $filePath = $this->_getClassPath($className);
        if (file_exists($filePath)) {
            return new $className($this->_request);
        } else {
            $this->_debug(__METHOD__, "File $filePath does not Exist");
            return null;
        }
    }

    /**
     * Gets name of current module
     * 
     * @return string
     */
    protected function _getModuleName()
    {
        return $this->_request->getModuleName();
    }

    /**
     * Gets name of current controller
     * 
     * @return string
     */
    protected function _getControllerName()
    {
        return $this->_request->getControllerName();
    }

    /**
     * Gets name of current controller action
     * 
     * @return string
     */
    protected function _getActionName()
    {
        return $this->_request->getActionName();
    }

    /**
     * Checks to see if the current environtment is 'sandbox'
     * @return bool true if environment is sandbox, false otherwise
     */
    protected function _isSandbox()
    {
        $env = isset($this->_config->app->env) ? $this->_config->app->env : '';
        return (strtolower($env) == 'sandbox');
    }

    /**
     * Perform a redirect to an action/controller/module with params
     *
     * @param  string $action
     * @param  string $controller
     * @param  string $module
     * @param  array  $params
     * @return void
     */
    protected function _redirect($action, $controller = null, $module = null, array $params = array())
    {
        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
        /* @var $redirector Zend_Controller_Action_Helper_Redirector */
        $redirector->gotoSimple($action, $controller, $module, $params);
    }

    /**
     * Gets event info 
     * 
     * @param string $eventName
     * @return object 
     */
    protected function _getEventInfo($eventName)
    {
        if (!isset($this->_eventsInfo[$eventName])) {

            //  Get Events from Registry
            $evts = Zend_Registry::get('Events');

            //
            $eventInfo = new stdClass();
            if (isset($evts[$eventName]) && is_array($evts[$eventName])) {
                foreach ($evts[$eventName] as $key => $value) {
                    $eventInfo->$key = $value;
                }
            }

            //
            $this->_eventsInfo[$eventName] = $eventInfo;
        }

        return $this->_eventsInfo[$eventName];
    }

    /**
     * Gets request information
     * 
     * @return object {time, uri, params}
     */
    protected function _getRequestInfo()
    {
        $reqInfo = new stdClass();
        $reqInfo->time = time();
        $reqInfo->uri = $_SERVER['REQUEST_URI'];
        $reqInfo->params = $this->_request->getParams();

        return $reqInfo;
    }

    /**
     * Logs a debug message
     * 
     * @param string $method
     * @param string $msg 
     */
    protected function _debug($method, $msg)
    {
        $this->_log->debug("$method(): $msg");
    }

}
