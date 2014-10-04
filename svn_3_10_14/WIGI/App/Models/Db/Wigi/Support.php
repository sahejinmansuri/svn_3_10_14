<?php
class App_Models_Db_Wigi_Support extends Zend_Db_Table_Abstract
{

    protected $_name = 'support';
    protected $_primary = 'support_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

