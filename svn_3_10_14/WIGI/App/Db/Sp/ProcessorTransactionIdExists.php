<?php

class App_Db_Sp_ProcessorTransactionIdExists extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi_log', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_processor_transaction_id_exists',
                    'returns_value' => 0,
                    'in' => array(
                         array('input', 'ID')
                    ),
                    'out' => array(
                        '@p_res'
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
