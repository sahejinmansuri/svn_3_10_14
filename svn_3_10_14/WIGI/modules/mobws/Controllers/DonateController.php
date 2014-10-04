<?php
include(__DIR__ . '/WebController.php');

class Mobws_DonateController extends Mobws_WebController{

    public function donatemoneyAction(){
	
			/*$result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = 'data';*/

		/*$evt = new App_Event_Mobws_DonateController_donatemoney( $this->getRequest() );
        $result = $evt->execute($this->ns,$this->view,$this);
        $this->sendResponse($result);*/
			
			/*$evt = new App_Event_Mobws_DonateController_donatemoney( $this->getRequest() );
            $this->view = $evt->execute($this->ns,$this->view,$this);*/
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
				
				$amount_without_currency = $amount;


                $uid = App_User::getUserIdFromMerchantId($merchantid);
                $user = new App_User($uid);
				$u_from = new App_User($ns->userid);
				
				//add for kyc start
				$kyc_to_user = $u_from->getKYC();
				if($kyc_to_user == 0){
					throw new App_Exception_WsException("KYC Pending! To Access this feature your kyc must be under green and approved");
				}
				//add for kyc end
				
				//subscription checking start
				$subscription_to_user = $u_from->getSubscribedUser(); 
				$SubscribedCount = $u_from->getSubscribedCount();
				
				if($subscription_to_user == 0){
					$subscribe = App_User::subscribe_userbyid($ns->userid, $SubscribedCount); 
				}
				
				$u_from = new App_User($ns->userid);
				$subscription_to_user_new = $u_from->getSubscribedUser(); 
				
				if($subscription_to_user_new == 0){
					throw new App_Exception_WsException("Your subscription is not completed");
				}
				
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

                //setlocale(LC_MONETARY, 'en_US');
                //$amount = money_format('%i',$amount);
				

                

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
				
				//can not send recurring donation to same merchant which has been donated before
		
			$p["CONSUMER_MOBILE_ID"] = $ns->mobileid;
			$p["STATUS"] = 'recurring';
			$timezone = '+5.5';

			$results = App_Order::getConsumerOrdersRecurring($ns->userid,$p,'donate','0','1000',$timezone);
			$flag = 0;
			//$now = time() + (24 * 60*60*40);
			$now = time();
			foreach($results as $key=>$val){
				$merchant_id = $val['merchant_user_id'];
				$donate_end_date = $val['donate_end_date'];
				$donate_start_date = $val['donate_start_date'];
				if($merchant_id == $to_user_id){
					$time_end = $val['time_end'];
					if($now < $time_end){
						$flag = 1;
					}
				}
			}
			
		if (isset($startdate)) {
			if($flag == 1){
				throw new App_Exception_WsException("This merchant is already linked to your wallet. Update your linked merchant to donate.");
			}
		}
		//end code for recurring checking

                //get virtual pos id
                $to_id = $u_to->getDefaultCellphone();
                $from_id = $ns->mobileid;

                $c_from = new App_Cellphone($from_id);
                $c_from->checkConstraint($amount_without_currency,'1');
                $c_from->checkConstraint($amount_without_currency,'3');
                
				$cfg = Zend_Registry::get('config');
				$basepath = $cfg->paths->baseurl;
		
				
                if (!$to_id) {
                  $m = new App_Messenger();
                  $m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you ₹$amount. Please sign up at ".$basepath,$to,'2');
                  throw new App_Exception_WsException('Cellphone is not a registered InCashMe User. A message has been sent to the recipient.');
                  return false;
                }

                $c_to = new App_Cellphone($to_id);
                $c_to->checkConstraint($amount,'7',false);

                if ($u_to->getStatus() === "unconfirmed") {
                  $c_to->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you ₹$amount, but your email is not currently activated. Please check your email and click 'Verify Now' to active your account.",'Activate InCashMe Account',1);
                  throw new App_Exception_WsException('Cellphone is registered but unable to receive funds at this time. Please try again later.');
                  return false;
                }


                if ($u_to->getStatus() !== "active") {
                  throw new App_Exception_WsException('Merchant is registered but not activated. Please try again later.');
                  return false;
                }

                $ns->extinfo['user_description'] = $reason;

                $w = new App_WigiEngine();
                $w->sendMoney($ns->extinfo,$from_id,$to_id,$amount,"Donation");
				$to = $c_to->getCellphone();
                $c_from->sendMessage("InCashMe: You have sent INR ".$amount." to $to", 'InCashMe : Donate Money',1);
                $c_to->sendMessage("InCashMe: You have received INR ".$amount." from " . $c_from->getCellphone() . " Message: $message", 'InCashMe : Recieve Money',1);
				
                $order_id = App_Order::donate($ns->mobileid,$to_id,$ns->userid,$to_user_id,$amount,'',$reason,'','',$startdate,$enddate,$frequency);

				if (isset($startdate)) {
					$insert_data = array(
						'order_id' => $order_id,
					   'donate_date'  => time(),
					   'osid' => $ns->extinfo['osid'],
					   'devicetod'  => $ns->extinfo['devicetod'],
					   'appversion' => $ns->extinfo['appversion'],
					   'devicemodel'    => $ns->extinfo['devicemodel'],
					   'systemname' => $ns->extinfo['systemname'],
					   'systemversion' => $ns->extinfo['systemversion'],
					   'gps' => $ns->extinfo['gps'],
					   'appname' =>  $ns->extinfo['appname'],
					   'language' => $ns->extinfo['language'],
					   'ip_address' => $ns->extinfo['ip_address'],
					   'server_datetime' => $ns->extinfo['server_datetime'],
					   'client_datetime' => $ns->extinfo['client_datetime'],
					   'os' => $ns->extinfo['os'],
					   'browser_string' => $ns->extinfo['browser_string'],
					   'user_description' => $ns->extinfo['user_description'],
					);
					$dr = new App_Models_Db_Wigi_DonateRecurring();
					$dr->insert($insert_data);
				}
				
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

	public function scandonateAction()
    {
          /*$evt = new App_Event_Mobws_DonateController_scandonate( $this->getRequest() );
          $result = $evt->execute($this->ns,$this->view,$this);
		  $this->sendResponse($result);*/
		  
		  $merchantid = $this->getRequest()->getParam("MERCHANTID");
        $amount = $this->getRequest()->getParam("AMOUNT");
		$reason = "Scan and Donate";
       
		  
		  try {
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile',$reason);

                /*if ($ns->setdonation != true) {
                  throw new App_Exception_WsException("Please login to the mobile app to send donations.");
                }*/
				
				$cfg = Zend_Registry::get('config');
				$basepath = $cfg->paths->baseurl;

                $merchantid = $this->getRequest()->getParam("MERCHANTID");
                $amount = $this->getRequest()->getParam("AMOUNT");
                $wigicode = $this->getRequest()->getParam("WIGICODE");
                $doaction = $this->getRequest()->getParam("doaction");
				
				$amount_without_currency = $amount;


                $uid = App_User::getUserIdFromMerchantId($merchantid);
                $user = new App_User($uid);
				$u_from = new App_User($ns->userid);
				
				//add for kyc start
				$kyc_to_user = $u_from->getKYC();
				if($kyc_to_user == 0){
					throw new App_Exception_WsException("KYC Pending! To Access this feature your kyc must be under green and approved");
				}
				//add for kyc end
				
				//subscription checking start
				$subscription_to_user = $u_from->getSubscribedUser(); 
				$SubscribedCount = $u_from->getSubscribedCount();
				
				if($subscription_to_user == 0){
					$subscribe = App_User::subscribe_userbyid($ns->userid, $SubscribedCount); 
				}
				
				$u_from = new App_User($ns->userid);
				$subscription_to_user_new = $u_from->getSubscribedUser(); 
				
				if($subscription_to_user_new == 0){
					throw new App_Exception_WsException("Your subscription is not completed");
				}
				//add for subscription checking
				
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

                

                //get virtual pos id
                $to_id = $u_to->getDefaultCellphone();
                $from_id = $ns->mobileid;

                $c_from = new App_Cellphone($from_id);
                $c_from->checkConstraint($amount_without_currency,'1');
                $c_from->checkConstraint($amount_without_currency,'3');
                
                if (!$to_id) {
                  $m = new App_Messenger();
                  $m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you ₹$amount. Please sign up at ".$basepath,$to,'2');
                  throw new App_Exception_WsException('Cellphone is not a registered InCashMe User. A message has been sent to the recipient.');
                  return false;
                }

                $c_to = new App_Cellphone($to_id);
                $c_to->checkConstraint($amount,'7',false);

                if ($u_to->getStatus() === "unconfirmed") {
                  $c_to->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you ₹$amount, but your email is not currently activated. Please check your email and click 'Verify Now' to active your account.",'Activate InCashMe Account',1);
                  throw new App_Exception_WsException('Cellphone is registered but unable to receive funds at this time. Please try again later.');
                  return false;
                }


                if ($u_to->getStatus() !== "active") {
                  throw new App_Exception_WsException('Merchant is registered but not activated. Please try again later.');
                  return false;
                }

                $ns->extinfo['user_description'] = $reason;

                $w = new App_WigiEngine();
                $w->sendMoney($ns->extinfo,$from_id,$to_id,$amount,"Donation");
				$to = $c_to->getCellphone();
                $c_from->sendMessage("InCashMe: You have sent INR ".$amount." to $to", 'InCashMe : Donate Money',1);
                $c_to->sendMessage("InCashMe: You have received INR ".$amount." from " . $c_from->getCellphone() . " Message: $message", 'InCashMe : Recieve Money',1);
				
                $order_id = App_Order::donate($ns->mobileid,$to_id,$ns->userid,$to_user_id,$amount,'',$reason,'','',$startdate,$enddate,$frequency);

				
				$this->view->showcontent = "success";
                //$ns->setdonation = false;
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