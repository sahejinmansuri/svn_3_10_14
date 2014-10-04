<?php
class App_Models_Db_Wigi_RoutingNumberInfo extends Zend_Db_Table_Abstract
{

    protected $_name = 'routing_number_info';
    protected $_primary = 'routing';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

