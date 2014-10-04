<?php

class App_WigiDbBackUp extends App_Models_Db_Wigi_DBBackUp {

  private $appid;
  private $type;

  public function getDbBackUp(){
        $res = $this->fetchAll($this->select()->from($this));
        $tmp = $res->toArray();
        return $tmp;
  }

   
  public function pdump($prefs){
      //return;
      $str = Zend_Json::encode($prefs);
      error_log("prefs: value is as ". $str);    
  }
}

?>
