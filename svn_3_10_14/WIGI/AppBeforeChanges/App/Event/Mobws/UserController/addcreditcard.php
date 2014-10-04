<?php

class App_Event_Mobws_UserController_addcreditcard extends App_Event_WsEventAbstract
{

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
		'NAME' => array('generic', 50, 0, App_Constants::getFormLabel('NAME')),
		'TYPE' => array('generic', 50, 0, App_Constants::getFormLabel('TYPE')),
		'CREDITCARD' => array('generic', 50, 0, App_Constants::getFormLabel('CREDITCARD')),
		'EXPIRATION' => array('generic', 50, 0, App_Constants::getFormLabel('EXPIRATION')),
		'CVV2' => array('generic', 50, 0, App_Constants::getFormLabel('CVV2')),
		'DESCRIPTION' => array('generic', 50, 0, App_Constants::getFormLabel('DESCRIPTION')),
		'NAME_ON_CARD' => array('generic', 50, 0, App_Constants::getFormLabel('NAME_ON_CARD')),

            )
        );
    }

}
