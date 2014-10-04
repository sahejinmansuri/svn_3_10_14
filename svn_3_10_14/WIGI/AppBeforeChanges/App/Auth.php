<?php

class App_Auth {


  public function authCheck($userid,$password) {
    $sp  = new App_Db_Sp_UserAuth();
    $res = $sp->getSimpleResponse(array( 'USERID'=> $userid, 'PASSWORD'=>$password));
    if ($res['@p_result'] > 0) return true;
    else return false;

  }

  public function mobileAuthCheck($mobileid,$pin) {
    $sp  = new App_Db_Sp_MobileAuth();
    $res = $sp->getSimpleResponse(array( 'MOBILEID'=> $mobileid, 'PIN'=>$pin));
    if ($res['@p_result'] > 0) return true;
    else return false;
  }

  public function auth1($type,$userid,$password) {

    $this->userConstraintCheck($type,$userid,$password);
    $password = Atlasp_Utils::inst()->encryptPassword($password);
    $sp  = new App_Db_Sp_Auth1();
    $res = $sp->getSimpleResponse(array( 'USERID'=> $userid, 'PASSWORD'=>$password));
    return $res['@p_code'];
  }

  public function userConstraintCheck($type,$userid,$password,$resetlock = true,$checkpass = true) {
    
    $user = new App_User($userid);
    $password = Atlasp_Utils::inst()->encryptPassword($password);

    if ($user->getType() !== "consumer" && $type === "consumer") { 
      throw new App_Exception_WsException('Account is not a consumer account.'); 
    }

    if ($user->getType() !== "merchant" && $type === "merchant") {
      throw new App_Exception_WsException('Account is not a merchant account.');
    }

    if ($user->getType() !== "merchant" && $user->getType() !== "posuser" && $type === "posuser") {
      throw new App_Exception_WsException('Account is not a merchant');
    }


    if ($user->getStatus() === "inactive") {
      throw new App_Exception_WsException('Account is inactive');
      return false;
    }

    if ( $user->isLocked() ) {
      throw new App_Exception_WsException('Account locked. Please call customer service.');
      return false;
    }

    if ( $user->isPending() ) {
      throw new App_Exception_WsException('You have successfully created your account, however your account is waiting final verification by WiGime staff.');
      return false;
    }

    if ( $user->isSuspended() ) {
      throw new App_Exception_WsException('The login capabilities on this account will be temporarly locked. Please try again in 15 minutes.');
      return false;
    }

    if ($user->getSuspendCount() >= Atlasp_App_Login::WRONG_PASSWORD_COUNT_MAX) {
        $user->suspend();
        throw new App_Exception_WsException('The login capabilities on this account will be temporarly locked. Please try again in 15 minutes.');
    }

    if ($checkpass && ($user->getPassword() !== $password)) {
      $user->increaseSuspendCount();
      throw new App_Exception_WsException('Invalid username or password');
    }

    if( $user->getStatus() === "unconfirmed") {

            $msg = new App_Messages();
            $emailMsg = $msg->getConsumerRegister($user->getFirstName(), $user->getLastName(),$user->getEmail(),$user->getEmailConfirmationCode(),$user->getUserId());

            $m = new App_Messenger();
            $m->sendMessage($emailMsg,$user->getEmail(),'1','WiGime Message: Please verify your Email'); //email

			if ($type === "consumer") { 
				throw new App_Exception_WsException('The email activation is still pending. Please visit your email account and complete the activation process. We have just sent you a new verification email.');
			}else
			{
				throw new App_Exception_WsException('Account is unconfirmed.');
			}
    }

    if ( !$user->isActive() ) {
      throw new App_Exception_WsException('Account is not active.');
      return false;
    }

    if ($resetlock) {
      $user->resetSuspendCount();
    }



  }

  public function mobileConstraintCheck($type,$mobileid,$pin,$osid,$resetlock = true,$checkpass = true,$osid_present = true) {

    $cellphone = new App_Cellphone($mobileid);
    $pin = Atlasp_Utils::inst()->encryptPassword($pin);

    if ( $cellphone->isLocked() ) {
      throw new App_Exception_WsException('Account locked. Please call customer service.');
      return false;
    }

    if ( $cellphone->isSuspended() ) {
      throw new App_Exception_WsException('The login capabilities on this account will be temporarly locked. Please try again in 15 minutes.');
      return false;
    }

    if ($cellphone->getSuspendCount() >= Atlasp_App_Login::WRONG_PASSWORD_COUNT_MAX) {
        $cellphone->suspend();
        throw new App_Exception_WsException('The login capabilities on this account will be temporarly locked. Please try again in 15 minutes.');
    }

    if ($cellphone->getStatus() === "unconfirmed") {
      throw new App_Exception_WsException('Cellphone has not been confirmed');
    }

    if ($checkpass && ($cellphone->getPin() !== $pin)) {
      $cellphone->increaseSuspendCount();
      throw new App_Exception_WsException('Invalid cellphone number or pin');
    }

    //if( $user->getStatus() === "unconfirmed") 

    if ($cellphone->getStatus() !== "active") { 
      throw new App_Exception_WsException('Cellphone has not been activated');
    }

    if ($osid_present && !$cellphone->isAuthorized($osid) ) {
      throw new App_Exception_WsException('Invalid OSID');
    }
    //if( $user->tosIsCurrent() == false) return Atlasp_App_Login::RESULT_FAILED_TOS;

    if ($resetlock) {
      $cellphone->resetSuspendCount();
    }



  }



  public function auth2($type,$userid,$password,$code) {

    $this->userConstraintCheck($type,$userid,$password,false);
    $password = Atlasp_Utils::inst()->encryptPassword($password);
    $sp  = new App_Db_Sp_Auth2();
    $res = $sp->getSimpleResponse(array( 'USERID'=> $userid, 'PASSWORD'=>$password, 'CODE'=>$code));

    $user = new App_User($userid);
    if (!($res['@p_res'])) {
      $user = new App_User($userid);
      $user->increaseSuspendCount();
      throw new App_Exception_WsException('Invalid Code');
    }
    $user->resetSuspendCount();
  }

  public function authMobile($cellphone,$pin) {
    $sp  = new App_Db_Sp_AuthMobile();
    $res = $sp->getSimpleResponse(array( 'MOBILEID'=> $cellphone, 'PIN'=>$pin));
    return $res['@p_res'];

  }

}

?>
