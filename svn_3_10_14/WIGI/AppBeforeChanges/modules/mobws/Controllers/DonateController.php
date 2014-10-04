<?php
include(__DIR__ . '/WebController.php');

class Mobws_DonateController extends Mobws_WebController{

    public function donatemoneyAction(){

			try {
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Donate Money');

                if ($ns->setdonation != true) {
                  throw new App_Exception_WsException("Please login to the mobile app to send donations.");
                }

                $merchantid = $this->getRequest()->getParam("MERCHANTID");
                $amount = $this->getRequest()->getParam("AMOUNT");
                $reason = $this->getRequest()->getParam("REASON");
                $startdate = $this->getRequest()->getParam("START_DATE");
                $enddate = $this->getRequest()->getParam("END_DATE");
                $frequency = $this->getRequest()->getParam("FREQUENCY");

                $doaction = $this->getRequest()->getParam("doaction");

                $uid = App_User::getUserIdFromMerchantId($merchantid);
                $user = new App_User($uid);

                $this->view->showcontent = "form";

                $this->view->MERCHANT = $user->getBusinessName();
                $this->view->MERCHANTID = $merchantid;
                $this->view->AMOUNT     = $amount;
                $this->view->REASON     = $reason;
                
                if (! $startdate) {
	                $this->view->ONETIME    = true;
                    $this->view->START_DATE = "";
	                $this->view->END_DATE   = "";
	                $this->view->FREQUENCY  = "";
		        } else {
		        	$startdate = App_DataUtils::fmttime_datetime($startdate);
	            	$enddate = App_DataUtils::fmttime_datetime($enddate);
	            	
	                $this->view->ONETIME    = false;
	                $this->view->START_DATE = $startdate;
	                $this->view->END_DATE   = $enddate;
	                $this->view->FREQUENCY  = $frequency;
		        }
                
                $this->view->URLKEY = $this->getRequest()->getParam("KEY");
                $this->view->IDENTIFIER = $this->getRequest()->getParam("IDENTIFIER");
                $this->view->OSID = $this->getRequest()->getParam("OSID");

                if ($doaction != null) {

                setlocale(LC_MONETARY, 'en_US');
                $amount = money_format('%i',$amount);

                $u_from = new App_User($ns->userid);

                //extract user_id from merchant id
                $to_user_id = App_User::getUserIdFromMerchantId($merchantid);
                $u_to = "";
                try {
                $u_to = new App_User($to_user_id);
                } catch(App_Exception_WsException $e) {
                        throw new App_Exception_WsException("Merchant ID does not exist");
                }

                if ($u_to->getStatus() === "locked") {
                        throw new App_Exception_WsException("Can not donate to this organization at this time");
                }

                if ($u_to->getBusinessType() != "5") {
                        throw new App_Exception_WsException("Only non-profit groups can accept donations");
                }

                //get virtual pos id
                $to_id = $u_to->getDefaultCellphone();
                $from_id = $ns->mobileid;

                $c_from = new App_Cellphone($from_id);
                $c_from->checkConstraint($amount,'1');
                $c_from->checkConstraint($amount,'3');
                
                if (!$c_from->hasEnoughMoney($amount)) {
                  throw new App_Exception_WsException('This operation is not allowed since you do not have sufficient funds available in your account.');
                  return false;
                }

                if (!$to_id) {
                  $m = new App_Messenger();
                  $m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you \$$amount. Please sign up at incashme.in",$to,'2');
                  throw new App_Exception_WsException('Cellphone is not a registered InCashMe User. A message has been sent to the recipient.');
                  return false;
                }

                $c_to = new App_Cellphone($to_id);
                $c_to->checkConstraint($amount,'7',false);

                if ($u_to->getStatus() === "unconfirmed") {
                  $c_to->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you \$$amount, but your email is not currently activated. Please check your email and click 'Verify Now' to active your account.");
                  throw new App_Exception_WsException('Cellphone is registered but unable to receive funds at this time. Please try again later.');
                  return false;
                }


                if ($u_to->getStatus() !== "active") {
                  throw new App_Exception_WsException('Merchant is registered but not activated. Please try again later.');
                  return false;
                }

                $ns->extinfo['user_description'] = $reason;

                $w = new App_WigiEngine();

                if ($startdate === "") {
                  $w->sendMoney($ns->extinfo,$from_id,$to_id,$amount,"Donation");
                }

                //$c_fro->sendMessage("InCashMe: You have sent \$$amount to $to");
                //$c_to->sendMessage("InCashMe: You have received \$$amount from " . $c_from->getCellphone() . " Message: $message");
                App_Order::donate($ns->mobileid,$to_id,$ns->userid,$to_user_id,$amount,'',$reason,'','',$startdate,$enddate,$frequency);

                $this->view->showcontent = "success";
                $ns->setdonation = false;
                session_write_close();

                }
          } catch (Exception $e) {
               $this->view->error = $e->getMessage();
               $a["MESSAGE"] = $e->getMessage();
               $this->redirect('usererror','usererror','mobws',$a);
          }



    }

    public function testAction(){
    }

    
}