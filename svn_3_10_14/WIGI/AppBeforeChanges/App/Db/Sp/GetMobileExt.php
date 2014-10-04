<?php

class App_Db_Sp_GetMobileExt extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_get_mobile_ext',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'KEY'),
			array('input', 'CATEGORY'),
			array('session', 'mobileid'),
						
                    ),
                    'out' => array(
                        '@p_val',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
