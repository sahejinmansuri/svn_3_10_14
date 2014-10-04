<?php
interface Atlasp_App_Login_Login
{
	public function setDbHandler(Zend_Db_Adapter_Abstract $handler);
	public function setUsername($username);
	public function setPassword($password);

	/**
	*
	* @param string $username
	* @param string $password
	* @return bool
	*/
	public function authenticate();
	public function checkPassword();
	public function checkSuspension();
	public function checkPasswordChange();
	public function checkCompanyType();


	public function createLoginSession();
	public function logout();
	public function isLogged();
	public function getRole();
}
