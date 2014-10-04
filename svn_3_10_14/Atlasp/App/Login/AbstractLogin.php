<?php
abstract class Atlasp_App_Login_AbstractLogin
{
    /**
     *
     * @var Zend_Db_Adapter_Abstract
     */
    protected $dbhandler;

    /**
     * @var Zend_Session_Namespace
     */
    protected $namespace;
    protected $userTbl = 'USERS';
    protected $companyTbl = 'COMPANY';

    protected $username = '';
    protected $password = '';

    protected $lastError = '';
    protected $errors = array();
    
    protected $loginHistoryId = 0;

    public function __construct($tname=null)
    {
	if($tname) $this->userTbl = $tname;
		
	$appName = Zend_Registry::get('name');
	$this->namespace = new Zend_Session_Namespace($appName);
	
	// Setup Loginid From Session if exists
	$identity = $this->namespace->identity;
	if ($identity) {
	    $identity = (object) $identity;
	    $this->username = $identity->loginid;
	}
	
	//$this->setDbHandler(Zend_Registry::get('auth'));
    }
    
    abstract public function getIdentity();
    abstract public function recordLoginHistory($loginid, $companyid=0, $status=0);
    abstract public function updateWrongPasswordCount();
    abstract public function resetWrongPasswordCount();
    abstract public function updateLastLoginDate($u);
    abstract public function expireTempPassword();
    abstract public function doLogin($options);
    

    public function setDbHandler(Zend_Db_Adapter_Abstract $handler) {
	$this->dbhandler = $handler;
    }
    
    public function setPassword($password) {
	$this->password = $password;
    }

    public function setUsername($username) {
	$this->username = $username;
    }

    public function getLastError()
    {
	return $this->lastError;
    }

    protected function setErrorString($err)
    {
	$this->lastError = $err;
	$this->errors[] = $err;
    }

    /*
    public function doLogin() {
         //  Get identity
        $identity = $this->getIdentity();
        
        //  Get Login status
        $status = ($identity) ? $this->_getLoginStatus() : Atlasp_App_Login::RESULT_FAILED_IDENTITY_FETCH;

        // Update Last Login Date
        $this->updateLastLoginDate();

        $this->expireTempPassword();

        // record authentication attempts
        $companyid = isset($identity->companyid) ? $identity->companyid : 0;
        $this->loginHistoryId = $this->recordLoginHistory($this->username, $companyid, $status);

        //
        return $status;
    }
    */   
    
    
    /*
     * Login History Id accessor
     */
    public function getLoginHistoryId() {
    	return $this->loginHistoryId;
    }
    
    public function checkPassword()
    {
    	$m = __METHOD__ . '(): ';
	try
	{
		//
		if (empty($this->username) || empty($this->password))
		{
			Zend_Registry::get('log')->warn($m.' failed authentication. empty username or password');
			return Atlasp_App_Login::RESULT_FAILED_PASSWORD;
		}
		
		
		//
	    $adapter = new Atlasp_Auth_Adapter($this->dbhandler,
						    $this->userTbl,
						    'LOGINID',
						    'encrypted_password');
	    
	    $adapter->setIdentity($this->username);
	    $adapter->setCredential( md5(strtoupper($this->password)) );

	    $result = $adapter->authenticate();

	    if (!$result->isValid())
	    {
		Zend_Registry::get('log')->warn($m.' RESULT_FAILED_PASSWORD');
		return Atlasp_App_Login::RESULT_FAILED_PASSWORD;
	    }
	    
	    Zend_Registry::get('log')->warn($m.' RESULT_SUCCESS');
	    return Atlasp_App_Login::RESULT_SUCCESS;
	}
	catch (Exception $e)
	{
	    $this->setErrorString($e->getMessage());
	    Zend_Registry::get('log')->warn($m.' Exception thrown : ' . $e);
	}
	
    	return Atlasp_App_Login::RESULT_FAILED_SYSTEM;
    }

    public function checkSuspension()
    {
	$identity = $this->getIdentity();
	if (!$identity)
	{
		return Atlasp_App_Login::RESULT_FAILED_IDENTITY_FETCH;
	}
	
	if (strtoupper($identity->suspended) == 'Y')
	{
	    $this->setErrorString('User account has been suspended');
	    return Atlasp_App_Login::RESULT_FAILED_SUSPENDED;
	}
	return Atlasp_App_Login::RESULT_SUCCESS;
    }

