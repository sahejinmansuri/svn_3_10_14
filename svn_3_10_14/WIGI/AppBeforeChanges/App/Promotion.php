<?php

class App_Promotion extends App_Models_Db_Wigi_Promotion {

  private $id;
  private $start;
  private $end;
  private $userid;
  private $amount;
  private $qty;

  public function __construct($id) {

    parent::__construct();
    $result = $this->find($id)->current();

    $this->id              = $id;
    $this->name_on_card    = $result->name_on_card;
  }

  public function getId() {
    return $this->id;
  }

  public function reduceQty($num) {
  
  }

  public function createWigiCode($dstmobileid) {
    //make sure that the dstmobileid has never redeemed the promotion 
    //make sure there's enough qty left
    //make sure current date is between start/end date 
    //figure out expiration date
    //create wigicode as normal from WigiEngine
  }

}

?>
