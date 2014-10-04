<?php
include(__DIR__ . '/WebController.php');

class Mw_OrdersController extends Mw_WebController {

	public function homeAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_home( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }	
	}

        public function scanandpayAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_scanandpay( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
        }

        public function scanandbuyAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_scanandbuy( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
        }

        public function ecommerceAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_ecommerce( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
        }

        public function posdevicesAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_posdevices( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
        }

        public function donationsAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_donations( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
        }

        public function receiveAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_receive( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
        }

        public function paymentsAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_payments( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
        }


	public function wigiAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_wigi( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }	
	}

		public function wigicAction(){
                try {
                        $evt = new App_Event_Mw_OrdersController_wigic( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }	
	}


	public function deleteorderAction() {
                try {
                        $evt = new App_Event_Mw_OrdersController_deleteorder( $this->getRequest() );
                        $evt->execute($this->ns,$this->view,$this);
                } catch (Exception $e) {
                        $a["MESSAGE"] = $e->getMessage();
                        $this->redirect('usererror','usererror','mw',$a);
                }
	
	}
	
}
