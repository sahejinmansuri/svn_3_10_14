<?php
include(__DIR__ . '/WebController.php');

class Cw_OrdersController extends Cw_WebController {

	public function homeAction(){
          try {
            $evt = new App_Event_Cw_OrdersController_home( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
	}

        public function scanandpayAction(){
          try {
			$this->view->pageid_inner = "scanandpay";
            $evt = new App_Event_Cw_OrdersController_scanandpay( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }

        public function scanandbuyAction(){
          try {
			$this->view->pageid_inner = "scanandbuy";
            $evt = new App_Event_Cw_OrdersController_scanandbuy( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }

        public function ecommerceAction(){
          try {
			$this->view->pageid_inner = "ecommerce";
            $evt = new App_Event_Cw_OrdersController_ecommerce( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }

        public function paymentsAction(){
          try {
			$this->view->pageid_inner = "payments";
            $evt = new App_Event_Cw_OrdersController_payments( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }

        public function donationsAction(){
          try {
			$this->view->pageid_inner = "donations";
            $evt = new App_Event_Cw_OrdersController_donations( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }


	public function deleteorderAction() {
          try {
            $evt = new App_Event_Cw_OrdersController_deleteorder( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }	
	}
	
}
