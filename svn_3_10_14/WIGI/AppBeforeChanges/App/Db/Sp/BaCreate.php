<?php

class App_Db_Sp_BaCreate extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi_safe', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_ba_create',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USERID'),
			array('input', 'BANK_ACCOUNT'),
			array('input', 'CONF_NUMBER'),
			array('input', 'KEY_VERSION'),
			array('input', 'USERNAME'),
                    ),
                    'out' => array(
                        '@p_res',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
