<?php
class App_Models_Db_Wigi_ViewOrders extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_orders';
    protected $_primary = 'order_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

