<?php
class App_Models_Db_Wigi_ViewSupportTickets extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_support_tickets';
    protected $_primary = 'support_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

