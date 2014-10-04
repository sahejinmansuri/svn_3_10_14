<?php

class App_Db_Sp_SendMessage extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_send_message',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'MESSAGE_ID'),
			array('input', 'MOBILE_ID'),		
                    ),
                    'out' => array(
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
