<?php

class App_Event_Posws_DocumentController_getdocuments extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USERID' => array('int', 25, 1, App_Constants::getFormLabel('USERID')),
                'PASSWORD' => array('pin', 25, 1, App_Constants::getFormLabel('PASSWORD')),
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
		$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
      $userid       = $this->_request->getParam("USERID");
      $passwd       = $this->_request->getParam("PASSWORD");
		$user = new App_User($userid);            
      if(!$user->passwordMatches($passwd))
      {
			$result = array(
									'error'  => array( 'code' => '-32000', 'message' => 'Password is wrong', 'data' => ''),
								);
			$result['result']['status'] = 'failure';
			$result['result']['value']  = '';
			$result['result']['data']   = 'Password is wrong';
		}
      else
      {
			$de = new App_DocumentEngine();
         $res = $de->getDocuments($ns->mobileid);
         $result = array();
         $result['result']['status'] = 'success';
         $result['result']['value'] = '';
         $result['result']['data']   = $res;
		}
      App_DataUtils::commit();
      return $result;
                
    }
}
