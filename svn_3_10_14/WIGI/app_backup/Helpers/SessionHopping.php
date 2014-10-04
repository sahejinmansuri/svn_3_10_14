<?php

require_once 'HelperAbstract.php';

class Helpers_SessionHopping extends Helpers_HelperAbstract
{

    /**
     * Sets device identifier in session
     */
    public function setDeviceIdentifier()
    {
        //
        $identifier = $this->_getIdentifierFromRequest();
        $this->_setIdentifier($identifier);

        //
        $this->_log->debug(__METHOD__ . "() Device Identifier is set to $identifier");
    }

    /**
     * Checks to see if the identifier in the request matches the 
     * identifier in the session
     * 
     * @return bool
     */
    public function isCorrectIdentifier()
    {
        return ($this->_getIdentifierFromRequest() == $this->_getIdentifierFromSession());
    }

    /**
     * Sends notification to errto email specified in cfg with details about 
     * invalid identifier
     */
    public function sendInvalidIdentifierNotification()
    {
        $app = Zend_Registry::get('name') . ' [BPS]';
        $subject = "$app:Invalid Device Identifier";
        $message = "$app Identifiers did not match";
        $code = App_Ws_Types_Response::ERRNO_INVALID_DEVICE_IDENTIFIER;

        //  Get detailed message
        $message .= PHP_EOL . PHP_EOL . $this->_getInvalidIdentifierDetailedMessage();

        //  Create exception
        $ex = new Atlasp_Exception($message, $code, null);
        $ex->notify($subject, $message);
    }

    /**
     * Set identifier in session
     * 
     * @param string $identifier 
     */
    protected function _setIdentifier($identifier)
    {
        $this->_session->identifier = $identifier;
    }

    /**
     * Get identifier from request
     * 
     * @return string
     */
    protected function _getIdentifierFromRequest()
    {
        return (string) $this->getRequest()->getParam('IDENTIFIER');
    }

    /**
     * Get identifier from session
     * 
     * @return string
     */
    protected function _getIdentifierFromSession()
    {
        return $this->_session->identifier;
    }

    /**
     * Gets detailed error message for invalid identifier situation
     * 
     * @return string
     */
    protected function _getInvalidIdentifierDetailedMessage()
    {
        // Init vars
        $request = $this->getRequest();
        /* @var $request Zend_Controller_Request_Http */
        $identity = $this->_session->identity;
        /* @var $identity Atlasp_App_Login_Identity */

        //  Create detailed error message
        $message = array();
        //
        $message[] = '[Identifiers]';
        $message[] = 'Session Identifier: ' . $this->_getIdentifierFromSession();
        $message[] = 'Request Identifier: ' . $this->_getIdentifierFromRequest();
        $message[] = '';
        //
        $message[] = '[User Info]';
        $message[] = 'IP Address: ' . $request->getClientIp();
        $message[] = 'User Agent: ' . $request->getServer('HTTP_USER_AGENT');
        $message[] = 'Login Id  : ' . $identity->loginid;
        $message[] = 'User Id   : ' . $identity->userid;
        $message[] = 'Company Id: ' . $identity->companyid;
        $message[] = '';
        //
        $message[] = '[Request]';
        $message[] = 'Request URI : ' . $request->getRequestUri();
        $message[] = 'Request Type: ' . ($request->isPost() ? 'POST' : 'GET');
        $message[] = 'Request Params:';
        $message[] = print_r($request->getParams(), true);

        //
        return implode(PHP_EOL, $message);
    }

}
