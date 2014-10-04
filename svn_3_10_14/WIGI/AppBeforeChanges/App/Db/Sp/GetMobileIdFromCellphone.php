<?php

class App_Db_Sp_GetMobileIdFromCellphone extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_get_mobile_id_from_cellphone',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'CELLPHONE'),
			array('input','COUNTRY_CODE')				
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
