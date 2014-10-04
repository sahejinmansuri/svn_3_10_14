<?php

class App_WigiSafeClient {

  public $path;

  public function __construct() {
        $cfg = Zend_Registry::get('config');
        $this->path = $cfg->paths->wigisafe;    
  }

  public function creditCardSale($processor_transaction_id,$amount,$name_on_card,$expire_month,$expire_year,$cvv2,$creditcard,$zip,$address,$state,$type,$processor) {

    $params = array('NAME_ON_CARD'=>$name_on_card,
                    'EXPIRE_MONTH'=>$expire_month,
                    'EXPIRE_YEAR'=>$expire_year,
                    'TYPE'=>$type,
                    'CVV2'=>$cvv2,
                    'CREDITCARD'=>$creditcard,
                    'PROCESSOR'=>$processor,
                    'AMOUNT'=>$amount,
                    'ZIP'=>$zip,
                    'ADDRESS'=>$address,
                    'STATE'=>$state,
                    'PROCESSOR_TRANSACTION_ID'=>$processor_transaction_id);

    $client = new Zend_Http_Client($this->path . 'creditcardsale', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();
    error_log("response is $response");

    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }

  }

  public function testCreditCard($userid,$passphrase,$keyver,$creditcard,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$cvv2,$zip,$address,$state,$type,$processor) {

    $params = array('USERID'=>$userid,
                    'PASSPHRASE'=>$passphrase,
                    'KEYVER'=>$keyver,
                    'FIRST_NAME'=>$first_name,
                    'LAST_NAME'=>$last_name,
                    'NAME_ON_CARD'=>$name_on_card,
                    'EXPIRE_MONTH'=>$expire_month,
                    'EXPIRE_YEAR'=>$expire_year,
                    'TYPE'=>$type,
                    'PROCESSOR'=>$processor,
                    'CREDITCARD'=>$creditcard,
                    'CVV2'=>$cvv2,
                    'ZIP'=>$zip,
                    'ADDRESS'=>$address,
                    'STATE'=>$state,
                    'AMOUNT'=>$amount);

    $client = new Zend_Http_Client($this->path . 'testcreditcard', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }

  }

  public function testBankAccount($userid,$passphrase,$keyver,$bankaccount,$amount,$amount2,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor) {

    $params = array('USERID'=>$userid,
                    'PASSPHRASE'=>$passphrase,
                    'KEYVER'=>$keyver,
                    'FIRST_NAME'=>$first_name,
                    'LAST_NAME'=>$last_name,
                    'TYPE'=>$type,
                    'PROCESSOR'=>$processor,
                    'BANKACCOUNT'=>$bankaccount,
                    'ROUTING'=>$routing,
                    'ZIP'=>$zip,
                    'ADDRESS'=>$address,
                    'STATE'=>$state,
                    'AMOUNT'=>$amount,
                    'AMOUNT2'=>$amount2);
      
    $client = new Zend_Http_Client($this->path . 'testbankaccount', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }

  }



  public function addCreditCard($userid,$keyver,$creditcard,$conf_number,$username) {
    $params = array('USERID'=>$userid,'KEYVER'=>$keyver,'CREDITCARD'=>App_Encrypt::encrypt($creditcard,$keyver),'CONF_NUMBER'=>App_Encrypt::encrypt($conf_number,$keyver),'USERNAME'=>$username);
    $client = new Zend_Http_Client($this->path . 'addcreditcard', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }

  }

  public function addBankAccount($userid,$keyver,$bankaccount,$conf_number,$username) {
    $params = array('USERID'=>$userid,'KEYVER'=>$keyver,'BANKACCOUNT'=>App_Encrypt::encrypt($bankaccount,$keyver),'CONF_NUMBER'=>App_Encrypt::encrypt($conf_number,$keyver),'USERNAME'=>$username);
    $client = new Zend_Http_Client($this->path . 'addbankaccount', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();
  
    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }
   
  }

 

  public function addDocument($mobileid,$version,$keyver,$data,$data2,$number) {

    $encdata  = App_Encrypt::bigencrypt($data,$keyver);

    $encdata2 = App_Encrypt::bigencrypt($data2,$keyver);
    $params = array('MOBILEID'=>$mobileid,'KEYVER'=>$keyver,'NUMBER'=>App_Encrypt::encrypt($number,$keyver),'VERSION'=>$version,'DATA'=>$encdata['data'],'DATA2'=>$encdata2['data']);
    $client = new Zend_Http_Client($this->path . 'adddocument', array(
      'maxredirects' => 0,
      'timeout'      => 30));

    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    $result = Zend_Json::decode($response);

    if ($result['status'] === 'success') {
      $id =  $result['data'];
      file_put_contents("/u/data/$id/front.key",$encdata['key']);
      file_put_contents("/u/data/$id/back.key",$encdata2['key']);
      return $id;
    } else {
      return 0;
    }

  }

