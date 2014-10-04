<?php
class App_Models_Db_Wigi_Menu extends Zend_Db_Table_Abstract
{

    protected $_name = 'menu';
    protected $_primary = 'id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

