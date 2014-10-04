<?php
class Atlasp_App_Login
{
    const SYBASE = 'syb';
    const MYSQL  = 'mysql';

   // RETURN CODES
    const RESULT_SUCCESS			            = 0;
    const RESULT_FAILED				            = 991;	
    const RESULT_FAILED_SYSTEM			        = 992;	
    const RESULT_FAILED_PASSWORD		        = 8;	
    const RESULT_FAILED_SUSPENDED		        = 2;	
    const RESULT_FAILED_COMPANY_TYPE		    = 23;	
    const RESULT_FAILED_TMP_PASSWORD_EXPIRED	= 4;	
    const RESULT_FAILED_INACTIVE_DAYS		    = 3;	
    const RESULT_FAILED_IDENTITY_FETCH		    = 998;	
    const RESULT_FAILED_REQUIRE_PASSWORD_CHANGE	= 999;	
    const RESULT_FAILED_TOS                     = 980;
    const RESULT_FAILED_CELL_CONFIRM            = 981;
    const RESULT_FAILED_OSID                    = 982;
    const RESULT_FAILED_BAD_USERNAME_PASSWORD   = 983;
    const RESULT_FAILED_CELL_LOCKED   = 984;
    const RESULT_FAILED_USER_LOCKED   = 985;
    const RESULT_FAILED_CELL_SUSPENDED   = 986;
    const RESULT_FAILED_USER_SUSPENDED   = 987;
    const RESULT_FAILED_USER_CONFIRM   = 988;
    
    // CONSTANTS
    const WRONG_PASSWORD_COUNT_MAX		= 5;
    const MAX_INACTIVITY_DAYS			= 90;
    const PASSWORD_EXPIRE_DAYS			= 60;
    const TMP_PASSWORD_EXPIRE_DAYS		= 1;

    const RESULT_COMPANY_EXPIRED      	= 20; 
    const RESULT_COMPANY_SUSPENDED     	= 21;
    const RESULT_COMPANY_TERMINATED 	= 22;
    const RESULT_COMPANY_DENIED	        = 23;
    const RESULT_COMPANY_NOT_ACTIVATED	= 25;

    
    private function  __construct() {}
    
    public static function getConstName($c)
    {
    	if (self::RESULT_SUCCESS == $c) { return 'RESULT_SUCCESS'; }
    	else if (self::RESULT_FAILED == $c) { return 'RESULT_FAILED'; }
    	else if (self::RESULT_FAILED_SYSTEM == $c) { return 'RESULT_FAILED_SYSTEM'; }
    	else if (self::RESULT_FAILED_PASSWORD == $c) { return 'RESULT_FAILED_PASSWORD'; }
    	else if (self::RESULT_FAILED_SUSPENDED == $c) { return 'RESULT_FAILED_SUSPENDED'; }
    	else if (self::RESULT_FAILED_COMPANY_TYPE == $c) { return 'RESULT_FAILED_COMPANY_TYPE'; }
    	else if (self::RESULT_FAILED_TMP_PASSWORD_EXPIRED == $c) { return 'RESULT_FAILED_TMP_PASSWORD_EXPIRED'; }
    	else if (self::RESULT_FAILED_INACTIVE_DAYS == $c) { return 'RESULT_FAILED_INACTIVE_DAYS'; }
    	else if (self::RESULT_FAILED_IDENTITY_FETCH == $c) { return 'RESULT_FAILED_IDENTITY_FETCH'; }
    	else if (self::RESULT_FAILED_REQUIRE_PASSWORD_CHANGE == $c) { return 'RESULT_FAILED_REQUIRE_PASSWORD_CHANGE'; }
    	else if (self::RESULT_FAILED_TOS == $c) { return 'Please Accept the Terms of Service'; }
    	else if (self::RESULT_FAILED_CELL_CONFIRM == $c) { return 'Cellphone has not been activated'; }
    	else if (self::RESULT_FAILED_OSID == $c) { return 'Invalid OSID'; }
        else if (self::RESULT_FAILED_BAD_USERNAME_PASSWORD == $c) { return 'Invalid Cellphone or PIN'; }
        else if (self::RESULT_FAILED_CELL_LOCKED == $c) { return 'Cellphone is locked. Please visit www.wigime.com to unlock'; }
        else if (self::RESULT_FAILED_USER_LOCKED == $c) { return 'Account is locked. Please call customer service to unlock'; }
        else if (self::RESULT_FAILED_CELL_SUSPENDED == $c) { return 'Cellphone is suspended. Please wait 15 minutes.'; }
        else if (self::RESULT_FAILED_USER_SUSPENDED == $c) { return 'Account is suspended. Please wait 15 minutes.'; }
        else if (self::RESULT_FAILED_USER_CONFIRM == $c) { return 'Email has not been confirmed. Please check your email and click the link that has been sent.'; }
	return '';
    }

}
