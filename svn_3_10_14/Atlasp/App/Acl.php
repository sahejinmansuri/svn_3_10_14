<?php
class Atlasp_App_Acl extends Zend_Acl
{
    protected $_roles     = array();
    protected $_resources = array();
    protected $_aclRules  = array();

    public function __construct()
    {
        $this->_addRoles();
        $this->_addResources();
        $this->_addRules();
    }

    protected function _addRoles()
    {
        foreach ($this->_roles as $role => $inheritedRole) {
            if (empty($inheritedRole)) {
                $this->addRole(new Zend_Acl_Role($role));
            } else {
                $this->addRole(new Zend_Acl_Role($role), $inheritedRole);
            }
        }
    }

    protected function _addResources()
    {
        foreach ($this->_resources as $resource => $inheritedResource) {
            if (empty($inheritedResource)) {
                $this->add(new Zend_Acl_Resource($resource));
            } else {
                $this->add(new Zend_Acl_Resource($resource), $inheritedResource);
            }
        }
    }

    protected function _addRules()
    {
        foreach ($this->_aclRules as $role => $rules) {
            $allowed = array();
            $denied = array();

            if (isset($rules['allow'])) {
                $allowed = $rules['allow'];
            }
           
            if (isset($rules['deny'])) {
                $denied = $rules['deny'];
            }

            foreach ($allowed as $controller => $actions) {
                $this->allow($role, $controller, $actions);
            }

            foreach ($denied as $controller => $actions) {
                $this->deny($role, $controller, $actions);
            }
        }
    }
}
