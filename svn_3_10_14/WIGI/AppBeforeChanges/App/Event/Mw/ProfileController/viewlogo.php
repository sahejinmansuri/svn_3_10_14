<?php

class App_Event_Mw_ProfileController_viewlogo extends App_Event_WsEventAbstract  {
	
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
		
		$uid = $session_data->identity['userid'];
		if (is_file("/u/data/logos/$uid/logo")) {
			$res = file_get_contents("/u/data/logos/$uid/logo");
			header('Content-type: image/jpeg');
			echo $res;
		}
                App_DataUtils::commit();

		exit();
		
	}
	
}

?>
