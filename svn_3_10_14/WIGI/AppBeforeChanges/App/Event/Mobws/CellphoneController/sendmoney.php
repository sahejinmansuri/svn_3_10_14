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
                $amount = intval($this->_request->getParam("AMOUNT"));
                $message = $this->_request->getParam("MESSAGE");


                setlocale(LC_MONETARY, 'en_US');
               // $amount = money_format('%i',$amount);

                $u_from = new App_User($ns->userid);

                $to_id = App_Cellphone::getIdFromCellphone($to,$countrycode);
                $from_id = $ns->mobileid;

                $c_from = new App_Cellphone($from_id);
                $c_from->checkConstraint($amount,'1');
                $c_from->checkConstraint($amount,'3');

                if (($countrycode !== $u_from->getCountryCode()) && (!$ns->prefs["wigi"]['international_trans'])) {
                  throw new App_Exception_WsException('Can not send internationally');
                  return false;
                }

                if (!$to_id) {
                  $m = new App_Messenger();
                  $m->sendMessage("WiGime: " . $u_from->getFirstName() . " has tried to send you \$$amount. Please sign up at https://wigime.com/join",$to,'2');
                  throw new App_Exception_WsException('Cellphone is not a registered WiGime User. A message has been sent to the recipient.');
                  return false;
                }

                $c_to = new App_Cellphone($to_id);
               // $c_to->checkConstraint($amount,'7',false);

                $u_to = new App_User($c_to->getUserId());

                if ($c_to->isLocked()) {
                  $c_to->sendMessage("WiGime: " . $u_from->getFirstName() . " has tried to send you \$$amount, but your cellphone is currently locked. Please go to https://wigime.com for instructions.");
                  throw new App_Exception_WsException('Cellphone is registered but unable to receive funds at this time. Please try again later.');
                  return false;
                }

                if ($u_to->getStatus() === "unconfirmed") {
                  $c_to->sendMessage("WiGime: " . $u_from->getFirstName() . " has tried to send you \$$amount, but your email is not currently activated. Please check your email and click 'Verify Now' to active your account.");
                  throw new App_Exception_WsException('Cellphone is registered but unable to receive funds at this time. Please try again later.');
                  return false;
                }


                if (!($c_to->isActivated())) {
                  $c_to->sendMessage("WiGime: " . $u_from->getFirstName() . " has tried to send you \$$amount, but your cellphone is not currently active. Please go to https://wigime.com for instructions.");
                  throw new App_Exception_WsException('Cellphone is registered but not activated. Please try again later.');
                  return false;
                }

                $w = new App_WigiEngine();
                $w = $w->sendMoney($ns->extinfo,$from_id,$to_id,$amount,$type);

                //$c_from->sendMessage("WiGi: You have sent \$$amount to $to");
                $c_to->sendMessage("WiGime: You have received \$$amount from " . $u_from->getFirstName() . " at " . App_DataUtils::fmtphone($c_from->getCellphone()) . " Message: $message");


                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();

                return $result;
    }
}
