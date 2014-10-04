<?php

class App_Db_Sp_UserGetIdFromEmailAndParentId extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_get_id_from_email_and_parent_id',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'EMAIL'),
                        array('input', 'PARENTID'),
						
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
