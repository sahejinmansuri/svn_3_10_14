<?php

class App_Db_Sp_PosCreate extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_pos_create',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'COMPANY_ID'),
						array('input', 'OS_ID'),
						array('input', 'NAME'),
						
                    ),
                    'out' => array(
                        
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
