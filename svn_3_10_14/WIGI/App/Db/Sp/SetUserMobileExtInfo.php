<?php

class App_Db_Sp_SetUserMobileExtInfo extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_set_user_mobile_ext_info',
                    'returns_value' => 0,
                    'in' => array(
				array('input','MOBILEID'),
				array('input','PHONE_BRAND'),
				array('input','LAST_IP'),
                                array('input','OSID'),
				array('input','OS_VERSION'),
				array('input','APP_VERSION') 
                     ),
                    'out' => array(
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
