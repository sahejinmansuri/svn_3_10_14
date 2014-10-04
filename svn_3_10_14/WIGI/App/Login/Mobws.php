<?php

class App_Login_Mobws extends App_Login_Wigi {
    
    public function doLogin($options){
        $cell        = $options['CELL'];
        $countrycode = $options['CCODE'];
        $pin         = $options['PIN'];
        $osid        = $options['OSID'];

        $mobileid = App_Cellphone::getIdFromCellphone($cell,$countrycode);
        $mobileid = intval($mobileid);
		
        if (!($mobileid > 0)) {
          throw new App_Exception_WsException('Phone number is not a registered InCashMe account');
        } 

        $cellob = new App_Cellphone($mobileid);
        $user = new App_User($cellob->getUserId());


        $a = new App_Auth();
		
		$a->mobileConstraintCheck('consumer',$mobileid,$pin,$osid);
        $a->userConstraintCheck('consumer',$cellob->getUserId(),'',false,false);

        if($cellob->getStatus() !== "active") return Atlasp_App_Login::RESULT_FAILED_CELL_CONFIRM;

        if(!$cellob->isAuthorized($osid) ) return Atlasp_App_Login::RESULT_FAILED_OSID;

        if( $user->tosIsCurrent() == false)
          throw new App_Exception_WsException('Please Accept the Terms of Service');

		$system_timeout = $cellob->prefs['system']['timeout'];
		$new_timeout = time() + $system_timeout;
		
		$ulog = new App_Models_Db_Wigi_UserAppLog();
		$fetch = $ulog->fetchRow($ulog->select()->where('mobile_id = ?', $mobileid));
		$timelimit_id = $fetch['log_id'];
		if(isset($fetch['timelimit'])){
			$uinfof = $ulog->update(
				array(
					'timelimit' => $new_timeout,
                ),
				$ulog->getAdapter()->quoteInto('log_id = ?', $timelimit_id)
            );
		}else{
			if($mobileid != ""){
				$keyval = array(
				   'timelimit'  => $new_timeout,
				   'mobile_id' 	=> $mobileid,
				   'user_id'    => $cellob->getUserId(),
				);
				$ulog->insert($keyval);
			}
		}
		
        //$this->check_logged_in( $cellob->getCellphone() );
        $this->setIdentity( $user->getIdentity() );
        $this->addToIdentity('mobileid',$cellob->getMobileId());
        $this->addToIdentity('is_default',$cellob->isDefault());
        $this->updateLastLoginDate($user);
        $this->recordLoginHistory($user->getEmail());

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
            $this->namespace->usertags = $defSettings->getUserSettings( $identity['userid'] );
            $this->namespace->celltags = $defSettings->getAllMobileSettings( $identity['userid'] );
            $this->namespace->prefs    = $prefs->getCellphonePrefs( $identity['userid'], $identity['mobileid']);
            $sessionModel->updateCurrentSession(array('login_id' => $identity['loginid']));
        } catch (Exception $e) {
            $this->_log->err(__METHOD__ . "() Exception thrown : $e");
        }
    } 
	public function check_logged_in($mobile){
	
        $login_history = new App_Models_Db_Wigi_LoginHistory();
		$select = $login_history->select()->where('email = ?', '91'.$mobile)->order('login_history_id DESC')->limit(1);
		
		$fetch = $login_history->fetchRow($select);
		$stamp_login = $fetch['stamp'];
		
		$user_log = new App_Models_Db_Wigi_UserLog();
		$select_log = $user_log->select()->where('cellphone = ?', '91'.$mobile)->where('type = ?', 'Logout')->order('user_log_id DESC')->limit(1);
		
		$fetch_log = $user_log->fetchRow($select_log);
		$stamp_logout = $fetch_log['server_datetime'];
		
		$tet = print_r($stamp_logout, true);
		error_log($stamp_login."=====".$stamp_logout);
		
		$timestamp_login = strtotime($stamp_login);
		$timestamp_logout = strtotime($stamp_logout);
		
		if(($timestamp_login != "") && ($timestamp_logout != "")){
			if($timestamp_login > $timestamp_logout){
				throw new App_Exception_WsException('You are already logged in using this cellphone in other device');
				return false;
			}
		}
    }
}
