<?php

class App_Users extends App_Models_Db_Wigi_Users {

  private $uid;
  private $type;

  public function getUsers($uid){
	  $result = $this->fetchAll(
        $this->select()
          ->where('user_id = ?', $uid)
      );

		return $result->toArray();
  }

  public function getUserIdFromEmail($email){
	  $result = $this->fetchRow(
        $this->select()
          ->where('email = ?', $email)
      );

		return $result;
  }

  public function getUserIdentity($users_id){

	  $result = $this->fetchRow(
        $this->select()
          ->where('users_id = ?', $users_id)
      );

		return $result;
  }

    public function updateUser($data, $users_id, $user_id)
	{
		$this->update($data, array(
			'user_id = ? ' => $user_id,
			'users_id = ? ' => $users_id,
			//'status = ? ' => 'A',
		));
	}

	public function insertUser($data)
	{
		return $this->insert($data);
	}

	public function userConstraintChecks($type, $email, $pwd, $checkpass = true)
	{
		$rawData = self::getUserIdFromEmail($email);
		if(!$rawData)
		{
			throw new App_Exception_WsException('Account Does not Exists.');
			return false;
		}

		$identity = $rawData->toArray();
	    $password = Atlasp_Utils::inst()->encryptPassword($pwd);

		if ($identity['user_type'] !== "consumer" && $type === "consumer") { 
		  throw new App_Exception_WsException('Account is not a consumer account.'); 
		}

		if ($identity['user_type'] !== "merchant" && $type === "merchant") {
		  throw new App_Exception_WsException('Account is not a merchant account.');
		}

		if ($identity['user_type'] !== "merchant" && $identity['user_type'] !== "posuser" && $type === "posuser") {
		  throw new App_Exception_WsException('Account is not a merchant');
		}

		if ($identity['status'] === "I") {
		  throw new App_Exception_WsException('Account is inactive');
		  return false;
		}

		if ($identity['status'] === "P" || $identity['status'] === "V" ) {
		  throw new App_Exception_WsException('Account is Pending Verification');
		  return false;
		}

		if ($identity['status'] === "L") {
		  throw new App_Exception_WsException('Account is Locked');
		  return false;
		}

		if ($identity['status'] !== "A") {
		  throw new App_Exception_WsException('Account is Not Active');
		  return false;
		}

		if ($checkpass && ($identity['password'] !== $password)) {
		  throw new App_Exception_WsException('Invalid username or password');
		}

		return $identity;
	}

}

?>
