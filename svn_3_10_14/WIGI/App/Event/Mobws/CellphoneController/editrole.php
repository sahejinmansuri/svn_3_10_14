<?php

class App_Event_Mobws_CellphoneController_editrole extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('pin', 25, 1, App_Constants::getFormLabel('USER')),
                'rolename' => array('pin', 25, 1, App_Constants::getFormLabel('rolename')),
                'VIEW_PROFILE_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('VIEW_PROFILE_INDEX')),
                'VIEW_DOCUMENTS_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('VIEW_DOCUMENTS_INDEX')),
                'MESSAGES_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('MESSAGES_INDEX')),
                'PREFERENCES_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('PREFERENCES_INDEX')),
                'VIEW_HISTORY_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('VIEW_HISTORY_INDEX')),
                'VIEW_STATEMENTS_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('VIEW_STATEMENTS_INDEX')),
                'CHNAGE_PIN_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('CHNAGE_PIN_INDEX')),
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
        $pview->pageid = "admin";
		$pview->tzpref = $session_data->prefs["system"]["timezone"];

		$uid = $this->_request->getParam('USER');
		
		//$uid = $session_data->identity['userid'];
		$pview->user = $session_data->identity;
	
		$permissions = App_Perm::getUserWigiFeatures();
		$pview->permissions_add = $permissions;

		//$wigi_admin_settings = $cthis->getWigiUsersSettings($uid);

		/*$was = new App_WigiUsersSetting();
		$wigi_admin_settings = $was->getWebUsersSettings($uid);*/
		
		$result = array();
		$rolestr='';
		$rolename = $this->_request->getParam('rolename');

		
			$permissionsData = App_Perm::setUserSettings('0000000', 0);
			$pview->permissions = $permissionsData;

			$existing_roles = App_Perm::prepareRolesDataUsers($wigi_admin_settings);
			//echo "<pre>"; print_r($existing_roles); die();
			$pview->existing_roles = $existing_roles;
			$pview->is_existing_roles = count($existing_roles);
		
			$rolestr = $cthis->getPermissionStringFromInputsUser();		
			$r=array();
			$r['category']=$rolename;
			$r['value']=$rolestr;
			$cthis->updateWigiUsersSettings($r,$uid); //Mark Current record as Inactive
			$cthis->insertWigiUsersSettings($r,$uid);
			
				$result['result']['status'] = 'success';
				$result['result']['value'] = '';
				$result['result']['data']   = 'You have successfully updated Role';
			
		     
        return $result;	
    }
}
