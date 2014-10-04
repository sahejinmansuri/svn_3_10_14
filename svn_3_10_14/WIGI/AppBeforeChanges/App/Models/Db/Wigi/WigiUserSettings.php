<?php
class App_Models_Db_Wigi_WigiUserSettings extends Zend_Db_Table_Abstract
{

    protected $_name = 'wigi_user_settings';
    protected $_primary = 'wigi_user_settings_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

