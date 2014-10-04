<?php

class App_Event_Mw_OrdersController_wigi extends App_Event_WsEventAbstract  {
	
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
                $pview->pageid = "wigishare";

				$pview->tzpref = $session_data->prefs["system"]["timezone"];

				$uid = $session_data->identity['userid'];
				$user = new App_User($uid);

				$list = App_Transaction_Type::getConstName();
                $pview->typelist = $list;

				// Set session vars here
                $pview->wigi_fixed_billing = $session_data->wigi_billing_settings['wigi_fixed_billing'];
                $pview->wigi_percentage_billing = $session_data->wigi_billing_settings['wigi_percentage_billing'];
                $pview->wigi_default_billing = $session_data->wigi_billing_settings['wigi_default_billing'];
                $pview->wigi_merchant_billing = $session_data->wigi_merchant_settings['wigi_billing'];

				//var_dump($session_data->identity);
				//die();
	}
	
}

?>
