<?php

class App_Event_Posws_RegistrationController_editrole extends App_Event_WsEventAbstract  {
	
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
		


		$r=array();
		$category='POS roles '.$rolename;
		$r['value']=$rolestr;
		$r['usermodified']=$uid;
		$r['datemodified']=new Zend_Db_Expr('NOW()');

		
		
		$ms = new App_WigiMerchantSettings();
		$ms->updateMerchantSetting($r,$category, $uid);

		//$session_data->wigi_merchant_settings = $ms->getMerchantSettings( $uid );
			$aa=$session_data->wigi_merchant_settings = $ms->getMerchantSettings( $uid );
			
	/*$new[]=array_keys($aa);
	$value[]=array_values($aa);

   $count=count($new[0]);
  
  for($i=0;$i<$count;$i++) {
  	
       $rolename1=$new[0][$i];
  		 $result['result']['rolename'.$i] =$rolename1 ;
  		 $rolename2=$value[0][$i];
  		 $result['result']['value'.$i] =$rolename2 ;
  		 
  }*/
 
 
      $result['result']['status'] = 'success';

      App_DataUtils::commit();
      
			return $result;

	//	$cthis->redirect('home','admin','mw');
	}
	
}

?>
