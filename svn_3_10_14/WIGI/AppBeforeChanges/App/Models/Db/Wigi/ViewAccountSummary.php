<?php
class App_Models_Db_Wigi_ViewAccountSummary extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_account_summary';
    protected $_primary = 'user_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