  public function updateDocument($docid,$mobileid,$version,$keyver,$data,$data2,$number) {

    $encdata['data'] = ""; $encdata2['data'] = "";

    if ($data !== "") {
      $encdata = App_Encrypt::bigencrypt($data,$keyver);
    }

    if ($data2 !== "") {
      $encdata2 = App_Encrypt::bigencrypt($data2,$keyver);
    }

    $params = array('DOCID'=>$docid,'MOBILEID'=>$mobileid,'KEYVER'=>$keyver,'NUMBER'=>App_Encrypt::encrypt($number,$keyver),'VERSION'=>$version,'DATA'=>$encdata['data'],'DATA2'=>$encdata2['data']);
    $client = new Zend_Http_Client($this->path . 'updatedocument', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    error_log("WSC response" . $response);

    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {

    if ($data !== "") {
      file_put_contents("/u/data/$docid/front.key",$encdata['key']); 
    }

    if ($data2 !== "") {
      file_put_contents("/u/data/$docid/back.key",$encdata2['key']);
    }

      return $result['data'];

    } else {
      return 0;
    }

  }


  public function getDocument($mobileid,$passphrase,$keyver,$docid) {
    $params = array('MOBILEID'=>$mobileid,'KEYVER'=>$keyver,'PASSPHRASE'=>$passphrase,'DOCID'=>$docid);
    $client = new Zend_Http_Client($this->path . 'getdocument', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }

  }

  public function getDocumentData($mobileid,$passphrase,$keyver,$docid,$type) {
    $params = array('MOBILEID'=>$mobileid,'KEYVER'=>$keyver,'PASSPHRASE'=>$passphrase,'DOCID'=>$docid,'TYPE'=>$type);
    $client = new Zend_Http_Client($this->path . 'getdocumentdata', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    return $response;

  }

  public function getCreditCardConfNumber($userid,$passphrase,$keyver,$id) {
    $params = array('USERID'=>$userid,'KEYVER'=>$keyver,'PASSPHRASE'=>$passphrase,'ID'=>$id);
    $client = new Zend_Http_Client($this->path . 'getcreditcardconfnumber', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    return $response;

  }

  public function getBankAccountConfNumber($userid,$passphrase,$keyver,$id) {
    $params = array('USERID'=>$userid,'KEYVER'=>$keyver,'PASSPHRASE'=>$passphrase,'ID'=>$id);
    $client = new Zend_Http_Client($this->path . 'getbankaccountconfnumber', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();

    return $response;

  }



  public function fromCreditCardToWigi($processor_transaction_id,$userid,$passphrase,$keyver,$accountid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor) {

    $params = array('USERID'=>$userid,
		    'PASSPHRASE'=>$passphrase,
		    'KEYVER'=>$keyver,
                    'FIRST_NAME'=>$first_name,
                    'LAST_NAME'=>$last_name,
                    'NAME_ON_CARD'=>$name_on_card,
                    'EXPIRE_MONTH'=>$expire_month,
                    'EXPIRE_YEAR'=>$expire_year,
                    'TYPE'=>$type,
                    'PROCESSOR'=>$processor,
                    'PROCESSOR_TRANSACTION_ID'=>$processor_transaction_id,
                    'ACCOUNTID'=>$accountid,
                    'ZIP'=>$zip,
                    'ADDRESS'=>$address,
                    'STATE'=>$state,
                    'AMOUNT'=>$amount);

    $client = new Zend_Http_Client($this->path . 'fromcreditcardtowigi', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();
 error_log($response); 
    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }

  }

  public function fromWigiToCreditCard($processor_transaction_id,$userid,$passphrase,$keyver,$accountid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor) {
    $params = array('USERID'=>$userid,
		    'PASSPHRASE'=>$passphrase,
		    'KEYVER'=>$keyver,
                    'FIRST_NAME'=>$first_name,
                    'LAST_NAME'=>$last_name,
                    'NAME_ON_CARD'=>$name_on_card,
                    'EXPIRE_MONTH'=>$expire_month,
                    'EXPIRE_YEAR'=>$expire_year,
                    'ZIP'=>$zip,
                    'ADDRESS'=>$address,
                    'STATE'=>$state,
                    'EXPIRE_YEAR'=>$state,
                    'TYPE'=>$type,
                    'PROCESSOR'=>$processor,
                    'PROCESSOR_TRANSACTION_ID'=>$processor_transaction_id,
                    'ACCOUNTID'=>$accountid,
                    'AMOUNT'=>$amount);

    $client = new Zend_Http_Client($this->path . 'fromwigitocreditcard', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();
    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }
  }

  public function fromBankAccountToWigi($processor_transaction_id,$userid,$passphrase,$keyver,$accountid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor) {
    $params = array('USERID'=>$userid,
		    'PASSPHRASE'=>$passphrase,
		    'KEYVER'=>$keyver,
                    'FIRST_NAME'=>$first_name,
                    'LAST_NAME'=>$last_name,
                    'ROUTING'=>$routing,
                    'TYPE'=>$type,
                    'ZIP'=>$zip,
                    'ADDRESS'=>$address,
                    'STATE'=>$state,
                    'PROCESSOR'=>$processor,
                    'PROCESSOR_TRANSACTION_ID'=>$processor_transaction_id,
                    'ACCOUNTID'=>$accountid,
                    'AMOUNT'=>$amount);

    $client = new Zend_Http_Client($this->path . 'frombankaccounttowigi', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();
    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }

  }

  public function fromWigiToBankAccount($processor_transaction_id,$userid,$passphrase,$keyver,$accountid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor) {
    $params = array('USERID'=>$userid,
		    'PASSPHRASE'=>$passphrase,
		    'KEYVER'=>$keyver,
                    'FIRST_NAME'=>$first_name,
                    'LAST_NAME'=>$last_name,
                    'ROUTING'=>$routing,
                    'TYPE'=>$type,
                    'PROCESSOR'=>$processor,
                    'ZIP'=>$zip,
                    'ADDRESS'=>$address,
                    'STATE'=>$state,
                    'PROCESSOR_TRANSACTION_ID'=>$processor_transaction_id,
                    'ACCOUNTID'=>$accountid,
                    'AMOUNT'=>$amount);

    $client = new Zend_Http_Client($this->path . 'fromwigitobankaccount', array(
      'maxredirects' => 0,
      'timeout'      => 30));
    $client->setParameterPost($params);
    $response = $client->request('POST')->getBody();
  
    $result = Zend_Json::decode($response);
    if ($result['status'] === 'success') {
      return $result['data'];
    } else {
      return 0;
    }
  }


}
?>