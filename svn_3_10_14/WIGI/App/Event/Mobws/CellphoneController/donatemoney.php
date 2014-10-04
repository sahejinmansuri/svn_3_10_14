<?php

class App_Event_Mobws_CellphoneController_donatemoney extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MERCHANTID' => array('merchantid', 60, 1, App_Constants::getFormLabel('MERCHANTID')),
                'AMOUNT' => array('amount', 12, 1, App_Constants::getFormLabel('AMOUNT')),
                'REASON' => array('generic', 50, 0, App_Constants::getFormLabel('REASON')),
                'START_DATE' => array('generic', 50, 0, App_Constants::getFormLabel('START_DATE')),
                'END_DATE' => array('generic', 50, 0, App_Constants::getFormLabel('END_DATE')),
                'FREQUENCY' => array('generic', 50, 0, App_Constants::getFormLabel('FREQUENCY')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$session_data,&$pview,&$cthis){


                App_DataUtils::beginTransaction();
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
				//$ns->userid = '692';
				//$ns->mobileid = '821';
                //App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Donate Money');
                $merchantid = $this->_request->getParam("MERCHANTID");
                $amount = $this->_request->getParam("AMOUNT");
				
                $reason = $this->_request->getParam("REASON");
				$startdate = $this->_request->getParam("START_DATE");
                $enddate = $this->_request->getParam("END_DATE");
                $frequency = $this->_request->getParam("FREQUENCY");
				
				if (isset($startdate)) {
					$startdate = App_DataUtils::fmttime_datetime($startdate);
	            	$enddate = App_DataUtils::fmttime_datetime($enddate);
		        }
                
                if ($reason == null) {
	                $reason = "";
                }

                $doaction = $this->_request->getParam("doaction");


		$pview->MERCHANTID = $merchantid;
                $pview->AMOUNT     = $amount;
                $pview->REASON     = $reason;                 

				
				
        //if ($doaction != null) {

                //setlocale(LC_MONETARY, 'en_US');
                $amount = money_format('%i',$amount);

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
                $c_from->checkConstraint($amount,'1');
                $c_from->checkConstraint($amount,'3');

                if (!$to_id) {
                  $m = new App_Messenger();
                  $m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you ₹$amount. Please sign up at incashme.in",$to,'2');
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

		//}

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $amount;

                App_DataUtils::commit();
                return $result;

    }
}
