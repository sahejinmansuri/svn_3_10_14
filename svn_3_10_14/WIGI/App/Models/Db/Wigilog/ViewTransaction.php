<?php
class App_Models_Db_Wigilog_ViewTransaction extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_transaction';
    #protected $_primary = 'transaction_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi_log')));
	}
}

