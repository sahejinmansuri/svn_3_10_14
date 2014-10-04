<?php
class App_Models_Db_Wigi_DBBackUp extends Zend_Db_Table_Abstract
{

    protected $_name = 'dbbackup';
    protected $_primary = 'dbbackup_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

