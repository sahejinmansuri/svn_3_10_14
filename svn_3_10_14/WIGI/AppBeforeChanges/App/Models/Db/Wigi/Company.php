<?php
class App_Models_Db_Wigi_Company extends Zend_Db_Table_Abstract
{

    protected $_name = 'company';
    protected $_primary = 'company_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

