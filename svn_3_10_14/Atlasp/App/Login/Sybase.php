<?php
class Atlasp_App_Login_Sybase extends Atlasp_App_Login_AbstractLogin
{
    protected $identity_cache = array();
    
    /**
     *
     * @return Atlasp_App_Login_Identity|false
     */
    public function getIdentity()
    {
	$m = __METHOD__ . '(): ';
	
	if (!empty($this->identity_cache)) {
	    if (array_key_exists($this->username, $this->identity_cache)) {
		return $this->identity_cache[$this->username];
	    }
	}
	$this->identity_cache = array(); //reset ... only one item should be cached
    	
	$b = Atlasp_Utils::inst()->startTimer();
	$identity = false;
        try {
            $w = $this->dbhandler->quoteInto("SELECT
		    {$this->userTbl}.*,
		    {$this->companyTbl}.companytype,
		    {$this->companyTbl}.industryclass,
		    {$this->companyTbl}.company_status,
	             CASE
	             	WHEN last_login_date IS NULL
	             	THEN 0
	             	ELSE DATEDIFF(mi, getdate(), last_login_date)
	             END AS last_login_minutes_ago,
	             
	             CASE
	             	WHEN password_changed_date IS NULL
	             	THEN 0
	             	ELSE  DATEDIFF(mi, getdate(), password_changed_date)
	             END AS password_changed_minutes_ago
	      FROM {$this->userTbl}
	      LEFT JOIN {$this->companyTbl} ON {$this->companyTbl}.companyid = {$this->userTbl}.companyid
              WHERE LOGINID = ?", $this->username);

            $row = $this->dbhandler->fetchRow($w);
            if ($row)
            {
		    $identity = new Atlasp_App_Login_Identity($row);
		    $this->identity_cache[$this->username] = $identity;
            }
            
        } catch (Exception $e) {
	    Zend_Registry::get('log')->warn($m.'Exception thrown : ' . $e);
        }

	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('sGetIdent'=> Atlasp_Utils::inst()->endTimer($b))));

	return $identity;
    }
    
    
    public function recordLoginHistory($loginid, $companyid=0, $status=0, $override=array())
    {
	$m = __METHOD__ . '(): ';
	$appName = Zend_Registry::get('name');
	$cfg = Zend_Registry::get('config');
   	$loginHistoryId    = 0;
	
	// Record login history
	try
	{
	   //put below in config
	   //$num = 70000000001341800;
	   $num = $cfg->sybase->login_id_fix;
	   $loginHistoryId    = Atlasp_Utils::inst()->getUid('syb', 'login_history') ;

	   $res = $this->dbhandler->query("select nextnum - $num from seq_control where obj_name='login_history'");
	   $arr = $res->fetchAll();
	   $slid = $arr[0]['computed'];
	   $loginHistoryId =  (( $slid + $num ) * 10) +7;
	   
	   // --
	   $data = array(
		    'LOGIN_HISTORY_ID' => new Zend_Db_Expr('convert(numeric(20,0), '.$loginHistoryId.')'),
		    'loginid' => $loginid,
		    'activity' => 'LOGIN',
		    'application' => strtoupper($appName),
		    'ip' => $_SERVER['REMOTE_ADDR'],
		    'browser' => isset($_SERVER['HTTP_USER_AGENT']) ? substr($_SERVER['HTTP_USER_AGENT'],0,60) : '',
		    'timestamp' => new Zend_Db_Expr('getdate()'),
		    'bad_password' => null,
		    'customerid' => ''.$companyid,
		    'status' => ''.$status
	   );

	   //Zend_Registry::get('log')->debug( print_r($data, true));

	   $data = array_merge($data, $override);
	   $this->dbhandler->insert('login_history', $data );
	   
	   Zend_Registry::get('log')->debug($m.'Inserted login_history '.$loginHistoryId);
	} catch (Exception $e) {
	    Zend_Registry::get('log')->warn($m.'Error writing login_history: '.$e);
	}
	return $loginHistoryId;
    }

    public function updateWrongPasswordCount()
    {
	$b = Atlasp_Utils::inst()->startTimer();
    	try
    	{
    		$count = (int) $this->dbhandler->fetchOne("SELECT wrong_password_cnt FROM {$this->userTbl} WHERE loginid = ?", $this->username);
    		$count++;
	    	$where = $this->dbhandler->quoteInto("loginid = ?", $this->username);

		// values
		$values = array(
			'datechanged' => new Zend_Db_Expr('getdate()'),
		);

		if ($count >= Atlasp_App_Login::WRONG_PASSWORD_COUNT_MAX) {
			$values['wrong_password_cnt'] = new Zend_Db_Expr("convert(int, '0')");
			$values['suspended'] = 'Y';
		} else {
			$values['wrong_password_cnt'] = new Zend_Db_Expr("convert(int, '$count')");
		}
		$ret = $this->dbhandler->update($this->userTbl, $values, $where);
    	}
    	catch (Exception $e) {
    		Zend_Registry::get('log')->warn(__METHOD__ . ' exception thrown : ' . $e);
	}

	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('mWrngPwdCnt'=> Atlasp_Utils::inst()->endTimer($b))));
    }
    
    public function resetWrongPasswordCount()
    {
	$b = Atlasp_Utils::inst()->startTimer();
    	try
    	{
	    	$where = $this->dbhandler->quoteInto("loginid = ?", $this->username);
		 $values = array(
		 	'wrong_password_cnt' => new Zend_Db_Expr("convert(int, '0')"),
			'datechanged' => new Zend_Db_Expr('getdate()'),
		);
	    	$this->dbhandler->update($this->userTbl, $values, $where);
    	}
    	catch (Exception $e) {
    		Zend_Registry::get('log')->warn(__METHOD__ . ' exception thrown : ' . $e);
    	 }
	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('mWrngPwdCnt'=> Atlasp_Utils::inst()->endTimer($b))));
    }
    
    public function updateLastLoginDate()
    {
	$b = Atlasp_Utils::inst()->startTimer();
    	try
    	{
	    	$where = $this->dbhandler->quoteInto("loginid = ?", $this->username);
		$values = array(
			'last_login_date' => new Zend_Db_Expr('getdate()'),
			'datechanged' => new Zend_Db_Expr('getdate()'),
		);
	    	$this->dbhandler->update($this->userTbl, $values, $where);
    	}
    	catch (Exception $e) {
    		Zend_Registry::get('log')->warn(__METHOD__ . ' exception thrown : ' . $e);
    	}
	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('mWrngPwdCnt'=> Atlasp_Utils::inst()->endTimer($b))));
    }
    
    public function expireTempPassword()
    {
	$m = __METHOD__ . '(): ';

	$b = Atlasp_Utils::inst()->startTimer();
	
    	$identity = $this->getIdentity();
    	if (!$identity) {
    		return;
    	}
    	
    	try
    	{
	    	if ( $identity->require_password_change == 2 )
	    	{
	    		$where = $this->dbhandler->quoteInto("loginid = ?", $this->username);
			$values = array(
				'require_password_change' => new Zend_Db_Expr("convert(int, '0')"),
				'datechanged' => new Zend_Db_Expr('getdate()'),
			);
	    		$this->dbhandler->update($this->userTbl, $values, $where);
	    	}
    	}
    	catch (Exception $e)
    	{
	    Zend_Registry::get('log')->warn($m.' Exception thrown : ' . $e);
    	}

	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('mWrngPwdCnt'=> Atlasp_Utils::inst()->endTimer($b))));
    }
    
}
