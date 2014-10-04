<?php
class App_Models_Db_Wigi_ViewUserCellphones extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_user_cellphones';
    #protected $_primary = '';
    protected $_primary = 'mobile_id';	

	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

