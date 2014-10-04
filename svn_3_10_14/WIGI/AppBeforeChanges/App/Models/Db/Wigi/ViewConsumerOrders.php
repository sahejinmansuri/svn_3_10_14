<?php
class App_Models_Db_Wigi_ViewConsumerOrders extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_consumer_orders';
    protected $_primary = 'order_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

