<?php

class App_Login_Mw extends App_Login_Wigi {

    public function doLogin($options){

        $uname = $options['LOGIN'];    
        $pwd   = $options['PASSWD'];
		$users = new App_Users();

		// First check if the email exists in the users table
		$userRecord = $users->getUserIdFromEmail($uname);
		if($userRecord)
		{
	
		$userIdentity = $users->userConstraintChecks('merchant',$uname,$pwd);
		$user = new App_User( $userIdentity['user_id'] );
		$identity = $user->getIdentity();
		$identity['mw_user_id']=$userIdentity['users_id'];
		$identity['mw_first_name']=$userIdentity['first_name'];
		$identity['mw_last_name']=$userIdentity['last_name'];
		$identity['systemadmin']=$userIdentity['admin'];
		$identity['role']=$userIdentity['role'];	
	
		}
	else
		{

		// Check for the email in user table now -- this is needed for non verified account
		$uid = App_User::getUserIdFromEmail($uname);
		$user = new App_User( $uid );
		$a    = new App_Auth();
		$a->userConstraintCheck('merchant',$uid,$pwd);
		$user = new App_User($uid);	
		$identity = $user->getIdentity();
		
		}
 $this->setIdentity($identity);
		 $this->updateLastLoginDate($user);
       $this->recordLoginHistory($user->getEmail());

		
    }


    public function doLoginOld($options){
        $uname = $options['LOGIN'];    
        $pwd   = $options['PASSWD'];
        $uid = App_User::getUserIdFromEmail($uname);
        $user = new App_User( $uid );

		$a    = new App_Auth();
        $a->userConstraintCheck('merchant',$uid,$pwd); 

        $this->setIdentity( $user->getIdentity() );
        $this->updateLastLoginDate($user);
        $this->recordLoginHistory($user->getEmail());
    }


    public function createSession(){
        $identity = $this->getIdentity();
        $identity['user_type'] = 'web';
        $defSettings = new App_DefSettings();
        $merchantSettings = new App_WigiMerchantSettings();
        $billingSettings = new App_WigiAdminSettings();
        $prefs       = new App_Prefs();
         try {
                //  Create new Session
                $sessionModel = new Atlasp_Models_Db_Session();
                $sessionModel->createSession($identity['loginid'],0);

                $this->namespace->logged_in = 1;
                $this->namespace->systemadmin = $identity['systemadmin'];
                $this->namespace->role = $identity['role'];
                $this->namespace->timestamp = time();
                $this->namespace->identity = $identity;
                $this->namespace->usertags = $defSettings->getmerchantSettings( $identity['userid'] );
                $this->namespace->celltags = $defSettings->getAllMobileSettings( $identity['userid'] );
                $this->namespace->prefs    = $prefs->getWebUserPrefs( $identity['userid']);
                $this->namespace->wigi_merchant_settings = $merchantSettings->getMerchantSettings( $identity['userid'] );
                $this->namespace->wigi_billing_settings = $billingSettings->getAdminSetting();
                $this->namespace->current_wigi_special_billing_setting = $billingSettings->getCurrentAdminSpecialBilling();
                $sessionModel->updateCurrentSession(array('login_id' => $identity['loginid']));
            } catch (Exception $e) {
                $this->_log->err(__METHOD__ . "() Exception thrown : $e");
            }
    }

}
