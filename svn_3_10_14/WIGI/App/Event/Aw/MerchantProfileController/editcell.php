<?php

class App_Event_Aw_ProfileController_editcell extends App_Event_WsEventAbstract  {
	
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
	
	public function execute(&$uid,&$pview,&$cthis){
		
		$pview->pageid = "profile";
		
		$pview->showcontent = "form";
		
		
		$item = $this->_request->getParam("ITEM");
		if ($item != null && is_numeric($item)) {
			
			$c = new App_Cellphone($item);
        	if ($c->getUserId() != $uid) {
            	throw new App_Exception_WsException('You do not own this device.');
    		}
			
			$alias = $this->_request->getParam('CELLDESC');
			
			$ucell = new App_Models_Db_Wigi_UserMobile();
			$ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $item));
		
			if ($ucget["is_default"] == 1) {
				throw new App_Exception_WsException('Can not edit the virtual device.');
			}

			$pview->ITEM = $item;
			
			$pview->CELLDESC = $ucget['alias'];
			
			if ($this->_request->getParam('doaction') != null) {
				
				$ucedit = $ucell->update(
					array('alias' => $alias),
					$ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
				);
				
				$pview->showcontent = "success";
				
			}
			
		} else {
			
			$pview->ITEM = "";
			
		}
		
	}
	
}

?>
