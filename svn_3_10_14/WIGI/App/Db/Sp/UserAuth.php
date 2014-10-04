<?php

class App_Db_Sp_UserAuth extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_auth',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USERID'),
						array('input', 'PASSWORD'),
						
                    ),
                    'out' => array(
                        '@p_result',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
