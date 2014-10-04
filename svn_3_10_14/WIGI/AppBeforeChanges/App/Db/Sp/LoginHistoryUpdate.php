<?php

class App_Db_Sp_LoginHistoryUpdate extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_login_history_update',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USERID'),
                        array('input', 'APP'),
                        array('input', 'IP'),
                        array('input', 'BROWSER'),
                        array('input', 'CLIENT_TYPE')
	
                    ),
                    'out' => array(
                        
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
