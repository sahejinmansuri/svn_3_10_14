<?php

class App_Event_Mw_LoginController_auth extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'LOGIN' => array('generic', 100, 1, App_Constants::getFormLabel('LOGINID')),
				
				'PASSWD' => array('generic', 100, 1, App_Constants::getFormLabel('PASSWD')),
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
		
        $login = new App_Login_Mw();
        $stat  = $login->doLogin(array('LOGIN'=>$this->_request->getParam('LOGIN'), 'PASSWD'=>$this->_request->getParam('PASSWD') ));

            $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
            $idm = $login->getIdentity();
            $ns->userid    = $idm['userid'];
            $ns->email     = $this->_request->getParam('LOGIN');
            $ns->logged_in = 1;
            $p = new App_Prefs($ns->userid);
            $ns->prefs = $p->getPrefs("mw");
            $login->createSession();


            $ns->extinfo["osid"]          = "";
            $ns->extinfo["devicetod"]     = "";
            $ns->extinfo["appversion"]    = "";
            $ns->extinfo["devicemodel"]   = "";
            $ns->extinfo["systemname"]    = "";
            $ns->extinfo["systemversion"] = "";
            $ns->extinfo["gps"]           = "";
            $ns->extinfo["appname"]       = "";
            $ns->extinfo["language"]      = "";
            $ns->extinfo["ip_address"]    = getenv("REMOTE_ADDR");

            $ns->extinfo["server_datetime"]    = "";
            $ns->extinfo["client_datetime"]    = "";
            $ns->extinfo["os"]    = "";
            $ns->extinfo["browser_string"]    = getenv("HTTP_USER_AGENT");
            $ns->login_type = "merchant";

            //$browser = get_browser(null, true);

            $u = new App_User($idm["userid"]);
            $u->updateLogin('1',getenv('REMOTE_ADDR'),'browser');

            $result['status']=1;

        $cthis->getResponse()->setHeader('Content-type', 'application/json');
        $cthis->getHelper('ViewRenderer')->setNoRender();
        App_DataUtils::commit();
        print Zend_Json::encode($result);
	
	}
	
}

?>
