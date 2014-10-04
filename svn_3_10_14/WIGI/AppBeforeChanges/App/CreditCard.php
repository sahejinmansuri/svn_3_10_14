<?php

class App_CreditCard extends App_Models_Db_Wigi_UserCreditCard {

  private $ccid;
  private $name_on_card;
  private $expire_month;
  private $expire_year;
  private $type;

  public function __construct($ccid) {

    parent::__construct();
    $result = $this->find($ccid)->current();

    $this->ccid            = $ccid;
    $this->name_on_card    = $result->name_on_card;
    $this->expire_month    = $result->expire_month;
    $this->expire_year     = $result->expire_year;
    $this->card_type       = $result->card_type;
    $this->conf_amt        = $result->conf_amt;
    $this->status          = $result->status;
    $this->key_version     = $result->key_version;
    $this->user_id         = $result->user_id;
    $this->zip             = $result->zip;
  }

  public function getId() {
    return $this->ccid;
  }

  public function getNameOnCard() {
    return $this->name_on_card;
  }

  public function getExpireMonth() {
    return $this->expire_month;
  }

  public function getExpireYear() {
    return $this->expire_year;
  }

  public function getCardType() {
    return $this->card_type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getConfAmt() {
    return $this->conf_amt;
  }

  public function getKeyVer() {
    return  $this->key_version;
  }

  public function getUserId() {
    return $this->user_id;
  }

  public function getZip() {
    return $this->zip;
  }


}

?>
