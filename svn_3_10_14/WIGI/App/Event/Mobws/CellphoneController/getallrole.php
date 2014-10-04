<?php

class App_Event_Mobws_CellphoneController_getallrole extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('pin', 25, 1, App_Constants::getFormLabel('USER')),
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
				$user = new App_User($uid);
				
				$was = new App_WigiUsersSetting();
				$wigi_admin_settings = $was->getMobwsUsersSettings($uid);
				$data = array();
				$data = $wigi_admin_settings;
				$i = 0;
				/*foreach($wigi_admin_settings as $key=>$val){
					$data[$i]['rolename'] = $key;
					$data[$i]['value'] = $val;
					$i++;
				}*/
                
				$result['result']['status'] = 'success';
				$result['result']['value'] = '';
				$result['result']['data']   = $data;

                App_DataUtils::commit();
                return $result;
    }
}
