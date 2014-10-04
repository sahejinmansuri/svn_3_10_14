<?php

class App_WigiUsersSetting extends App_Models_Db_Wigi_WigiUsersSettings {

  private $uid;
  private $type;

  public function getWebUsersSettings($uid,$type='web'){
        //error_log("Mayur| wigi_admin_settings: Get InCashMe&trade; Settings");
        $res = $this->fetchAll($this->select()->from($this,array('category', 'value'))->where('status = ?','A')->where('useradded = ?',$uid));

        $tmp = $res->toArray();
		$a=array();
		foreach($tmp as $key=>$data)
	   {
			$a[str_replace(' ','_',$data['category'])] = $data['value'];
	   }
        return $a;
  }

  public function getMobwsUsersSettings($uid,$type='web'){
        //error_log("Mayur| wigi_admin_settings: Get InCashMe&trade; Settings");
        $res = $this->fetchAll($this->select()->from($this,array('category', 'value'))->where('status = ?','A')->where('useradded = ?',$uid));

        $tmp = $res->toArray();
		$a=array();
		$i=0;
		foreach($tmp as $key=>$data)
	   {
			$a[$i]['rolename'] = $data['category'];
			$a[$i]['value'] = $data['value'];
			$i++;
	   }
        return $a;
  }
   
  public function pdump($prefs){
      //return;
      $str = Zend_Json::encode($prefs);
      //error_log("prefs: value is as ". $str);    
  }
  public function insertUsersSettings($data)
	{
        $this->insert($data);
	}
	public function updateUsersSettings($data, $cat)
	{
		$this->update($data, array(
			'category = ? ' => $cat,
			'status = ? ' => 'A',
		));
	}
	
	
	
	
	
   
}

?>
