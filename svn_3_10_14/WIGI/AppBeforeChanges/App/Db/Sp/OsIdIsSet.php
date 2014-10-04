<?php

class App_Db_Sp_OsIdIsSet extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_os_id_is_set',
                    'returns_value' => 0,
                    'in' => array(
                        array('session', 'mobileid'),
						
                    ),
                    'out' => array(
                        '@res',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
