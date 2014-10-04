<?php
class App_Models_Db_Wigi_ViewMyDocuments extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_my_documents';
    protected $_primary = 'doc_info_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

