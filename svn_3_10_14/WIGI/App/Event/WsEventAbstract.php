<?php

class App_Event_WsEventAbstract extends App_Event_Event
{

    /**
     * Gets env data  with required inputs including required inputs 
     * for all requests
     * 
     * @return array
     */
    public function getEvtData()
    {
        //  Define inputs that are required for all requests
        $requiredInputs = array(
            'KEY' => array('char_digit', 32, 1, App_Constants::getFormLabel('SESSION_ID')),
            'IDENTIFIER' => array('device_id', 100, 1, App_Constants::getFormLabel('DEVICE_ID')),
        );
        
        //  Make sure input array is set
        if (!isset($this->_evt_data['inputs']) || !is_array($this->_evt_data['inputs'])) {
            $this->_evt_data['inputs'] = array();
        }

        //  Add required inputs to list of existing inputs
        $this->_evt_data['inputs'] = array_merge($this->_evt_data['inputs'], $requiredInputs);

        //
        return parent::getEvtData();
    }

    /**
     * @param array $errors Array with list of occured validation errors
     * @return App_Ws_Types_Response 
     */
    public function validationFailedEventHandler($errors=array())
    {
        //  Create Error Response
        $response = new App_Ws_Types_Response();
        $response->setError(App_Ws_Types_Response::ERRNO_INVALID_PARAMS, null, $errors);

        //  Send Response
        $response->respondAndExit();
    }

    /**
     * Sets Error Message
     * 
     * @param int $status
     * @param string $postParam
     * @return App_Event_Bps_EventAbstract 
     */
    protected function _setErrorMessage($status, $postParam, $formLabel=null)
    {
        //  Get Label
        if (!$formLabel) {
            $formLabel = App_Constants::getFormLabel($postParam);
        }

        switch ($status) {
            case Atlasp_App_Patterns::REQUIRED_FIELD:
                $this->_errorMessages[] = "$formLabel is a required";
                break;
            case Atlasp_App_Patterns::SIZE_TOO_LONG:
                $this->_errorMessages[] = "$formLabel exceeds maximum length";
                break;
            case Atlasp_App_Patterns::INVALID_FORMAT:
                $this->_errorMessages[] = "$formLabel has invalid format";
                break;
            default:
                $this->_errorMessages[] = "Unknown error for $formLabel";
                break;
        }

        return $this;
    }

}
