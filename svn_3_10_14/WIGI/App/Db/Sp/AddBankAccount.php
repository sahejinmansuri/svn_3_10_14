<?php

class App_Db_Sp_AddBankAccount extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_add_bank_account',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USER_BANK_ACCOUNT_ID'),
			array('session', 'userid'),
						array('input', 'KEY_VERSION'),
						array('input', 'LAST4'),
						array('input', 'DESCRIPTION'),
                        array('input', 'TYPE'),
                        array('input', 'ROUTING'),
                        array('input', 'CONF_AMT'),
                        array('input', 'CONF_AMT2'),
			array('session', 'email'),
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
