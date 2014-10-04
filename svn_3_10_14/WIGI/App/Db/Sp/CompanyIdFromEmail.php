<?php

class App_Db_Sp_CompanyIdFromEmail extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_company_id_from_email',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'EMAIL'),
						
                    ),
                    'out' => array(
                        '@p_company_id',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
