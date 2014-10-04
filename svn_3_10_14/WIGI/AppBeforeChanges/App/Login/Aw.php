<?php

class App_Login_Aw extends App_Login_Wigi {

    public function doLogin($options){
        $uname = $options['LOGIN'];    
        $pwd   = $options['PASSWD'];

        $uid = App_AdminUser::getAdminUserIdFromLoginId($uname);
        
        $stat =  Atlasp_App_Login::RESULT_FAILED;

        if (!($uid > 0)) {
           throw new App_Exception_WsException('Incorrect username or password');
           return $stat;
        }

        $adminuser = new App_AdminUser( $uid );
        if (!($adminuser->passwordMatches($pwd))) {
           throw new App_Exception_WsException('Incorrect username or password');
           return $stat;
        }
        
        $this->setIdentity( $adminuser->getIdentity() );
        $stat = $this->getLoginStatus($adminuser);


        $this->updateLoginDetails( $adminuser, $uname);
        //$this->recordLoginHistory($user->getEmail());
        //error_log("returning status $stat");
        return $stat;
    }

    public function updateLoginDetails($adminuser, $loginid){
        $data = array(
				'last_login_date' => new Zend_Db_Expr('NOW()'),
				'last_login_ip'   => $_SERVER['REMOTE_ADDR']  
		);   

        $b = Atlasp_Utils::inst()->startTimer();
		$adminuser->updateUserPermissions($data, $loginid);
        Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'), array('mUpdtLstLogin'=> Atlasp_Utils::inst()->endTimer($b))));
    }


    public function  getLoginStatus($adminuser){
        
        $rstat = Atlasp_App_Login::RESULT_SUCCESS;

        return $rstat;
    }
    
    public function createSession(){
        $identity = $this->getIdentity();
        $defSettings = new App_DefSettings();
        $prefs       = new App_Prefs();
         try {
                //  Create new Session
                $sessionModel = new Atlasp_Models_Db_Session();
                $sessionModel->createSession($identity['loginid'],0);

                $this->namespace->logged_in = 1;
                $this->namespace->timestamp = time();
                $this->namespace->identity = $identity;
                //$this->namespace->permissions = App_Perm::setUserSettings($identity['permissions'],$identity['admin']);
                $this->namespace->permissions = $this->createUserPermissions($identity);
            } catch (Exception $e) {
                $this->_log->err(__METHOD__ . "() Exception thrown : $e");
            }
    }

	public function createUserPermissions($identity)
	{
		$role_name = $identity['permissions'];
		$role_name=str_replace(" ","_",$role_name);

		$was = new App_WigiAdminSettings();
		$wigi_admin_settings = $was->getAdminSetting();

		$existing_roles = App_Perm::prepareRolesData($wigi_admin_settings);
		$userPermissionStr = isset($existing_roles[$role_name])?$existing_roles[$role_name]['value']:'00000000';
        error_log("Role of the user	".$userPermissionStr);
		return App_Perm::setUserSettings($userPermissionStr,$identity['admin']);
	}
}
