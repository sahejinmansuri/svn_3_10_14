<?php
class App_Models_Db_Wigi_UserMobile extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_mobile';
    protected $_primary = 'mobile_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

