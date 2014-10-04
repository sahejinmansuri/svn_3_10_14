<?php

abstract class Atlasp_Ws_Abstract
{

    /**
     * @var Atlasp_Config_Ini
     */
    protected $_config;
    /**
     * @var Zend_Session_Namespace 
     */
    protected $_namespace;
    /**
     * @var Zend_Controller_Request_Abstract 
     */
    protected $_request;
    /**
     * @var Zend_Log 
     */
    protected $_log;

    /**
     * Default Constructor
     */
    public function __construct(Zend_Controller_Request_Abstract $request=null)
    {
        $this->_request = $request;
        $this->_config = Zend_Registry::get('config');
        $this->_log = Zend_Registry::get('log');
        $this->_namespace = new Zend_Session_Namespace(Zend_Registry::get('name'));
    }

    /**
     * Sets web service end point 
     * 
     * @param array$reqData
     * @param array $sidef
     * @return string 
     */
    protected function _setEndpoint($reqData, $sidef)
    {
        $ver = isset($reqData['VER']) ? $reqData['VER'] : $sidef['esp_data']['vmap']['default'];
        $ep = $sidef['esp_data']['endpoint'] . "?ver_=$ver&internal=1";
        return $ep;
    }

    /**
     * Creates soap inputs
     * 
     * @param type $soapInputs
     * @param type $requestParams
     * @return type 
     */
    protected function _makeSoapInput($soapInputs, $requestParams)
    {
        $tmp = array();

        foreach ($soapInputs as $k => $v) {
            if (is_array($v)) {
                $tmp[$k] = $this->_makeSoapInput($v, $requestParams);
            } else {
                $tmp[$k] = $this->_getParameterValue($v);
            }
        }

        return $tmp;
    }

    /**
     * Gets parameter value. 
     * Supports: session, identity, config, constant, callback function and input
     * 
     * @param string $pname 
     * @param Zend_Controller_Request_Abstract
     */
    protected function _getParameterValue($pname)
    {
        //
        $ret = null;

        //
        $inSource = explode(':', $pname, 2);
        $isAdvanced = (is_array($inSource) && count($inSource) == 2);
        $source = $isAdvanced ? trim($inSource[0]) : 'input';
        $name = $isAdvanced ? trim($inSource[1]) : $pname;

        //
        switch ($source) {
            case 'sess':
            case 'session':
                $ret = $this->_getComplexObjectValue($this->_namespace, $name);
                break;

            case 'idt':
            case 'identity':
                $ret = $this->_getComplexObjectValue($this->_namespace->identity, $name);
                break;

            case 'cfg':
            case 'config':
                $ret = $this->_getComplexObjectValue($this->_config, $name);
                break;

            case 'c':
            case 'constant':
                $ret = $name;
                break;

            case 'fn':
            case 'function':
                $ret = $this->_getCallbackFunctionValue($name);
                break;

            case 'input':
            //  NOTE:   inputs means that regular request parameter will 
            //          be used. This is why we need to fall into 'default'
            //          case. 
            //          1. break;  is not needed for this case. 
            //          2. must be right above 'default' case
            default:
                $ret = $this->_request->getParam($name);
                break;
        }

        //
        return $ret;
    }

    /**
     * Gets values for the callback function with or without parameters
     * 
     * @param string $function funtion name OR static call
     *                  foo
     *                  Foo::bar 
     *                  foo('REQ_PARAM', 'session: value', 'identity: value')
     *                  Foo::bar('REQ_PARAM', 'session: value', 'identity: value')
     * @return mixed
     */
    protected function _getCallbackFunctionValue($function)
    {
        //  Initialize
        $ret = null;

        //  Check if function is callable the way it is
        if (is_callable($function)) {
            $ret = call_user_func($function);
        } else {
            //  Check if function has parameters
            preg_match('/^(.*?)\((.*)\)/', $function, $match);
            $fname = $match[1];
            //  Scan through all parameters
            foreach (preg_split('/,/', $match[2]) as $param) {
                //  Sanitize
                $param = trim($param);
                //$param = substr($param, 1, strlen($param) - 2);
                //  Get parameter value
                $fparams[] = $this->_getParameterValue($param);
            }

            //  Call user function with parameters
            $ret = call_user_func_array($fname, $fparams);
        }

        //
        return $ret;
    }

    /**
     * Gets comblex object value
     *  
     * @param object $obj
     * @param string $name
     * @return mixed 
     */
    protected function _getComplexObjectValue($obj, $name)
    {
        //  Initialize return value
        $ret = null;

        //  Check if object property is chain accessible with var property name
        if (isset($obj->$name)) {
            $ret = $obj->$name;
        } else {
            //  If object property is not chain accessible                    
            //  Create a cmd and try to get the value of the object directly
            $directVar = "\$obj->$name";
            eval("\$ret = isset($directVar) ? $directVar : null;");
        }

        //
        return $ret;
    }

    /**
     * Dumps XML response to file
     * 
     * @param string $xml 
     */
    protected function _dumpResponseToFile($xml)
    {
        $file = $this->_config->paths->tmp . "so_response.xml";
        file_put_contents($file, $xml);
    }

    /**
     * Gets current request object
     * 
     * @return Zend_Controller_Request_Abstract
     */
    public function getRequest()
    {
        return $this->_request;
    }

}