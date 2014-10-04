<?php

class App_Event_Mobws_CellphoneController_scanpay extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MESSAGE'  => array('generic', 500, 1, App_Constants::getFormLabel('MESSAGE')),
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

		$message  = $this->_request->getParam("MESSAGE");
		
        $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
        //App_DataUtils::userlogp('User',$ns->mobileid,'support','Support Message');

		
		$mobile_id = $ns->mobileid;
		$extinfo = $ns->extinfo;
		
		//$mobile_id = '821';
		//$extinfo = "";
		
		$message_1 =  App_DataUtils::unobfuscate($message);
		//echo $message_1;
//echo "<br>";
		//echo $message_1;
		//exit();
		$parts = explode('&',$message_1);
		foreach ($parts as $part) {
			list($var,$val) = explode('=',$part);
			$data[$var] = $val;
		}
		
		
		$cellphone_user = new App_Cellphone($mobile_id);
		
		$user_id = $cellphone_user->getUserId();
		
		$user = new App_User($user_id);
		$amount = $data['AMOUNT'];
		$wigicode = $data['WIGICODE'];
		
		$mname = App_ScanPayment::scan_and_pay($cellphone_user, $user, $data['MERCHANT_ID'], $amount, $wigicode,$extinfo);
		
		$result = array();
		$result['result']['status'] = 'success';
		$result['result']['value'] = '';
		$result['result']['data']   = 'Your have sent payment of INR  '.$amount.' to '.$mname;


		App_DataUtils::commit();
		return $result;

    }
}
