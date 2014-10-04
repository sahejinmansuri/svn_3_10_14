<?php
class App_Models_Db_Wigi_UserMobileCreditCard extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_mobile_credit_card';
    #protected $_primary = '';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

