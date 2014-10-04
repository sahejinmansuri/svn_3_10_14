<?php

class App_Event_Mw_AdvancedController_getconsumername extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'CELLPHONE' => array('generic', 100, 1, App_Constants::getFormLabel('CELLPHONE')),
                                'COUNTRYCODE' => array('generic', 100, 1, App_Constants::getFormLabel('COUNTRYCODE')),
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
                        $cellphone = $this->_request->getParam("CELLPHONE");
                        $countrycode = $this->_request->getParam("COUNTRYCODE");

                        $cellid = App_Cellphone::getIdFromCellphone($cellphone, $countrycode);
                        $cell = new App_Cellphone($cellid);
                        $userid = $cell->getUserId();
                        $user = new App_User($userid);

                        if ($userid != null) {
                                $uaddr = new App_Models_Db_Wigi_UserAddress();
                                $uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
                                        array('city', 'state')
                                )->where('user_id = ?', $userid));

                                $name = Array(
                                        "fname" => $user->getFirstName(),
                                        "lname" => $user->getLastName(),
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
