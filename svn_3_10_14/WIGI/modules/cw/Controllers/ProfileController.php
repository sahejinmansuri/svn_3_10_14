<?php
include(__DIR__ . '/WebController.php');

class Cw_ProfileController extends Cw_WebController {
	
	public function homeAction(){
          try {
            $evt = new App_Event_Cw_ProfileController_home( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
		
	}
	
	public function editpersonalAction(){

          try {
            $evt = new App_Event_Cw_ProfileController_editpersonal( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	
	}
	
	public function editpasswordAction(){

          try {
            $evt = new App_Event_Cw_ProfileController_editpassword( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function forceeditpasswordAction(){

          try {
            $evt = new App_Event_Cw_ProfileController_forceeditpassword( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function addmoneyAction(){

          try {
            $evt = new App_Event_Cw_ProfileController_addmoney( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function getroutingnumberAction(){
		$num = $this->getRequest()->getParam("ROUTING");
		
		$routings = new App_Models_Db_Wigi_RoutingNumberInfo();
		$result = $routings->fetchRow($routings->select()->where('routing = ?', $num));
		
		$this->getHelper('ViewRenderer')->setNoRender();
		if ($result != null) {
			echo $result->description;
		}
		
	}
	
	public function confirmmoneyAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_confirmmoney( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function deletemoneyAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_deletemoney( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function editprefsAction(){

          try {
            $evt = new App_Event_Cw_ProfileController_editprefs( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }


	}
	
	public function lockaccountAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_lockaccount( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function deleteaccountAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_deleteaccount( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function addcellAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_addcell( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	
	}
	
	public function editcellAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_editcell( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	
	}
	public function editpictureAction(){
	
          try {
            //$evt = new App_Event_Cw_ProfileController_editcell( $this->getRequest() );
            //$evt->execute($this->ns,$this->view,$this);
			$doaction = $this->getRequest()->getParam("doaction");
			$uid = $this->ns->userid;
			
			if($doaction == "edit"){
				
				$picture = $_FILES['picture'];
				if(($picture['type'] == 'image/jpeg') || ($picture['type'] == 'image/png') || ($picture['type'] == 'image/jpg')){
					$image_type_array = explode('/',$picture['type']);
					$image_type = $image_type_array[1];
					$time = time();
					
					$image_dir = '/var/www/html/incash/public_html/u/profile/';
					$image_name = $uid."_".$time.".".$image_type;
					move_uploaded_file($picture["tmp_name"],  $image_dir.$image_name);
					
					$uinfo = new App_Models_Db_Wigi_User();
					$uinfof = $uinfo->update(
						array(
							'image_path' => $image_name,
						),
						$uinfo->getAdapter()->quoteInto('user_id = ?', $uid)
					);
					
				}else{
					$a["MESSAGE"] = 'Please upload PNG, JPEG file format only';
					$this->redirect('usererror','usererror','cw',$a);
				}
				//print_r($picture);
				//exit();
				$file_path = $picture;
				$this->view->showcontent = 'success';
			}else{
				$this->view->showcontent = 'form';
			}
			
			$uinfo = new App_Models_Db_Wigi_User();
            $uinfof = $uinfo->fetchRow($uinfo->select()->from($uinfo,
				array('image_path','image_path2')
            )->where('user_id = ?', $uid));

			$this->view->image_path = $uinfof['image_path'];
			$this->view->image_path2 = $uinfof['image_path2'];
			
			
			
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	
	}
	
	public function editcellprefsAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_editcellprefs( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function editpinAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_editpin( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	
	}
	
	public function forgotpinAction(){
		try {
			$evt = new App_Event_Cw_ProfileController_forgotpin( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','cw',$a);
		}
	}
	
	public function viewquestionAction() {
	
          try {
            $evt = new App_Event_Cw_ProfileController_viewquestion( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function addquestionAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_addquestion( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function editquestionAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_editquestion( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function linkcellAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_linkcell( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function confirmcellAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_confirmcell( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	
	}
	
	public function deletecellAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_deletecell( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function setdefaultcellAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_setdefaultcell( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function lockcellAction(){
	
          try {
            $evt = new App_Event_Cw_ProfileController_lockcell( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
	}
	
	public function unlockcellAction(){

          try {
            $evt = new App_Event_Cw_ProfileController_unlockcell( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
						
		
	}
	
	public function accountAction(){

          try {
            //$evt = new App_Event_Cw_ProfileController_unlockcell( $this->getRequest() );
            //$evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            //$a["MESSAGE"] = $e->getMessage();
            //$this->redirect('usererror','usererror','cw',$a);
          }
						
		
	}
	public function getroleAction(){
		$mobile = $this->getRequest()->getParam("ITEM");
		$rolename = $this->getRequest()->getParam("rolename");
		$uid = $this->ns->identity['userid'];
		$ucell = new App_Models_Db_Wigi_UserMobile();
		$ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $mobile));
		
		$wigi_user_settings = $this->getWigiUsersSettings($uid);
		$existing_roles = App_Perm::prepareRolesDataUsers($wigi_user_settings);
		$this->view->existing_roles = $existing_roles;
		$this->view->showcontent = 'form';
		$this->view->currentrole = $ucget['role'];
		$this->view->ITEM = $mobile;
		
		$user = new App_User($uid);
		$cellphones = $user->getFmtCellphones();
		
		foreach ($cellphones as $cell) {
			if ($cell['mobile_id'] == $mobile) {
				$this->view->selectedcellphone = $cell['cellphone'];
			}
		}
		
		if(isset($rolename)){
		
			$ucell = new App_Models_Db_Wigi_UserMobile();
			$uinfof = $ucell->update(
				array(
					'role' => $rolename
                ),
				$ucell->getAdapter()->quoteInto('mobile_id = ?', $mobile)
			);
			$this->view->showcontent = 'success';
		}
	}
	
}
?>
