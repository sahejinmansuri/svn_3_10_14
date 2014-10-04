<?php

class App_Event_Posws_LockController_lockpos extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MOBILEID' => array('int', 25, 1, App_Constants::getFormLabel('MOBILEID')),
                'STATUS' => array('generic', 25, 1, App_Constants::getFormLabel('STATUS')),
            //   'TITLE' => array('generic', 25, 1, App_Constants::getFormLabel('TITLE')),
             //   'DESCRIPTION' => array('generic', 255, 1, App_Constants::getFormLabel('DESCRIPTION')),
               // 'SAME' => array('generic', 50, 1, App_Constants::getFormLabel('TYPE')),

            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
	public function execute()
   {
		App_DataUtils::beginTransaction();
		//$status     = 'locked';
      $usermobid       = $this->_request->getParam("MOBILEID");
      $status1       = $this->_request->getParam("STATUS");
      if($status1==0) {
      	
      	$status     = 'locked';
      }
  else {
  	
  	$status     = 'active';
  }
      $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
     
      $de = new App_LockEngine();
      $de->lockpos($usermobid,$ns->mobileid, $status);
		$result = array();
      $result['result']['status'] = 'success';
      $result['result']['value'] = '';
      $result['result']['data']   = '';
		App_DataUtils::commit();
      return $result;
    }
}
