<?php
class App_Models_Db_Wigi_BeVersion extends Zend_Db_Table_Abstract
{

    protected $_name = 'be_version';
    protected $_primary = 'be_version';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