    public function isPasswordChangeRequired()
    {
    	$m = __METHOD__ . '(): ';

	if ( $this->namespace->require_password_change )
	{
	    return true;
	}

	// if days to expiration
    	$daysToExpiration = $this->getDaysToExpirationTime();
    	if ($daysToExpiration < 1)
	{
		return true;
	}

	return false;
    }

    public function checkCompanyStatus()
    {
    	$m = __METHOD__ . '(): ';

    	$identity = $this->getIdentity();

		if (strtoupper($identity->company_status) == 'X')
		{
			$this->setErrorString('Company has expired');
			return Atlasp_App_Login::RESULT_COMPANY_EXPIRED;
		}

		if (strtoupper($identity->company_status) == 'S')
		{
			$this->setErrorString('Company is suspended');
			return Atlasp_App_Login::RESULT_COMPANY_SUSPENDED;
		}

		if (strtoupper($identity->company_status) == 'T')
		{
			$this->setErrorString('Company is terminated');
			return Atlasp_App_Login::RESULT_COMPANY_TERMINATED;
		}

		if (strtoupper($identity->company_status) == 'D')
		{
			$this->setErrorString('Company Denied');
			return Atlasp_App_Login::RESULT_COMPANY_DENIED;
		}

		if (strtoupper($identity->company_status) == 'H')
		{
			$this->setErrorString('Company not activated');
			return Atlasp_App_Login::RESULT_COMPANY_NOT_ACTIVATED;
		}

		return Atlasp_App_Login::RESULT_SUCCESS;
    }

    public function isPWChangeRequired()
    {
    	$m = __METHOD__ . '(): ';

    	$identity = $this->getIdentity();
    	if ($identity->require_password_change == 1)
    	{
			Zend_Registry::get('log')->warn($m.' RESULT_FAILED_REQUIRE_PASSWORD_CHANGE ... Password Change required.');
    		return Atlasp_App_Login::RESULT_FAILED_REQUIRE_PASSWORD_CHANGE;
    	}

	Zend_Registry::get('log')->debug($m.' SUCCESS');
	return Atlasp_App_Login::RESULT_SUCCESS;
    }


    public function checkCompanyType()
    {
	    $m = __METHOD__ . '(): ';

	    Zend_Registry::get('log')->warn($m.' NOT IMPLEMENTED');

	    return Atlasp_App_Login::RESULT_SUCCESS;
    }
    
    public function createLoginSession($disable_multiple_sess=0)
    {
	    $m = __METHOD__ . '(): ';

	    Zend_Registry::get('log')->debug($m.' START');
		

    	    $this->namespace->unsetAll();
	    $identity = $this->getIdentity();
	    if (!$identity)
	    {
		Zend_Registry::get('log')->warn($m.' getIdentity() FAILED');
	    	return Atlasp_App_Login::RESULT_FAILED_IDENTITY_FETCH;
	    }

	try
	{
	    $sess = new Atlasp_Models_Db_Session();

	    $sess->createSession($identity->loginid, $disable_multiple_sess);
	   // $sess->regenerateSessionId($identity->loginid);

	    $this->namespace->logged_in = 1;
	    $this->namespace->timestamp = time();
	    $this->namespace->identity = $identity;
	    $this->namespace->manage_company_id = $identity->companyid;
	    $this->namespace->require_password_change = (int) $identity->require_password_change;
	}
	catch (Exception $e)
	{
	    Zend_Registry::get('log')->warn($m.' Exception thrown : ' . $e->getMessage());
	}
    	Zend_Registry::get('log')->debug($m.' END');
    }

    public function logout()
    {
	$this->namespace->logged_in = 0;
	//Atlasp_Auth::getInstance()->clearIdentity();
	//Zend_Session::destroy(true);
	//Zend_Session::regenerateId();
    }

    /**
	*
	* @return bool
	*/
    public function isLogged()
    {
	/* No Identity setup, then logout */
	$identity = $this->namespace->identity;
	if (!$identity) {
	    return false;
	}

	if ( $this->namespace->logged_in != 1 )
	{
	    return false;
	}

	return true;
    }

    /**
	*
	* @return string
	*/
    public function getRole()
    {
	if (!$this->isLogged())
	{
	    return 'guest';
	}

	$identity = (object) $this->namespace->identity;
	return ($identity->sysadmin == 1 ? 'admin' : 'member');
    }

