<?php

/**
 * Module Parameter Validator
 *
 */
class Atlasp_Plugins_ModuleParamValidator extends Atlasp_Plugins_PluginAbstract
{

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        //  Make sure plug-in fires only if module is requested
        if ($request->getModuleName()) {
            //  Validate Module Inputs
            $this->_validateModuleInputs();
        }
    }

    /**
     * Validates module input parameters
     */
    protected function _validateModuleInputs()
    {
        //  Get Event Validator
        $eventValidator = $event = $this->_getEventObject();
        if ($eventValidator) {
            //  Validate the input parameters
            // $isValid = $eventValidator->validate();
            $isValid = true;
            //  Log Validation Status
            $status = $isValid ? 'Successful': 'Failed';
            $this->_log->debug(__METHOD__ . "() Input Validation - $status");

            //  Check status
            if ($isValid === false) {
                $failedEventHandler = 'validationFailedEventHandler';
                //  Check to see if failed event handler is defined
                if (is_callable(array($eventValidator, $failedEventHandler))) {
                    $errors = $eventValidator->getErrorMessages();
                    //  Call custom failed event handler
                    call_user_func(array($eventValidator, $failedEventHandler), $errors);
                } else {
                    //  Perform default failed event handling
                    $errors = $eventValidator->getErrorMessage();
                    $errorEvent = $eventValidator->getInputErrorEvent();

                    //
                    $this->_request->setParam('FORM_ERRORS', $errors);
                    $this->_request->setControllerName($errorEvent['CONTROLLER']);
                    $this->_request->setActionName($errorEvent['ACTION']);
                }
            }
        }
    }

}
