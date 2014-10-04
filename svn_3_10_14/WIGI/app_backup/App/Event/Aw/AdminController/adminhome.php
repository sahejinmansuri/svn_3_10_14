<?php

class App_Event_Aw_AdminController_adminhome extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
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
			$pview->pageid = "admin";
			$pview->adminusers = App_AdminUser::getAllUsers();
			//print_r($pview->adminusers); die();
			$error = $cthis->getRequest()->getParam('MESSAGE');
			$pview->error = $error;
			$wigi_admin_settings = $cthis->getWigiAdminSettings();
			// Get the default permissions data
			$permissionsData = App_Perm::setUserSettings('0000000', 0);
			$pview->permissions = $permissionsData;

			$existing_roles = App_Perm::prepareRolesData($wigi_admin_settings);
			//print_r($existing_roles); die();
			$pview->existing_roles = $existing_roles;
			$pview->is_existing_roles = count($existing_roles);
    }
}
