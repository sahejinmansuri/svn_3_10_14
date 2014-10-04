<?php

class App_Event_Mobws_RegistrationController_getquestionfrompin extends App_Event_WsEventAbstract
{

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
		'CELLPHONE' => array('generic', 50, 0, App_Constants::getFormLabel('CELLPHONE')),
		'COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY')),
		'PIN' => array('generic', 50, 0, App_Constants::getFormLabel('PIN')),

            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }

}
