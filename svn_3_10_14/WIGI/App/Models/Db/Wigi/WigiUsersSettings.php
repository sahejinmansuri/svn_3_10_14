<?php
class App_Models_Db_Wigi_WigiUsersSettings extends Zend_Db_Table_Abstract
{

    protected $_name = 'wigi_users_settings';
    protected $_primary = 'wigi_users_settings_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

