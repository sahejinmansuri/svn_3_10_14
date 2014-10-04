<?php

class App_Event_Mobws_CellphoneController_scangiftdecode extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MESSAGE'  => array('generic', 500, 1, App_Constants::getFormLabel('MESSAGE')),
                'KEY'  => array('generic', 500, 1, App_Constants::getFormLabel('KEY')),
                'IDENTIFIER'  => array('generic', 500, 1, App_Constants::getFormLabel('IDENTIFIER')),
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
		
		$mobile_id = $ns->mobileid;
		$extinfo = $ns->extinfo;
		
		$message_1 =  App_DataUtils::unobfuscate($message);
		
		$parts = explode('&',$message_1);
		foreach ($parts as $part) {
			list($var,$val) = explode('=',$part);
			$data[$var] = $val;
		}
		
		$cfg = Zend_Registry::get('config');
		$basepath = $cfg->paths->baseurl;
		
		$key = $this->_request->getParam("KEY");
		$IDENTIFIER = $this->_request->getParam("IDENTIFIER"); 
		 
		$url = $basepath."v2/mobws/cellphone/scangift/KEY/".$key."/IDENTIFIER/".$IDENTIFIER."/MERCHANTID/".$data['MERCHANTID']."/AMOUNT/".$data['AMOUNT']."/WIGICODE/".$data['WIGICODE']."";
		
		$success_message = "Scan and Gift™ transaction completed successfully!";
		
		$result = array();
		$result['result']['status'] = 'success';
		$result['result']['value'] = '';
		$dataRes=$url;
		
				$to_user_id = $data['MERCHANT_ID'];
                $u_to = "";
			if(!isset($data['TYPE'])){
					$result['result']['status'] = 'failure';
					$dataRes=array('title'=>'Security Warning','message'=>'This is an invalid & unsafe QR capture. Do not scan unrecognised QR codes! Tap info button on top to find more about recognized secure InCashMe Scan Payment System™ QR Codes');
				}else{
					/*try {
						$u_to = new App_User($to_user_id);
					} catch(App_Exception_WsException $e) {
						$dataRes=array('title'=>'Security Warning','message'=>'This is an invalid & un secure QR capture. Do not scan unrecognized QR codes! Tap info button on top to find more about recognized secure InCashMe™ Scan Payment System™ QR Codes.');
					}*/
					if((($data['TYPE'] != "Gift"))){
					$result['result']['status'] = 'failure';
						$dataRes=array('title'=>'Something is not Right','message'=>'This QR code is cross scanned from another feature. Tap info button on top to find more about recognized secure InCashMe Scan Payment System™ QR Code.');
					}
				}

		$result['result']['data']   = $dataRes;
		App_DataUtils::commit();
		return $result;

    }
}
