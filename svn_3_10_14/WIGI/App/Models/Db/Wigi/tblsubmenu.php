<?php
class App_Models_Db_Wigi_tblsubmenu extends Zend_Db_Table_Abstract
{

    protected $_name = 'tblsubmenu';
    protected $_primary = 'sub_menu_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

