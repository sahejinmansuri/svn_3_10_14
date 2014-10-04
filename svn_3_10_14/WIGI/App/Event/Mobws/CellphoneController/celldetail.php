<?php

class App_Event_Mobws_CellphoneController_celldetail extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CELLPHONE' => array('phone', 15, 1, App_Constants::getFormLabel('CELLPHONE')),
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

        $CELLPHONE = $this->_request->getParam('CELLPHONE');
		$result = array();
		$c = new App_Cellphone('',$CELLPHONE);
		$mobile = $c->getMobileId();
		
		$cfg = Zend_Registry::get('config');
		$basepath = $cfg->paths->baseurl;
		
        $u = new App_User($c->getUserId());
		
		$first_name = $u->getFirstName();
		$last_name = $u->getLastName();
		
		$image_path = $u->getImagePath();
		if($image_path == ""){
			$image_name = "";
		}else{
			$image_name = $basepath.'u/profile/'.$image_path;
		}
		
		
		$result['result']['status'] = 'success';
        $result['result']['value']  = '';
		$result['result']['data']['first_name']   = $first_name;
		$result['result']['data']['last_name']   = $last_name;
		$result['result']['data']['image_path'] = $image_name;
			
		App_DataUtils::commit();

        return $result;

    }
}
