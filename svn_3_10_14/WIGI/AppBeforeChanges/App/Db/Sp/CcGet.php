<?php

class App_Db_Sp_CcGet extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi_safe', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_cc_get',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USER_CREDIT_CARD_ID'),
						
                    ),
                    'out' => array(
                        '@p_user_id',
			'@p_credit_card',
			'@p_key_version',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
