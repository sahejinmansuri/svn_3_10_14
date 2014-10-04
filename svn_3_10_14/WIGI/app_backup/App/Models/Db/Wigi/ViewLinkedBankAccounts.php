<?php
class App_Models_Db_Wigi_ViewLinkedBankAccounts extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_linked_bank_accounts';
    protected $_primary = 'id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

