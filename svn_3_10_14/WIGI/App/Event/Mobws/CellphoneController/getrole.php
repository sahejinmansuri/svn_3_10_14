<?php

class App_Event_Mobws_CellphoneController_getrole extends App_Event_WsEventAbstract {

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
            )        
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(){
                App_DataUtils::beginTransaction();

				$uid     = $this->_request->getParam("USER");
				$rolename     = $this->_request->getParam("rolename");
				$user = new App_User($uid);
				
				$was = new App_WigiUsersSetting();
				$wigi_admin_settings = $was->getMobwsUsersSettings($uid);
				//echo "<pre>";
				//print_r($wigi_admin_settings);
				//exit();
				$data = array();
				$i = 0;
				//$rolename = str_replace(' ','_',$rolename);
				//$user_role_name = "User Roles ".$rolename;
				$user_role_name = $rolename;
				foreach($wigi_admin_settings as $key=>$val){
					if($val['rolename'] == $user_role_name){
						$data[$i] = $val;
						$i++;
					}
				}
                
				$result['result']['status'] = 'success';
				$result['result']['value'] = '';
				$result['result']['data']   = $data;

                App_DataUtils::commit();
                return $result;
    }
}
