<?php

class App_Transaction_WigiBilling
{

/* This function will calculate the billing (with Special Billing) for the Merchant
Inputs: array of wigi admin settings, merchantid, transaction code and amount of transaction */
public static function calculateMerchantBilling($wigiData, $current_wigi_special_billing_setting, $mid, $amt, $code)
{
	if (!$mid or !$code or !$amt) { return 0; }

	$merchantData = self::getMerchantBillingData($mid);

	$defFixed = $wigiData['wigi_fixed_billing'];
	$defPercentage = $wigiData['wigi_percentage_billing'];
	$defField = $wigiData['wigi_default_billing'];
	$userSettings = $merchantData['wigi_billing'];

	$wigicharge = App_Transaction_WigiCharges::getWigiCharge($defFixed, $defPercentage, $defField, $userSettings,$amt,$code);

	$category = App_Transaction_WigiSpecialBilling::getCurrentMonthCategory();
	//$specialBillingWigi = (isset($wigiData[$category]))?$wigiData[$category]:''; --> This is based on Month Billing settings
	$specialBillingMerchant = (isset($merchantData[$category]))?$merchantData[$category]:'';

	// This is based on Date Range implementation 
	$specialBillingWigi = (isset($current_wigi_special_billing_setting[0]['value']))?$current_wigi_special_billing_setting[0]['value']:'';

	$wigiSpecialBillingData = App_Transaction_WigiSpecialBilling::getWigiSpecialBilling($specialBillingWigi, $specialBillingMerchant, $amt,$code, $wigicharge['charge']);

	self::updateMerchantTransaction($mid, $wigiSpecialBillingData['update_str']);
	$desc = '<ul>'.$wigicharge['desc'].$wigiSpecialBillingData['desc'].'</ul>';
	$wigiSpecialBillingData['desc']=$desc;

	return $wigiSpecialBillingData;
}


/* This function will calculate the billing (with Special Billing) for the Merchant
Inputs: array of wigi admin settings, merchantid, transaction code and amount of transaction */
public static function calculateConsumerBilling($wigiData, $cid, $amt, $code)
{
	if (!$cid or !$code or !$amt) { return 0; }

	$merchantData = self::getConsumerBillingData($cid);

	$defFixed = $wigiData['wigi_fixed_billing'];
	$defPercentage = $wigiData['wigi_percentage_billing'];
	$defField = $wigiData['wigi_default_billing'];
	$userSettings = $merchantData['wigi_billing'];

	$wigicharge = App_Transaction_WigiCharges::getWigiCharge($defFixed, $defPercentage, $defField, $userSettings,$amt,$code);

	$desc = '<ul>'.$wigicharge['desc'].'</ul>';
	$wigicharge['desc']=$desc;

	return $wigicharge;
}


public static function getMerchantBillingData($mid)
{
	$merchantSettings = new App_WigiMerchantSettings();
	$merchantData = $merchantSettings->getMerchantSettings($mid, 'web');
	return $merchantData;
}

public static function getConsumerBillingData($cid)
{
	$userSettings = new App_WigiUserSetting();
	$merchantData = $userSettings->getWebUserSettings($cid, 'web');
	return $merchantData;
}

/* Update merchant total transaction for the current month
   and the total amount of transaction after every appropriate transaction */
public static function updateMerchantTransaction($mid, $value)
{
	$category = self::getCurrentMonthCategory();

	$us = new App_Models_Db_Wigi_WigiMerchantSettings();
	$u1['datemodified']= new Zend_Db_Expr('NOW()');
	$u1['value'] = $value;

	$us->update($u1, array(
		'user_id = ? ' => $mid,
		'category = ? ' => $category,
	));

}


public static function getCurrentMonthCategory()
{
	return date('F').' '.date('Y').' special billing';
}

}
