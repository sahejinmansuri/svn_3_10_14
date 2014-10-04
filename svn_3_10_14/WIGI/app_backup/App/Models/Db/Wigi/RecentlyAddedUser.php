<?php
class App_Models_Db_Wigi_RecentlyAddedUser extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_new_user';
    protected $_primary = 'user_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

