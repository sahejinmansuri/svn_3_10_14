<?php
class App_Models_Db_Wigisession_Sessions extends Zend_Db_Table_Abstract
{

    protected $_name = 'sessions';
    protected $_primary = 'id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('sess')));
	}
}

