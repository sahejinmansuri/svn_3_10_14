<?php
class App_Models_Db_Wigi_scanedonate extends Zend_Db_Table_Abstract
{

    protected $_name = 'scanedonate';
    protected $_primary = 'scaneid';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

