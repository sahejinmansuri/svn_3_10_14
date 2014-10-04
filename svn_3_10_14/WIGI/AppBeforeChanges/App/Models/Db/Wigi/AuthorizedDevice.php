<?php
class App_Models_Db_Wigi_AuthorizedDevice extends Zend_Db_Table_Abstract
{

    protected $_name = 'authorized_device';
    protected $_primary = 'authorized_device_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

