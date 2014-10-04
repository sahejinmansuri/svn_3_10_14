<?php

class App_Db_Sp_BankAccountIsLinked extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_bank_account_is_linked',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'MOBILEID'),
			array('input', 'USER_BANK_ACCOUNT_ID'),
						
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
