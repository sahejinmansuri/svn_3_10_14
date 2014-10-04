<?php

class App_WigiAdminSettings extends App_Models_Db_Wigi_WigiAdminSettings {

  private $uid;
  private $type;

  public function getAdminSetting(){
        //error_log("Mayur| wigi_admin_settings: Get InCashMe&trade; Settings");
        $res = $this->fetchAll($this->select()->from($this,array('category', 'value'))->where('status = ?','A'));

        $tmp = $res->toArray();
		$a=array();
		foreach($tmp as $key=>$data)
	   {
			$a[str_replace(' ','_',$data['category'])] = $data['value'];
	   }
        return $a;
  }

  public function getAdminBillingByDates($datefrom, $dateto){
	  $select = $this->select()->from($this,array('wigi_admin_settings_id', 'value','datefrom','dateto'))
			->where('status = ?','A')
			->where('category like ?','%Special Billing')
			->where('(datefrom <= ? and dateto >= ?',$datefrom,$datefrom)
			->orwhere('datefrom <= ? and dateto >= ?)',$dateto,$dateto);

		$res = $this->fetchAll($select);
		return $res->toArray();

  }

  public function getCurrentAdminSpecialBilling(){
	  $select = $this->select()->from($this,array('wigi_admin_settings_id', 'value','datefrom','dateto'))
			->where('status = ?','A')
			->where('category like ?','%Special Billing')
			->where('datefrom <= now() and dateto >= now()');

		$res = $this->fetchAll($select);
		return $res->toArray();
  }

  public function getAdminSettingbyCategory($cat){
        $res = $this->fetchAll($this->select()->from($this,array('category', 'value'))->where('category = ?',$cat)->where('status = ?','A'));

        $tmp = $res->toArray();
		$a=array();
		foreach($tmp as $key=>$data)
	   {
			$a[str_replace(' ','_',$data['category'])] = $data['value'];
	   }
        return $a;
  }

    public function insertAdminSettings($data)
	{
        $this->insert($data);
	}

    public function updateAdminSettings($data, $cat)
	{
		$this->update($data, array(
			'category = ? ' => $cat,
			'status = ? ' => 'A',
		));
	}
   
  public function pdump($prefs){
      //return;
      $str = Zend_Json::encode($prefs);
      error_log("prefs: value is as ". $str);    
  }


  /*public function getSpecialBilling($datefrom, $dateto){
        $res = $this->fetchAll(
			$this->select()
				->from($this,array('category', 'value','datefrom','dateto','wigi_admin_settings_id'))
				->where('status = ?','A')
				->where('category = ?','Special Billing')
				->where('datefrom >= ?',$datefrom)
				->where('dateto <= ?',$dateto)
		);

        $tmp = $res->toArray();
		$a=array();
		foreach($tmp as $key=>$data)
	   {
			$a[str_replace(' ','_',$data['category'])] = $data['value'];
	   }
        return $a;
  }*/

}

?>
