<?php

class App_Db_Sp_UserCreate extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_create',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'EMAIL'),
						array('input', 'USER_TYPE'),
						array('input', 'PASSWORD'),
						array('input', 'STATUS'),
						array('input', 'FIRST_NAME'),
						array('input', 'LAST_NAME'),
						array('input', 'MIDDLE_INIT'),
                                                array('input', 'COUNTRY_CODE'),
						array('input', 'BIRTHDATE'),
						array('input', 'DATE_ADDED'),
						array('input', 'USER_ADDED'),
						array('input', 'USER_CHANGED'),
					        array('input', 'IP'),
                                                array('input', 'PARENT_USER_ID'),	
                                                array('input', 'CREATED_VIA'),
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
