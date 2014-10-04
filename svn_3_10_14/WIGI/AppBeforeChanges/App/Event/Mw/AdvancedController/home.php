<?php

class App_Event_Mw_AdvancedController_home extends App_Event_WsEventAbstract  {
	
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

                $pview->pageid = "advanced";
                $pview->enabled = false;
                $pview->token = "";

                $uid  = $session_data->identity['userid'];
                $user = new App_User($uid);


                if ($this->_request->getParam('doaction') != null) {
                        $user->addCellphone("oscommerce-" . $uid,'','OS Commerce','pos');
                        $mobileid = App_Cellphone::getIdFromCellphone("oscommerce-" . $uid,$user->getCountryCode());
                        $cellphone = new App_Cellphone($mobileid);
                        $cellphone->confirm( $cellphone->getConfirmationCode(),"" );
                }

                foreach ($user->getCellphones() as $phone) {
                        $name = substr($phone->cellphone, 0, 10);
                        if ($name === "oscommerce") {
                                $pview->enabled = true;
                                $pview->token = $phone->cellphone;
                        }
                }
                App_DataUtils::commit();
	
	}
	
}

?>
