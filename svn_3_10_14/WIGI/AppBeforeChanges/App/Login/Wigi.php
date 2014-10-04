<?php

class App_Login_Wigi extends Atlasp_App_Login_MySql {
    protected $_log;
    protected $_identity;

    public function __construct($tname = null) {
        parent::__construct($tname);
        $this->_log = Zend_Registry::get('log');
    }
    
    public function getIdentity(){
        return $this->_identity;
    }

    public function setIdentity($idm){
        $this->_identity = $idm;    
    }
    public function addToIdentity($k, $v){
        $this->_identity[$k] = $v;    
    }


    public function updateWrongPasswordCount(){}
    public function resetWrongPasswordCount(){}
    
    public function updateLastLoginDate($u){
        $data = array('last_login_date' => new Zend_Db_Expr('NOW()'),
                      'last_login_ip'   => $_SERVER['REMOTE_ADDR']  
                     );   
        $where = $u->getAdapter()->quoteInto('user_id = ?', $u->getUid());
        $b = Atlasp_Utils::inst()->startTimer();
        $u->update($data,$where);
        Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
                array('mUpdtLstLogin'=> Atlasp_Utils::inst()->endTimer($b))));
    }
    
    public function expireTempPassword(){}


    public function recordLoginHistory($loginid, $status=0, $override=array()) {
    }

    public function checkCompanyType() {
    }


    public function getPermissionHandler($cid=0, $uid=0) {
    }

    public function isAllowed($CONST) {
    }

    public function getUserPreferences($companyId=0, $loginId=null) {

    }

    public function isLogged() {
        if (!parent::isLogged()) {
            return false;
        }
        if ($this->namespace->logged_in != 1) {
            return false;
        }
        $timeToExpire = 60 * 60; // one hour

        $expiration = $this->namespace->timestamp + $timeToExpire;
        if ($expiration < time()) {
            Zend_Registry::get('log')->debug($m . ' session expired.');
            return false;
        }
        $this->namespace->timestamp = time();
        return true;
    }

}
