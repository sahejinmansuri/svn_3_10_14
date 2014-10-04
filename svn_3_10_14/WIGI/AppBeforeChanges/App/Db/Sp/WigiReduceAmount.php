<?php

class App_Db_Sp_WigiReduceAmount extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi_log', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_wigi_reduce_amount',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'CODE'),
			array('input','MOBILEID'),
			array('input', 'AMOUNT'),
						
                    ),
                    'out' => array(
                        
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
