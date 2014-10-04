<?php


class App_Models_Db_Wigi_ViewMerchantInfo  extends Zend_Db_Table_Abstract
{

    protected $_name = 'view_merchant_info';
    protected $_primary = 'user_id';	

	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi')));
	}
}

?>
