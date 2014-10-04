<?php

class App_WigiSystemMaintainence extends App_Models_Db_Wigi_SystemMaintainence {

  private $appid;
  private $type;

  // select TO_DAYS(end_time), TO_DAYS(start_time), TO_DAYS(NOW()),now(), start_time, end_time from system_maintainence where app='aw' and now()<start_time and (TO_DAYS(start_time) - to_days(now()))=1
  public function getMaintainenceInfo($appid){
        $res = $this->fetchAll($this->select()->from($this)
				->where('app = ?',$appid)
				->where('status = ?','A')
				->where('start_time < now()')
				->where('end_time > now()')
			);

        $tmp = $res->toArray();
        return $tmp;
  }

  public function getAllMaintainenceInfo(){
        $res = $this->fetchAll($this->select()->from($this)
				->where('status = ?','A'));
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
