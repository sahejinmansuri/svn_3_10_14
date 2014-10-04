<?php
class App_Models_Db_Wigi_AdminUser extends Zend_Db_Table_Abstract
{

    protected $_name = 'adminuser';
    protected $_primary = 'adminuser_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

