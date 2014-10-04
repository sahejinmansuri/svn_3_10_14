<?php
include(__DIR__ . '/WebController.php');

class Mw_AdvancedController extends Mw_WebController {
	
	public function homeAction(){
            try {
                    $evt = new App_Event_Mw_AdvancedController_home( $this->getRequest() );
                    $evt->execute($this->ns,$this->view,$this);
            } catch (Exception $e) {
                    $a["MESSAGE"] = $e->getMessage();
                    $this->redirect('usererror','usererror','mw',$a);
            }	
	}

        public function orderreportAction(){
            try {
                    $this->_helper->viewRenderer->setNoRender();
                    $evt = new App_Event_Mw_AdvancedController_orderreport( $this->getRequest() );
                    $evt->execute($this->ns,$this->view,$this);
            } catch (Exception $e) {
                    $a["MESSAGE"] = $e->getMessage();
                    $this->redirect('usererror','usererror','mw',$a);
            }
        }


        public function merchantidqrcodeAction(){
            try {
                    $this->_helper->viewRenderer->setNoRender();
                    $evt = new App_Event_Mw_AdvancedController_merchantidqrcode( $this->getRequest() );
                    $evt->execute($this->ns,$this->view,$this);
            } catch (Exception $e) {
                    $a["MESSAGE"] = $e->getMessage();
                    $this->redirect('usererror','usererror','mw',$a);
            }
        }


	public function getconsumernameAction(){
            try {
                    $evt = new App_Event_Mw_AdvancedController_getconsumername( $this->getRequest() );
                    $evt->execute($this->ns,$this->view,$this);
            } catch (Exception $e) {
                    $a["MESSAGE"] = $e->getMessage();
                    $this->redirect('usererror','usererror','mw',$a);
            }
	}

    public function getmerchantnameAction(){
            try {
                    $evt = new App_Event_Mw_AdvancedController_getmerchantname( $this->getRequest() );
                    $evt->execute($this->ns,$this->view,$this);
            } catch (Exception $e) {
                    $a["MESSAGE"] = $e->getMessage();
                    $this->redirect('usererror','usererror','mw',$a);
            }
    }
    
    public function getmerchantsAction(){
            try {
                    $evt = new App_Event_Mw_AdvancedController_getmerchants( $this->getRequest() );
                    $evt->execute($this->ns,$this->view,$this);
            } catch (Exception $e) {
                    $a["MESSAGE"] = $e->getMessage();
                    $this->redirect('usererror','usererror','mw',$a);
            }
    }

    public function sendpaymentAction(){
            try {
                    $evt = new App_Event_Mw_AdvancedController_sendpayment( $this->getRequest() );
                    $evt->execute($this->ns,$this->view,$this);
            } catch (Exception $e) {
                    $a["MESSAGE"] = $e->getMessage();
                    $this->redirect('usererror','usererror','mw',$a);
            }

    }
	
}
?>
