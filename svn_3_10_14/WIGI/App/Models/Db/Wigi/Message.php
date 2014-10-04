<?php
class App_Models_Db_Wigi_Message extends Zend_Db_Table_Abstract
{

    protected $_name = 'message';
    protected $_primary = 'message_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

