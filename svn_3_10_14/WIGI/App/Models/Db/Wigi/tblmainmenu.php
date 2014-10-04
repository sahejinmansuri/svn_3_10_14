<?php
class App_Models_Db_Wigi_tblmainmenu extends Zend_Db_Table_Abstract
{

    protected $_name = 'tblmainmenu';
    protected $_primary = 'main_menu_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

