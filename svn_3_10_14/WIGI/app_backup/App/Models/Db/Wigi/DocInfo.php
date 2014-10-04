<?php
class App_Models_Db_Wigi_DocInfo extends Zend_Db_Table_Abstract
{

    protected $_name = 'doc_info';
    protected $_primary = 'doc_info_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

