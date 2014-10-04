<?php

class App_Db_Sp_UserAddMobile extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_add_mobile',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'USERID'),
						array('input', 'MOBILE_TYPE'),
						array('input', 'CELLPHONE'),
						array('input', 'PIN'),
						array('input', 'DATE_ADDED'),
						array('input', 'USER_ADDED'),
						array('input', 'DATE_CHANGED'),
						array('input', 'USER_CHANGED'),
                                                array('input', 'ALIAS'),
                                                array('input', 'LAST_NAME'),
                                                array('input', 'IP')						
                    ),
                    'out' => array(
                        '@p_id',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
