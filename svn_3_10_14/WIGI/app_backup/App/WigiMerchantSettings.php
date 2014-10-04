<?php

class App_WigiMerchantSettings extends App_Models_Db_Wigi_WigiMerchantSettings {

  private $uid;
  private $type;

  public function getMerchantSettings($uid,$type='web'){
        error_log("getMerchantSettings: get Merchant settings for uid $uid");
        $res = $this->fetchAll($this->select()->from($this,array('category', 'value'))->where('user_id = ?',$uid)->where('status = ?','A'));

        $tmp = $res->toArray();
		$a=array();
		foreach($tmp as $key=>$data)
	   {
			$a[str_replace(' ','_',$data['category'])] = $data['value'];
	   }
        return $a;
  }

  public function getMerchantSetting($uid,$category, $type='web'){
        error_log("getMerchantSettings: get Merchant settings for uid $uid");
        $res = $this->fetchAll(
			$this->select()->from($this,array('category', 'value'))
			->where('user_id = ?',$uid)
			->where('status = ?','A')
			->where('category = ?',$category)
		);

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
      error_log("prefs: value is as ". $str);    
  }

    public function insertMerchantSettings($data)
	{
        $this->insert($data);
	}

    public function updateMerchantSettings($data, $cat)
	{
		$this->update($data, array(
			'category = ? ' => $cat,
			'status = ? ' => 'A',
		));
	}

    public function updateMerchantSetting($data, $cat,$uid)
	{
		$this->update($data, array(
			'category = ? ' => $cat,
			'user_id = ? ' => $uid,
			'status = ? ' => 'A',
		));
	}

}

?>
