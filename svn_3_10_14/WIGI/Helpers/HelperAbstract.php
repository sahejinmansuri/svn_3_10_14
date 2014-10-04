<?php

abstract class Helpers_HelperAbstract extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * @var Zend_Session_Namespace 
     */
    protected $_session;
    /**
     * @var Zend_Log 
     */
    protected $_log;
    /**
     * @var Zend_Config_Ini 
     */
    protected $_cfg;

    /**
     * Default Constructor
     */
    public function __construct()
    {
        $appName = Zend_Registry::get('name');
        $this->_session = new Zend_Session_Namespace($appName);
        $this->_log = Zend_Registry::get('log');
        $this->_cfg = Zend_Registry::get('config');
    }

}