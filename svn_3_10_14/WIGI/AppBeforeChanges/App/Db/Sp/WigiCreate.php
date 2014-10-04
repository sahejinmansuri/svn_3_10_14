<?php

class App_Db_Sp_WigiCreate extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi_log', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_wigi_create',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'MOBILEID'),
			array('input', 'AMOUNT'),
			array('input', 'CODE'),
			array('input', 'EXPIRES')			
                    ),
                    'out' => array(
                        '@p_date_added',
			'@p_date_expires'
						
                    ), 
                ), 
            )
        );

        parent::__construct($request);
    }
}
