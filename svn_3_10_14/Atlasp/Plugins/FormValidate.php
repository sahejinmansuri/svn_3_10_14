<?php
class Atlasp_Plugins_FormValidate extends Zend_Controller_Plugin_Abstract
{
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {   
        $m = __METHOD__ . '(): ';
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        $class = 'App_Event_' . ucfirst($controller) . 'Controller_' . $action; 

        $cfg = Zend_Registry::get('config');
        $file = $cfg->paths->coderoot . str_replace('_', '/', $class) . '.php';

        if (!is_file($file)) {
            Zend_Registry::get('log')->debug($m . "{$controller}/{$action} does not exist.");
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
            $redirector->gotoSimple('index', 'index');
        }

        $evt_class = new $class($request);
        $status = $evt_class->validate();

        if (false === $status) {
            $errors = $evt_class->getErrorMessage();
            $errorEvent = $evt_class->getInputErrorEvent();

            $request->setParam('FORM_ERRORS', $errors);
            $request->setControllerName($errorEvent['CONTROLLER']);
            $request->setActionName($errorEvent['ACTION']);
        }
    }
}
