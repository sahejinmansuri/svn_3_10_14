<?php

class App_Db_Sp_LogTransaction extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi_log', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_log_transaction',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'TYPE'),
						array('input', 'DIRECTION'),
						array('input', 'AMOUNT'),
						array('input', 'BILLING_AMOUNT'),
                                                array('input', 'BALANCE'),
                                                array('input', 'TEMP_BALANCE'),
						array('input', 'FROM'),
						array('input', 'TO'),
						array('input', 'FROM_DESCRIPTION'),
						array('input', 'TO_DESCRIPTION'),
						array('input', 'DESCRIPTION'),
                                                array('input', 'FROM_USER_ID'),
                                                array('input', 'TO_USER_ID'),
                                                array('input', 'FROM_USER_ID_DESCRIPTION'),
                                                array('input', 'TO_USER_ID_DESCRIPTION'),
                                                array('input', 'IP_ADDRESS'),
                                                array('input', 'GPS'),
                                                array('input', 'SERVER_DATETIME'),
                                                array('input', 'CLIENT_DATETIME'),
                                                array('input', 'APP_NAME'),
                                                array('input', 'APP_VERSION'),
                                                array('input', 'DEVICE_MODEL'),
                                                array('input', 'SYSTEM_NAME'),
                                                array('input', 'SYSTEM_VERSION'),
                                                array('input', 'OS'),
                                                array('input', 'BROWSER_STRING'),
                                                array('input', 'LANGUAGE'),
                                                array('input', 'OS_ID'),
                                                array('input', 'PROCESSOR_TRANSACTION_ID'),
                                                array('input', 'USER_DESCRIPTION'),
                                                array('input', 'TAX'),                                                
                                                array('input', 'TIP'),
                                                array('input', 'RAW_AMOUNT'),
                                                array('input', 'POS_NAME'),
						array('input', 'WIGI_CODE_ID'),
						array('input', 'ORDER_ID'),
                    ),
                    'out' => array(
                      '@res',  
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
