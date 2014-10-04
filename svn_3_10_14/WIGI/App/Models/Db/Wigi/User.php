<?php
class App_Models_Db_Wigi_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';
    protected $_primary = 'user_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

