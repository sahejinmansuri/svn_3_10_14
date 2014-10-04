<?php

class App_Event_Mw_ProfileController_edituserpassword extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'ITEM' => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
				
				'NEWPASSWORD' => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
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
		
		$pview->ITEM = $this->_request->getParam('ITEM');
        $pview->showcontent = "form";
        
        $uid = $session_data->identity['userid'];
    		
    		$objitem = $this->_request->getParam('ITEM');
    		if ($objitem == null) {
    			throw new App_Exception_WsException('There were no users selected.');
    		} else {
    			$objuser = new App_User($objitem);
				if ($objuser->getParentUserId() != $uid) {
					throw new App_Exception_WsException('You do not own this user.');
				}
    		}

            if ($this->_request->getParam('doaction') != null) {

                $newpassword = $this->_request->getParam('NEWPASSWORD');
                $item        = $this->_request->getParam('ITEM');
                
				$user = new App_User($item);

                if (strlen($newpassword) >= 8) {

                        $uinfo = new App_Models_Db_Wigi_User();
                        $uinfof = $uinfo->update(
                                array(
                                        'password' => Atlasp_Utils::inst()->encryptPassword($newpassword1)
                                ),
                                $uinfo->getAdapter()->quoteInto('user_id = ?', $uid)
                        );

                        $pview->showcontent = "success";

                } else {

                        $pview->showcontent = "error";

                }

            }
		
            App_DataUtils::commit();

	}
	
}

?>
