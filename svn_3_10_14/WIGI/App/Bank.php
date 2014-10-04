<?php
include "App/config.php";
include "App/payment.php";

class App_Bank {

  protected $passphrase;
  protected $keyver;

  public function initCrypto($type,$id=0) {
    $this->initKeyVer($type,$id);
    $this->initPassphrase();
  }

  public function initKeyVer($type,$id) {

    if ($type === "current") {

        $this->keyver = Zend_Registry::get('config')->keyver;

    } else if ($type === "creditcard") {

        $cc = new App_CreditCard($id);
        $this->keyver = $cc->getKeyVer();

    } else if ($type === "bankaccount") {

        $ba = new App_BankAccount($id);
        $this->keyver = $ba->getKeyVer();

    }

  }

  public function initPassphrase() {
	$cfg = Zend_Registry::get('config');
	$baseroot = $cfg->paths->baseroot;
    $this->passphrase = file_get_contents($baseroot."etc/wigi-keys/v" . $this->keyver . "/passphrase");
    $this->passphrase = rtrim($this->passphrase);

  }

  public function checkOwnership($type,$id,$userid,$mobileid,$linkRequired) {

    $u = new App_User($userid);

    if ($type === "creditcard") {

        if (!$u->isCreditCardOwner($id)) {
            throw new App_Exception_WsException("You don't own this credit card!");
            return false;
        }

        //make sure the cellphone is authorized
        if ((!$u->isCreditCardLinked($mobileid,$id)) && $linkRequired) {
            throw new App_Exception_WsException("You are not authorized to use this credit card");
            return false;
        }

    }

    else if ($type === "bankaccount") {

        if (!$u->isBankAccountOwner($id)) {
            throw new App_Exception_WsException("You don't own this bank account!");
            return false;
        }

        //make sure the cellphone is authorized
        if ((!$u->isBankAccountLinked($mobileid,$id)) && $linkRequired) {
            throw new App_Exception_WsException("You are not authorized to use this bank account");
            return false;
        }


    }

    //make sure mobile has parent of userid
    if (!$u->isCellphoneOwner($mobileid)) {

      //Very bad! Probably a cracking attempt
      throw new App_Exception_WsException("Cellphone does not belong to User");
      return false;

    }

  }


   public function checkMoney($mobileid,$amount) {

      $c = new App_Cellphone($mobileid);
      if (!$c->hasEnoughMoney($amount)) {
        throw new App_Exception_WsException("Can not transfer more than is in the account");
        return false;
      }

    }

    public function checkActiveUser($userid) {
      $u = new App_User($userid);
      if (!$u->isActive()) {
        throw new App_Exception_WsException("Account must be active");
        return false;
      }
    }

    public function checkActiveCellphone($mobileid) {
      $c = new App_Cellphone($mobileid);
      if (!$c->isActive()) {
        //error_log("Status is " . $c->getStatus());
        throw new App_Exception_WsException("Cellphone must be active");
        return false;
      }
    }


  public function addCreditCard($userid,$type,$creditcard,$conf_number,$expire_month,$expire_year,$description,$name_on_card,$conf_amt) {

    $this->initCrypto("current");

    $u = new App_User($userid);
    $this->checkActiveUser($userid);

    //use wigi safe client to add credit card
    $wsc = new App_WigiSafeClient();
    $id = $wsc->addCreditCard($userid,$this->keyver,$creditcard,$conf_number,$u->getEmail());
    
    if ($id == 0) {
      throw new App_Exception_WsException("Unable to add credit card at this time");
      return false;
    }
  
    //insert into wigi_log database

    //insert into regular user database
    $last4 = substr($creditcard,-4);
    $u->addCreditCard($id,$name_on_card,$last4,$description,$this->keyver,$type,$expire_month,$expire_year,$conf_amt);
    return $id;
  }


