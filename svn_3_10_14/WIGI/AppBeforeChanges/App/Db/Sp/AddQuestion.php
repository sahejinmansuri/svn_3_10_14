<?php

class App_Db_Sp_AddQuestion extends Atlasp_App_StoredProcedure
{
    public function __construct(Zend_Controller_Request_Http $request = null)
    {
        $this->_evt_data = array(
            'db_handle' => 'wigi', 
            'db_type' => 'pdo_mysql',
            'stored_procs'=> array(
                array(
                    'name' => 'sp_add_question',
                    'returns_value' => 0,
                    'in' => array(
			array('input', 'QUESTION'),
			array('input', 'ANSWER'),
			array('input', 'MOBILEID'),
                        array('input', 'USERID'),
                    ),
                    'out' => array(
						
                    ), 
                ), 
            ),
        );

        parent::__construct($request);
    }
}
