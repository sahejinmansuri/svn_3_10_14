<?php
class App_Models_Db_Wigi_Useraddrpos extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_addresspos';
  //  protected $_primary = 'user_address_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

