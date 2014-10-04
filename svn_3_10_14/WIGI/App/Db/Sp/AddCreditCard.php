<?php

class App_Db_Sp_AddCreditCard extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_add_credit_card',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USER_CREDIT_CARD_ID'),
			array('session', 'userid'),
			array('input', 'KEY_VERSION'),
			array('input', 'LAST4'),
			array('input', 'DESCRIPTION'),
                        array('input', 'TYPE'),
                        array('input', 'EXPIRE_MONTH'),
                        array('input', 'EXPIRE_YEAR'),
                        array('input', 'NAME_ON_CARD'),
                        array('input', 'CONF_AMT'),
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
