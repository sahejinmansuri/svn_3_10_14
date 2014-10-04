<?php

class App_Event_Mw_LoginController_forgotloginid extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'BSEARCH' => array('generic', 100, 0, App_Constants::getFormLabel('SEARCH')),
				
				'BUSINESS' => array('generic', 100, 0, App_Constants::getFormLabel('BUSINESS_NAME')),
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
		
        $pview->showcontent = "form";

        if ($this->_request->getParam('doaction') != null) {

                $s = $this->_request->getParam('BSEARCH');
                $b = $this->_request->getParam('BUSINESS');
                $ein = $this->_request->getParam('EIN');

                if ($b != null) {

                        $u = new App_User($b);
                        $e = $u->getEmail();
                        $messages = new App_Messages();
                        $message = $messages->getForgotMerchLoginId($u->getBusinessName());
                        $messenger = new App_Messenger();
                        $messenger->sendMessage($message,$e,'1');

                        /*$ep = explode("@", $e);
                        $ep[0] = substr($ep[0], 0, 1) . "******" . substr($ep[0], -1, 1);
                        $ep[1] = explode(".", $ep[1]);
                        $ep[2] = array_pop($ep[1]);
                        $ep[1] = implode($ep[1]);
                        $ep[1] = substr($ep[1], 0, 1) . "******" . substr($ep[1], -1, 1);
                        $ep = $ep[0] . "@" . $ep[1] . "." . $ep[2];

                        $pview->showemail = $ep;
                        */
                        $pview->showcontent = "success";

                } else {

                        if ($s != null && strlen($s) >= 3 & $ein != null) {

                                $businesses = App_User::searchMerchantLoginId($s, $ein);
								if(isset($businesses[2]))
								{
									$pview->user_id = $businesses[0];
									$pview->business_name = $businesses[1];
									$login_id='';
									$email = $this->maskEmail($businesses[2]);
									$pview->login_id = $this->maskEmail($businesses[2]);
								}else
								{
									$pview->login_id='';
								}

                                $pview->showcontent = "form2";

                        } else {

                                $pview->showcontent = "error";

                        }

                }

        }
	
        App_DataUtils::commit();


	}
	

	protected function maskEmail($email, $percent=50)
	{
        list( $user, $domain ) = preg_split("/@/", $email );
        $len = strlen( $user );

        $mask_count = floor( $len * $percent /100 );
		$mask_char='*';
        $offset = floor( ( $len - $mask_count ) / 2 );

        $masked = substr( $user, 0, $offset )
                .str_repeat( $mask_char, $mask_count )
                .substr( $user, $mask_count+$offset );


        return( $masked.'@'.$domain );
	}

}

?>
