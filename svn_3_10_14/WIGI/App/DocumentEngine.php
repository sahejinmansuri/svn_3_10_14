<?php

class App_DocumentEngine {

  protected $passphrase;
  protected $keyver;

  public function checkOwner($docid,$mobileid) {
    $c = new App_Cellphone($mobileid);
    $cres = $c->getDocument($docid);

    if ($cres["mobile_id"] !== $mobileid) {
      throw new App_Exception_WsException('You do not own this document'); 
    }

  }

  public function initCrypto($type,$id=0) {
    $this->initKeyVer($type,$id);
    $this->initPassphrase();
  }

  public function initKeyVer($type,$id) {

    if ($type === "current") {

        $this->keyver = Zend_Registry::get('config')->keyver;

    } else if ($type === "document") {

        $cc = new App_CreditCard($id);
        $this->keyver = $cc->getKeyVer();

    }
  }

  public function initPassphrase() {

    $this->passphrase = file_get_contents("/var/www/html/incash/etc/wigi-keys/v" . $this->keyver . "/passphrase");
    $this->passphrase = rtrim($this->passphrase);

  }

  public function addDocument($mobileid,$doctype,$version,$description,$data,$data2,$number,$expires) {

    $this->initCrypto("current");

    $c = new App_Cellphone($mobileid);
    $userid = $c->getUserId();
    //$u = new App_User($userid);

    if (count($this->getDocuments($mobileid)) >= 20) {
      throw new App_Exception_WsException("My Documents is limited to 20 documents. Please delete documents to add more.");
      return false;
    }

    //use wigi safe client to add credit card
    $wsc = new App_WigiSafeClient();
    $id = $wsc->addDocument($userid,$version,$this->keyver,$data,$data2,$number); 

    if ($id == 0) {
      throw new App_Exception_WsException("Unable to add document at this time");
      return false;
    }
  
    //insert into regular user database
    $c->addDocument($id,$doctype,$version,$description,$this->keyver,$expires);
    return $id;
  }

  public function updateDocument($docid,$mobileid,$doctype,$version,$description,$data,$data2,$number,$expires,$same,$same2) {
	error_log("DOCID  new: ".$docid);
    $this->checkOwner($docid,$mobileid);

    $this->initCrypto("current");
   
   $c = new App_Cellphone($mobileid);
    $userid = $c->getUserId();
    $u = new App_User($userid);

    //use wigi safe client to add credit card
    $wsc = new App_WigiSafeClient();
    $wsc->updateDocument($docid,$userid,$version,$this->keyver,$data,$data2,$number,$expires,$same,$same2);

    if ($docid == 0) { //instead of id put docid by attune
      throw new App_Exception_WsException("Unable to update document at this time");
      return false;
    }

    //insert into regular user database
    $c->updateDocument($docid,$doctype,$version,$description,$this->keyver,$expires);
    return $docid;
  }


  public function getDocument($mobileid,$docid) {

    $this->checkOwner($docid,$mobileid);

    $this->initCrypto("current");
    
    //Use WigiSafe client to transfer funds
    $wsc = new App_WigiSafeClient();  
    $res = $wsc->getDocument($mobileid,$this->passphrase,$this->keyver,$docid);

    if (!$res) {
      throw new App_Exception_WsException("Unable to retrieve this document at this time.");
      return false;
    }

    //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);
    $cres = $c->getDocument($docid);

    $result = array();
    $result["doc_id"]      = $cres["doc_info_id"];
    $result["expiration"]  = App_DataUtils::datetime_fmtdate($cres["expiration"],"");
    $result["type"]        = $cres["doc_type"];
    $result["description"] = $cres["description"];
    $result["number"]      = $cres["number"];
    $result["editable"]      = $cres["editable"];
    return $result;

  }

  public function getDocumentData($mobileid,$docid,$type) {

    $this->checkOwner($docid,$mobileid);

    $this->initCrypto("current");

    $key = "";

    if ($type === "FRONT") {
      $key = file_get_contents("/var/www/html/incash/u/data/$docid/front.key");
    } else if ($type === "BACK") {
      $key = file_get_contents("/var/www/html/incash/u/data/$docid/back.key");
    }
	$docdata = file_get_contents("/var/www/html/incash/u/data/$docid/front"); 
    $docdata2 = file_get_contents("/var/www/html/incash/u/data/$docid/back");
    $keyver = $this->keyver;
    //$passphrase = $this->passphrase;
    $result = "";

    if ($type === "FRONT") {
		 //$front_key = file_get_contents("/var/www/html/incash/u/data/$docid/front.key"); 
      $result = App_Decrypt::docdecrypt($docdata,$key,$keyver);
    } else if ($type === "BACK") {
		 //$back_key = file_get_contents("/var/www/html/incash/u/data/$docid/front.key"); 
      $result = App_Decrypt::docdecrypt($docdata2,$key,$keyver);
    }

    //Use WigiSafe client to transfer funds
    /*$wsc = new App_WigiSafeClient();
    $res = $wsc->getDocumentData($mobileid,$key,$this->keyver,$docid,$type);
    if (!$res) {
     throw new App_Exception_WsException("Unable to retrieve this document at this time.");
      return false;
    }*/

    return $result;

  }

  public function getDocuments($mobileid) {
    $c = new App_Cellphone($mobileid);
    $a = $c->getDocuments();

    $result = array();
    foreach($a as $row) {
      $b["description"]		 = $row->description;
      $b["doc_id"]       	 = $row->doc_info_id;
	  $b["type"]         	 = $row->doc_type;
	  $b["editable"]         = $row->editable;
      array_push($result,$b);
    }
    return $result;
  }

  public function deleteDocument($mobileid,$docid) {
    $c = new App_Cellphone($mobileid);
    $c->deleteDocument($docid);

  }



 	public function getinvoice($mobileid,$amount) {

        //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);
    $cres = $c->getinvoice($amount);

    $result = array();
    $result["invoice_number"]      = $cres["order_id"];
    $result["accepted_currency"]      = 'INR';
    //$result["price"]        = $cres["price"];
    $result["description"] = $cres["description"];
    $result["due_date"]      = $cres["due_date"];
    $result["consumer_mobile_id"]      = $cres["consumer_mobile_id"];
    $result["merchant_mobile_id"]      = $cres["merchant_mobile_id"];
    $result["donate_start_date"]      = $cres["donate_start_date"];
    $result["donate_end_date"]      = $cres["donate_end_date"];
    return $result;

  }
} 
?>