  public function creditCardSale($extinfo,$mobileid,$userid,$creditcard,$amount,$name_on_card,$expire_month,$expire_year,$cvv2,$zip,$address,$state,$type,$processor) {

    //get a transaction id
    $processor_transaction_id = App_Transaction_Transaction::GetProcessorTransactionId($mobileid);
    $extinfo["processor_transaction_id"] = $processor_transaction_id;

    //Use WigiSafe client to take out that much money
    $wsc = new App_WigiSafeClient();
    $res = $wsc->creditCardSale($processor_transaction_id,$amount,$name_on_card,$expire_month,$expire_year,$cvv2,$zip,$address,$state,$creditcard,$zip,$address,$state,$type,$processor);
    if (!$res) {
      throw new App_Exception_WsException("Can not fund from this card");
      return false;
    }

    $c = new App_Cellphone($mobileid);


    $balance = $c->getBalance();
    $temp_balance = $c->getTempBalance();

    //if (Zend_Registry::get('pp.env') === "live") {
      $c->addToBalance($amount);
      $balance = $c->getBalance() + $amount;
      $temp_balance = $c->getTempBalance();
    //}

    $u = new App_User($userid);

    return App_Transaction_Transaction::log(App_Transaction_Type::CREDIT_SALE_PENDING,'Info',$amount,$balance,$temp_balance,$mobileid,'0',App_Transaction_Type::getConstName(App_Transaction_Type::CREDIT_SALE_PENDING),$c->getCellphone(),"",$userid,"",$c->getAlias() . ":" . $u->getEmail(),"","",$extinfo);
  }


  public function testCreditCard($userid,$cc,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$cvv2,$zip,$address,$state,$type,$processor) {

    //setup crypto
    $this->initCrypto("current");

    //Use WigiSafe client to take out that much money
    $wsc = new App_WigiSafeClient();
    $res = $wsc->testCreditCard($userid,$this->passphrase,$this->keyver,$cc,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$cvv2,$zip,$address,$state,$type,$processor);

    if (!$res) {
      throw new App_Exception_WsException("Can not fund from this card");
      return false;
    }

  }

  public function fundFromCreditCard($extinfo,$userid,$mobileid,$ccid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor,$linkRequired = true) {
    
    $u = new App_User($userid);
    $this->checkActiveUser($userid);
    $this->checkActiveCellphone($mobileid);

    //check ownership
    $this->checkOwnership("creditcard",$ccid,$userid,$mobileid,$linkRequired);

    //setup crypto
    $this->initCrypto("creditcard",$ccid);

    //get a transaction id
    $processor_transaction_id = App_Transaction_Transaction::GetProcessorTransactionId($mobileid);
    $extinfo["processor_transaction_id"] = $processor_transaction_id;

    //Use WigiSafe client to take out that much money
    $wsc = new App_WigiSafeClient();
    $res = $wsc->fromCreditCardToWigi($processor_transaction_id,$userid,$this->passphrase,$this->keyver,$ccid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor);

    if (!$res) {
      throw new App_Exception_WsException("Can not fund from this card");
      return false;
    }

    //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);

    $balance      = $c->getBalance();
    $temp_balance = $c->getTempBalance();

    //if (Zend_Registry::get('pp.env') === "live") {
      $c->addToBalance($amount);
      $balance      = $c->getBalance() + $amount;
      $temp_balance = $c->getTempBalance();
    //}


    //log transaction
    $cres = $u->getCreditCard($ccid);
    App_Transaction_Transaction::log(App_Transaction_Type::FUND_FROM_CREDIT_CARD_PENDING,'Credit',$amount,$balance,$temp_balance,$mobileid,'0',App_Transaction_Type::getConstName(App_Transaction_Type::FUND_FROM_CREDIT_CARD_PENDING),$c->getFmtCellphone(),$cres['description'] . " " . $cres['last4'],$userid,"",$u->getEmail(),"","",$extinfo);
    
  }

