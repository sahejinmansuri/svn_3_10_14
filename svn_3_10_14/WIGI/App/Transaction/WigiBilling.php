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
	$userSettings = @$merchantData['wigi_billing'];

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

public static function stringrpl($r,$str){
	$temp = substr($str,6);
	$out1 = substr_replace($str,"$r",6);
	$out1 .= $temp;
	
	$temp = substr($out1,4);
	$out = substr_replace($out1,"$r",4);
	$out .= $temp;
	return $out;
}
public static function calculateConsumerBilling($wigiData, $cid, $amt, $code)
{
	if (!$cid or !$code or !$amt) { return 0; }

	 
	$merchantData = self::getConsumerBillingData($cid);

	$defFixed = $wigiData['wigi_fixed_billing'];
	$defPercentage = $wigiData['wigi_percentage_billing'];
	$defField = $wigiData['wigi_default_billing'];
	$userSettings = @$merchantData['wigi_billing'];
	$specialField = array();
	$i = 0;
	foreach($wigiData as $key=>$val){
		$strpos = strpos($key,'Special_Billing');
		if($strpos !== FALSE){
			//20140516-20140518_Special_Billing
			$key_array1 = explode('-',$key);
			$key_array2 = explode('_',$key_array1[1]);
			
			$from_date = $key_array1[0];
			$to_date = $key_array2[0];
			$today = date('Ymd',time());
			
			if($from_date == $to_date){
				if($from_date == $today){
					$specialField[$i]['key'] = $key;
					$specialField[$i]['value'] = $wigiData[$key];
					$specialField[$i]['from_date'] = $from_date;
					$specialField[$i]['to_date'] = $to_date;
					$i++;
				}
			}else{
				$today = self::stringrpl("-",$today);
				$today_timestamp =  strtotime($today);
				
				$to_date = self::stringrpl("-",$to_date);
				$to_date_timestamp =  strtotime($to_date);
				
				$from_date = self::stringrpl("-",$from_date);
				$from_date_timestamp =  strtotime($from_date);
				

				if(($today_timestamp >= $from_date_timestamp) && ($today_timestamp <= $to_date_timestamp)){
					$specialField[$i]['key'] = $key;
					$specialField[$i]['value'] = $wigiData[$key];
					$specialField[$i]['from_date'] = $from_date;
					$specialField[$i]['to_date'] = $to_date;
					$i++;
				}
			}
		}
	}

	$wigicharge = App_Transaction_WigiCharges::getWigiCharge($defFixed, $defPercentage, $defField, $userSettings,$amt,$code,$specialField);

     
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
	$cell = new App_Cellphone($cid);
	$user_id = $cell->getUserId();
	$userSettings = new App_WigiUserSetting();
	$merchantData = $userSettings->getWebUserSettings($user_id, 'web');
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
