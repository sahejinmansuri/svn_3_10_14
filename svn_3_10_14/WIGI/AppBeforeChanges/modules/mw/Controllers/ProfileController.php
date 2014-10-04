<?php
include(__DIR__ . '/WebController.php');

class Mw_ProfileController extends Mw_WebController {
	
	public function homeAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_home( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function editpersonalAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_editpersonal( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function editpasswordAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_editpassword( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function edituserpasswordAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_edituserpassword( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function forceeditpasswordAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_forceeditpassword( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function edituserstatusAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_edituserstatus( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function addmoneyAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_addmoney( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
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
			$evt = new App_Event_Mw_ProfileController_confirmmoney( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function deletemoneyAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_deletemoney( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function editprefsAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_editprefs( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function lockaccountAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_lockaccount( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function deleteaccountAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_deleteaccount( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function addcellAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_addcell( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function editcellAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_editcell( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function editcellprefsAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_editcellprefs( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function editpinAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_editpin( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function forgotpinAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_forgotpin( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function editquestionAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_editquestion( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function addquestionAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_addquestion( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function viewquestionAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_viewquestion( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function deletecellAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_deletecell( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function setdefaultcellAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_setdefaultcell( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function lockcellAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_lockcell( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function unlockcellAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_unlockcell( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function adduserAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_adduser( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function edituserAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_edituser( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function deleteuserAction(){
		try {
			$evt = new App_Event_Mw_ProfileController_deleteuser( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function addlogoAction() {
		try {
			$evt = new App_Event_Mw_ProfileController_addlogo( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function viewlogoAction() {
		try {
			$evt = new App_Event_Mw_ProfileController_viewlogo( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
}
?>