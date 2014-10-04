<?php
class App_Models_Db_Wigi_Settings extends Zend_Db_Table_Abstract
{

    protected $_name = 'settings';
    protected $_primary = 'setting_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

