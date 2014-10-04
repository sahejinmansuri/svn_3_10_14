<?php

class App_Event_Posws_RegistrationController_deleterole extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			 'MOBILE'  => array('generic', 100, 1, App_Constants::getFormLabel('MOBILE')),
		  'ROLENAME'  => array('generic', 100, 1, App_Constants::getFormLabel('ROLENAME')),
		  
		);
	}
	
	public function getEvtData() {
		$data = parent::getEvtData();
		unset($data['inputs']['KEY']);
		unset($data['inputs']['IDENTIFIER']);
		return $data;
	}
	
	public function execute(&$session_data,&$pview,&$cthis){
		/*$pview->pageid = "admin";
		$pview->tzpref = $session_data->prefs["system"]["timezone"];*/

				App_DataUtils::beginTransaction();

		$uid = $session_data->identity['userid'];
		$rolename = $this->_request->getParam('ROLENAME');
		/*$role=explode('_',$rolename,3);
$role1=$role[2];*/
/*print_r($role1);
exit;*/
		$r=array();
		$category='POS Roles '.$rolename;
		$r['status']='I';
		$r['usermodified']=$session_data->identity['mw_user_id'];
		$r['datemodified']=new Zend_Db_Expr('NOW()');

		$ms = new App_WigiMerchantSettings();
		$ms->updateMerchantSetting($r, $category, $uid);

		$session_data->wigi_merchant_settings = $ms->getMerchantSettings( $uid );

		
      $result['result']['status'] = 'success';
     
   
      App_DataUtils::commit();
      
			return $result;
	}
	
}

?>
