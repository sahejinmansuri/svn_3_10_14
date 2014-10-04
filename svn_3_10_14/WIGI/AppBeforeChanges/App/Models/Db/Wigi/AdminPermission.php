<?php

/**
 * Description of AdminPermission
 *
 * @author nhenehan
 */
class App_Models_Db_Wigi_AdminPermission   extends Zend_Db_Table_Abstract
{

    protected $_name = 'admin_permission';
    protected $_primary = 'admin_permission_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

?>
