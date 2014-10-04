<?php

class App_Login_Posws extends App_Login_Wigi {

    public function doLogin($options){ 

        $uname        = $options['LOGIN'];     
        $pwd          = $options['PASSWD'];
        $merchantid   = $options['MERCHANTID'];
        $osid         = $options['OSID'];

        $uid = "";
        $countrycode = "";
	$parentid = "";
        $mid = "";

        //Admin users are an email address
        //Basic users will just be something like "jsmith"
        if ( strpos($uname, "@")  ) {
            $uid = App_User::getUserIdFromEmail($uname);
            $puser = new App_User($uid);
            $countrycode = $puser->getCountryCode();
            $parentid = $uid;
            $mid = $puser->getDefaultCellphone();
        } else {
            $uid = App_User::getUserIdFromEmail($uname);
            $u = new App_User($uid);
            $parentid = $u->getParentUserId();
            $puser = new App_User($parentid);
            $countrycode = $puser->getCountryCode();
            $mid = $puser->getDefaultCellphone();
        }

        //$uid = App_User::getUserIdFromEmail($uname); 
        $user = new App_User( $uid );
        $a    = new App_Auth();
	$a->userConstraintCheck("posuser",$uid,$pwd);


        //if ($osid === "oscommerce") {
	//	$osid = "virtual-" . $uid;	
	//} 
        //check to see if the user_id is the owner of the App_Cellphone
       	//$mid = App_Cellphone::getIdFromCellphone($osid,$countrycode);
        //if (!($mid > 0)) {
        //  throw new App_Exception_WsException('Device is not registered');
        //}

        $c = new App_Cellphone($mid);
        if ($parentid != $c->getUserId()) {
          throw new App_Exception_WsException('Your merchant account does not own this device. Please register this device or call customer support.');
        }

        if (!$user->posAuthorized($osid) && $user->getType() !== "merchant") {
           throw new App_Exception_WsException('Account is inactive');
        }

        $this->setIdentity( $user->getIdentity() );
        $this->updateLastLoginDate($user);
        $this->recordLoginHistory($user->getEmail());
        $this->recordPosLogin($uname,$mid,$c);

    }

    public function createSession(){
        $identity = $this->getIdentity();
        $prefs       = new App_Prefs();
         try {
                //  Create new Session
                $sessionModel = new Atlasp_Models_Db_Session();
                $sessionModel->createSession($identity['loginid'],0);

                $this->namespace->logged_in = 1;
                $this->namespace->timestamp = time();
                $this->namespace->identity = $identity;
                $sessionModel->updateCurrentSession(array('login_id' => $identity['loginid']));

		$prefsuid = 0;
		$u = new App_User($identity['userid']);
		if ($u->getType() === "posuser") {
			$prefsuid = $u->getParentUserId();
		} else {
			$prefsuid = $identity['loginid'];
		}

                $this->namespace->prefs    = $prefs->getWebUserPrefs( $prefsuid, 'mw');
            } catch (Exception $e) {
                $this->_log->err(__METHOD__ . "() Exception thrown : $e");
            }
    }

    public function recordPosLogin($loginid,$mid,$c) {
        $data = array('last_login'  => new Zend_Db_Expr('NOW()'),
                      'last_ip'     => $_SERVER['REMOTE_ADDR'],
                      'last_user'   => $loginid
                     );
        $where = $c->getAdapter()->quoteInto('mobile_id = ?', $mid);
        $c->update($data,$where);
    }

}
