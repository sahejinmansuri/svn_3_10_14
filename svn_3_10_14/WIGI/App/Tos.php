<?php
class App_Tos {
  
  private $tosid;

  public function __construct($tosid) {
    $this->$tosid = $tosid;
  }

  public static function create($username,$tos) {
    $sp = new App_Db_Sp_CreateTos();
    $sp->getSimpleResponse(array( 'UNAME'=>$username, 'TOS' => $tos));
  }
  
  public static function getCurrentTos() {

    $t = new App_Models_Db_Wigi_ViewCurrentTos();

    $rows = $t->fetchRow(
      $t->select()
      
    );

    return $rows;
  }

}
?>
