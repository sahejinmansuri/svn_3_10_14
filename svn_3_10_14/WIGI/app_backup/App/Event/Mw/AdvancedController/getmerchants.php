<?php

class App_Event_Mw_AdvancedController_getmerchants extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => 0
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
                ini_set('display_errors', false);
                $cthis->getHelper('ViewRenderer')->setNoRender();
                try {
                		
                        $merchant_name = $this->_request->getParam("NAME");
						
						$merchants = Array();
                        $getmerchants = App_User::searchMerchant($merchant_name);
                        foreach ($getmerchants as $merchant) {
                        	$userid = $merchant["user_id"];
                        	$user = new App_User($userid);
							$uaddr = new App_Models_Db_Wigi_UserAddress();
							$uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
							        array('city', 'state')
							)->where('user_id = ?', $userid));
							$merchantname = $user->getBusinessName();
							if ($user->getBusinessDBAName() != null) {
								$merchantname .= " / ".$user->getBusinessDBAName();
							}
							$merchants[] = array(
									"id" => $user->getMerchantId(),
							        "name" => $merchantname,
						        	"business_name" => $user->getBusinessName(),
							        "business_dba_name" => $user->getBusinessDBAName(),
							        "city" => $uaddrf["city"],
							        "state" => $uaddrf["state"]
							);
                        }
                        App_DataUtils::commit();
                        echo json_encode($merchants);
                        
                } catch(Exception $e) {};
	
	}
	
}

?>