    public function getDaysToExpirationTime()
    {
	$m = __METHOD__ . '(): ';
	Zend_Registry::get('log')->debug($m.' START');

    	$identity = $this->getIdentity();
    	if (!$identity)
    	{
		Zend_Registry::get('log')->warn($m.' RESULT_FAILED_IDENTITY_FETCH');
    		return 0;
    	}

	// minutes to expiration date
	$minsToExpire = $identity->password_changed_minutes_ago;

	// rounded up days to expiration time
	$daysToExpire = Atlasp_App_Login::PASSWORD_EXPIRE_DAYS - ( floor($minsToExpire / ( 60 * 24 )) * -1);

	Zend_Registry::get('log')->debug($m.' END');

	return $daysToExpire;
    }

    public function checkTemporaryPasswordExpire()
    {
	$m = __METHOD__ . '(): ';
	Zend_Registry::get('log')->debug($m.' START');

    	$identity = $this->getIdentity();
    	if (!$identity)
    	{
		Zend_Registry::get('log')->warn($m.' RESULT_FAILED_IDENTITY_FETCH');
    		return Atlasp_App_Login::RESULT_FAILED_IDENTITY_FETCH;
    	}
    	
    	// temporary password was already used
    	if ($identity->require_password_change == 3)
    	{
		Zend_Registry::get('log')->warn($m.' RESULT_FAILED_TMP_PASSWORD_EXPIRED ... Temp password was already used.');
    		return Atlasp_App_Login::RESULT_FAILED_TMP_PASSWORD_EXPIRED;
    	}
    	
    	// check that temporary password has not expired
    	$hours24 = (60 * 24 * Atlasp_App_Login::TMP_PASSWORD_EXPIRE_DAYS) * -1; //24 hours ago
    	if ($identity->require_password_change == 2 && $identity->password_changed_minutes_ago < $hours24)
    	{
		Zend_Registry::get('log')->warn($m.' RESULT_FAILED_TMP_PASSWORD_EXPIRED');
    		return Atlasp_App_Login::RESULT_FAILED_TMP_PASSWORD_EXPIRED;
    	}
    	
	Zend_Registry::get('log')->debug($m.' SUCCESS');
	return Atlasp_App_Login::RESULT_SUCCESS;
    }

    public function checkLoginInactivity()
    {
    	$identity = $this->getIdentity();
    	if (!$identity)
    	{
    		return Atlasp_App_Login::RESULT_FAILED_IDENTITY_FETCH;
    	}
    	

    	$lastChanceActivity = (60 * 24 * Atlasp_App_Login::MAX_INACTIVITY_DAYS) * -1; // 90 days ago in minutes
    	
    	if ($identity->last_login_minutes_ago < $lastChanceActivity)
    	{
    		return Atlasp_App_Login::RESULT_FAILED_INACTIVE_DAYS;
    	}
    	
	return Atlasp_App_Login::RESULT_SUCCESS;
    }
    
    /**
     * @return int login status code
     */
    protected function _getLoginStatus()
    {
        //  Default return value
        $status = Atlasp_App_Login::RESULT_SUCCESS;
      
        // check Company Status before checking User Credentials
        if ($status == Atlasp_App_Login::RESULT_SUCCESS) {
            $status = $this->checkCompanyStatus();
        }

        // check suspension
        if ($status == Atlasp_App_Login::RESULT_SUCCESS) {
            $status = $this->checkSuspension();
        }

        // check password
        if ($status == Atlasp_App_Login::RESULT_SUCCESS) {
            $status = $this->checkPassword();
            if ($status == Atlasp_App_Login::RESULT_SUCCESS) {
                // Reset Password Count
                $this->resetWrongPasswordCount();
            } else if ($status == Atlasp_App_Login::RESULT_FAILED_PASSWORD) {
                $this->updateWrongPasswordCount();
            }
        }

        // check company type
        if ($status == Atlasp_App_Login::RESULT_SUCCESS) {
            $status = $this->checkCompanyType();
        }

        // check if password change is required
        if ($status == Atlasp_App_Login::RESULT_SUCCESS) {
            $status = $this->isPWChangeRequired();
        }

        // check temp password
        if ($status == Atlasp_App_Login::RESULT_SUCCESS) {
            $status = $this->checkTemporaryPasswordExpire();
        }

        // check login inactivity
        if ($status == Atlasp_App_Login::RESULT_SUCCESS) {
            $status = $this->checkLoginInactivity();
        }
        
        return $status;
    }
        
}












