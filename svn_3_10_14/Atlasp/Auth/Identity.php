<?php

class Atlasp_Auth_Identity
{
	private $_loginId = null;
	private $_sessionId = null;
	private $_groups = null;
	private $_roles = null;
	private $_perms = null;

	public function __construct($loginId, $sessionId) {
	    $this->_loginId = $loginId;
	    $this->_sessionId = $sessionId;
	    $this->_loadPermissions();
	}
	
	public function getLoginId() {
	    return $this->_loginId;
	}
	
	private function _loadPermissions(){
	}
	
	public function getGroups() {
	    return $this->_groups;
	}
	
	public function getRoles() {
	    return $this->_roles;
	}
	
	public function getPerms() {
	    return $this->_perms;
	}
	
	public function hasGroup($group) {
	    return !empty($this->_groups[$group]);
	}
	
	public function hasRole($role) {
	    return !empty($this->_roles[$role]);
	}
	
	public function hasPerm($perm) {
	    return in_array($perm, $this->_perms);
	}
}
