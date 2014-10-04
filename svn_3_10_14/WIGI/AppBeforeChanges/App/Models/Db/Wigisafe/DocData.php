<?php
class App_Models_Db_Wigisafe_DocData extends Zend_Db_Table_Abstract
{

    protected $_name = 'doc_data';
    protected $_primary = 'doc_data_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi_safe')));
	}
}

