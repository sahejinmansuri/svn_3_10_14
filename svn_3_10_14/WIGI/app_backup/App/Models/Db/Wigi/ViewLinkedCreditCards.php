<?php
class App_Models_Db_Wigi_ViewLinkedCreditCards extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_linked_credit_cards';
    protected $_primary = 'id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

