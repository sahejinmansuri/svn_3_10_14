<?php
class Atlasp_App_Event
{
    const PATTERN_NAME = 0;
    const SIZE         = 1;
    const REQUIRED     = 2;
    const FORM_LABEL   = 3;
    
    protected $_errorMessages = array();
    protected $_request;

    public function __construct(Zend_Controller_Request_Abstract $request)
    {
        $this->_request = $request;
    }
   
    public function getErrorMessages()     
    {
        return $this->_errorMessages;
    }
        
    public function getErrorMessage()
    {
        $errorMessage = '';

        if (!empty($this->_errorMessages)) {
            $errorMessage  = '<h3>Input Validation Errors</h3><ul>';
            $errorMessage .= implode("", $this->_errorMessages);
            $errorMessage .= '</ul>';
        }

        return $errorMessage;
    }

    protected function _setErrorMessage($status, $postParam, $formLabel=null)
    {
        if (!$formLabel){
            $formLabel = Atlasp_App_Constants::getFormLabel($postParam);
        }

        switch ($status)
        {
            case Atlasp_App_Patterns::REQUIRED_FIELD:
                $this->_errorMessages[] = "<li>{$formLabel} is a required field.</li>";
                break;
            case Atlasp_App_Patterns::SIZE_TOO_LONG:
                $this->_errorMessages[] = "<li>{$formLabel} exceeds maximum length.</li>";
                break;
            case Atlasp_App_Patterns::INVALID_FORMAT:
                $this->_errorMessages[] = "<li>{$formLabel} is invalid.</li>";
                break;
            default:
                $this->_errorMessages[] = "<li>Unknown error for {$formLabel}</li>";
                break;
        }

  
        return $this;
    }
    
    public function validate($formInputs)
    {
        
        if ($formInputs === 0) {
            return true;
        } elseif (empty($formInputs)) {
            return true;
            //trigger_error('No form inputs to validate.', E_USER_ERROR);
        }

        $validator = new Atlasp_App_Patterns($this->_request);
        
        foreach ($formInputs as $postParam => $metaData)
        {
            $patternName = null;
            $size        = null;
            $required    = 0;
            
            if (isset($metaData[self::PATTERN_NAME])) {
                $patternName = $metaData[self::PATTERN_NAME];
            } else {
                $patternName = Atlasp_App_Constants::getDefaultPattern($postParam);
            }
            
            if ($patternName === null) {
                trigger_error('No pattern name specified.', E_USER_ERROR);
            }
 
            if (isset($metaData[self::SIZE])) {
                $size = $metaData[self::SIZE];
            }
            
            if (isset($metaData[self::REQUIRED])) {
                $required = $metaData[self::REQUIRED];
            }
            
            $status = $validator->validate($postParam, 
                                           $patternName, 
                                           $required, 
                                           $size);

            if ($status != Atlasp_App_Patterns::SUCCESS && $status != Atlasp_App_Patterns::NO_VALIDATION) {
                $formLabel = isset($metaData[self::FORM_LABEL]) ? $metaData[self::FORM_LABEL] : null;
                $this->_setErrorMessage($status, $postParam, $formLabel);
            }
        }

        $status = false;
       
        if (empty($this->_errorMessages)) {
            $status = true;
        }

        return $status;
    }

    public function saveSearchTerms($req){
	$inArr ;
	$inPresent=0;
	$inputs = $this->getInputNames();
	foreach($inputs as $k => $v){
	    if($req->getParam($k) != ''){
		$inArr[$k]=$req->getParam($k);
		$inPresent=1;
	    }
	}
	if($inPresent ==1){
	    $sess = new Zend_Session_Namespace( strtolower( Zend_Registry::get('name')) );
	    $sess->lastSearch = $inArr;
	}

    }

}
