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
          throw new App_Exception_WsException('Phone number is not a registered WiGime account');
        } 

        $cellob = new App_Cellphone($mobileid);
        $user = new App_User($cellob->getUserId());

        $a = new App_Auth();
	$a->mobileConstraintCheck('consumer',$mobileid,$pin,$osid);
        $a->userConstraintCheck('consumer',$cellob->getUserId(),'',false,false);

        if($cellob->getStatus() !== "active") return Atlasp_App_Login::RESULT_FAILED_CELL_CONFIRM;

        if(! $cellob->isAuthorized($osid) ) return Atlasp_App_Login::RESULT_FAILED_OSID;

        if( $user->tosIsCurrent() == false)
          throw new App_Exception_WsException('Please Accept the Terms of Service');

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
    
}
