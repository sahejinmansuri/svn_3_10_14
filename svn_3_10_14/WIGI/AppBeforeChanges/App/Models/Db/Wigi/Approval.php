<?php

/**
 * Approval records for non-profit entities
 *
 * @author nhenehan
 */

class App_Models_Db_Wigi_Approval extends Zend_Db_Table_Abstract
{

    protected $_name = 'approval';
    protected $_primary = 'approval_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}


?>
