<?php

class App_Db_Sp_CompanyConfirm extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_company_confirm',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'COMPANY_ID'),
						array('input', 'CONFIRMATION_CODE'),
						
                    ),
                    'out' => array(
                        '@p_res',
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
