<?php

class App_Db_Sp_UserLog extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_log',
                    'returns_value' => 0,
                    'in' => array(
				array('input','TYPE'),
				array('input','REF_ID'),
				array('input','TABLE'),
                                array('input','DESCRIPTION'),
				array('input','IP_ADDRESS'),
				array('input','GPS'),
				array('input','DEVICE_DATETIME'),
				array('input','SERVER_DATETIME'),
				array('input','APP_NAME'),
				array('input','APP_VERSION'),
				array('input','OS_VERSION'),
				array('input','DEVICE_MODEL'),
				array('input','BROWSER_STRING'),
				array('input','OS_ID'),
				array('input','CELLPHONE'),
				array('input','EMAIL'),
				array('input','LANGUAGE') 
                     ),
                    'out' => array(
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
