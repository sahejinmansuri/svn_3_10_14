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

    $this->passphrase = file_get_contents("/etc/wigi-keys/v" . $this->keyver . "/passphrase");
    $this->passphrase = rtrim($this->passphrase);

  }

  public function addDocument($mobileid,$doctype,$version,$description,$data,$data2,$number,$expires) {

    $this->initCrypto("current");

    $c = new App_Cellphone($mobileid);
    $userid = $c->getUserId();
    $u = new App_User($userid);

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

  public function updateDocument($docid,$mobileid,$doctype,$version,$description,$data,$data2,$number,$expires) {

    $this->checkOwner($docid,$mobileid);

    $this->initCrypto("current");


    $c = new App_Cellphone($mobileid);
    $userid = $c->getUserId();
    $u = new App_User($userid);

    //use wigi safe client to add credit card
    $wsc = new App_WigiSafeClient();
    $wsc->updateDocument($docid,$userid,$version,$this->keyver,$data,$data2,$number);

    //if ($id == 0) {
    //  throw new App_Exception_WsException("Unable to update document at this time");
    //  return false;
    //}

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
    $result["number"]      = $res["number"];
    return $result;

  }

  public function getDocumentData($mobileid,$docid,$type) {

    $this->checkOwner($docid,$mobileid);

    $this->initCrypto("current");

    $key = "";

    if ($type === "FRONT") {
      $key = file_get_contents("/u/data/$docid/front.key");
    } else if ($type === "BACK") {
      $key = file_get_contents("/u/data/$docid/back.key");
    }


    //Use WigiSafe client to transfer funds
    $wsc = new App_WigiSafeClient();
    $res = $wsc->getDocumentData($mobileid,$key,$this->keyver,$docid,$type);
    //if (!$res) {
    //  throw new App_Exception_WsException("Unable to retrieve this document at this time.");
    //  return false;
    //}

    return $res;

  }

  public function getDocuments($mobileid) {
    $c = new App_Cellphone($mobileid);
    $a = $c->getDocuments();

    $result = array();
    foreach($a as $row) {
      $b["description"]      = $row->description;
      $b["doc_id"]           = $row->doc_info_id;
      array_push($result,$b);
    }
    return $result;
  }

  public function deleteDocument($mobileid,$docid) {
    $c = new App_Cellphone($mobileid);
    $c->deleteDocument($docid);

  }

} 
?>
