<?php
class App_Models_Db_Wigi_UserLog extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_log';
    protected $_primary = 'user_log_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

