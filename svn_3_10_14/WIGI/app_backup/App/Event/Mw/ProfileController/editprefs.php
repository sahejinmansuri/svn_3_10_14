<?php

class App_Event_Mw_ProfileController_editprefs extends App_Event_WsEventAbstract  {
	
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

                App_DataUtils::beginTransaction();
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$uid = $session_data->identity['userid'];
		$user = new App_User($uid);
		
		$uprefs = new App_Prefs();
		$preferences = $uprefs->getWebUserPrefs($uid, 'mw');
		$pview->preferences = $preferences;
		
		if ($this->_request->getParam('doaction') != null) {
			
			$acceptcash = $this->_request->getParam('ACCEPTCASH');
			$acceptcreditcard = $this->_request->getParam('ACCEPTCREDITCARD');
			$acceptscanandpay = $this->_request->getParam('ACCEPTSCANANDPAY');
			$acceptscanandbuy = $this->_request->getParam('ACCEPTSCANANDBUY');
			$acceptecommerce = $this->_request->getParam('ACCEPTECOMMERCE');
			$acceptpos = $this->_request->getParam('ACCEPTPOS');
			
			$possecret = $this->_request->getParam('POSSECRET');
			$salestax = $this->_request->getParam('SALESTAX');
			$timezone = $this->_request->getParam('TIMEZONE');
            $tips = $this->_request->getParam('TIPS');
            
			$p = new App_Prefs();
			$prefs = $p->getWebUserPrefs($uid, 'mw');
			
			$prefs["accept"]["cash"] = $acceptcash;
			$prefs["accept"]["creditcard"] = $acceptcreditcard;
			$prefs["accept"]["scanandpay"] = $acceptscanandpay;
			$prefs["accept"]["scanandbuy"] = $acceptscanandbuy;
			$prefs["accept"]["ecommerce"] = $acceptecommerce;
			$prefs["accept"]["pos"] = $acceptpos;
			
			$prefs["possecret"] = $possecret;
			$prefs["salestax"] = $salestax;
			$prefs["system"]["timezone"] = $timezone;
            $prefs["tips"] = $tips;				
			//$p->checkConstraint($prefs,"system");
			$mw_user_id = $session_data->identity['mw_user_id'];

            $session_data->identity['prefs'] = $prefs;
            $p->saveWebUserPrefs($uid, $prefs, 'mw',$mw_user_id);
			
			//check all the cellphones for constraint violations
			/*foreach ($user->getCellphones() as $cellphone) {
				
				$cellprefs = $p->getCellphonePrefs($uid,$cellphone["mobile_id"],"posws");
				$newprefs = $p->checkConstraint($cellprefs,$prefs,false);
				
				if ( $newprefs != null) { //there was a constraint violation
					$p->saveCellphonePrefs($uid,$cellphone["mobile_id"],$newprefs);
				}
				
			}*/
			
			$pview->showcontent = "success";
			
		}
		
            App_DataUtils::commit();

	}
	
}

?>
