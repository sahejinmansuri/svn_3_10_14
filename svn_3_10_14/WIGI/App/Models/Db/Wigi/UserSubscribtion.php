<?php
class App_Models_Db_Wigi_UserSubscribtion extends Zend_Db_Table_Abstract
{

    protected $_name = 'id';
    #protected $_primary = '';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

