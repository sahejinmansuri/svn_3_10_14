<?php

class App_Prefs extends App_Models_Db_Wigi_Preferences {

  private $uid;
  private $type;
  private $defaultPrefs;
  private $dbPrefs;
  private $webUserPrefs;
  private $cellPrefs;
    

  public function checkConstraint($prefs,$hardprefs,$throwexp=true) { 

      if ($hardprefs === "system") {
          $p = $this->getDefault();
          $hardprefs = $p["system"];
      }

      $error = 0; $errmsg = "";

//comment removed_s
      if ($prefs["system"]["timeout"] > $hardprefs["system"]["timeout"]) { 
          $error=1; 
          $errmsg .= "Session timeout can not be greater than " . $hardprefs["system"]["timeout"] . "\n";
          $prefs["system"]["timeout"] = $hardprefs["system"]["timeout"];
      }
//comment removed_e

      if ($prefs["wigi"]["timeout"] > $hardprefs["wigi"]["timeout"]) {
          $error=1;
          $errmsg .= "InCashMe Money Payment Code timeout[".$prefs["wigi"]["timeout"]."] can not be greater than [" . $hardprefs["wigi"]["timeout"] . "]\n";
          $prefs["wigi"]["timeout"] = $hardprefs["wigi"]["timeout"];
      }

//comment removed_s
      if ($prefs["wigi"]["minbal"] < $hardprefs["wigi"]["minbal"]) { 
          $error=1; 
          $errmsg .= "Minimum balance must be greater than $" . $hardprefs["wigi"]["minbal"] . "\n"; 
          $prefs["wigi"]["minbal"] = $hardprefs["wigi"]["minbal"];
      }
//comment removed_e


      if ($prefs["wigi"]["max_per_trans"] > $hardprefs["wigi"]["max_per_trans"]) {
          $error=1;
          $errmsg .= "Max amount per InCashMe transaction can not be greater than ₹" . $hardprefs["wigi"]["max_per_trans"] . "\n";
          $prefs["wigi"]["max_per_trans"] = $hardprefs["wigi"]["max_per_trans"];
      }

      if ($prefs["wigi"]["max_per_day"] > $hardprefs["wigi"]["max_per_day"]) {
          $error=1;
          $errmsg .= "Max number of InCashMe transactions per day can not be greater than " . $hardprefs["wigi"]["max_per_day"]  . "\n";
          $prefs["wigi"]["max_per_day"] = $hardprefs["wigi"]["max_per_day"];
      }

      if ($hardprefs["wigi"]["international_trans"] === "false" && $prefs["wigi"]["international_trans"] === "true") { 
          $error=1; 
          $errmsg .= "International transactions are not allowed for this account"; 
          $prefs["wigi"]["international_trans"] = "false";
      }


      if ($prefs["gift"]["max_per_trans"] > $hardprefs["gift"]["max_per_trans"]) { 
          $error = 1; 
          $errmsg .= "Max amount per gift can not be greater than ₹" . $hardprefs["gift"]["max_per_trans"] . "\n"; 
          $prefs["gift"]["max_per_trans"] = $hardprefs["gift"]["max_per_trans"];
      }

      if ($prefs["gift"]["max_per_day"] > $hardprefs["gift"]["max_per_day"]) { 
          $error = 1; 
          $errmsg .= "Max number of gifts per day can not be greater than " . $hardprefs["gift"]["max_per_day"] . "\n"; 
          $prefs["gift"]["max_per_day"] = $hardprefs["gift"]["max_per_day"];
      }

      if ($prefs["funding"]["max_per_trans"] > $hardprefs["funding"]["max_per_trans"]) {
          $error = 1;
          $errmsg .= "Max amount of account funding can not be greater than ₹" . $hardprefs["funding"]["max_per_trans"] . "\n";
          $prefs["funding"]["max_per_trans"] = $hardprefs["funding"]["max_per_trans"];
      }

      if ($prefs["funding"]["max_per_day"] > $hardprefs["funding"]["max_per_day"]) {
          $error = 1;
          $errmsg .= "Max number of account funding per day can not be greater than " . $hardprefs["funding"]["max_per_day"] . "\n";
          $prefs["funding"]["max_per_day"] = $hardprefs["funding"]["max_per_day"];
      }

      if ($error == 1) {
          if ($throwexp) {
              throw new App_Exception_WsException($errmsg);
              return false;
          }
          else {
              return $prefs;
          }
      } else {
          return;
      }

  }

