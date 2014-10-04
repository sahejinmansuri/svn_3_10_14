<?php

class Atlasp_Auth extends Zend_Auth 
{
    protected static $_instance = null;

    public static function getInstance()
    {
        if (self::$_instance == null) 
            self::$_instance = new self();
        return self::$_instance;
    }

    public function getStorage()
    {    	
    	$sessionId = Zend_Session::getId();    	
        if (empty($sessionId) && !empty($_COOKIE[Zend_Registry::get('config')->session->cookie])) {        	
        	Zend_Session::setId($_COOKIE[Zend_Registry::get('config')->session->cookie]);
        }
        return parent::getStorage();
    }
    
    public function clearIdentity()
    {
        parent::clearIdentity();
	$sessionId = Zend_Session::getId();
	Zend_Session::destroy();
    }
    
    public function hasIdentity()
    {
        // first check to see if they have an identity.
        if (!parent::hasIdentity()) {
            return false;
        }
        return true;                    
    }
    
    public function authenticate(Zend_Auth_Adapter_Interface $adapter)
    {    	
        $result = $adapter->authenticate();
        if ($result->isValid()) {
       	    #Zend_Session::setId($adapter->getSessionId());
            #$this->getStorage()->write( new Atlasp_Auth_Identity($adapter->getIdentity(), $adapter->getSessionId()));
	    #var_dump($result);
        }
        return $result;
    }	
}
