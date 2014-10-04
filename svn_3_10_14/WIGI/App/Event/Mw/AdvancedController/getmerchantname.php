<?php

class App_Event_Mw_AdvancedController_getmerchantname extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'MERCHANT_NUMBER' => array('generic', 100, 1, App_Constants::getFormLabel('MERCHANT_NUMBER')),
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

                ini_set('display_errors', false);
                $cthis->getHelper('ViewRenderer')->setNoRender();
                try {
                        $merchant_number = $this->_request->getParam("MERCHANT_NUMBER");

                        $userid = App_User::getUserIdFromMerchantId($merchant_number);
                        $user = new App_User($userid);

                        if ($userid != null) {
                                $uaddr = new App_Models_Db_Wigi_UserAddress();
                                $uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
                                        array('city', 'state')
                                )->where('user_id = ?', $userid));

                                $name = Array(
                                        "business_name" => $user->getBusinessName(),
                                        "business_dba_name" => $user->getBusinessDBAName(),
                                        "city" => $uaddrf["city"],
                                        "state" => $uaddrf["state"]
                                );
                                App_DataUtils::commit();
                                echo json_encode($name);
                        }
                } catch(Exception $e) {};
	
	}
	
}

?>
