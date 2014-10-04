<?php

class App_Db_Sp_MobileOsIdIsAuthorized extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_mobile_os_id_is_authorized',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'MOBILEID'),
						array('input', 'OS_ID'),
						
                    ),
                    'out' => array(
                        '@p_result',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
