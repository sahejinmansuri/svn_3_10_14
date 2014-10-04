<?php
class App_Models_Db_Wigi_UserMobileMessage extends Zend_Db_Table_Abstract
{

    protected $_name = 'user_mobile_message';
    protected $_primary = 'user_mobile_message_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

