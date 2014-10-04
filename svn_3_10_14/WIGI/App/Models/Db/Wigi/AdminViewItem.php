<?php

/**
 * Description of AdminToRole
 *
 * @author nhenehan
 */
class App_Models_Db_Wigi_AdminViewItem extends Zend_Db_Table_Abstract
{

    protected $_name = 'admin_view';
    protected $_primary = 'admin_view_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

?>