  protected function getDefault(){
    $prefs = array(
        'mobws' => array(                #Prefs for cellphone
             'wigi' => array(
                'timeout'       => '5',
                'minbal' => '1',
                'max_per_trans' => '5000',
                'max_per_day' => '5',
                'international_trans' => 'false',
                'alert'    => 'SMS'

             ),
             'funding' => array(
                'max_per_trans' => '50000',
                'max_per_day' => '5',
                'alert'    => 'SMS'
             ),
             'gift'  => array(
                'max_per_trans' => '5000',
                'max_per_day'   => '5',
                'max_get_per_day'   => '50000',
                'alert'    => 'SMS'
             ),
			 'scan'  => array(
                'max_per_trans' => '5000',
                'max_per_day'   => '5',
                'alert'    => 'SMS'
             ),
             'notification' => array(
                'statement'  => 'Email',
                'alert'    => 'SMS'
             ),
             'system' => array(
                'timeout'  => '300',
                'timezone' => '+5.5'
             ),
         ),
         'cw' => array(              #Prefs for Consumer Web User
            'login' => array(
                'otp'           => 0,
                'sitekeyimg'    => 'def.gif',
                'sitekeyphrase' => 'This is a sitekey'
             ),
             'wigi' => array(
                'timeout'       => '10',
                'minbal' => '1',
                'max_per_trans' => '50000',
                'max_per_day' => '10',
                'international_trans' => 'false'

             ),
             'funding' => array(
                'max_per_trans' => '50000',
                'max_per_day' => '10',
                'alert'    => 'SMS'
             ),
             'gift'  => array(
                'max_per_trans' => '50000',
                'max_per_day'   => '10',
                'max_get_per_day'   => '50000',
                'alert'    => 'SMS'
             ),
			 'scan'  => array(
                'max_per_trans' => '50000',
                'max_per_day'   => '10',
                'alert'    => 'SMS'
             ),
             'notification' => array(
                'statement'  => 'Email',
                'alert'    => 'SMS'
             ),
             'system' => array(
                'timeout'  => '300',
                'timezone' => '+5.5'
             ),
         ),
         'posws' => array(              #Prefs for POS merchant  
            'salestax' => '0.0',
            'tips'     => '0',
            'tipval'   => '0',
            'dname'    => '',
            'tipval'   => '0',
            'gps'      => 'On',
            'timezone' => '+5.5'
         
         ),
         'mw' => array(              #Prefs for Merchant Web User
            'accept' => array(
               'cash' => 'true',
               'creditcard' => 'true',
               'scanandpay' => 'true',
               'scanandbuy' => 'true',
               'ecommerce' => 'true',
               'pos' => 'true'
            ),
            'salestax' => '0.0',
            'tips'     => '0',
            'dname'    => '',
            'possecret' => '',
            'system' => array(
               'timezone' => '+5.5'
            ),
         ),
         'system' => array(              #Prefs for Consumer Web User
            'login' => array(
                'otp'           => 0,
                'sitekeyimg'    => 'def.gif',
                'sitekeyphrase' => 'This is a sitekey'
             ),
             'wigi' => array(
                'timeout'       => '120',
                'minbal' => '1',
                'max_per_trans' => '50000',
                'max_per_day' => '20',
                'international_trans' => 'false'

             ),
             'funding' => array(
                'max_per_trans' => '50000',
                'max_per_day' => '20',
             ),
             'gift'  => array(
                'max_per_trans' => '50000',
                'max_per_day'   => '20',
                'max_get_per_day'   => '50000'
             ),
			 'scan'  => array(
                'max_per_trans' => '50000',
                'max_per_day'   => '10'
             ),
             'notification' => array(
                'statement'  => 'Email',
                'alert'    => 'SMS'
             ),
             'system' => array(
                'timeout'  => '3600',
                'timezone' => '+5.5'
             )
         )


    );    
    return $prefs;  
  }  

  public function __construct() {
    parent::__construct();
    $this->defaultPrefs = $this->getDefault();
    /*
    $this->defaultPrefs = $this->getDefault();

    $result = $this->find($uid)->current();
    if(!$result){
        $data = array(
            'user_id' => $uid,
            'prefs'   => Zend_Json::encode($this->defaultPrefs),
        );
        $this->insert($data);
        $this->uid       = $uid;
        $this->dbPrefs   = $this->defaultPrefs;
    }else{	
        $this->uid       = $uid;
        $this->dbPrefs   = $this->mergePrefs(Zend_Json::decode($result->prefs), $this->defaultPrefs);
    }
    */
  }

  public function getPrefs($type){
      return $this->dbPrefs[$type];
  } 

