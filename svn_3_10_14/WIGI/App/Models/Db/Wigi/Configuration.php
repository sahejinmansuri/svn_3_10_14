<?php

/**
 * Description of App_Models_Db_Wigi_AdminRole
 *
 * @author nhenehan
 */
class App_Models_Db_Wigi_Configuration  extends Zend_Db_Table_Abstract
{

    protected $_name = 'configuration';
    protected $_primary = 'id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

?>
