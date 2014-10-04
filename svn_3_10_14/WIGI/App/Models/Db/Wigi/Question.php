<?php
class App_Models_Db_Wigi_Question extends Zend_Db_Table_Abstract
{

    protected $_name = 'question';
    protected $_primary = 'question_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

