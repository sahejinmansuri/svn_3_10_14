<?php

class App_Db_Sp_Auth1 extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_auth1',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USERID'),
			array('input', 'PASSWORD'),
						
                    ),
                    'out' => array(
                        '@p_code',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