  public function fundToCreditCard($extinfo,$userid,$mobileid,$ccid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor,$linkRequired = true) {

    $u = new App_User($userid);

    $this->checkActiveUser($userid);
    $this->checkActiveCellphone($mobileid);

    //check ownership
    $this->checkOwnership("creditcard",$ccid,$userid,$mobileid,$linkRequired);

    //setup crypto
    $this->initCrypto("creditcard",$ccid);

    $this->checkMoney($mobileid,$amount);

    //get a transaction id
    $processor_transaction_id = App_Transaction_Transaction::GetProcessorTransactionId($mobileid);
    $extinfo["processor_transaction_id"] = $processor_transaction_id;

    //Use WigiSafe client to transfer funds
    $wsc = new App_WigiSafeClient();
    $res = $wsc->fromWigiToCreditCard($processor_transaction_id,$userid,$this->passphrase,$this->keyver,$ccid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor);

    if (!$res) {
      throw new App_Exception_WsException("Can not withdraw to card");
      return false;
    }

    //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);

    $balance      = $c->getBalance();
    $temp_balance = $c->getTempBalance();

    //if (Zend_Registry::get('pp.env') === "live") {
      $c->reduceFromBalance($amount);
      $c->reduceFromTempBalance($amount);

      $balance      = $c->getBalance() - $amount;
      $temp_balance = $c->getTempBalance() - $amount;
    //}

    //log transaction
    $cres = $u->getCreditCard($ccid);
    App_Transaction_Transaction::log(App_Transaction_Type::WITHDRAW_TO_CREDIT_CARD,'Debit',$amount,$balance,$temp_balance,$mobileid,'0',App_Transaction_Type::getConstName(App_Transaction_Type::WITHDRAW_TO_CREDIT_CARD),$c->getFmtCellphone(),$cres['description'] . " " . $cres['last4'],$userid,"",$u->getEmail(),"","",$extinfo);
    
  }

  public function testBankAccount($userid,$ba,$amount,$amount2,$first_name,$last_name,$routing,$zip,$address,$state,$type,$processor) {

    //setup crypto
    $this->initCrypto("current");

    //Use WigiSafe client to take out that much money
    $wsc = new App_WigiSafeClient();
    $res = $wsc->testBankAccount($userid,$this->passphrase,$this->keyver,$ba,$amount,$amount2,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor);

    if (!$res) {
      throw new App_Exception_WsException("Can not fund from this bank account");
      return false;
    }

  }

  public function addBankAccount($userid,$type,$bankaccount,$conf_number,$routing,$description,$conf_amt,$conf_amt2) {

   $this->initCrypto("current");

    $u = new App_User($userid);

    $this->checkActiveUser($userid);

    //use wigi safe client to add credit card
    $wsc = new App_WigiSafeClient();
    $id = $wsc->addBankAccount($userid,$this->keyver,$bankaccount,$conf_number,$u->getEmail());

    //insert into wigi_log database

    //insert into regular user database
    $last4 = substr($bankaccount,-4);
    $u->addBankAccount($id,$routing,$last4,$description,$this->keyver,$type,$conf_amt,$conf_amt2);
    return $id;
  }

