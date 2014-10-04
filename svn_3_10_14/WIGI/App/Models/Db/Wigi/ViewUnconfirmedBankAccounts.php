<?php
class App_Models_Db_Wigi_ViewUnconfirmedBankAccounts extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_unconfirmed_bank_accounts';
    protected $_primary = 'user_bank_account_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

