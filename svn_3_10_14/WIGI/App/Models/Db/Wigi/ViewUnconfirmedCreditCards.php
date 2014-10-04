<?php
class App_Models_Db_Wigi_ViewUnconfirmedCreditCards extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_unconfirmed_credit_cards';
    protected $_primary = 'user_credit_card_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