  public function fundFromBankAccount($extinfo,$userid,$mobileid,$baid,$amount,$first_name,$last_name,$routing,$zip,$address,$state,$type,$processor,$linkRequired = true,$web_app="") {
    
    $u = new App_User($userid);

    $this->checkActiveUser($userid);
    $this->checkActiveCellphone($mobileid);

    //check ownership
    //$this->checkOwnership("bankaccount",$baid,$userid,$mobileid,$linkRequired);
			
    //setup crypto
    $this->initCrypto("bankaccount",$baid);

    //get a transaction id
    $processor_transaction_id = App_Transaction_Transaction::GetProcessorTransactionId($mobileid);
    $extinfo["processor_transaction_id"] = $processor_transaction_id;

    //Use WigiSafe client to transfer funds
    $wsc = new App_WigiSafeClient();  
    $res = $wsc->fromBankAccountToWigi($processor_transaction_id,$userid,$this->passphrase,$this->keyver,$baid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor);

    if (!$res) {
      //throw new App_Exception_WsException("Can not fund from this bank account");
      //return false;
    }

    //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);

    $balance      = $c->getBalance();
    $temp_balance = $c->getTempBalance();

	$cfg = Zend_Registry::get('config');
	$basepath = $cfg->paths->baseurl;
	
    //if (Zend_Registry::get('pp.env') === "live") {
      //$c->addToBalance($amount);
	  
		if($web_app == "App"){
			$return_url = "ru=".$basepath."v2/mobws/cellphone/banktransfer";
		}else{
			$return_url = "ru=".$basepath."v2/cw/money/banktransfer";
		}
	 
	  $TType = 'NBFundTransfer';
	  $product = 'NSE';
	  //$amount = '60';
	  $clientcode = $mobileid;
	  $AccountNo = '123456789012';
	  
	  $payment = new payment();
	  $this->paymentConfig = new payment_config();
	  $datenow = date("d/m/Y h:m:s");
		$modifiedDate = str_replace(" ", "%20", $datenow);
		$payment->url = $this->paymentConfig->Url;
		
		$postFields  = "";
		$postFields .= "&login=".$this->paymentConfig->Login;
		$postFields .= "&pass=".$this->paymentConfig->Password;
		$postFields .= "&ttype=".$TType;
		$postFields .= "&prodid=".$product;
		$postFields .= "&amt=".$amount;
		$postFields .= "&txncurr=".$this->paymentConfig->TxnCurr;
		$postFields .= "&txnscamt=".$this->paymentConfig->TxnScAmt;
		$postFields .= "&clientcode=".urlencode(base64_encode($clientcode));
		$postFields .= "&txnid=".rand(0,999999);
		$postFields .= "&date=".$modifiedDate;
		$postFields .= "&custacc=".$AccountNo;
		$postFields .= "&".$return_url;
		
		$sendUrl = $payment->url."?".substr($postFields,1)."\n";

		//$this->writeLog($sendUrl);
		
		$returnData = $payment->sendInfo($postFields);
		//$this->writeLog($returnData."\n");
		$xmlObjArray     = $this->xmltoarray($returnData);

		$url = $xmlObjArray['url'];
		$postFields  = "";
		$postFields .= "&ttype=".$TType;
		$postFields .= "&tempTxnId=".$xmlObjArray['tempTxnId'];
		$postFields .= "&token=".$xmlObjArray['token'];
		$postFields .= "&txnStage=1";
		$url = $payment->url."?".$postFields;
		//$this->writeLog($url."\n");
			
		header("Location: ".$url);
	  
	  
      $balance      = $c->getBalance() + $amount;
      $temp_balance = $c->getTempBalance();
    //} 
    //log transaction
    $cres = $u->getBankAccount($baid);
    App_Transaction_Transaction::log(App_Transaction_Type::FUND_FROM_BANK_ACCOUNT_PENDING,'Credit',$amount,$balance,$temp_balance,$mobileid,'0',App_Transaction_Type::getConstName(App_Transaction_Type::FUND_FROM_BANK_ACCOUNT_PENDING),$c->getFmtCellphone(),$cres['description'] . " " . $cres['last4'],$userid,"",$u->getEmail(),"","",$extinfo);
    
  }
function xmltoarray($data){
		$parser = xml_parser_create('');
		xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); 
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, trim($data), $xml_values);
		xml_parser_free($parser);
		
		$returnArray = array();
		$returnArray['url'] = $xml_values[3]['value'];
		$returnArray['tempTxnId'] = $xml_values[5]['value'];
		$returnArray['token'] = $xml_values[6]['value'];

		return $returnArray;
	}
  public function fundToBankAccount($extinfo,$userid,$mobileid,$baid,$amount,$first_name,$last_name,$routing,$zip,$address,$state,$type,$processor,$linkRequired = true) {

    $u = new App_User($userid);

    $this->checkActiveUser($userid);
    $this->checkActiveCellphone($mobileid);

    //check ownership
    //$this->checkOwnership("bankaccount",$baid,$userid,$mobileid,$linkRequired);

    //setup crypto
    $this->initCrypto("bankaccount",$baid);

    $this->checkMoney($mobileid,$amount);
    

    //get a transaction id
    $processor_transaction_id = App_Transaction_Transaction::GetProcessorTransactionId($mobileid);
    $extinfo["processor_transaction_id"] = $processor_transaction_id;

    $wsc = new App_WigiSafeClient();
    /*$res = $wsc->fromWigiToBankAccount($processor_transaction_id,$userid,$this->passphrase,$this->keyver,$baid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor);*/
	
    $res = $wsc->fromWigiToBankAccount($processor_transaction_id,$userid,$this->passphrase,$this->keyver,$baid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor);

    /*if (!$res) {
      throw new App_Exception_WsException("Can not withdraw to this bank account");
      return false;
    }*/

    //use safe client to take out that much money
    //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);

    $balance      = $c->getBalance();
    $temp_balance = $c->getTempBalance();


    //if (Zend_Registry::get('pp.env') === "live") {

      $c->reduceFromBalance($amount);
      $c->reduceFromTempBalance($amount);

      $balance      = $c->getBalance() - $amount;
      $temp_balance = $c->getTempBalance() - $amount;

    //}

    //log transaction
    $cres = $u->getBankAccount($baid);
    App_Transaction_Transaction::log(App_Transaction_Type::WITHDRAW_TO_BANK_ACCOUNT,'Debit',$amount,$balance,$temp_balance,$mobileid,'0',App_Transaction_Type::getConstName(App_Transaction_Type::WITHDRAW_TO_BANK_ACCOUNT),$c->getFmtCellphone(),$cres['description'] . " " . $cres['last4'],$userid,"",$u->getEmail(),"","",$extinfo);
    
  }

  public function merchantCashSale($extinfo,$userid,$mobileid,$amount) {
    $u = new App_User($userid);
    $c = new App_Cellphone($mobileid);
    
    $balance      = $c->getBalance();
    $temp_balance = $c->getTempBalance();

    //log transaction
    return App_Transaction_Transaction::log(App_Transaction_Type::CASH_SALE,'Info',$amount,$balance,$temp_balance,$mobileid,'0',App_Transaction_Type::getConstName(App_Transaction_Type::CASH_SALE),$c->getCellphone(),"",$userid,"",$c->getAlias() . ":" . $u->getEmail(),"","",$extinfo);

  }

  public function merchantCreditSale($extinfo,$userid,$mobileid,$amount,$creditcard,$expire_month,$expire_year,$cvv2,$type,$name,$zip,$address,$state) {
    $u = new App_User($userid);

    //Use WigiSafe client to transfer funds
    //$wsc = new App_WigiSafeClient();
    //$res = $wsc->fromBankAccountToWigi($userid,$this->passphrase,$this->keyver,$baid,$amount,$routing,$first_name,$last_name,$type,$processor);

    //if (!$res) {
    //  throw new App_Exception_WsException("Can not fund from this bank account");
    //  return false;
    //}

    //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);
    //$c->addToBalance($amount);

    //log transaction

    $balance      = $c->getBalance();
    $temp_balance = $c->getTempBalance();

    return App_Transaction_Transaction::log(App_Transaction_Type::CREDIT_SALE,'Info',$amount,$balance,$temp_balance,$mobileid,'0',App_Transaction_Type::getConstName(App_Transaction_Type::CREDIT_SALE),$c->getCellphone(),"",$userid,"",$c->getAlias() . ":" . $u->getEmail(),"","",$extinfo);

  }

} 
?>
