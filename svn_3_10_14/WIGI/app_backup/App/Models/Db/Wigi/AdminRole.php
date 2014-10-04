<?php

/**
 * Description of App_Models_Db_Wigi_AdminRole
 *
 * @author nhenehan
 */
class App_Models_Db_Wigi_AdminRole  extends Zend_Db_Table_Abstract
{

    protected $_name = 'admin_role';
    protected $_primary = 'role_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

?>
