<?php

class App_Db_Sp_UserIsCreditCardOwner extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_is_credit_card_owner',
                    'returns_value' => 0,
                    'in' => array(
                        array('session', 'userid'),
			array('input', 'USER_CREDIT_CARD_ID'),
						
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
