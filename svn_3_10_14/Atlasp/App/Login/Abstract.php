<?php
abstract class Atlasp_App_Login_Abstract
{
    protected $_storedProcedure = null;
    protected $_username;
    protected $_password;
    protected $_auth;
    protected $_adapter;

    public function __construct($credentials, $storedProcedure = null)
    {
        $this->_storedProcedure = $storedProcedure;
        $this->_auth = Atlasp_Auth::getInstance();
        $this->_username = $credentials['USERNAME'];
        $this->_password = $credentials['PASSWORD'];

        $this->_setupAdapter();
    }

    public function authenticate()
    {
        return $this->_auth->authenticate($this->_adapter);
    }

    protected abstract function _setupAdapter();
}
