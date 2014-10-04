<?php
class App_Models_Db_Wigi_ViewMobilePrefs extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_mobile_prefs';
    protected $_primary = 'user_mobile_ext_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

