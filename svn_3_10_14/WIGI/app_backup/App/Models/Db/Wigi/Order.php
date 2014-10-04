<?php
class App_Models_Db_Wigi_Order extends Zend_Db_Table_Abstract
{

    protected $_name = 'order';
    protected $_primary = 'order_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

