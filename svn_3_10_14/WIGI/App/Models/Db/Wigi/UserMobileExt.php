<?php
class App_Models_Db_Wigi_UserMobileExt extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_mobile_ext';
    #protected $_primary = '';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

