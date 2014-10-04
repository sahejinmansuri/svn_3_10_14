<?php

class App_BankAccount extends App_Models_Db_Wigi_UserBankAccount {

  private $baid;
  private $routing;
  private $type;

  public function __construct($baid) {

    parent::__construct();
    $result = $this->find($baid)->current();

    $this->baid            = $baid;
    $this->routing         = $result->routing;
    $this->bank_type       = $result->bank_type;
    $this->conf_amt        = $result->conf_amt;
    $this->conf_amt2       = $result->conf_amt2;
    $this->status          = $result->status;
    $this->key_version     = $result->key_version;
    $this->user_id         = $result->user_id;
    $this->lock_count      = $result->lock_count;
    $this->conf_amt_cleared= $result->conf_amt_cleared;
    $this->admin_cleared   = $result->admin_cleared;

  }

  public function getId() {
    return $this->baid;
  }

  public function getRouting() {
    return $this->routing;
  }

  public function getBankType() {
    return $this->bank_type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getConfAmt() {
    return $this->conf_amt;
  }

  public function getConfAmt2() {
    return $this->conf_amt2;
  }


  public function getKeyVer() {
    return $this->key_version;
  }

  public function getUserId() {
    return $this->user_id;
  }

  public function setStatus($status) {
  }

  public function getLockCount() {
    return $this->lock_count;
  }

  public function getConfAmtCleared() {
    return $this->conf_amt_cleared;
  }

  public function getAdminCleared() {
    return $this->admin_cleared;
  }

  public function increaseLockCount() {
    $cnt = $this->getLockCount() + 1;
    $this->update(
      array('lock_count' => $cnt),
      $this->getAdapter()->quoteInto('user_bank_account_id = ?', $this->baid)
    );


  }

  public function checkLockCount() {
    if ($this->getLockCount() >= 4) {
      throw new App_Exception_WsException('After too many unsuccessful confirmation attempts, this bank account has been locked');
    }
  }

  public function confirm($amt1,$amt2) {

    $this->checkLockCount();
    if ( ($this->conf_amt == $amt1) && ($this->conf_amt2 == $amt2) || ($this->conf_amt == $amt2) && ($this->conf_amt2 == $amt1) ) {

      $this->update(
                          array('conf_amt_cleared' => '1'),
                          $this->getAdapter()->quoteInto('user_bank_account_id = ?', $this->getId())
      );


      if ($this->getAdminCleared() == 1) {
      	$this->update(
        	            array('status' => 'active'),
                	    $this->getAdapter()->quoteInto('user_bank_account_id = ?', $this->getId())
      	);
      }

    } else {
      $this->increaseLockCount();
      throw new App_Exception_WsException('The amounts entered do not match the amounts sent. Please check your bank statement and confirm the amounts.');
    }

  }

  public function adminConfirm($status) {

      $this->update(
                          array('admin_cleared' => $status),
                          $this->getAdapter()->quoteInto('user_bank_account_id = ?', $this->getId())
      );


      //if ($this->getConfAmtCleared() == 1) {
        $this->update(
                            array('status' => 'active'),
                            $this->getAdapter()->quoteInto('user_bank_account_id = ?', $this->getId())
        );
      //}


  }

  public static function getBankAccounts() {
    $t = new App_Models_Db_Wigi_ViewAdminBankAccounts();

    $result = $t->fetchAll(
      $t->select()
        ->where('admin_cleared = ?', '0')
    );


    return $result;

  }

}

?>
