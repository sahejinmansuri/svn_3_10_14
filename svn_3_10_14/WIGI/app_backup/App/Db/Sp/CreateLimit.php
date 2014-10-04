<?php

class App_Db_Sp_CreateLimit extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_create_limit',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'TYPE'),
						array('input', 'TIME_SPAN'),
						array('input', 'LIMIT'),
						array('input', 'ORDER'),
						array('input', 'OWNER_ID'),
						
                    ),
                    'out' => array(
                        
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
