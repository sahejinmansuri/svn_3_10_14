<?php

class App_Db_Sp_UserCellphoneRemove extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_cellphone_remove',
                    'returns_value' => 0,
                    'in' => array(
                        array('session', 'userid'),
			array('input', 'MOBILEID'),
						
                    ),
                    'out' => array(
                        
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
