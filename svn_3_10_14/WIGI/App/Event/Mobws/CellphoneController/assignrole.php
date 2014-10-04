<?php

class App_Event_Mobws_CellphoneController_assignrole extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MOBILE' => array('phone', 15, 1, App_Constants::getFormLabel('MOBILE')),
                'rolename' => array('countrycode', 3, 1, App_Constants::getFormLabel('rolename')),
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
		$result = array();
		
		$mobile     = $this->_request->getParam("MOBILE");
		$rolename     = $this->_request->getParam("rolename");
		
		/*$ucell = new App_Models_Db_Wigi_UserMobile();
		$uinfof = $ucell->update(
			array(
				'role' => $rolename
               ),
			$ucell->getAdapter()->quoteInto('mobile_id = ?', $mobile)
		);*/
		
		

$data = array(
   'role' => $rolename
);
$table = new App_Models_Db_Wigi_UserMobile();
$where = $table->getAdapter()->quoteInto("mobile_id = ?", $mobile);

$table->update($data, $where);


		$result['result']['status'] = 'success';
		$result['result']['value']  = '';
		$result['result']['data']   = 'Role '.$rolename.' is successfully assigned';
		
        return $result;

    }
}
