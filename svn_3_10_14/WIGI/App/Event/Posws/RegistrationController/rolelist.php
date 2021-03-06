<?php

class App_Event_Posws_RegistrationController_rolelist extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
		 'MOBILE'  => array('generic', 100, 1, App_Constants::getFormLabel('MOBILE')),
		  
		 
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
			
	$new[]=array_keys($aa);
	$value[]=array_values($aa);

   $count=count($new[0]);
  
  
  $array_data = array();
  $array_data_push = array();
  for($i=0;$i<$count;$i++) {
  	
       $rolename1=$new[0][$i];
       
  		 //$result1['result']['rolename'.$i] =$rolename1 ;
  		 $check=split("_",$rolename1);
  		 
  		if($check[0]!='Merchant') {
  			
 			 $rolename2=$value[0][$i];	
 			 $rolename3= explode('_',$rolename1);
          $array_data_push['rolename'] =$rolename3[2] ;
          $array_data_push['value'] = $rolename2;
  			 //$result['result']['data']['rolename'][$i] =$rolename1 ;
  		    //$result['result']['data']['value'][$i] =$rolename2 ;
          array_push($array_data,$array_data_push);     		
  		}
  	
  }
      $result['result']['data'] = $array_data;
 
      $result['result']['status'] = 'success';

      App_DataUtils::commit();
      
			return $result;

	//	$cthis->redirect('home','admin','mw');
	}
	
}

?>
