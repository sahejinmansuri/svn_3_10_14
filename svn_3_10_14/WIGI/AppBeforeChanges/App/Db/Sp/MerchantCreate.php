<?php

class App_Db_Sp_MerchantCreate extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_merchant_create',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'EMAIL'),
						array('input', 'USER_TYPE'),
						array('input', 'PASSWORD'),
						array('input', 'STATUS'),
						array('input', 'FIRST_NAME'),
						array('input', 'LAST_NAME'),
						array('input', 'MIDDLE_INIT'),
						array('input', 'QUESTION'),
						array('input', 'ANSWER'),
                                                array('input', 'COUNTRY_CODE'),
                                                array('input', 'BUSINESS_TYPE'),
                                                array('input', 'BUSINESS_NAME'),
                                                array('input', 'BUSINESS_TAX_ID'),
                                                array('input', 'BUSINESS_PHONE'),
                                                array('input', 'BUSINESS_DBA_NAME'),
                                                array('input', 'BUSINESS_URL'),
						array('input', 'DATE_ADDED'),
						array('input', 'USER_ADDED'),
						array('input', 'USER_CHANGED'),
						array('input', 'CREATED_VIA'),
                                                array('input', '501C'),
                                                array('input', 'STATE_OF_INC'),					        	
                    ),
                    'out' => array(
                        '@p_user_id',
						'@p_email_code',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
