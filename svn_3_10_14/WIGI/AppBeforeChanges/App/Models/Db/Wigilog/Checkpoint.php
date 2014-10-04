<?php
class App_Models_Db_Wigilog_Checkpoint extends Zend_Db_Table_Abstract
{

    protected $_name = 'checkpoint';
    protected $_primary = 'checkpoint_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi_log')));
	}
}

