<?php

class App_Db_Sp_BaGet extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi_safe', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_ba_get',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USER_BANK_ACCOUNT_ID'),
						
                    ),
                    'out' => array(
                        '@p_user_id',
			'@p_bank_account',
			'@p_key_version',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
