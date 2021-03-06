<?php

class App_Db_Sp_UserAddAddress2 extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
    	
    
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_add_address2',
                    'returns_value' => 0,
                    'in' => array(
                  array('input', 'USERID'),
						array('input', 'DATE_OF_INCORPORATION'),
						array('input', 'PLACE_OF_INCORPORATION'),
						array('input', 'VATTIN'),
						array('input', 'CSTTIN'),
						array('input', 'SERVICE_TAX'),
						array('input', 'LEGAL_NAME'),
						array('input', 'DOING_BUSINESS'),
						array('input', 'INVOLVED_PROVIDING'),
						array('input', 'FOREIGN_EXCHANGE'),
						array('input', 'GAMING'),
						array('input', 'MONEY_LENDING')
                    ),
                    'out' => array(
                        '@p_address_id'
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
