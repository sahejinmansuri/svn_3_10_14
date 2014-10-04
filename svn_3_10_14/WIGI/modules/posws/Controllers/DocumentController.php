<?php

include(__DIR__ . '/RestController.php');

class Posws_DocumentController extends Posws_RestController
{

       
	public function adddocumentAction() {
          $evt = new App_Event_Posws_DocumentController_adddocument( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

    public function getdocumentAction() {

          $evt = new App_Event_Posws_DocumentController_getdocument( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

    public function getdocumentsAction() {

          $evt = new App_Event_Posws_DocumentController_getdocuments( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);

    }

    public function getdocumentdataAction() {

          $evt = new App_Event_Posws_DocumentController_getdocumentdata( $this->getRequest() );
          $evt->execute();
			//$this->sendResponse($result);

    }
 	public function getinvoiceAction() {

          $evt = new App_Event_Posws_DocumentController_getinvoice( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);

    }

   public function deletedocumentAction() {
          $evt = new App_Event_Posws_DocumentController_deletedocument( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }

   public function updatedocumentAction() {
          $evt = new App_Event_Posws_DocumentController_updatedocument( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }

  
	public function setprefsAction(){
          $evt = new App_Event_Posws_DocumentController_setprefs( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function getprefsAction() {
          $evt = new App_Event_Posws_DocumentController_getprefs( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}
	public function editpasswordAction()
    {
          $evt = new App_Event_Posws_DocumentController_editpassword( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }
	public function editpasswordappAction()
    {
          $evt = new App_Event_Posws_DocumentController_editpasswordapp( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }


	public function editquestionAction()
    {
          $evt = new App_Event_Posws_DocumentController_editquestion( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }
	public function viewquestionAction()
    {
          $evt = new App_Event_Posws_DocumentController_viewquestion( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }
	public function addcellAction()
    {
		$evt = new App_Event_Posws_DocumentController_addcell( $this->getRequest() );
        $result = $evt->execute($this->ns,$this->view,$this);
        $this->sendResponse($result);
		
          //$evt = new App_Event_Mobws_CellphoneController_addcell( $this->getRequest() );
          //$result = $evt->execute($this);
          //$this->sendResponse($result);

    }
	public function deletecellAction()
    {
		$evt = new App_Event_Posws_DocumentController_deletecell( $this->getRequest() );
        $result = $evt->execute($this->ns,$this->view,$this);
        $this->sendResponse($result);
		
          //$evt = new App_Event_Mobws_CellphoneController_addcell( $this->getRequest() );
          //$result = $evt->execute($this);
          //$this->sendResponse($result);

    }
	public function getcellphonesAction()
    {
          $evt = new App_Event_Posws_DocumentController_getcellphones( $this->getRequest() );
          $result = $evt->execute();
		  $this->sendResponse($result);

    }
public function getcellAction()
    {
          $evt = new App_Event_Posws_DocumentController_getcell( $this->getRequest() );
          $result = $evt->execute();
		  $this->sendResponse($result);

    }
public function getcellcodeAction()
    {
          $evt = new App_Event_Posws_DocumentController_getcellcode( $this->getRequest() );
          $result = $evt->execute();
		  $this->sendResponse($result);

    }
	public function editcellAction()
    {
          $evt = new App_Event_Posws_DocumentController_editcell( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function emailinvoiceAction()
    {
          $evt = new App_Event_Posws_DocumentController_emailinvoice( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result); 
    }
	public function invoiceqrcodeAction()
    {
          $evt = new App_Event_Posws_DocumentController_invoiceqrcode( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result); 
    }
	public function scanedonateqrcodeAction()
    {
          $evt = new App_Event_Posws_DocumentController_scanedonateqrcode( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result); 
    }
}
