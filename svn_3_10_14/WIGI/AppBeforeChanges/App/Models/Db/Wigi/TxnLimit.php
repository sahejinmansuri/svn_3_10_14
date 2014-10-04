<?php
class App_Models_Db_Wigi_TxnLimit extends Zend_Db_Table_Abstract
{

    protected $_name = 'txn_limit';
    #protected $_primary = '';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

