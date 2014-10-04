<?php

class App_MainmenuEngine {

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

  public function addmainmenu($userid, $mobileid,$title,$description,$data) {
  	
    $this->initCrypto("current");

    $c = new App_Cellphone($mobileid);
    $userid = $c->getUserId();
    
    //insert into regular user database
    $id = $c->addmainmenu($userid, $mobileid,$title,$description,$data);
    return $id;
  }



  public function updatemainmenu($main_menu_id,$mobileid,$title,$description,$data,$same) {

  //  $this->checkOwner($main_menu_id,$mobileid);
  
    $this->initCrypto("current");
   
   $c = new App_Cellphone($mobileid);
   // $userid = $c->getUserId();
   // $u = new App_User($userid);


    //insert into regular user database
   
    $c->updatemainmenu($main_menu_id,$title,$description,$data,$same);
  
    return $docid;
  }

public function updatesubmenu($sub_menu_id,$main_menu_id,$mobileid,$title,$description,$data,$same, $rate, $quantity) {
        
  //  $this->checkOwner($main_menu_id,$mobileid);
 
    $this->initCrypto("current");
   
   $c = new App_Cellphone($mobileid);
   // $userid = $c->getUserId();
   // $u = new App_User($userid);


    //insert into regular user database
    $c->updatesubmenu($sub_menu_id,$main_menu_id,$title,$description,$data,$rate, $quantity);
    return $docid;
  }

  public function getmainmenu($mobileid,$userid) {

   // $this->checkOwner($docid,$mobileid);

   // $this->initCrypto("current");
    
    //Use WigiSafe client to transfer funds
   /* $wsc = new App_WigiSafe();  
    $res = $wsc->getDocument($mobileid,$this->passphrase,$this->keyver,$docid);

    if (!$res) {
      throw new App_Exception_WsException("Unable to retrieve this document at this time.");
      return false;
    }*/

    //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);
    $cres = $c->getmainmenu($mobileid, $userid);

    $result = array();
    $result["main_menu_id"]      = $cres["main_menu_id"];
    $result["title"]        = $cres["title"];
    $result["description"] = $cres["description"];
    $result["menuimage"]      = $cres["menuimage"];
    return $result;

  }

  public function getDocumentData($mobileid,$docid,$type) {

    $this->checkOwner($docid,$mobileid);
    
    //Use WigiSafe client to transfer funds
    $wsc = new App_WigiSafe();
    $res = $wsc->getDocumentData($docid,$type);
    if (!$res) {
     throw new App_Exception_WsException("Unable to retrieve this document at this time.");
      return false;
    }

    return $res;

  }

 public function getmainmenudata($mobileid,$menuid) {
	
    //$this->checkOwner($menuid,$mobileid);
    
    //Use WigiSafe client to transfer funds
    //$wsc = new App_WigiSafe();
     $c = new App_Cellphone($mobileid);
    //$userid = $c->getUserId();
    $res = $c->getmainmenudata($menuid);
    if (!$res) {
     throw new App_Exception_WsException("Unable to retrieve this document at this time.");
      return false;
    }

    return $res;

  }

public function getsubmenudata($mobileid,$submenuid) {
	
    //$this->checkOwner($menuid,$mobileid);
    
    //Use WigiSafe client to transfer funds
    //$wsc = new App_WigiSafe();
     $c = new App_Cellphone($mobileid);
    //$userid = $c->getUserId();
    $res = $c->getsubmenudata($submenuid);
    if (!$res) {
     throw new App_Exception_WsException("Unable to retrieve this document at this time.");
      return false;
    }

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

public function getallmainmenu($mobileid) {
    $c = new App_Cellphone($mobileid);
    $a = $c->getallmainmenu($mobileid);

    $result = array();
    foreach($a as $row) {
    	$b["main_menu_id"]           = $row->main_menu_id;
      $b["title"]      = $row->title;
      $b["description"]      = $row->description;
      $b["menuimage"]      = $row->menuimage;
     
      array_push($result,$b);
    }
    return $result;
  }
  public function deletemainmenu($mobileid,$menuid) {
  	
    $c = new App_Cellphone($mobileid);
    $c->deletemainmenu($menuid);

  }
  public function deletesubmenu($mobileid,$submenuid) {
  	
    $c = new App_Cellphone($mobileid);
    $c->deletesubmenu($submenuid);

  }
	public function addsubmenu($mobileid,$menuid,$title,$description, $data, $rate, $quantity) {
  	
    $this->initCrypto("current");

    $c = new App_Cellphone($mobileid);
    $userid = $c->getUserId();
    
    //insert into regular user database
    $id = $c->addsubmenu($menuid, $title,$description, $data, $rate, $quantity);
    return $id;
  }
  public function getallsubmenu($mobileid) {
    $c = new App_Cellphone($mobileid);
    $a = $c->getallsubmenu();

    $result = array();
    foreach($a as $row) {
    	$b["sub_menu_id"]           = $row->sub_menu_id;
    	$b["main_menu_id"]           = $row->main_menu_id;
      $b["title"]      = $row->title;
      $b["description"]      = $row->description;
     // $b["menuimage"]      = $row->menuimage;
     
      array_push($result,$b);
    }
    return $result;
  }
  
  public function getallmainsubmenu($mobileid, $userid) {
    $c = new App_Cellphone($mobileid);
    $a = $c->getallmainsubmenu($mobileid, $userid);

    $result = array();
    foreach($a as $row) {
    	//$b["sub_menu_id"]           = $row->sub_menu_id;
    	$b["main_menu_id"]           = $row->main_menu_id;
      $b["title"]      = $row->title;
      $b["description"]      = $row->description;
     // $b["menuimage"]      = $row->menuimage;
      
       $c = new App_Cellphone($mobileid);
    	$cres = $c->getsubmenu($row->main_menu_id);

	    $b1 = array();
	    $result1 = array();
	    foreach($cres as $row) {
	    	$b1["sub_menu_id"]           = $row->sub_menu_id;
	    	$b1["main_menu_id"]           = $row->main_menu_id;
	      $b1["title"]      = $row->title;
	      $b1["description"]      = $row->description;
	      $b1["rate"]      = $row->rate;
	      $b1["max_quantity"]      = $row->max_quantity;
	     // $b1["submenuimg"]      = $row->submenuimg;
	     //	$image = imagecreatefromstring(base64_decode($row->submenuimg));
        //	header('Content-type: image/jpeg');
        	//imagejpeg($image);
	      array_push($result1,$b1);
	    }
	  $b['submenu'] = $result1;
    
      array_push($result,$b);
    }
    return $result;
  }
   public function getsubmenu($mobileid,$menuid) {

   
    //put that amount of money into the cache
    $c = new App_Cellphone($mobileid);
    $cres = $c->getsubmenu($menuid);

    $result = array();
    foreach($cres as $row) {
    	$b["sub_menu_id"]           = $row->sub_menu_id;
    	$b["main_menu_id"]           = $row->main_menu_id;
      $b["title"]      = $row->title;
      $b["description"]      = $row->description;
      $b["rate"]      = $row->rate;
      $b["max_quantity"]      = $row->max_quantity;
     
      array_push($result,$b);
    }
    return $result;

  }
  
} 
?>
