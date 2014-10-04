<?php
class App_Models_Db_Wigi_ViewGetMessages extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_get_messages';
    protected $_primary = 'mobile_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

