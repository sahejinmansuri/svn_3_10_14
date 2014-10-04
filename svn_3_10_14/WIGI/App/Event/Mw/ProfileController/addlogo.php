<?php

class App_Event_Mw_ProfileController_addlogo extends App_Event_WsEventAbstract  {
	
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
		
		$upload = new Zend_File_Transfer_Adapter_Http();
		$upload->setDestination("/tmp");
		$upload->receive();
		$file = $upload->getFileName('COMPANYLOGO');
		$filedir = "/u/data/logos/$uid";
		if ($file != null) {
			$data = file_get_contents($file);
			@mkdir($filedir);
			file_put_contents($filedir."/logo", $data);
			
			/*
			$filter = new Zend_Filter_ImageSize();
			$output = $filter
				->setWidth(600)
				->setType('jpeg')
				->filter($filedir."/logo");
			*/
		}
		
                App_DataUtils::commit();

		exit();
		
	}
	
}

?>
