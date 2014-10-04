<?php
class App_Models_Db_Wigi_WigiAdminSettings extends Zend_Db_Table_Abstract
{

    protected $_name = 'wigi_admin_settings';
    protected $_primary = 'wigi_admin_settings_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

