<?php

class App_WigiCode extends App_Models_Db_Wigi_WigiCode {

  private $code;
  private $srcid;
  private $dstid;
  private $amount;


  public function __construct($code,$mobileid) {

    parent::__construct();

    $result = $this->fetchRow(
      $this->select()
        ->where('wigi_code_id = ?', $code)
        ->where('from_mobile_id = ?' , $mobileid )
    );


    $this->wigicode                 = $result->wigi_code_id;
    $this->from_id                  = $result->from_mobile_id;
    $this->to_id                    = $result->to_mobile_id;
    $this->amount                   = $result->amount;
    $this->status                   = $result->status;
  }

  public function getWigiCode() {
    return $this->wigicode;
  }

  public function getFromId() {
    return $this->from_id;
  }

  public function getToId() {
    return $this->to_id;
  }  

  public function getAmount() {
    return $this->amount;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setPending($to_mobile_id) {
                                $this->update(
                                        array(
                                                'status' => "pending", 'to_mobile_id' => $to_mobile_id
                                        ),
                                        $this->getAdapter()->quoteInto('wigi_code_id = ? AND ', $this->wigicode) . $this->getAdapter()->quoteInto('from_mobile_id = ? AND ', $this->from_id) .
					$this->getAdapter()->quoteInto('status = ?', "active")
                                );

  }

}

?>
