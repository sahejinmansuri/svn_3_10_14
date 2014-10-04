<?php
include(__DIR__ . '/WebController.php');

class Cw_AdminController extends Cw_WebController {
	
    public function homeAction(){
		try {
				$evt = new App_Event_Cw_AdminController_addrole( $this->getRequest() );
				$evt->execute($this->ns,$this->view,$this);
				$this->manageMessages();
		} catch (Exception $e) {
				$a["MESSAGE"] = $e->getMessage();
				$this->redirect('usererror','usererror','cw',$a);
		}	
    }
	public function managemessages() {
        
		$params=array();
       
        $support = new App_ManageMessage();
		$manageMessages = $support->getWigiMessages($params);
		$finalResults=array();
		foreach($manageMessages as $id=>$data)
		{
			$finalResults[]=$data;
		}
		$this->view->manage_messages = $finalResults;
		$this->view->manage_messages_count = count($manageMessages);
	}
	public function addmessageAction() {
       	try {
			$evt = new App_Event_Cw_AdminController_addmessage( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','cw',$a);
		}
	}
	public function editmessageAction() {
       	try {
			$evt = new App_Event_Cw_AdminController_editmessage( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','cw',$a);
		}
	}
	public function deletemessageAction() {
       	try {
			$evt = new App_Event_Cw_AdminController_deletemessage( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','cw',$a);
		}
	}
	public function addroleAction(){
			try {
					$evt = new App_Event_Cw_AdminController_addrole( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','cw',$a);
			}	
	}

	public function editroleAction(){
			try {
					$evt = new App_Event_Cw_AdminController_editrole( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','cw',$a);
			}	
	}
	public function deleteroleAction(){
			try {
					$evt = new App_Event_Cw_AdminController_deleterole( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','cw',$a);
			}
	}

	public function edituserAction(){
			try {
					$evt = new App_Event_Cw_AdminController_edituser( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','cw',$a);
			}	
	}

	public function searchuserAction(){
			/*try {
					$evt = new App_Event_Cw_AdminController_adduser( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','cw',$a);
			}	*/
	}
	

	public function adduserAction(){
			try {
					$evt = new App_Event_Cw_AdminController_adduser( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','cw',$a);
			}	
	}



    public function viewpermissionsAction(){
    	$this->view->pageid = "admin";
		$login_id = $this->getRequest()->getParam("id");

        $r = App_AdminUser::getAdminUserFromLoginId($login_id);
		$r1 = App_Perm::setUserSettings($r['permissions'], $r['admin']);

		$this->view->login_id = $login_id;
		$this->view->permissions = $r1;

    }


	public function insertUser($a)
	{
		$a['usermodified']=$this->ns->identity['userid'];
		$a['date_added']=new Zend_Db_Expr('NOW()');
		$a['status']='A';
		$a['suspended']=0;
		
		// Check if loginid exists
		$user_id = App_AdminUser::getAdminUserIdFromLoginId($a['login_id']);
		if($user_id)
		{
			$a["MESSAGE"] = 'Login Id exists. Please choose a new one.';
			$this->redirect('home','admin','cw',$a);
		}

		$user_id =App_AdminUser::insertUser($a);

		return $user_id;
	}

	public function updateAdminUser($a, $adminuser_id)
	{
		$user_id =App_AdminUser::updateAdminUser($a, $adminuser_id);
		return $user_id;
	}

	public function insertWigiAdminSettings($a)
	{
		//print_r($this->ns->identity);
		$a['useradded']=$this->ns->identity['userid'];
		$a['datecreated']=new Zend_Db_Expr('NOW()');
		$a['status']='A';
		$was = new App_WigiAdminSettings();
		$was->insertAdminSettings($a);
	}

	public function updateWigiAdminSettings($a)
	{
		$b['status']='I';
		$b['usermodified']=$this->ns->identity['userid'];
		$b['datemodified']=new Zend_Db_Expr('NOW()');

		$was = new App_WigiAdminSettings();
		$was->updateAdminSettings($b, $a['category']);
	}

	public function getPermissionStringFromInputs()
	{
		$r=App_Perm::getUserWigiFeatures();
		$str='';

		foreach($r as $id=>$data)
		{
			$str.=$this->getRequest()->getParam($data['vname']);
			foreach($data['subcat'] as $id2=>$data2)
			{
				if($this->getRequest()->getParam($data2['vname']))
				{
					$str.=$this->getRequest()->getParam($data2['vname']);
				}else
				{
					$str.=0;
				}
			}
			$str.='|';
		}

		return $str;

	}


    public function savepermissionsAction(){
		$login_id = $this->getRequest()->getParam('login_id');

		$r=App_Perm::getUserWigiFeatures();
		$str='';

		foreach($r as $id=>$data)
		{
			$str.=$this->getRequest()->getParam($data['vname']);
			foreach($data['subcat'] as $id2=>$data2)
			{
				if($this->getRequest()->getParam($data2['vname']))
				{
					$str.=$this->getRequest()->getParam($data2['vname']);
				}else
				{
					$str.=0;
				}
			}
			$str.='|';
		}
		
		//echo $login_id.' => '.$str;
		//print_r($this->ns->identity);
		//echo "====================";

		$b['permissions']=$str;
		$b['usermodified']=$this->ns->identity['userid'];
		$b['date_modified']=new Zend_Db_Expr('NOW()');
		
		$au = new App_AdminUser();
		$au->updateUserPermissions($b, $login_id);

		$this->redirect('home','admin','cw');


	}

}
