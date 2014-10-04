<?php

class App_Billing {

  protected $passphrase;
  protected $keyver;

  public function billing_check($mobileid, $amount, $transaction_type) {
    $c = new App_Cellphone($mobileid);
    $userid = $c->getUserId();
    $u = new App_User($userid);
    $billing_amount = 0;	
		  
	$billing_settings_a = new App_WigiAdminSettings();
	$billing_settings = $billing_settings_a->getAdminSetting();
	$special_billing_settings = $billing_settings_a->getCurrentAdminSpecialBilling();
	 
	$a = App_Transaction_WigiCharges::_convertDefaultValStrtoArr($billing_settings['wigi_default_billing']);
	$minamount = @$a['minamt']['type'];
	
	if($amount > $minamount){
		if ($u->getType() === "consumer") {
			 $data = App_Transaction_WigiBilling::calculateConsumerBilling(
									$billing_settings, 
									$mobileid, 
									$amount, 
									$transaction_type);
			  $billing_amount = $data['charge'];
		 } else {

			 $data = App_Transaction_WigiBilling::calculateMerchantBilling(
									$billing_settings, 
									$special_billing_settings, 
									$userid, 
									$amount,
									$transaction_type); 
			  $billing_amount = $data['charge'];
		 }
		 if($billing_amount == ""){
			$billing_amount = 0;
		 }
	}else{
		$billing_amount = 0;
	}
	return $billing_amount;
  }
  
} 
?>
