<?php

class App_Db_Sp_UserAddAddress extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    { 
    	
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_add_address',
                    'returns_value' => 0,
                    'in' => array(
                  array('input', 'USERID'),
						array('input', 'ADDRESS_TYPE'),
						array('input', 'ADDR_LINE1'),
						array('input', 'ADDR_LINE2'),
						array('input', 'ADDR_LINE3'),
						array('input', 'ADDR_LINE4'),
						array('input', 'CITY'),
						array('input', 'STATE'),
						array('input', 'ZIP'),
						array('input', 'COUNTRY_CODE'),
						array('input', 'DATE_ADDED'),
						array('input', 'USER_ADDED'),
						array('input', 'DATE_CHANGED'),
						array('input', 'USER_CHANGED'),
						array('input', 'COUNTRY'),
						array('input', 'PT_COUNTRY'),
						array('input', 'PT_ADDRESS'),
						array('input', 'PT_CITY'),
						array('input', 'PT_STATE'),
						array('input', 'PT_ZIP'),
						array('input', 'LANDLINE_HOME1'),
						array('input', 'LANDLINE_HOME2'),
						array('input', 'EMAIL_ADDRESS'),
						array('input', 'ADDRESS_PROOF'),
						array('input', 'SIGNATURE'),
						array('input', 'APP_SUITE'),
						array('input', 'PT_APP_SUITE'),
						array('input', 'PT_ADDRESS2'),
						array('input', 'PT_LANDLINE_HOME1'),
						array('input', 'PT_LANDLINE_HOME2')
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
