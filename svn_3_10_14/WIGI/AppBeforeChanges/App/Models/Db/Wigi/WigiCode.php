<?php
class App_Models_Db_Wigi_WigiCode extends Zend_Db_Table_Abstract
{

    protected $_name = 'wigi_code';
    protected $_primary = 'wigi_code_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi_log')));
	}
}

