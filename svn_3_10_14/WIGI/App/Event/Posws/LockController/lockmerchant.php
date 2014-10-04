<?php

class App_Event_Posws_LockController_lockmerchant extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USERID' => array('int', 25, 1, App_Constants::getFormLabel('USERID')),
               'PASSWD' => array('generic', 25, 1, App_Constants::getFormLabel('PASSWD')),
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
		$status     = 'locked';
      $userid       = $this->_request->getParam("USERID");
      $passwd       = $this->_request->getParam("PASSWD");
      $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
      $password = Atlasp_Utils::inst()->encryptPassword($passwd);
      $de = new App_LockEngine();
      $user = new App_User($userid);
    //  $user->passwordMatches($oldpassword);
     
if(!$user->passwordMatches($passwd)){
									$result = array(
										'error'  => array( 'code' => '-32000', 'message' => 'Password is wrong', 'data' => ''),
									);
									$result['result']['status'] = 'failure';
									$result['result']['value']  = '';
									$result['result']['data']   = 'Password is wrong';
								}
		else
		{
		
		//echo "<pre>";
		//print_r($anArray);exit;
      	$de->lockmerchant($userid,$ns->mobileid, $status);
			$result = array();
      	$result['result']['status'] = 'success';
      	$result['result']['value'] = '';
      	$result['result']['data']   = '';
      }
  		
		App_DataUtils::commit();
      return $result;
       
    }
}
