<?php

class App_Event_Mobws_WigiController_createtransaction extends App_Event_WsEventAbstract
{

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
		'AMOUNT' => array('generic', 50, 0, App_Constants::getFormLabel('AMOUNT')),

            )
        );
    }

}
