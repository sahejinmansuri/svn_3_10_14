<?php
class App_Models_Db_Wigi_Preferences extends Zend_Db_Table_Abstract
{

    protected $_name = 'preferences';
    protected $_primary = 'user_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

