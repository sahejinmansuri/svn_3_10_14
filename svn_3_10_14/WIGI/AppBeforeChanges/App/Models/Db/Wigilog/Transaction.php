<?php
class App_Models_Db_Wigilog_Transaction extends Zend_Db_Table_Abstract
{

    protected $_name = 'transaction';
    protected $_primary = 'transaction_id';
	
	public function __construct(){
		parent::__construct(array( 'db' => Zend_Registry::get('wigi_log')));
	}

    public function getRecentTransactions($uid){
        return $this->getTransactions($uid, 5);
    }

    public function getTransactions($uid,$count=0,$noformat=false){
        $rows = $this->getTransFromDb($uid,$count);
        $res = array();
        $to  = array();
        $i=0;
        $stats = App_Transaction_Type::getConstName();
        foreach($rows as $row){
            $res[$i]['tid'] = $row->transaction_id;
            $res[$i]['type'] = $stats[$row->type];    
            $res[$i]['amount'] = $row->amount;    
            $res[$i]['from'] = $row->from;    
            $res[$i]['to'] = $row->to;   
            $res[$i]['description'] = $row->description;    
            $res[$i]['stamp'] = $row->stamp;    
            $i++;
            $to[$row->to] =1;
        }
        if(count(array_keys($to)) ==0) return $res;
        
        if($noformat == true) return $res;

        $u = new App_Models_Db_Wigi_User();
        $ures = $u->fetchAll($u->select()->from($u,array('user_id','email','first_name','last_name'))->where('user_id in (?)', array_keys($to)));
        $toid = array();
        foreach ($ures as $u){
            $toid[$u->user_id] = array($u->email, $u->first_name, $u->last_name);
        }
        for($i=0; $i< count($res); $i++){
            #var_dump( $res[$i]['to']);
            $res[$i]['to'] = (!is_null($res[$i]['to']) && isset($toid[$res[$i]['to']]) )?$toid[ $res[$i]['to'] ][1]:'self';  
        }
        
        return $res;
    }

    public function getTransFromDb($uid,$count){
        $select = ($count)?$this->select()->where('`from` = ?', $uid)->order("stamp desc")->limit($count):$this->select()->where('`from`= ?', $uid)->order("stamp desc");
        return $this->fetchAll($select);
            
    }
}

