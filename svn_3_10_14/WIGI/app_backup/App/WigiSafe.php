<?php

class App_WigiSafe {
  
  private $userid;
  private $passphrase;
  private $keyver; 

  public function __construct($userid,$passphrase,$keyver) {
    $this->userid = $userid;
    $this->passphrase = $passphrase;
    $this->keyver = $keyver;
  }

  private function getCreditCard($ccid) {

    $cc = array();

    $sp = new App_Db_Sp_CcGet();
    $result = $sp->getSimpleResponse(array( 'USER_CREDIT_CARD_ID'=>$ccid ));

    $keyver = $result['@p_key_version'];

    $cc['user_id']          = $result['@p_user_id'];
    $cc['credit_card']      = App_Decrypt::decrypt($result['@p_credit_card'],$this->passphrase,$keyver);
    $cc['key_version']      = $result['@p_key_version'];

    return $cc;
  }

  public function fromCreditCardToWigi($processor_transaction_id,$accountid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor) {
    //should take in payment gateway as a parameter

    $cc = $this->getCreditCard($accountid);
    $pg = new App_PaymentGateway($processor_transaction_id,$processor,$amount,$type,$cc['credit_card'],$expire_month,$expire_year,$first_name,$last_name,$name_on_card,'','',$zip,$address,$state,'1');
    return $pg->makeTransfer();

  }

  public function fromWigiToCreditCard($processor_transaction_id,$accountid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor) {
    //should take in payment gateway as a parameter

    $cc = $this->getCreditCard($accountid);
   
    $pg = new App_PaymentGateway($processor_transaction_id,$processor,$amount,$type,$cc['credit_card'],$expire_month,$expire_year,$first_name,$last_name,$name_on_card,'','',$zip,$address,$state,'2');
    return $pg->makeTransfer();
  }

  public function addCreditCard($creditcard,$conf_number,$username) {
      $sp = new App_Db_Sp_CcCreate();
      $res = $sp->getSimpleResponse(array( 'CREDIT_CARD'=>$creditcard , 'KEY_VERSION'=> $this->keyver,'USERNAME'=>$username,'USERID'=>$this->userid,'CONF_NUMBER'=>$conf_number ));
      return $res['@p_res'];
  }

  private function getBankAccount($baid) {

    $sp = new App_Db_Sp_BaGet();
    $result = $sp->getSimpleResponse(array( 'USER_BANK_ACCOUNT_ID'=>$baid ));

    $ba = array();

    $keyver = $result['@p_key_version'];

    $ba['user_id']          = $result['@p_user_id'];
    $ba['bank_account']     = App_Decrypt::decrypt($result['@p_bank_account'],$this->passphrase,$keyver);
    $ba['key_version']      = $result['@p_key_version'];

    return $ba;
  }

  public function fromBankAccountToWigi($processor_transaction_id,$accountid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor) {
    $ba = $this->getBankAccount($accountid);
   
    $pg = new App_PaymentGateway($processor_transaction_id,$processor,$amount,$type,$ba['bank_account'],'','',$first_name,$last_name,'',$routing,'',$zip,$address,$state,'3');
    return $pg->makeTransfer();

  }

  public function fromWigiToBankAccount($processor_transaction_id,$accountid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor) {
    //should take in payment gateway as a parameter

    $ba = $this->getBankAccount($accountid);
   
    $pg = new App_PaymentGateway($processor_transaction_id,$processor,$amount,$type,$ba['bank_account'],'','',$first_name,$last_name,'',$routing,'',$zip,$address,$state,'4');
    return $pg->makeTransfer();
  }

  public function addBankAccount($bankaccount,$conf_number,$username) {

      $sp = new App_Db_Sp_BaCreate();
      $res = $sp->getSimpleResponse(array( 'BANK_ACCOUNT'=>$bankaccount , 'KEY_VERSION'=> $this->keyver,'USERNAME'=>$username,'USERID'=>$this->userid,'CONF_NUMBER'=>$conf_number ));
      return $res['@p_res'];
  }

