<?php
include(__DIR__ . '/WebController.php');

class Cw_MoneyController extends Cw_WebController {

    public function showaddAction(){

          try {
            $evt = new App_Event_Cw_MoneyController_showadd( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

    }

    public function addAction(){

          try {
            $evt = new App_Event_Cw_MoneyController_add( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }


    }

    public function showwithdrawAction(){

          try {
            $evt = new App_Event_Cw_MoneyController_showwithdraw( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

    }
    
    public function withdrawAction(){

          try {
            $evt = new App_Event_Cw_MoneyController_withdraw( $this->getRequest() );
            $evt->execute($this->ns,$this->view,$this);
          } catch (Exception $e) {
            $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror','usererror','cw',$a);
          }

	
    }


}
?>
