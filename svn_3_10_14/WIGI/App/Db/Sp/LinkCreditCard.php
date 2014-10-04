<?php

class App_Db_Sp_LinkCreditCard extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_link_credit_card',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'MOBILEID'),
			array('input', 'USER_CREDIT_CARD_ID'),
						
                    ),
                    'out' => array(
                        
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