  public function getWebUserPrefs($uid,$type='cw'){
        //error_log("prefs: get web/$type pref for uid $uid");
        $res = $this->fetchRow($this->select()->from($this,array('prefs'))->where('user_id = ?',$uid)->where('category = ?','web'));
        if(!$res){
            $data = array(
                'user_id' => $uid,
                'category'=> 'web',
                'prefs'   => Zend_Json::encode($this->defaultPrefs)
            );
            $this->insert($data);
            $this->webUserPrefs = $this->defaultPrefs;
            //error_log("prefs : new");$this->pdump($this->webUserPrefs[$type]);
            return $this->webUserPrefs[$type];
        }    
        $this->webUserPrefs = $this->mergePrefs(Zend_Json::decode($res['prefs']), $this->defaultPrefs);
        $this->pdump($this->webUserPrefs[$type]);
        return $this->webUserPrefs[$type];
  }

  public function getCellphonePrefs($uid,$mid,$type='mobws'){
        //error_log("prefs: get cell/$type pref for uid $uid mid $mid");
        $res = $this->fetchRow($this->select()->from($this,array('prefs'))->where('user_id = ?',$uid)->where('mobile_id = ?',$mid)->where('category = ?','mobile'));
        if(!$res){
            $data = array(
                'user_id' => $uid,
                'mobile_id' => $mid,
                'category'=> 'mobile',
                'prefs'   => Zend_Json::encode($this->defaultPrefs),
            );
            $this->insert($data);
            $this->cellPrefs[$mid] = $this->defaultPrefs;
            //error_log("prefs : new");$this->pdump($this->cellPrefs[$mid][$type]);
            return $this->cellPrefs[$mid][$type];
        }

        $this->cellPrefs[$mid] = $this->mergePrefs(Zend_Json::decode($res['prefs']), $this->defaultPrefs);
        $this->pdump($this->cellPrefs[$mid][$type]);
        return $this->cellPrefs[$mid][$type];
      
  }

  public function getAllCellphonePrefs($uid,$type='mobws'){
        //error_log("prefs: getall cell/$type pref for uid $uid mid $mid");
        $res = $this->fetchAll($this->select()->from($this,array('prefs'))->where('user_id = ?',$uid)->where('category = ?','mobile'));
        $tmp = $res->toArray();
        $out = array();
        foreach($tmp as $k){
            $this->cellPrefs[$k['mobile_id']] = $this->mergePrefs(Zend_Json::decode($k['prefs']), $this->defaultPrefs);
            $out[$k['mobile_id']] = $this->cellPrefs[$k['mobile_id']][$type];
        }
        return $out;
      
  }

  public function saveWebUserPrefs($uid, $newPrefs, $type='cw',$user_id=null){
    //error_log("prefs: save web/$type pref for uid $uid");
    $this->webUserPrefs[$type] = $newPrefs;
    $this->pdump($this->webUserPrefs);
    $data = array(
        'prefs' => Zend_Json::encode($this->webUserPrefs),
		'date_changed'=>new Zend_Db_Expr('NOW()'),
		'user_changed'=>$user_id
    );
    $this->update($data, array(
        'user_id = ? ' => $uid,
        'category = ?' => 'web'
    ));
      
  }

  public function saveCellphonePrefs($uid, $mid, $newPrefs, $type='mobws'){
    //error_log("prefs: save cell/$type pref for uid $uid mid $mid");
    $this->cellPrefs[$mid][$type] = $newPrefs;
    $this->pdump($newPrefs);
    $data = array(
        'prefs' => Zend_Json::encode($this->cellPrefs[$mid])
    );
/*
    #var_dump($data);

    #$where['user_id = ?']   = $uid;
    #$where['mobile_id = ?'] = $mid;
    #$where['category = ?']  = "mobile";
    #$this->update($data, $where);
*/

    $this->update($data, array(
        'user_id = ? ' => $uid,
        'mobile_id = ? ' => $mid,
        'category = ? ' => 'mobile'
    ));
  }

  public function mergePrefs($changed,$default ){
      foreach($default as $key => $Value) {
          if(array_key_exists($key, $changed) && is_array($Value))
              $changed[$key] = $this->mergePrefs($changed[$key], $default[$key]);
          else {
              if(!array_key_exists($key,$changed))
              $changed[$key] = $Value;
          }    
      }
      return $changed;
  }

  public function savePrefs($newPref, $type){
    //error_log("prefs: oldsave pref/$type pref for uid ".$this->uid);
    $this->dbPrefs[$type] = $newPref;
    $this->pdump($newPref);
    $data = array(
        'prefs' => Zend_Json::encode($this->dbPrefs)
    );
    $where = $this->getAdapter()->quoteInto('user_id = ?', $this->uid);
    $this->update($data, $where);
  }  
    
  public function pdump($prefs){
      return;
      $str = Zend_Json::encode($prefs);
      //error_log("prefs: value is as ". $str);    
  }
}

?>
