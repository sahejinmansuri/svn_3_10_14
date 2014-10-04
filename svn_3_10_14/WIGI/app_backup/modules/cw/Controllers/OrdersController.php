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
            $evt = new App_Event_Cw_OrdersController_scanandpay( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }

        public function scanandbuyAction(){
          try {
            $evt = new App_Event_Cw_OrdersController_scanandbuy( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }

        public function ecommerceAction(){
          try {
            $evt = new App_Event_Cw_OrdersController_ecommerce( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }

        public function paymentsAction(){
          try {
            $evt = new App_Event_Cw_OrdersController_payments( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }
        }

        public function donationsAction(){
          try {
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
