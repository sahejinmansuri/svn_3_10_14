<?php
class App_Models_Db_Wigi_SystemMaintainence extends Zend_Db_Table_Abstract
{

    protected $_name = 'system_maintainence';
    protected $_primary = 'system_maintainence_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