  public function testBankAccount($accountno,$amount,$amount2,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor) {

    $pg1 = new App_PaymentGateway('',$processor,$amount,$type,$accountno,'','',$first_name,$last_name,'',$routing,'',$zip,$address,$state,'3');
    $pg1_res = $pg1->makeTransfer();
    if (!$pg1_res) return false;
 
    $pg2 = new App_PaymentGateway('',$processor,$amount2,$type,$accountno,'','',$first_name,$last_name,'',$routing,'',$zip,$address,$state,'3');
    $pg2_res = $pg2->makeTransfer();
    if (!$pg2_res) return false;

    $pg3 = new App_PaymentGateway('',$processor,$amount+$amount2,$type,$accountno,'','',$first_name,$last_name,'',$routing,'',$zip,$address,$state,'4');
    return $pg3->makeTransfer();
  }

  public function testCreditCard($accountno,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$cvv2,$zip,$address,$state,$type,$processor) {
    $pg = new App_PaymentGateway('',$processor,$amount,$type,$accountno,$expire_month,$expire_year,$first_name,$last_name,$name_on_card,'',$cvv2,$zip,$address,$state,'5');
    return $pg->makeTransfer();
  }

  public function addDocument($version,$data,$data2,$number) {
            $docmodel = new App_Models_Db_Wigisafe_DocData();
            $keyval = array(
               'key_version'  => $this->keyver,
               'doc_version' => $version,
               'number' => $number,
            );
            $docid = $docmodel->insert($keyval);

            mkdir("/u/data/$docid");
            file_put_contents("/u/data/$docid/front",$data);
            file_put_contents("/u/data/$docid/back",$data2);

            return $docid;
  }

  public function getCreditCardConfNumber($id) {
    $docmodel = new App_Models_Db_Wigisafe_UserCreditCard();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('user_credit_card_id = ?', $id)
    );

    $keyver = $row["key_version"];
    $passphrase = $this->passphrase;
    $result = "";

    $result['user_id']          = $row['user_id'];
    $result['conf_number']      = App_Decrypt::decrypt($row['conf_number'],$this->passphrase,$keyver);
    $result['key_version']      = $keyver;

    return $result;

  }

  public function getBankAccountConfNumber($id) {
    $docmodel = new App_Models_Db_Wigisafe_UserBankAccount();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('user_bank_account_id = ?', $id)
    );

    $keyver = $row["key_version"];
    $passphrase = $this->passphrase;
    $result = "";

    $result['user_id']          = $row['user_id'];
    $result['conf_number']      = App_Decrypt::decrypt($row['conf_number'],$this->passphrase,$keyver);
    $result['key_version']      = $keyver;

    return $result;

  }



  public function getDocumentData($docid,$type) {
    $docmodel = new App_Models_Db_Wigisafe_DocData();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('doc_data_id = ?', $docid)
    );

    $docdata = file_get_contents("/u/data/$docid/front"); 
    $docdata2 = file_get_contents("/u/data/$docid/back");
    $keyver = $row["key_version"];
    $passphrase = $this->passphrase;
    $result = "";

    if ($type === "FRONT") {
      $result = App_Decrypt::bigdecrypt($docdata,$passphrase,$keyver);
    } else if ($type === "BACK") {
      $result = App_Decrypt::bigdecrypt($docdata2,$passphrase,$keyver);
    }

    return $result;

  }
 
  public function getDocument($docid) {
    $docmodel = new App_Models_Db_Wigisafe_DocData();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('doc_data_id = ?', $docid)
    );

    $number = $row["number"];
    $keyver = $row["key_version"];
    $passphrase = $this->passphrase;

    $result = array();
    $result["number"] = App_Decrypt::decrypt($number,$passphrase,$keyver);
    return $result;

  }

 
  public function deleteDocument($docid) {
    $docmodel = new App_Models_Db_Wigisafe_DocData();

    $row = $docmodel->fetchRow(
      $docmodel->select()
        ->where('mobile_id = ?', $this->mobileid)
    );

    return App_Decrypt::decrypt($row["doc_data"],$this->passphrase,$row["key_version"]);

  }

  public function updateDocument($docid,$version,$data,$data2,$number) {
    $docmodel = new App_Models_Db_Wigisafe_DocData();

    $docmodel->update(
                       array(
                              'number' => $number
                             ),
                             $docmodel->getAdapter()->quoteInto('doc_data_id = ?', $docid)
                      );

    if ($data !== "") {
      file_put_contents("/u/data/$docid/front",$data);
    }

    if ($data2 !== "") {
      file_put_contents("/u/data/$docid/back",$data2);
    }


  }



}

?>
