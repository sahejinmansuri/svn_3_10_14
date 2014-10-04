<?php

class App_Event_Posws_RegistrationController_addrole extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
		  'MOBILE'  => array('generic', 100, 1, App_Constants::getFormLabel('MOBILE')),
		  'ROLENAME'  => array('generic', 100, 1, App_Constants::getFormLabel('ROLENAME')),
		  'vname'  => array('generic', 100, 1, App_Constants::getFormLabel('vname'))
		  
		);
	}
	
	public function getEvtData() {
		$data = parent::getEvtData();
		unset($data['inputs']['KEY']);
		unset($data['inputs']['IDENTIFIER']);
		return $data;
	}
	
	public function execute(&$session_data,&$pview,&$cthis){
		


			App_DataUtils::beginTransaction();
						
						$mid = $this->_request->getParam("MOBILE");
					$rolename=$this->_request->getParam("ROLENAME");
					$rolestr= $this->_request->getParam('vname');
					
		$uid = $session_data->identity['userid'];
		
		
		$pview->user = $session_data->identity;



		// Check if the a role with the same name does not exist!
		
	if(!App_MwPerm::checkRoleAvailable1($rolename))
		{
			// A Role exists with the same name.
			echo "hi";
			exit;
			$cthis->redirect('home','admin','pos');
		}
		

	
			
		
		$r=array();
		$r['merchantid']=$session_data->identity['merchantid'];
		$r['category']='POS Roles '.$rolename;
		$r['status']='A';
		$r['mobile_id']=$mid;
		$r['value']=$rolestr;
		$r['useradded']=$uid;
		$r['user_id']=$uid;
		$r['datecreated']=new Zend_Db_Expr('NOW()');

		$ms = new App_WigiMerchantSettings();
		$ms->insert($r);
		

      $result['result']['status'] = 'success';
     
     
      App_DataUtils::commit();
      
			return $result;

		/*$session_data->wigi_merchant_settings = $ms->getMerchantSettings( $uid );

		$cthis->redirect('home','admin','pos');*/
	}
	
}

?>
