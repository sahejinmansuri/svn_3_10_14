<?php

class App_Login_Cw extends App_Login_Wigi {

    public function doLogin($options){
        $uname = $options['LOGIN'];    
        $pwd   = $options['PASSWD'];
        $code  = $options['CODE'];

        $uid = App_User::getUserIdFromEmail($uname);
        $user = new App_User( $uid );
        $a    = new App_Auth();
        
        $a->auth2("consumer",$uid, $pwd, $code);

        $this->setIdentity( $user->getIdentity() );
        $this->updateLastLoginDate($user);
        $this->recordLoginHistory($user->getEmail());
    }

    public function createSession(){
        $identity = $this->getIdentity();
        $identity['user_type'] = 'web';
        $defSettings = new App_DefSettings();
        $prefs       = new App_Prefs();
         try {
                //  Create new Session
                $sessionModel = new Atlasp_Models_Db_Session();
                $sessionModel->createSession($identity['loginid'],0);

                $this->namespace->logged_in = 1;
                $this->namespace->timestamp = time();
                $this->namespace->identity = $identity;
                $this->namespace->usertags = $defSettings->getUserSettings( $identity['userid'] );
                $this->namespace->celltags = $defSettings->getAllMobileSettings( $identity['userid'] );
                $this->namespace->prefs    = $prefs->getWebUserPrefs( $identity['userid']);
                $sessionModel->updateCurrentSession(array('login_id' => $identity['loginid']));
            } catch (Exception $e) {
                $this->_log->err(__METHOD__ . "() Exception thrown : $e");
            }
    }

}
