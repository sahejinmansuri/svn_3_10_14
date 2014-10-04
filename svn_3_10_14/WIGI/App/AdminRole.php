<?php

class App_AdminRole extends App_Models_Db_Wigi_AdminRole {

    private $role_id;
    private $role_name;
    private $role_description;
    private $is_disabled;
    private $date_added;
    private $date_modified;

    public function getIdentity() {
        return array(
            'role_id' => $this->role_id,
            'role_name' => $this->role_name,
            'role_description' => $this->role_description,
            'is_disabled' => $this->is_disabled,
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified,
        );
    }

    public function setAdminuserData($adminArray) {
        $this->role_id  = $adminArray['role_id'];
        $this->role_name    = $adminArray['role_name'];
        $this->role_description     = $adminArray['role_description'];
        $this->is_disabled   = $adminArray['is_disabled'];
        $this->date_added    = $adminArray['date_added'];
        $this->date_modified = $adminArray['date_modified'];
    }

    public function getRoleId() {
        return $this->role_id;
    }

    public function getRoleName() {
        return $this->role_name;
    }

    public function getRoleDescription() {
        return $this->role_description;
    }

    public function IsDisabled() {
        return $this->is_disabled;
    }

    public function getDateAdded() {
        return $this->date_added;
    }

    public function getDateModified() {
        return $this->date_modified;
    }

    public function __construct($role_id=0) {

        parent::__construct();

        if ($role_id > 0) {

            $this->role_id = $role_id;
            $result = $this->find($role_id)->current();
            if (!$result) {
                //error_log("roleid $role_id does not exist");
                throw new App_Exception_WsException('Role ID does not exist');
                return false;
            }

            $this->role_id = $result->role_id;
            $this->role_name = $result->role_name;
            $this->role_description = $result->role_description;
            $this->is_disabled = $result->is_disabled;
            $this->date_added = $result->date_added;
            $this->date_modified = $result->date_modified;
        }
    }

    public static function getRoleIdFromRoleName($role_name) {

        $t = new App_Models_Db_Wigi_AdminRole();

        $result = $t->fetchRow(
                $t->select()
                        ->where('role_name = ?', $login_id)
        );

        return $result['role_id'];
    }
    
    public function save() {
        $data = $this->getIdentity();
        $this->insert($data);
    }
    
    
    public static function findAll() {
        $roleTable = new App_Models_Db_Wigi_AdminRole();
        $roles = array();

        $selectAll = $roleTable->select();
        $selectAll->from($roleTable->_name);
        $rawRoleSet = $roleTable->fetchAll($selectAll);
        
        $i = 0;
        foreach ( $rawRoleSet as $role ){
            $thisrole = new App_AdminRole();
            $thisrole->setAdminuserData($role);
            $roles[$i] = $thisrole;
            ++$i;
        }
        return $roles;
    }

}

?>

