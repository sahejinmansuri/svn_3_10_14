<?php
class App_Models_Db_Wigi_UserMobileOsId extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_mobile_os_id';
    protected $_primary = 'id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

