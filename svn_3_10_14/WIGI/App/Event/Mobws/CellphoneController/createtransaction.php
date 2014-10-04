<?php

class App_Event_Mobws_CellphoneController_createtransaction extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'AMOUNT' => array('amount', 12, 1, App_Constants::getFormLabel('AMOUNT')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(){
                App_DataUtils::beginTransaction();
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Create WigiCode');

                $amount = $this->_request->getParam("AMOUNT");
                $result = array();

                $c = new App_Cellphone($ns->mobileid);
                $c->checkConstraint($amount,'2',true,true);
                $c->checkConstraint($amount,'4',true,false);
				
				//add for kyc start
				$uid = $c->getUserId();
				$user = new App_User($uid);
				$kyc_to_user = $user->getKYC();
				if($kyc_to_user == 0){
					throw new App_Exception_WsException("KYC Pending! To Access this feature your kyc must be under green and approved");
				}
				//add for kyc end
				
				//subscription checking start
				$subscription_to_user = $user->getSubscribedUser(); 
				$SubscribedCount = $user->getSubscribedCount();
				
				if($subscription_to_user == 0){
					$subscribe = App_User::subscribe_userbyid($uid, $SubscribedCount); 
				}
				
				$user = new App_User($uid);
				$subscription_to_user_new = $user->getSubscribedUser(); 
				
				if($subscription_to_user_new == 0){
					throw new App_Exception_WsException("Your subscription is not completed");
				}
				//add for subscription checking

                $w = new App_WigiEngine();
				$r = $w->createTransaction( $ns->extinfo ,$ns->mobileid ,$amount,$ns->prefs["wigi"]['timeout'],$ns->prefs["system"]["timezone"]);

	$mobileid = $ns->mobileid;
	$amount = $amount;
	$transaction_type = 207;
	
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
	$flag = 0;
	if($billing_amount != 0){
		$flag = 1;
	}
	if($flag == 1){
			$chargable = 1;
	}else{
			$chargable = 0;
	}
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $r;
				$result['result']['data']['chargable_wigi']   = $chargable;

                App_DataUtils::commit();
                return $result;
    }
}
