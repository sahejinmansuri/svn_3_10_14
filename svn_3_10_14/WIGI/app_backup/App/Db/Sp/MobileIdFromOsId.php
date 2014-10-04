<?php

class App_Db_Sp_MobileIdFromOsId extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_mobile_id_from_os_id',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'OS_ID'),
						
                    ),
                    'out' => array(
                        '@p_mobile_id',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
