<?php

class App_Event_Mobws_UserController_addaddress extends App_Event_WsEventAbstract
{

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
		'ADDRESS' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS')),
		'CITY' => array('generic', 50, 0, App_Constants::getFormLabel('CITY')),
		'STATE' => array('generic', 50, 0, App_Constants::getFormLabel('STATE')),
		'ZIP' => array('generic', 50, 0, App_Constants::getFormLabel('ZIP')),
		'COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY')),

            )
        );
    }

}
