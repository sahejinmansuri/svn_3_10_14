<?php
class Atlasp_App_Login_Identity implements ArrayAccess, IteratorAggregate
{
    public $userid;
    public $companytype;
    public $loginid;
    public $companyid;
    public $last_login;
    public $sysadmin;
    public $fname;
    public $lname;
    public $firstname;
    public $lastname;
    public $email;
    public $suspended;
    public $last_login_date;
    public $password_changed_date;
    public $require_password_change;
    public $wrong_password_cnt;
    public $systemadministrator;
    public $last_login_minutes_ago;
    public $password_changed_minutes_ago;
    public $company_status;
    
    /**
     * 
     * @param array user row from users table
     */
    public function __construct($row)
    {
    	$row = (array) $row;
    	$row = array_change_key_case($row, CASE_LOWER);
    	
    	//
    	foreach ($row as $k => $v)
    	{
	        $this->$k = $v;
    	}
    	
    	// Casting & Other field name exceptions
        $this->userid     = (integer) $row['userid'];
        $this->companytype = (integer) $row['companytype'];
        $this->companyid  = (integer) $row['companyid'];
        $this->last_login = $row['last_login_date'];
        $this->sysadmin   = $row['systemadministrator'];
        $this->fname      = $row['firstname'];
        $this->lname      = $row['lastname'];
        $this->email      = $row['email_addr'];
    }
    
    // Array Access implementation
    public function offsetSet($offset, $value) { $this->$offset = $value; }
    public function offsetExists($offset) { return property_exists($this, $offset); }
    public function offsetUnset($offset) { unset($this->$offset); }
    public function offsetGet($offset) { if ($this->offsetExists($offset)) { return $this->$offset; } return null; }
    
    //IteratorAggregate implementation
    public function getIterator() { return new ArrayIterator($this); }
    
}
