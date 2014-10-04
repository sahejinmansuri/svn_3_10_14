<?php

class App_Event_Mw_AdminController_editrole extends App_Event_WsEventAbstract  {
	
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

		foreach($categories as $id=>$data)
		{
			$rolestr.= $this->_request->getParam($data['vname']);
		}
		
		$r=array();
		$category='Merchant Roles '.$rolename;
		$r['value']=$rolestr;
		$r['usermodified']=$session_data->identity['mw_user_id'];
		$r['datemodified']=new Zend_Db_Expr('NOW()');

		$ms = new App_WigiMerchantSettings();
		$ms->updateMerchantSetting($r, $category, $uid);

		$session_data->wigi_merchant_settings = $ms->getMerchantSettings( $uid );

		$cthis->redirect('home','admin','mw');
	}
	
}

?>
