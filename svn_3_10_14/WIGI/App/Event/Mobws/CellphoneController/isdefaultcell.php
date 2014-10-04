<?php

class App_Event_Mobws_CellphoneController_isdefaultcell extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('pin', 25, 1, App_Constants::getFormLabel('USER')),
                'MOBILE' => array('pin', 25, 1, App_Constants::getFormLabel('MOBILE')),
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

				$user_id     = $this->_request->getParam("USER");
				$mobile_id     = $this->_request->getParam("MOBILE");
				$user = new App_User($user_id);

                $res = $user->getUserCellphones();
				$result_cell = array();
				$result = array();
				$flag = 0;
				foreach($res as $key=>$val){
					if($val['is_default'] == 1){
						if($val['mobile_id'] == $mobile_id){
							$flag = 1;
						}
					}
				}
				if($flag == 0){
					$errno = "You do not have permission";
					$result = array(
						'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
					);
					$result['result']['status'] = 'failure';
					$result['result']['value']  = '';
					$result['result']['data']   = $errno;
				}else{
					$result['result']['status'] = 'success';
					$result['result']['value'] = '';
					$result['result']['data']   = $result_cell;
				}

                App_DataUtils::commit();
                return $result;
    }
}
