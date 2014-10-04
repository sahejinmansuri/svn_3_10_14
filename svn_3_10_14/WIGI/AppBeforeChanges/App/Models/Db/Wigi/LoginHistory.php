<?php
class App_Models_Db_Wigi_LoginHistory extends Zend_Db_Table_Abstract
{

    protected $_name = 'login_history';
    protected $_primary = 'login_history_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

