<?php
class App_Models_Db_Wigi_MobileAddFund extends Zend_Db_Table_Abstract
{

    protected $_name = 'mobile_add_fund';
    #protected $_primary = '';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

