<?php

class App_Db_Sp_GetLastDayAmt extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi_log', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_get_last_day_amt',
                    'returns_value' => 0,
                    'in' => array(
                        array('session', 'mobileid'),
                        array('input', 'TYPE')	
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
