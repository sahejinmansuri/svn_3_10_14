<?php

class App_Merchant extends App_Db_Models_Wigi_Company {

  public function __construct($merchantid) {

    parent::__construct();

    $result = $this->find($merchantid)->current();
    if(!$result){
	    error_log("merchant $merchantid does not exist");
        throw new App_Exception_WsException('Merchant ID does not exist');
    	return false;
    }	

  }

  public function getMerchantId() {
    return $this->merchantid;
  }

  public function getEmail() {
    return $this->email;
  }

  public static function getIdFromEmail($email) {

    /*$dbh = DataUtils::getDBHandle();
    $stm = $dbh->query("call sp_get_mobile_id_from_cellphone('$cellphone',@id)");
    while ($stm->nextRowset()) { }
    
    $stm = $dbh->prepare("select @id as id");
    $stm->execute();
    $result = $stm->fetchAll();

    return $result[0]['id'];*/
  }

  public static function merchantIdExists($merchantid) {
    /*$dbh = DataUtils::getDBHandle();
    $stm = $dbh->query("call sp_mobile_id_exists('$mobileid',@res)");
    while ($stm->nextRowset()) { }
    
    $stm = $dbh->prepare("select @res as res");
    $stm->execute();
    $result = $stm->fetchAll();

    return $result[0]['res'];*/
  }

  public static function create() {

  }

  public function authorizeUser ($userid,$type) {

  }

  public function addPos($osid) {

  }

}

?>
