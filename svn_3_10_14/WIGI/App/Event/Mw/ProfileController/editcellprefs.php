<?php

class App_Event_Mw_ProfileController_editcellprefs extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'ITEM' => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
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
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		$uid = $session_data->identity['userid'];
		$user = new App_User($uid);
		
		$item = $this->_request->getParam("ITEM");
		if ($item != null && is_numeric($item)) {
			
			$pview->ITEM = $item;
			
			$cellobj = new App_Cellphone($item);
            if ($cellobj->getUserId() != $uid) {
                throw new App_Exception_WsException('You do not own this device.');
            }
			
			$cellobj = new App_Cellphone($item);
			if ($uid != $cellobj->getUserId()) {
				// throw exception
			}
			
			$uprefs = new App_Prefs();
			$preferences = $uprefs->getCellphonePrefs($uid, $item, 'posws');
			$pview->preferences = $preferences;
			
			if ($this->_request->getParam('doaction') != null) {
				
				$salestax = $this->_request->getParam('SALESTAX');
				$tips = $this->_request->getParam('TIPS');
				
				$p = new App_Prefs();
				$prefs = $p->getCellphonePrefs($uid,$item,'posws');
				
				$prefs["salestax"] = $salestax;
				$prefs["tips"] = $tips;
				
				$p->saveCellphonePrefs($uid, $item, $prefs);
				
				$pview->showcontent = "success";
				
			}
			
		} else {
			
			$pview->ITEM = "";
			
		}
		
                App_DataUtils::commit();

	}
	
}

?>
