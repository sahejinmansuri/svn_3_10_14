<?php

class App_LockEngine {

  protected $passphrase;
  protected $keyver;



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


	public function lockpos($usermobid,$mobileid,$status)
	{
		
		$this->initCrypto("current");
   	$c = new App_Cellphone($mobileid);
   	$c->lockpos($usermobid,$mobileid,$status);
  		return $usermobid;
  }
	public function lockmerchant($userid,$mobileid,$status)
	{
		//$password = Atlasp_Utils::inst()->encryptPassword($passwd);
   	
		$this->initCrypto("current");
   	$c = new App_Cellphone($mobileid);
   	$c->lockmerchant($userid,$mobileid,$status);
  		return $userid;
  		
  }


  
} 
?>
