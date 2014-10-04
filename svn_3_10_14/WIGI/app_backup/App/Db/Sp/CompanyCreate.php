<?php

class App_Db_Sp_CompanyCreate extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_company_create',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'COMPANY_TYPE'),
						array('input', 'COMPANY_SUB_TYPE'),
						array('input', 'NAME'),
						array('input', 'EMAIL'),
						array('input', 'PASSWORD'),
						array('input', 'CONFIRMATION_CODE'),
						
                    ),
                    'out' => array(
                        
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
