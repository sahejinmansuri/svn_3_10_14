<?php

class App_Event_Mobws_CellphoneController_deleterole extends App_Event_WsEventAbstract {

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
    
    public function execute(&$session_data,&$pview,&$cthis){
        $uid     		= $this->_request->getParam("USER");
		$rolename     	= $this->_request->getParam("rolename");
		$result = array();
		if(!$rolename)
		{
			$errno = "Please select a Role to delete";
			$result = array(
				'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
			);
			$result['result']['status'] = 'failure';
			$result['result']['value']  = '';
			$result['result']['data']   = $errno;
		}

		$rolestr = $cthis->getPermissionStringFromInputsUser();		
		$role_available = $cthis->getRoleUsers($uid,$rolename);
		
		if($role_available == 0){ 
			$r=array();
			$r['category']=$rolename;
			$r['value']=$rolestr;
			$cthis->updateWigiUsersSettings($r,$uid);
			
			$result['result']['status'] = 'success';
			$result['result']['value']  = '';
			$result['result']['data']   = 'You have successfully deleted Role';
		}else{
			$errno = "Please select a Role to delete";
			$result = array(
				'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
			);
			$result['result']['status'] = 'failure';
			$result['result']['value']  = '';
			$result['result']['data']   = $errno;
		}

                return $result;
    }
}
