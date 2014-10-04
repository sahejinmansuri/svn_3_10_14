<?php

class App_Event_Mw_AdminController_addrole extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => 0
		);
	}
	
	public function getEvtData() {
		$data = parent::getEvtData();
		unset($data['inputs']['KEY']);
		unset($data['inputs']['IDENTIFIER']);
		return $data;
	}
	
	public function execute(&$session_data,&$pview,&$cthis){
		$pview->pageid = "admin";

		$pview->tzpref = $session_data->prefs["system"]["timezone"];

		$uid = $session_data->identity['userid'];
		$pview->user = $session_data->identity;

		$categories = App_MwPerm::getMerchantWigiFeatures();
		$pview->categories = $categories;
		$rolestr='';

		$rolename = $this->_request->getParam('rolename');

		// Check if the a role with the same name does not exist!
		if(!App_MwPerm::checkRoleAvailable($session_data->wigi_merchant_settings, $rolename))
		{
			// A Role exists with the same name.
			$cthis->redirect('home','admin','mw');
		}

		

		foreach($categories as $id=>$data)
		{
			$rolestr.= $this->_request->getParam($data['vname']);
		}

		$r=array();
		$r['merchantid']=$session_data->identity['merchantid'];
		$r['category']='Merchant Roles '.$rolename;
		$r['status']='A';
		$r['value']=$rolestr;
		$r['useradded']=$uid;
		$r['user_id']=$uid;
		$r['datecreated']=new Zend_Db_Expr('NOW()');

		$ms = new App_WigiMerchantSettings();
		$ms->insert($r);

		$session_data->wigi_merchant_settings = $ms->getMerchantSettings( $uid );

		$cthis->redirect('home','admin','mw');
	}
	
}

?>
