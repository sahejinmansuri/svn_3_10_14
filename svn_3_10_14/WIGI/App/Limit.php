<?php

class App_Limit {

  private $limits;
  private $id;
  private $order;
  private $dbh;

  public function __construct($id,$order) {

    $this->dbh = Zend_Registry::get('wigi');

    $query = "select * from view_limit where `owner_id` = '$id' and `order` = '$order' ";

    $stm = $this->dbh->query($query);
    $this->limits = $stm->fetchAll();
    $this->id = $id;
    $this->order = $order;

  }

  public static function create($type,$time_span,$limit,$order,$owner_id) {
      $sp = new App_Db_Sp_CreateLimit();
      $sp->getSimpleResponse(array('TYPE'=>$type, 'TIME_SPAN'=>$time_span,'LIMIT'=>$limit,'ORDER'=>$order,'OWNER_ID'=>$owner_id));
  }

  public function run() {

    foreach ($this->limits as $row) {
    
      $val = 0;
      $start_date = App_DataUtils::hoursAgo($row['time_span']);

      $t = new App_Transaction_Transaction();
  
      switch ($row['type']) {
        case 1:
          $val = $t->getNoCodes($start_date,$this->id);
          break;
        case 2:
          $val = $t->getAmountCodes($start_date,$this->id);
          break;
        case 3: 
          $val = $t->getNoCredit($start_date,$this->id);
          break;
        case 4:
          $val = $t->getAmountCredit($start_date,$this->id);
          break;
        case 5:
          $val = $t->getNoDebit($start_date,$this->id);
          break;
        case 6:
          $val = $t->getAmountDebit($start_date,$this->id);
          break;
        case 7:
          $val = $t->getNoSendMoney($start_date,$this->id);
          break;
        case 8:
          $val = $t->getAmountSendMoney($start_date,$this->id);
          break;
      }

      if ($val >= $row['limit']) {
        return false;
      }
      
    }
    return true;
  }


//for each system limit
//if type 1
//if type 2
//etc etc


}

?>
