<?php

class App_Event_Mobws_CellphoneController_donate extends App_Event_WsEventAbstract {

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
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(){
                App_DataUtils::beginTransaction();
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Send Money');
                $merchantid = $this->_request->getParam("MERCHANTID");
                $amount = $this->_request->getParam("AMOUNT");
                $reason = $this->_request->getParam("REASON");


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

                if (!$to_id) {
                  $m = new App_Messenger();
                  $m->sendMessage("WiGime: " . $u_from->getFirstName() . " has tried to send you \$$amount. Please sign up at wigime.com",$to,'2');
                  throw new App_Exception_WsException('Cellphone is not a registered WiGime User. A message has been sent to the recipient.');
                  return false;
                }

                $c_to = new App_Cellphone($to_id);
                $c_to->checkConstraint($amount,'7',false);

                if ($u_to->getStatus() === "unconfirmed") {
                  $c_to->sendMessage("WiGime: " . $u_from->getFirstName() . " has tried to send you \$$amount, but your email is not currently activated. Please check your email and click 'Verify Now' to active your account.");
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

                //$c_from->sendMessage("WiGi: You have sent \$$amount to $to");
                //$c_to->sendMessage("WiGime: You have received \$$amount from " . $c_from->getCellphone() . " Message: $message");

                App_Order::donate($ns->mobileid,$to_id,$ns->userid,$to_user_id,$amount,'',$reason,'','');

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;
    }
}
