<?php

class App_Db_Sp_GetUserIdFromMobileId extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_get_user_id_from_mobile_id',
                    'returns_value' => 0,
                    'in' => array(
                        array('session', 'mobileid'),
						
                    ),
                    'out' => array(
                        '@p_user_id',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
