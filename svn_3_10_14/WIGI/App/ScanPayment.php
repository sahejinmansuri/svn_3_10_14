<?php

class App_ScanPayment {

	function scan_and_pay($cellphone_user, $user, $merchant_id, $amount, $wigicode,$extinfo){
		try {
			$merchant = new App_User($merchant_id);
        } catch(App_Exception_WsException $e) {
			throw new App_Exception_WsException("Merchant ID does not exist");
        }
		if ($merchant->getStatus() === "locked") {
			throw new App_Exception_WsException("Can not send to this organization at this time");
		}
		
		$cellphone_user->checkConstraint($amount,'1');
        $cellphone_user->checkConstraint($amount,'3');
		
		$to_id = $merchant->getDefaultCellphone();
		
		$cfg = Zend_Registry::get('config');
		$basepath = $cfg->paths->baseurl;
		
		if (!$to_id) {
			$m = new App_Messenger();
			$m->sendMessage("InCashMe: " . $cellphone_user->getFirstName() . " has tried to send you ₹$amount. Please sign up at ".$basepath,$to_id,'2');
			throw new App_Exception_WsException('Cellphone is not a registered InCashMe User. A message has been sent to the recipient.');
			return false;
        }
		
		if ($merchant->getStatus() !== "active") {
			throw new App_Exception_WsException('Merchant is registered but not activated. Please try again later.');
            return false;
        }
		
		$cellphone_merchant = new App_Cellphone($to_id);
		$merchantname  = $merchant->getBusinessName();
		
		//reduce money
		$cellphone_user->reduceFromBalance($amount); 
		$cellphone_user->reduceFromTempBalance($amount); 
		
		//add money to merchant
		$cellphone_merchant->addToBalance($amount);
		
		$cellphone_user->sendMessage("InCashMe: You have sent payment of INR ".$amount." to ".$merchantname, 'InCashMe : Make Payment',3);
        $cellphone_merchant->sendMessage("InCashMe: You have received payment of INR ".$amount." from " . $cellphone_user->getCellphone(), 'InCashMe : Receive Payment',3);
		
		$from_balance      = $cellphone_user->getBalance() - $amount;
		$from_temp_balance = $cellphone_user->getTempBalance() - $amount;	
		
		$to_balance      = $cellphone_merchant->getBalance() - $amount;
		$to_temp_balance = $cellphone_merchant->getTempBalance() - $amount;	
		
		$mobileid = $cellphone_user->getMobileId();
		$mobile_merchantid = $cellphone_merchant->getMobileId();
		
		$type1 = App_Transaction_Type::SCAN_AND_PAY_CONSUMER;
		$from_detail1 = App_Transaction_Type::getConstName($type1);
		$from_detail = $from_detail1." to ".$merchantname." IMPC™ ".$wigicode;
		
		$from_user_detail = $cellphone_user->getFmtCellphone();
		$from_merchant_detail = $cellphone_merchant->getFmtCellphone();
		$userid = $cellphone_user->getUserId();
		$usermail = $user->getEmail();
		$merchantmail = $merchant->getEmail();
		
		$type2 = App_Transaction_Type::SCAN_AND_PAY_MERCHANT;
		$to_detail = App_Transaction_Type::getConstName($type2);
		
		App_Transaction_Transaction::log($type1,'Debit',$amount,$from_balance,$from_temp_balance,$mobileid,$mobile_merchantid,$from_detail,$from_user_detail,$from_merchant_detail,$userid,$merchant_id,$usermail,$merchantmail,$wigicode,$extinfo);
		
		App_Transaction_Transaction::log($type2,'Credit',$amount,$to_balance,$to_temp_balance,$mobile_merchantid,$mobileid,$to_detail,$from_merchant_detail,$from_user_detail,$merchant_id,$userid,$merchantmail,$usermail,$wigicode,$extinfo);
		
		return $merchantname;
		
	}
	
	function scan_and_donate($cellphone_user, $user, $merchant_id, $amount, $wigicode,$extinfo){
		try {
			$merchant = new App_User($merchant_id);
        } catch(App_Exception_WsException $e) {
			throw new App_Exception_WsException("Merchant ID does not exist");
        }
		if ($merchant->getStatus() === "locked") {
			throw new App_Exception_WsException("Can not send to this organization at this time");
		}
		
		$cellphone_user->checkConstraint($amount,'1');
        $cellphone_user->checkConstraint($amount,'3');
		
		$to_id = $merchant->getDefaultCellphone();
		
		$cfg = Zend_Registry::get('config');
		$basepath = $cfg->paths->baseurl;
		
		if (!$to_id) {
			$m = new App_Messenger();
			$m->sendMessage("InCashMe: " . $cellphone_user->getFirstName() . " has tried to send you ₹$amount. Please sign up at ".$basepath,$to_id,'2');
			throw new App_Exception_WsException('Cellphone is not a registered InCashMe User. A message has been sent to the recipient.');
			return false;
        }
		
		if ($merchant->getStatus() !== "active") {
			throw new App_Exception_WsException('Merchant is registered but not activated. Please try again later.');
            return false;
        }
		
		$cellphone_merchant = new App_Cellphone($to_id);
		$merchantname  = $merchant->getBusinessName();
		
		//reduce money
		$cellphone_user->reduceFromBalance($amount); 
		$cellphone_user->reduceFromTempBalance($amount); 
		
		//add money to merchant
		$cellphone_merchant->addToBalance($amount);
		
		$cellphone_user->sendMessage("InCashMe: You have sent payment of INR ".$amount." to ".$merchantname, 'InCashMe : Make Payment',3);
        $cellphone_merchant->sendMessage("InCashMe: You have received payment of INR ".$amount." from " . $cellphone_user->getCellphone(), 'InCashMe : Receive Payment',3);
		
		$from_balance      = $cellphone_user->getBalance() - $amount;
		$from_temp_balance = $cellphone_user->getTempBalance() - $amount;	
		
		$to_balance      = $cellphone_merchant->getBalance() - $amount;
		$to_temp_balance = $cellphone_merchant->getTempBalance() - $amount;	
		
		$mobileid = $cellphone_user->getMobileId();
		$mobile_merchantid = $cellphone_merchant->getMobileId();
		
		$type1 = App_Transaction_Type::SCAN_AND_PAY_CONSUMER;
		$from_detail1 = App_Transaction_Type::getConstName($type1);
		$from_detail = $from_detail1." to ".$merchantname." IMPC™ ".$wigicode;
		
		$from_user_detail = $cellphone_user->getFmtCellphone();
		$from_merchant_detail = $cellphone_merchant->getFmtCellphone();
		$userid = $cellphone_user->getUserId();
		$usermail = $user->getEmail();
		$merchantmail = $merchant->getEmail();
		
		$type2 = App_Transaction_Type::SCAN_AND_PAY_MERCHANT;
		$to_detail = App_Transaction_Type::getConstName($type2);
		
		App_Transaction_Transaction::log($type1,'Debit',$amount,$from_balance,$from_temp_balance,$mobileid,$mobile_merchantid,$from_detail,$from_user_detail,$from_merchant_detail,$userid,$merchant_id,$usermail,$merchantmail,$wigicode,$extinfo);
		
		App_Transaction_Transaction::log($type2,'Credit',$amount,$to_balance,$to_temp_balance,$mobile_merchantid,$mobileid,$to_detail,$from_merchant_detail,$from_user_detail,$merchant_id,$userid,$merchantmail,$usermail,$wigicode,$extinfo);
		
		return $merchantname;
		
	}
}