<?php
class Atlasp_Plugins_Acl extends Zend_Controller_Plugin_Abstract
{
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $acl = Zend_Registry::get('acl');
        $role = $this->_getRole();

        $resource = strtolower($request->getControllerName());
        $action = strtolower($request->getActionName());
        
        if (!$acl->isAllowed($role, $resource, $action)) {
            error_log("{$role} is not allowed to access {$resource}/{$action}");
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector'); 
            $redirector->gotoSimple('index', 'index');
        }
    }

    protected function _getRole()
    {
        $role = 'guest';

        $appName = strtolower(Zend_Registry::get('name')); 
        $ns = new Zend_Session_Namespace($appName); 

        if (isset($ns->logged_in) && ($ns->logged_in === 1)) {
            $role = 'member';
            $idt = $ns->identity;

            if (isset($idt->sysadmin) && ($idt->sysadmin == '1')) {
                $role = 'admin';
            }
        } 

        return $role;
    }
}
