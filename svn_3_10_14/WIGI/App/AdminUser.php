<?php

class App_AdminUser extends App_Models_Db_Wigi_AdminUser {

    private $password;
    private $login_id;
    private $adminuser_id;
    private $first_name;
    private $last_name;
    private $is_disabled;
    private $email_address;
    private $date_added;
    private $date_modified;

    public function getIdentity() {
        return array(
            'userid' => $this->adminuser_id,
            'loginid' => $this->login_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'is_disabled' => $this->is_disabled,
            'email_address' => $this->email_address,
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified,
            'admin' => $this->admin,
            'permissions' => $this->permissions,
            'last_login_date' => $this->last_login_date,
            'last_login_ip' => $this->last_login_ip,
        );
    }

    public function setAdminuserData($adminArray) {
        $this->adminuser_id  = $adminArray['adminuser_id'];
        $this->login_id      = $adminArray['login_id'];
        $this->first_name    = $adminArray['first_name'];
        $this->last_name     = $adminArray['last_name'];
        $this->is_disabled   = $adminArray['is_disabled'];
        $this->email_address = $adminArray['email_address'];
        $this->date_added    = $adminArray['date_added'];
        $this->date_modified = $adminArray['date_modified'];
        $this->admin = $adminArray['admin'];
        $this->permissions = $adminArray['permissions'];
        $this->last_login_date = $adminArray['last_login_date'];
        $this->last_login_ip = $adminArray['last_login_ip'];
        $this->password      = Atlasp_Utils::inst()->encryptPassword($adminArray['password']);
    }

    public function getPassword() {
        return $this->password;
    }

    public function getLoginId() {
        return $this->login_id;
    }

    public function getAdminUserId() {
        return $this->adminuser_id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function IsDisabled() {
        return $this->is_disabled;
    }

    public function getEmailAddress() {
        return $this->email_address;
    }

    public function getDateAdded() {
        return $this->date_added;
    }

    public function getDateModified() {
        return $this->date_modified;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function __construct($adminuser_id=0) {

        parent::__construct();

        if ($adminuser_id > 0) {

            $this->userid = $adminuser_id;
            $result = $this->find($adminuser_id)->current();
            if (!$result) {
                error_log("adminuserid $adminuser_id does not exist");
                throw new App_Exception_WsException('Admin User ID does not exist');
                return false;
            }

            $this->login_id = $result->login_id;
            $this->adminuser_id = $result->adminuser_id;
            $this->password = $result->password;
            $this->first_name = $result->first_name;
            $this->last_name = $result->last_name;
            $this->is_disabled = $result->is_disabled;
            $this->email_address = $result->email_address;
            $this->date_added = $result->date_added;
            $this->date_modified = $result->date_modified;
            $this->admin = $result->admin;
            $this->permissions = $result->permissions;
            $this->last_login_date = $result->last_login_date;
            $this->last_login_ip = $result->last_login_ip;
        }
    }

    public static function getAdminUserIdFromLoginId($login_id) {

        $t = new App_Models_Db_Wigi_AdminUser();

        $result = $t->fetchRow(
                $t->select()
                        ->where('login_id = ?', $login_id)
        );

        return $result['adminuser_id'];
    }

    public static function getAdminUserFromLoginId($login_id) {

        $t = new App_Models_Db_Wigi_AdminUser();

        $result = $t->fetchRow(
                $t->select()
                        ->where('login_id = ?', $login_id)
        );

        return $result->toArray();
    }

    //public static function addAdminUser($login_id,$password) {
    //
  //          $data = array(
    //             'login_id'  => $login_id,
    //             'password'  => Atlasp_Utils::inst()->encryptPassword($password),
    //          );
    //          $au = new App_AdminUser();
    //          return $au->insert($data);
    //
  //}

	public static function insertUser($data) {
	  $au = new App_AdminUser();
	  return $au->insert($data);
	}


    public function save() {
        $data = $this->getIdentity();
        $this->insert($data);
    }

    public function passwordMatches($p) {
        if (Atlasp_Utils::inst()->encryptPassword($p) === $this->password) {
            return true;
        } else {
            return false;
        }
    }

    public function getRoles() {
        // todo
    }
    
    public function getPermissions() {
        $adminTable = new App_Models_Db_Wigi_AdminUser();
        $statement = $adminTable->prepare('CALL sp_get_admin_permissions( ? )');
        $permissions = array();

        $statement->bindParam(1, $this->adminuser_id);
        $permissions = $statement->execute();
        
        return $permissions;
    }
    
	public static function getAllUsers()
	{
        $allowed = false;
        $permTable = new App_Models_Db_Wigi_AdminUser();
        $admins = array();

        $selectAll = $permTable->select();
        $selectAll->from($permTable->_name);
        $rawAdminSet = $permTable->fetchAll($selectAll);

		return $rawAdminSet->toArray();
	}
	
	public static function getSearchUsers($params)
	{
        $allowed = false;
        $permTable = new App_Models_Db_Wigi_AdminUser();
        $admins = array();

        $selectAll = $permTable->select();
        $selectAll->from($permTable->_name);
		if(isset($params['FIRST_NAME'])){
			$selectAll->where('first_name = ?', $params['FIRST_NAME']);
		}
		if(isset($params['LAST_NAME'])){
			$selectAll->where('last_name = ?', $params['LAST_NAME']);
		}
        $rawAdminSet = $permTable->fetchAll($selectAll);

		return $rawAdminSet->toArray();
	}
    
    public static function findAll() {
        $allowed = false;
        $permTable = new App_Models_Db_Wigi_AdminUser();
        $admins = array();

        $selectAll = $permTable->select();
        $selectAll->from($permTable->_name);
        $rawAdminSet = $permTable->fetchAll($selectAll);
        
        $i = 0;
        foreach ( $rawAdminSet as $adminRow ){
            $thisadmin = new App_AdminUser();
            $thisadmin->setAdminuserData($adminRow);
            $admins[$i] = $thisadmin;
            ++$i;
        }
        return $admins;
    }

    public function updateUserPermissions($data, $login_id)
	{
		$this->update($data, array(
			'login_id = ? ' => $login_id,
		));
	}

    public static function updateAdminUser($data, $adminuser_id)
	{
	  $au = new App_AdminUser();
	  
	  return $au->update($data, array(
			'adminuser_id = ? ' => $adminuser_id,
		));
	}


}

?>
