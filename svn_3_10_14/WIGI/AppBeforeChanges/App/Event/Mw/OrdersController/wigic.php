<?php

class App_Event_Mw_OrdersController_wigic extends App_Event_WsEventAbstract  {
	
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
				$pview->trans_amount = $this->_request->getParam('trans_amount');
				$pview->userdata = $this->_request->getParam('userdata');
				$pview->typecode = $this->_request->getParam('typecode');

				# Test Data Sets Here 
				// String format is: TRANS_CODE-MIN_VALUE-DEF_VALUE-MAX_VALUE
				// $defFixed='100-50-80-100|101-25-48-90|102-20-45-75|';
				// $defPercentage='100-0.5-0.9-1.5|101-1-1.5-2.5|102-0.4-0.8-1.1|';
				// String format is TRANS_CODE-GLOBAL_DEFAULT
				// $defField='100-P|101-P|102-F';
				// String format is TRANS_CODE-USER_NEGOTIATED_TYPE-USER_NEGOTIATED_AMOUNT

                $pview->wigi_fixed_billing = $session_data->wigi_billing_settings['wigi_fixed_billing'];
                $pview->wigi_percentage_billing = $session_data->wigi_billing_settings['wigi_percentage_billing'];
                $pview->wigi_default_billing = $session_data->wigi_billing_settings['wigi_default_billing'];
                $pview->wigi_merchant_billing = $session_data->wigi_merchant_settings['wigi_billing'];

                $defFixed = $session_data->wigi_billing_settings['wigi_fixed_billing'];
                $defPercentage = $session_data->wigi_billing_settings['wigi_percentage_billing'];
                $defField = $session_data->wigi_billing_settings['wigi_default_billing'];
                $userSettings = $session_data->wigi_merchant_settings['wigi_billing'];

				$wigiSpecialBillingData = App_Transaction_WigiBilling::calculateMerchantBilling($session_data->wigi_billing_settings, $session_data->current_wigi_special_billing_setting, $uid, $this->_request->getParam('trans_amount'),$this->_request->getParam('typecode'));
	

				/*$wigicharge = App_Transaction_WigiCharges::getWigiCharge($defFixed, $defPercentage, $defField, $userSettings,$this->_request->getParam('trans_amount'),$this->_request->getParam('typecode'));

				// Get the special billing data for Wigi
				$category = App_Transaction_WigiSpecialBilling::getCurrentMonthCategory();

				$specialBillingWigi = (isset($session_data->wigi_billing_settings[$category]))?$session_data->wigi_billing_settings[$category]:'';
				// Get the special billing data for merchant based on the current month
				$mSpecialBillingStr = (isset($session_data->wigi_merchant_settings[$category]))?$session_data->wigi_merchant_settings[$category]:'';

				//echo "BEFORE: ".$mSpecialBillingStr."<br/>";
				$wigiSpecialBillingData = App_Transaction_WigiSpecialBilling::getWigiSpecialBilling($specialBillingWigi, $mSpecialBillingStr, $this->_request->getParam('trans_amount'),$this->_request->getParam('typecode'), $wigicharge['charge']);

				$session_data->wigi_merchant_settings[$category] = $wigiSpecialBillingData['update_str'];
				// Also update the user table with the new data
				App_Transaction_WigiBilling::updateMerchantTransaction($uid, $wigiSpecialBillingData['update_str']);*/

				$billingSettings = new App_WigiAdminSettings();
				$a = $billingSettings->getCurrentAdminSpecialBilling();

				$pview->wigicharge = $wigiSpecialBillingData['charge'];	
				$pview->wigichargedesc = $wigiSpecialBillingData['desc'];
				#echo "CHARGE	|".$wigicharge;
	}
	
}

?>
