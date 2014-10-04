<?php

/**
 * Description of AdminToRole
 *
 * @author nhenehan
 */
class App_Models_Db_Wigi_AdminToRole extends Zend_Db_Table_Abstract
{

    protected $_name = 'admin_to_role';
    protected $_primary = 'relation_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

?>
