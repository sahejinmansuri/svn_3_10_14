<?php
include(__DIR__ . '/WebController.php');

class Mw_MoneyController extends Mw_WebController {
	
	public function showaddAction(){
		try {
			$evt = new App_Event_Mw_MoneyController_showadd( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function addAction(){
		try {
			$evt = new App_Event_Mw_MoneyController_add( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
	public function showwithdrawAction(){
		try {
			$evt = new App_Event_Mw_MoneyController_showwithdraw( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}

	public function withdrawAction(){
		try {
			$evt = new App_Event_Mw_MoneyController_withdraw( $this->getRequest() );
			$evt->execute($this->ns,$this->view,$this);
		} catch (Exception $e) {
			$a["MESSAGE"] = $e->getMessage();
			$this->redirect('usererror','usererror','mw',$a);
		}
	}
	
}
?>
