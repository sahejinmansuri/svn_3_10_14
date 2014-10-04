<?php

class App_Event_Event extends Atlasp_App_Event
{

    /**
     * @var array 
     */
    protected $_evt_data = array();

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);
    }

    public function getEvtData()
    {
        return $this->_evt_data;
    }

    public function getInputErrorEvent()
    {
        $d = $this->getEvtData();
        return $d['input_error_event'];
    }

    public function getInputNames()
    {
        $d = $this->getEvtData();
        return $d['inputs'];
    }

    public function validate($evtData = null)
    {
        return parent::validate($this->getInputNames());
    }

}
