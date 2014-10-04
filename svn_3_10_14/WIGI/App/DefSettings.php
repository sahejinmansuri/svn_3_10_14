<?php

class App_DefSettings extends App_Models_Db_Wigi_Settings {

    private $uid;
    private $mid;
    private $cid;
    private $settings;

    protected function getDefault(){
        $settings = array(
            'mobile' => array(
                'minimum_balance' => '1',
                'max_wigi_amt_txn' => '50',
                'max_wigi_amt_day' => '10',
                'max_gift_amt_txn' => '50',
                'max_gift_amt_day' => 10,
             ),
            'user' => array(
                'minimum_balance' => 5,
                'max_wigi_amt_txn' => '50',
                'max_wigi_amt_day' => '10',
                'max_gift_amt_txn' => '50',
                'max_gift_amt_day' => 10,
             ),
            'company' => array(
                'minimum_balance' => 5,
                'max_per_trans' => '50',
                'max_per_day' => '10',
                'ach'         => '1',
             ),
        );     
        return $settings;  
    }  

    public function __construct() {
        parent::__construct();
        $this->settings = $this->getDefault();
    }

    public function createUserSettings($uid){
        foreach($this->settings['user'] as $k => $v){
            $data = array(
               'user_id'  => $uid,
               'category' => 'user',
               'key'      => $k,
               'value'    => $v,
               'mobile_id' => 0,
               'company_id' => 0,
            );
            $this->insert($data);
        }     
    } 

    public function createMobileSettings($uid,$mid){
        foreach($this->settings['mobile'] as $k => $v){
            $data = array(
               'user_id'   => $uid,
               'mobile_id' => $mid,
               'category' => 'mobile',
               'key'      => $k,
               'value'    => $v,
               'company_id' => 0,
            );
            $this->insert($data);
        }     
      
    } 

    public function createCompanySettings($cid){
        foreach($this->settings['company'] as $k => $v){
            $data = array(
               'company_id'  => $cid,
               'category' => 'company',
               'key'      => $k,
               'value'    => $v,
               'mobile_id' => 0,
               'user_id' => 0,
            );
            $this->insert($data);
        }     
    } 
    
    public function getMobileSettings($mid){
        $res = $this->fetchAll($this->select()->from($this,array('key','value'))->where('mobile_id = ?',$mid)->where('category = ?','mobile'));
        $tmp = $res->toArray();
        $out = array();
        foreach($tmp as $k){
            $out[ $k['key'] ] = $k['value'];
        }
        return $out;
    }

    public function getAllMobileSettings($uid){
        $res = $this->fetchAll($this->select()->from($this,array('mobile_id','key','value'))->where('user_id = ?',$uid)->where('category = ?','mobile'));
        $tmp = $res->toArray();
        $out = array();
        foreach($tmp as $k){
            $out[$k['mobile_id']][ $k['key'] ] = $k['value'];
        }
        return $out;
        
    }

    public function getUserSettings($uid){
        $res = $this->fetchAll($this->select()->from($this,array('key','value'))->where('user_id = ?',$uid)->where('category = ?','user'));
        $tmp = $res->toArray();
        $out = array();
        foreach($tmp as $k){
            $out[ $k['key'] ] = $k['value'];
        }
        return $out;
        
    }

    public function getMerchantSettings(){
        
    }

}

?>
