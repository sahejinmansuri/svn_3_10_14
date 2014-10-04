<?php
class App_Models_Db_Wigisafe_UserBankAccount extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_bank_account';
    protected $_primary = 'user_bank_account_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi_safe')));
	}
}

