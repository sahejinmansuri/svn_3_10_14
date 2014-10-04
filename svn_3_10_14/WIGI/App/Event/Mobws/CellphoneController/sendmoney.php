<?php

class App_Event_Mobws_CellphoneController_sendmoney extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'TO' => array('phone', 15, 1, App_Constants::getFormLabel('TO')),
                'COUNTRYCODE' => array('amount', 3, 1, App_Constants::getFormLabel('COUNTRYCODE')),
                'AMOUNT' => array('amount', 12, 1, App_Constants::getFormLabel('AMOUNT')),
                'MESSAGE' => array('generic', 50, 1, App_Constants::getFormLabel('MESSAGE')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute($type){
                App_DataUtils::beginTransaction();
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Send Money');
                $to = $this->_request->getParam("TO");
                $countrycode = $this->_request->getParam("COUNTRYCODE");
                $amount = $this->_request->getParam("AMOUNT");
                $message = $this->_request->getParam("MESSAGE");

                setlocale(LC_MONETARY, 'en_US');
               // $amount = money_format('%i',$amount);
			   
                $u_from = new App_User($ns->userid);
				
				$cfg = Zend_Registry::get('config');
				$basepath = $cfg->paths->baseurl;
				
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
				

                $to_id = App_Cellphone::getIdFromCellphone($to,$countrycode);
                $from_id = $ns->mobileid;

                $c_from = new App_Cellphone($from_id);
                $c_from->checkConstraint($amount,'1');
                $c_from->checkConstraint($amount,'3');

                if (($countrycode !== $u_from->getCountryCode()) && (!$ns->prefs["wigi"]['international_trans'])) {
                  throw new App_Exception_WsException('Can not send internationally');
                  return false;
                }

                  $m = new App_Messenger();
                
                if (!$to_id) {
                  $m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you INR $amount. Please sign up at ".$basepath,$to,'2');
                  throw new App_Exception_WsException('Recipient is not a registered InCashMe User. A message has been sent to the recipient.');
                  return false;
                }

               // $c_to->checkConstraint($amount,'7',false);
			   
				$c_to = new App_Cellphone($to_id);
				
                $u_to = new App_User($c_to->getUserId());
				$to = $c_to->getCellphone();
				
				//add for kyc start
				$kyc_to_user1 = $u_to->getKYC();
				if($kyc_to_user1 == 0){
					$m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you INR $amount, but your kyc is pending.",$to,'2');
					throw new App_Exception_WsException("Recipient is registered but KYC is pending, so your recipient is unable to receive funds at this time. Please try again later.");
				}
				//add for kyc end
				
				$subscription_to_user1 = $u_to->getSubscribedUser();
				/*if($subscription_to_user1 == 0){
					$m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you INR $amount, but your subscription is pending.",$to,'2');
					throw new App_Exception_WsException("Cellphone is registered but subscription is pending, so your recipient is unable to receive funds at this time. Please try again later.");
				}*/
				//add for subscription checking

                if ($c_to->isLocked()) {
                  $m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you INR $amount, but your cellphone is currently locked. Please go to ".$basepath." for instructions.",$to,'2');
                  throw new App_Exception_WsException('Cellphone is registered but unable to receive funds at this time. Please try again later.');
                  return false;
                }

                if ($u_to->getStatus() === "unconfirmed") {
                  $m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you INR $amount, but your email is not currently activated. Please check your email and click 'Verify Now' to active your account.",$to,'2');
                  throw new App_Exception_WsException('Cellphone is registered but unable to receive funds at this time. Please try again later.');
                  return false;
                }

                if (!($c_to->isActivated())) {
                  $m->sendMessage("InCashMe: " . $u_from->getFirstName() . " has tried to send you INR $amount, but your cellphone is not currently active. Please go to ".$basepath." for instructions.",$to,'2');
                  throw new App_Exception_WsException('Cellphone is registered but not activated. Please try again later.');
                  return false;
                }

                $w = new App_WigiEngine();
                $w = $w->sendMoney($ns->extinfo,$from_id,$to_id,$amount,$type);
				//attune change start
/*if($message == '' or $message == NULL){
	$message_pass = '';
}else{
	$message_pass = ' Message: '.$message;
}*/
$message_pass = ' Message: '.$message;
				//attune change finish
                $c_from->sendMessage("InCashMe: You have sent INR $amount to $to", 'InCashMe: Money Sent',1);
                $c_to->sendMessage("InCashMe: You have received INR $amount from " . $c_from->getCellphone() . " Message: $message", 'InCashMe™: Money Recieved',1);


                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();

                return $result;
    }
}
