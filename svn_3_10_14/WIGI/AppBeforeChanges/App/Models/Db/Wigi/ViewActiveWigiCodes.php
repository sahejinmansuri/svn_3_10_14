<?php
class App_Models_Db_Wigi_ViewActiveWigiCodes extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_active_wigi_codes';
    protected $_primary = 'wigi_code_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi_log')));
	}
}

