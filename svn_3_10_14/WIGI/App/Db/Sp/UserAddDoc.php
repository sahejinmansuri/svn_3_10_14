<?php

class App_Db_Sp_UserAddDoc extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_user_add_doc',
                    'returns_value' => 0,
                    'in' => array(
                        array('input', 'KEY_VERSION'),
                        array('input', 'MOBILE_ID'),
                        array('input', 'USERID'),
                        array('input', 'DOC_TYPE'),
						array('input', 'DOC_DESCRIPTION')
                    ),
                ), 
            ),
        );

        parent::__construct($request);
    }
}
