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
	
}
?>
