<?php

class App_Event_Mobws_CellphoneController_addrole extends App_Event_WsEventAbstract {

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
		
		if($rolename != ""){
			$rolestr = $cthis->getPermissionStringFromInputsUser();		
			$r=array();
			$r['category']='User Roles '.$rolename;
			$r['value']=$rolestr;
			
			$rolename_check = new App_Models_Db_Wigi_WigiUsersSettings();
			$res = $rolename_check->fetchAll($rolename_check->select()->from($rolename_check,array('wigi_users_settings_id'))->where('status = ?','A')->where('useradded = ?',$uid)->where('category = ?',$r['category']));
			$count = count($res);
			if($count == 0){
				$cthis->insertWigiUsersSettings($r,$uid);
				$result['result']['status'] = 'success';
				$result['result']['value'] = '';
				$result['result']['data']   = 'You have successfully added Role';
			}else{
				$errno = "This Role name already exist";
				$result = array(
					'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
				);
				$result['result']['status'] = 'failure';
				$result['result']['value']  = '';
				$result['result']['data']   = $errno;
			}
			
		}     
        return $result;	
    }
}
