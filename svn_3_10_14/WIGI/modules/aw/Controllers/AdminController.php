<?php
include(__DIR__ . '/WebController.php');

class Aw_AdminController extends Aw_WebController {
	
    public function homeAction(){
		try {
				$evt = new App_Event_Aw_AdminController_adminhome( $this->getRequest() );
				$evt->execute($this->ns,$this->view,$this);
				$this->manageMessages();
		} catch (Exception $e) {
				$a["MESSAGE"] = $e->getMessage();
				$this->redirect('usererror','usererror','aw',$a);
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
		
		$conf = new App_Models_Db_Wigi_Configuration();
		
		$raw = $conf->fetchAll(
		  $conf->select()
			->where('`key` = ?', 'yearly_subscription_charge')
		);
		foreach($raw as $key=>$val){
			$sub_charge = $val['value'];
		}
		
		$raw = $conf->fetchAll(
		  $conf->select()
			->where('`key` = ?', 'amount_load_first_time')
		);
		foreach($raw as $key=>$val){
			$load_amount_first = $val['value'];
		}
		
		$raw = $conf->fetchAll(
		  $conf->select()
			->where('`key` = ?', 'daily_transaction_limit')
		);
		foreach($raw as $key=>$val){
			$daily_transaction_limit = $val['value'];
		}
		
		
		$this->view->configuration = 'testtest';
		$this->view->sub_charge = $sub_charge;
		$this->view->load_amount_first = $load_amount_first;
		$this->view->daily_transaction_limit = $daily_transaction_limit;
	}
	public function updateconfigAction() {
       	try {
			$sub_charge = $this->getRequest()->getParam("sub_charge");
			$load_amount_first = $this->getRequest()->getParam('load_amount_first');
			$daily_transaction_limit = $this->getRequest()->getParam('daily_transaction_limit');
			
			$conf = new App_Models_Db_Wigi_Configuration();
			$uinfof = $conf->update(
				array(
				   'value'  => $sub_charge
				),
                $conf->getAdapter()->quoteInto('`key` = ?', 'yearly_subscription_charge')
			);
			
			$uinfof = $conf->update(
				array(
				   'value'  => $load_amount_first
				),
                $conf->getAdapter()->quoteInto('`key` = ?', 'amount_load_first_time')
			);
			
			$uinfof = $conf->update(
				array(
				   'value'  => $daily_transaction_limit
				),
                $conf->getAdapter()->quoteInto('`key` = ?', 'daily_transaction_limit')
			);
			
				$user = new App_Models_Db_Wigi_User();	
				$user_mob = new App_Models_Db_Wigi_UserMobile();	
				$raw_user = $user->fetchAll(
				  $user->select()
					->where('`user_type` = ?', 'consumer')
				);
				foreach($raw_user as $key=>$val){
					//$load_amount_first = $val['value'];
					$user_id = $val['user_id'];
					$raw_mobile = $user_mob->fetchAll(
					  $user_mob->select()
						->where('`user_id` = ?', $user_id)
					);
					foreach($raw_mobile as $key1=>$val1){
						$mobile_id = $val1['mobile_id'];
						//error_log($mobile_id);
						
						$p = new App_Prefs();
						$prefs = $p->getCellphonePrefs($user_id,$mobile_id);
						$prefs["gift"]["max_get_per_day"] = $daily_transaction_limit;

						$p->saveCellphonePrefs($user_id,$mobile_id,$prefs);
					}
					
				}
				

				
				
			$this->redirect('home','admin','aw');
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	public function addmessageAction() {
       	try {
			$evt = new App_Event_Aw_AdminController_addmessage( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	public function editmessageAction() {
       	try {
			$this->view->allow_php_tag = true;
			$evt = new App_Event_Aw_AdminController_editmessage( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	public function deletemessageAction() {
       	try {
			$evt = new App_Event_Aw_AdminController_deletemessage( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','aw',$a);
		}
	}
	public function addroleAction(){
			try {
					$evt = new App_Event_Aw_AdminController_addrole( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','aw',$a);
			}	
	}

	public function editroleAction(){
			try {
					$evt = new App_Event_Aw_AdminController_editrole( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','aw',$a);
			}	
	}

	public function edituserAction(){
			try {
					$evt = new App_Event_Aw_AdminController_edituser( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','aw',$a);
			}	
	}

	public function searchuserAction(){
			/*try {
					$evt = new App_Event_Aw_AdminController_adduser( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','aw',$a);
			}	*/
	}
	

	public function adduserAction(){
			try {
					$evt = new App_Event_Aw_AdminController_adduser( $this->getRequest() );
					$evt->execute($this->ns,$this->view,$this);
			} catch (Exception $e) {
					$a["MESSAGE"] = $e->getMessage();
					$this->redirect('usererror','usererror','aw',$a);
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
			$this->redirect('home','admin','aw',$a);
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
		$r=App_Perm::getAdminWigiFeatures();
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

		$r=App_Perm::getAdminWigiFeatures();
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

		$this->redirect('home','admin','aw');


	}

}
