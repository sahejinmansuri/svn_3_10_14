<?php

abstract class Atlasp_Db_Table_Abstract extends Zend_Db_Table_Abstract
{

    /**
     * @var Zend_Log
     */
    protected $_log;
    /**
     * @var Zend_Session_Namespace 
     */
    protected $_session;
    /**
     * @var Zend_Config_Ini
     */
    protected $_config;


    public function __construct($config = array())
    {
        parent::__construct($config);

        //
        $this->_log = Zend_Registry::get('log');
        $this->_session = new Zend_Session_Namespace(Zend_Registry::get('name'));
        $this->_cfg = Zend_Registry::get('config');
    }

}