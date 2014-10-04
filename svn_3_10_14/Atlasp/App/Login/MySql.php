<?php
class Atlasp_App_Login_MySql extends Atlasp_App_Login_AbstractLogin
{
    protected $identity_cache = array();
    
    /**
     *
     * @return Atlasp_App_Login_Identity
     */
    public function getIdentity()
    {

	if (!empty($this->identity_cache)) {
	    if (array_key_exists($this->username, $this->identity_cache)) {
		return $this->identity_cache[$this->username];
	    }
	}
	$this->identity_cache = array(); //reset ... only one item should be cached

	$b = Atlasp_Utils::inst()->startTimer();
	$identity = false;
        try {
		$sql = "SELECT
		{$this->userTbl}.*,
		{$this->companyTbl}.companytype,
        {$this->companyTbl}.industryclass,
        {$this->companyTbl}.company_status,
		TIMESTAMPDIFF(MINUTE, NOW(), IF(last_login_date IS NULL, NOW(), last_login_date)) AS last_login_minutes_ago,
		TIMESTAMPDIFF(MINUTE, NOW(), IF(password_changed_date IS NULL, NOW(), password_changed_date)) AS password_changed_minutes_ago
		FROM {$this->userTbl}
		LEFT JOIN {$this->companyTbl} ON {$this->companyTbl}.companyid = {$this->userTbl}.companyid
		WHERE LOGINID = ?";
            $w = $this->dbhandler->quoteInto($sql, $this->username);

            $row = $this->dbhandler->fetchRow($w);
            if ($row)
            {
		    //
		    $identity = new Atlasp_App_Login_Identity($row);
		    $this->identity_cache[$this->username] = $identity;
            }

        } catch (Exception $e) {
	    Zend_Registry::get('log')->warn(__METHOD__ . '() exception thrown : ' . $e);
        }

	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('mGetIdent'=> Atlasp_Utils::inst()->endTimer($b))));

	return $identity;
    }
    
    public function recordLoginHistory($loginid, $companyid=0, $status=0)
    {
	$m = __METHOD__ . '(): ';
	$b = Atlasp_Utils::inst()->startTimer();

	$appName = Zend_Registry::get('name');
	$loginHistoryId = 0;

	// Record login history
	try {
	    $loginHistoryId = Atlasp_Utils::inst()->getUid('auth','login_history', 1);
	    $loginHistory = new Atlasp_Models_Db_LoginHistory( array ( 'db' => 'auth') );
	    $loginHistory->insert( array(
		'login_history_id' => $loginHistoryId,
		'loginid' => $loginid,
		'activity' => 'LOGIN',
		'application' => strtoupper($appName),
		'ip' => $_SERVER['REMOTE_ADDR'],
		'browser' => substr($_SERVER['HTTP_USER_AGENT'],0,60),
		'timestamp' => new Zend_Db_Expr('NOW()'),
		'bad_password' => null,
		'customerid' => $companyid,
		'status' => $status,
		'client_type' => 'WEB',
	    ));

	    Zend_Registry::get('log')->debug($m.'Inserted login_history '.$loginHistoryId);
	}
	catch (Exception $e) {
	    Zend_Registry::get('log')->warn($m.'Error writing login_history: '.$e);
	}

	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('mLoginHist'=> Atlasp_Utils::inst()->endTimer($b))));
		
    	return $loginHistoryId;
    }
    
    public function updateWrongPasswordCount()
    {
	$b = Atlasp_Utils::inst()->startTimer();
    	try
    	{
    		$count = (int) $this->dbhandler->fetchOne("SELECT wrong_password_cnt FROM $this->userTbl WHERE loginid = ?", $this->username);
    		$count++;
		$where = $this->dbhandler->quoteInto("loginid = ?", $this->username);

		// values
		$values = array(
			'datechanged' => new Zend_Db_Expr('NOW()'),
		);

		if ($count >= Atlasp_App_Login::WRONG_PASSWORD_COUNT_MAX) {
			$values[ 'wrong_password_cnt' ] = 0;
			$values[ 'suspended'] = 'Y';
		} else {
			$values['wrong_password_cnt'] = $count;
		}

		$this->dbhandler->update($this->userTbl, $values, $where);
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
			'wrong_password_cnt' => 0,
			'datechanged' => new Zend_Db_Expr('NOW()'),
		);
	    	$this->dbhandler->update($this->userTbl, $values, $where);
    	}
    	catch (Exception $e) {
    		Zend_Registry::get('log')->warn(__METHOD__ . ' exception thrown : ' . $e);
    	 }

	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('mRstPwdCnt'=> Atlasp_Utils::inst()->endTimer($b))));
    }
    
    public function updateLastLoginDate($u)
    {
	$b = Atlasp_Utils::inst()->startTimer();
    	try
    	{
	    	$where = $this->dbhandler->quoteInto("loginid = ?", $this->username);
		$values = array(
			'last_login_date' => new Zend_Db_Expr('NOW()'),
			'datechanged' => new Zend_Db_Expr('NOW()'),
		);
	    	$this->dbhandler->update($this->userTbl, $values, $where);
    	}
    	catch (Exception $e) {
    		Zend_Registry::get('log')->warn(__METHOD__ . ' exception thrown : ' . $e);
    	}

	Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
		array('mUpdtLstLogin'=> Atlasp_Utils::inst()->endTimer($b))));
    }
    
    public function expireTempPassword() {
        $m = __METHOD__ . '(): ';
        $b = Atlasp_Utils::inst()->startTimer();
        $identity = $this->getIdentity();
        if (!$identity) { return; }
            
            try
            {
                if ( $identity->require_password_change == 2 )
                {
                    $where = $this->dbhandler->quoteInto("loginid = ?", $this->username);

                $values = array(
                    'require_password_change' => 3,
                    'datechanged' => new Zend_Db_Expr('NOW()'),
                );
                    $this->dbhandler->update($this->userTbl, $values, $where);
                }
            }
            catch (Exception $e) {
            Zend_Registry::get('log')->warn($m.' Exception thrown : ' . $e);
            }

        Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'),
            array('mEprTmpPass'=> Atlasp_Utils::inst()->endTimer($b))));
    }
    
    public function doLogin($options){}   
}
