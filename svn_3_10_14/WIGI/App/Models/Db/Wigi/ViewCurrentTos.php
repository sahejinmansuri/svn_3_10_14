<?php
class App_Models_Db_Wigi_ViewCurrentTos extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_current_tos';
    protected $_primary = 'tos_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

