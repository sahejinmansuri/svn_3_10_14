<?php

class App_WigiUserSetting extends App_Models_Db_Wigi_WigiUserSettings {

  private $uid;
  private $type;

  public function getWebUserSettings($uid,$type='web'){
        //error_log("HITESH| wigi_user_settings: get user settings for uid $uid");
        $res = $this->fetchAll($this->select()->from($this,array('category', 'value'))->where('user_id = ?',$uid)->where('status = ?','A'));

        /*if(!$res){
            $data = array(
                'user_id' => $uid,
                'category'=> 'web',
                'prefs'   => Zend_Json::encode($this->defaultPrefs),
            );
            $this->insert($data);
            $this->webUserPrefs = $this->defaultPrefs;
            error_log("prefs : new");$this->pdump($this->webUserPrefs[$type]);
            return $this->webUserPrefs[$type];
        }*/   

        $tmp = $res->toArray();
		$a=array();
		foreach($tmp as $key=>$data)
	   {
			$a[str_replace(' ','_',$data['category'])] = $data['value'];
	   }
        return $a;
  }

   
  public function pdump($prefs){
      //return;
      $str = Zend_Json::encode($prefs);
      //error_log("prefs: value is as ". $str);    
  }
}

?>
