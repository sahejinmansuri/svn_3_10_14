<?php

class App_Db_Sp_ZipGet extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_zip_get',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'ZIP'),
						
                    ),
                    'out' => array(
                        '@p_city',
						'@p_state',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
