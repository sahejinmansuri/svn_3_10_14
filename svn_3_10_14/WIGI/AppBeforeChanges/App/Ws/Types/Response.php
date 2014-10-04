<?php

class App_Ws_Types_Response
{
    const ERRNO_LOGIN_REQUIRED = 1;
    const ERRNO_LOGIN_FAILED = 2;
    const ERRNO_INTERNAL = 3;
    const ERRNO_NO_RESPONSE = 4;
    const ERRNO_NOT_ALLOWED = 5;
    const ERRNO_INVALID_SECTION = 6;
    const ERRNO_INVALID_PARAMS = 7;
    const ERRNO_INVALID_APP_TYPE = 8;
    const ERRNO_INVALID_GLB_OR_DPPA = 9;
    const ERRNO_NO_MOBILE_ACCESS = 10;
    const ERRNO_REQUIRE_PASSWORD_CHANGE = 11;
    const ERRNO_INVALID_DEVICE_IDENTIFIER = 12;
    const ERRNO_INVALID_REQUEST = 13;
    const ERRNO_SITE_DISABLED = 14;

    //  NOTE: When adding new error message make sure to add error definition 
    //        in class constructor

    /**
     * Error Definitions
     * @var array
     */
    protected $_errorDefinitions = array();
    /**
     * Response Array
     * @var array
     */
    protected $_resp = array();

    /**
     * 
     */
    public function __construct()
    {
        $this->_resp['count'] = 0;

        //  Error Definitions
        $this->_errorDefinitions = array(
            self::ERRNO_LOGIN_REQUIRED => 'Session has expired',
            self::ERRNO_LOGIN_FAILED => 'Login Failed',
            self::ERRNO_INTERNAL => 'Internal Error',
            self::ERRNO_NO_RESPONSE => 'No Response',
            self::ERRNO_NOT_ALLOWED => 'Not Allowed',
            self::ERRNO_INVALID_SECTION => 'Invalid Section Name',
            self::ERRNO_INVALID_PARAMS => 'Invalid Request Parameters',
            self::ERRNO_INVALID_APP_TYPE => 'Invalid Application Type',
            self::ERRNO_INVALID_GLB_OR_DPPA => 'Invalid GLB or DPPA',
            self::ERRNO_NO_MOBILE_ACCESS => 'No mobile access enabled',
            self::ERRNO_REQUIRE_PASSWORD_CHANGE => 'Require Password Change, please login online and change your password before you access Accurint Mobile',
            self::ERRNO_INVALID_DEVICE_IDENTIFIER => 'Invalid Device Identifier',
            self::ERRNO_INVALID_REQUEST => 'Invalid Request',
            self::ERRNO_SITE_DISABLED => 'The Mobile App is unavailable at this time, please try again later.',
        );
    }

    /**
     * Sets the error message
     * 
     * @param int $code
     * @param string $msg 
     * @param array $details
     */
    public function setError($code, $msg=null, array $details=array())
    {
	$this->_resp['result']['status'] = 'failure';
	$this->_resp['result']['value']  = '';
	$this->_resp['result']['data']   = '';

        $this->_resp['error']['errno'] = $code;
        $this->_resp['error']['message'] = ($msg) ? $msg : $this->_getErrorMessage($code);
        $this->_resp['error']['error_details'] = $details;
        //$this->_resp['error']['count'] = 0;
        //$this->_resp['error']['result'] = array();
    }

    /**
     * Sets the results
     * 
     * @param array $result 
     */
    public function setResult(array $result)
    {
        $this->_unsetErrors();
        $this->_resp['result'] = $result;
    }

    /**
     * Sets sections
     * 
     * @param array $sections 
     */
    public function setSections(array $sections)
    {
        $this->_unsetErrors();
        $this->_resp['sections'] = $sections;
    }

    /**
     * Sets count
     * 
     * @param int $count 
     */
    public function setCount($count)
    {
        $this->_resp['count'] = $count;
    }

    /**
     *
     * @return array 
     */
    public function toArray()
    {
        return $this->_resp;
    }

    /**
     *
     * @return string JSON encoded object 
     */
    public function toJson()
    {
        return Zend_Json::encode($this->toArray());
    }

    /**
     * 
     */
    public function respondAndExit()
    {
        header("Content-Type: application/json");
        echo $this->toJson();
        exit;
    }

    /**
     * Unsets all error messages in the response
     */
    protected function _unsetErrors()
    {
        unset($this->_resp['errno']);
        unset($this->_resp['error']);
    }

    /**
     * Gets error message description for given code
     * 
     * @param int $code
     * @return string
     */
    protected function _getErrorMessage($code)
    {
        if (isset($this->_errorDefinitions[$code])) {
            return $this->_errorDefinitions[$code];
        } else {
            return 'Unknown Error';
        }
    }

}
