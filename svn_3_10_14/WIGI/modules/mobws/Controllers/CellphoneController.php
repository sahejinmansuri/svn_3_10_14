<?php

include(__DIR__ . '/RestController.php');

class Mobws_CellphoneController extends Mobws_RestController
{

        public function donatemoneyAction(){
			$evt = new App_Event_Mobws_CellphoneController_donatemoney( $this->getRequest() );
			$result = $evt->execute($this->ns,$this->view,$this);
			$this->sendResponse($result);
          //try {
            //$evt = new App_Event_Mobws_CellphoneController_donatemoney( $this->getRequest() );
            //$this->view = $evt->execute($this->ns,$this->view,$this);
          //} catch (Exception $e) {
          //  $a["MESSAGE"] = $e->getMessage();
          //  $this->redirect('usererror','usererror','cw',$a);
          //}

        }

        public function setdonationAction(){
          $evt = new App_Event_Mobws_CellphoneController_setdonation( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

         public function updatedonationAction(){
          $evt = new App_Event_Mobws_CellphoneController_updatedonation( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

        public function canceldonationAction(){
          $evt = new App_Event_Mobws_CellphoneController_canceldonation( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

        public function getscheduleddonationsAction(){
          $evt = new App_Event_Mobws_CellphoneController_getscheduleddonations( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }


        public function addmoneyAction(){
          $evt = new App_Event_Mobws_CellphoneController_addmoney( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

        public function getroutingnumberAction(){
          $evt = new App_Event_Mobws_CellphoneController_getroutingnumber( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

        public function confirmmoneyAction(){
          $evt = new App_Event_Mobws_CellphoneController_confirmmoney( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

        public function deletemoneyAction(){
          $evt = new App_Event_Mobws_CellphoneController_deletemoney( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }


        public function updatescanandpayAction(){
          $evt = new App_Event_Mobws_CellphoneController_updatescanandpay( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

        public function cancelscanandpayAction(){
          $evt = new App_Event_Mobws_CellphoneController_cancelscanandpay( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

        public function tellfriendsAction(){
          $evt = new App_Event_Mobws_CellphoneController_tellfriends( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }


        public function sendbugAction(){
          $evt = new App_Event_Mobws_CellphoneController_sendbug( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }


        public function getallbalanceAction(){
          $evt = new App_Event_Mobws_CellphoneController_getallbalance( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

	
	public function getbalanceAction(){
          $evt = new App_Event_Mobws_CellphoneController_getbalance( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function gettempbalanceAction(){
          $evt = new App_Event_Mobws_CellphoneController_gettempbalance( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function sendgiftAction() {
          $evt = new App_Event_Mobws_CellphoneController_sendmoney( $this->getRequest() );
          $result = $evt->execute("Gift");
          $this->sendResponse($result);
        }

	public function sendmoneyAction(){
          $evt = new App_Event_Mobws_CellphoneController_sendmoney( $this->getRequest() );
          $result = $evt->execute("Money");
          $this->sendResponse($result);
	}

	public function createtransactionAction(){
          $evt = new App_Event_Mobws_CellphoneController_createtransaction( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function sendtransactionAction() {
          $evt = new App_Event_Mobws_CellphoneController_sendtransaction( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

        public function donateAction() {
          $evt = new App_Event_Mobws_CellphoneController_donate( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

	public function getmerchantnameAction() {
          $evt = new App_Event_Mobws_CellphoneController_getmerchantname( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}
	public function getmerchantdetailAction() {
          $evt = new App_Event_Mobws_CellphoneController_getmerchantdetail( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}


	public function selffundAction(){
          $evt = new App_Event_Mobws_CellphoneController_selffund( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function withdrawAction(){
          $evt = new App_Event_Mobws_CellphoneController_withdraw( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function getcreditcardsAction(){
          $evt = new App_Event_Mobws_CellphoneController_getcreditcards( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function getallaccountsAction(){
          $evt = new App_Event_Mobws_CellphoneController_getallaccounts( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}




	public function getbankaccountsAction(){
          $evt = new App_Event_Mobws_CellphoneController_getbankaccounts( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function getactivewigicodesAction(){
          $evt = new App_Event_Mobws_CellphoneController_getactivewigicodes( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function gethistoryAction(){
          $evt = new App_Event_Mobws_CellphoneController_gethistory( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);
	}

        public function getscheduledpaymentsAction(){
          $evt = new App_Event_Mobws_CellphoneController_getscheduledpayments( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

	public function resetpinAction(){
          $evt = new App_Event_Mobws_CellphoneController_resetpin( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function settransactionviewedAction(){
          $evt = new App_Event_Mobws_CellphoneController_settransactionviewed( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function setprefsAction(){
          $evt = new App_Event_Mobws_CellphoneController_setprefs( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function getprefsAction() {
          $evt = new App_Event_Mobws_CellphoneController_getprefs( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);
	}

	public function deletecodeAction(){
          $evt = new App_Event_Mobws_CellphoneController_deletecode( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);	
        }

	public function getmessageAction() {
          $evt = new App_Event_Mobws_CellphoneController_getmessage( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);
	}

	public function getnewmessageAction() {
          $evt = new App_Event_Mobws_CellphoneController_getnewmessage( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

	public function setmessageviewedAction() {
          $evt = new App_Event_Mobws_CellphoneController_setmessageviewed( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
	}

        public function contactusAction() {
          $evt = new App_Event_Mobws_CellphoneController_contactus( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }

        public function lockaccountAction() {
          $evt = new App_Event_Mobws_CellphoneController_lockaccount( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
        }


      public function wigiqrcodeAction() {
          $evt = new App_Event_Mobws_CellphoneController_wigiqrcode( $this->getRequest() );
          $result = $evt->execute();
      }
      public function qrcodetestAction() {
          $evt = new App_Event_Mobws_CellphoneController_qrcodetest( $this->getRequest() );
          $result = $evt->execute();
      }

    public function adddocumentAction() {
          $evt = new App_Event_Mobws_CellphoneController_adddocument( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

    public function getdocumentAction() {

          $evt = new App_Event_Mobws_CellphoneController_getdocument( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
    }

    public function getdocumentsAction() {

          $evt = new App_Event_Mobws_CellphoneController_getdocuments( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }

    public function getdocumentdataAction() {

          $evt = new App_Event_Mobws_CellphoneController_getdocumentdata( $this->getRequest() );
          $result = $evt->execute();


    }


   public function deletedocumentAction() {
          $evt = new App_Event_Mobws_CellphoneController_deletedocument( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }

   public function updatedocumentAction() {
          $evt = new App_Event_Mobws_CellphoneController_updatedocument( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }

   public function searchmerchantAction() {
          $evt = new App_Event_Mobws_CellphoneController_searchmerchant( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }

   public function getlogoAction() {
          $evt = new App_Event_Mobws_CellphoneController_getlogo( $this->getRequest() );
          $result = $evt->execute();
          $this->sendResponse($result);
   }

	public function addcellAction()
    {
		$evt = new App_Event_Mobws_CellphoneController_addcell( $this->getRequest() );
        $result = $evt->execute($this->ns,$this->view,$this);
        $this->sendResponse($result);
		
          //$evt = new App_Event_Mobws_CellphoneController_addcell( $this->getRequest() );
          //$result = $evt->execute($this);
          //$this->sendResponse($result);

    }
	public function deletecellAction()
    {
		$evt = new App_Event_Mobws_CellphoneController_deletecell( $this->getRequest() );
        $result = $evt->execute($this->ns,$this->view,$this);
        $this->sendResponse($result);
		
          //$evt = new App_Event_Mobws_CellphoneController_addcell( $this->getRequest() );
          //$result = $evt->execute($this);
          //$this->sendResponse($result);

    }
	public function editquestionAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_editquestion( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }
	public function editpasswordAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_editpassword( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }
	public function viewquestionAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_viewquestion( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
          $this->sendResponse($result);

    }
	public function editprofileAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_editprofile( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }	
	public function updateprofileAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_updateprofile( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }	
	public function getcellphonesAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_getcellphones( $this->getRequest() );
          $result = $evt->execute();
		  $this->sendResponse($result);

    }
	public function editcellAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_editcell( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function getstatementAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_getstatement( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function viewstatementAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_viewstatement( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);
    }
	public function downloadstatementAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_downloadstatement( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);
    }
	public function downloaddocumentAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_downloaddocument( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);
    }
	public function userstatementAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_userstatement( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);
    }
	public function emailstatementAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_emailstatement( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result); 
    }
	public function emailuserstatementAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_emailuserstatement( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result); 
    }
	public function banktransferAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_banktransfer( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);
    }
	public function applicationsessionAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_applicationsession( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result); 
    }
	public function emaildocumentAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_emaildocument( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result); 
    }
		
	public function isdefaultcellAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_isdefaultcell( $this->getRequest() );
          $result = $evt->execute();
		  $this->sendResponse($result);

    }
	public function addroleAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_addrole( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function getallroleAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_getallrole( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function getroleAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_getrole( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function editroleAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_editrole( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function deleteroleAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_deleterole( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function assignroleAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_assignrole( $this->getRequest() );
          $result = $evt->execute();
		  $this->sendResponse($result);

    }
	public function movefundsAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_movefunds( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function celldetailAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_celldetail( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function scanpayAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_scanpay( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function scandonatedecodeAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_scandonatedecode( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function scanpaydecodeAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_scanpaydecode( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function scangiftdecodeAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_scangiftdecode( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	public function scanbuydecodeAction()
    {
          $evt = new App_Event_Mobws_CellphoneController_scanbuydecode( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);

    }
	


}
