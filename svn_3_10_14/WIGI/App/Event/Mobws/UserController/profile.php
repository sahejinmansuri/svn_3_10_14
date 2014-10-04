<?php

class App_Event_Mobws_UserController_profile extends App_Event_WsEventAbstract
{

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
				'MOBILE' => array('generic', 50, 0, App_Constants::getFormLabel('MOBILE')),
				'PIN' => array('generic', 50, 0, App_Constants::getFormLabel('PIN')),
				'CCODE' => array('generic', 50, 0, App_Constants::getFormLabel('CCODE')),
            )
        );
		$this->execute();
    }
	public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$cthis){


        App_DataUtils::beginTransaction();

        $cellphone = $this->_request->getParam('MOBILE');
        $ccode     = $this->_request->getParam('CCODE');
        $pin       = $this->_request->getParam('PIN');
        //$osid      = $this->_request->getParam('OSID');


        $login = new App_Login_Mobws();
        $login->doLogin(array('CELL'=>$cellphone, 'CCODE'=> $ccode, 'PIN'=>$pin, 'OSID'=>$osid));

            $cthis->getHelper('SessionHopping')->setDeviceIdentifier();
            $login->createSession();
            $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
            $idm = $login->getIdentity();
            $ns->userid    = $idm['userid'];
            $ns->mobileid  = $idm['mobileid'];
            $ns->cellphone = $cellphone;
            $ns->pin       = $pin;
            $ns->osid      = $osid;
            $ns->type      = 'cellphone';
            $ns->countrycode   = $this->_request->getParam("CCODE");
            $ns->extinfo["osid"]          = $this->_request->getParam("OSID");
            $ns->extinfo["devicetod"]     = $this->_request->getParam("DEVICETOD");
            $ns->extinfo["appversion"]    = $this->_request->getParam("APPVERSION");
            $ns->extinfo["devicemodel"]   = $this->_request->getParam("DEVICEMODEL");
            $ns->extinfo["systemname"]    = $this->_request->getParam("SYSTEMNAME");
            $ns->extinfo["systemversion"] = $this->_request->getParam("SYSTEMVERSION");
            $ns->extinfo["gps"]           = $this->_request->getParam("GPS");
            $ns->extinfo["appname"]       = "";//$this->_request->getParam("APPNAME");
            $ns->extinfo["language"]      = "English";//$this->_request->getParam("LANGUAGE");
            $ns->extinfo["ip_address"]    = getenv("REMOTE_ADDR");

            $ns->extinfo["server_datetime"]    = "";
            $ns->extinfo["client_datetime"]    = "";
            $ns->extinfo["os"]    = "";
            $ns->extinfo["browser_string"]    = "";
            $ns->login_type    = "cellphone";

            $c = new App_Cellphone($idm["mobileid"]);
            $c->updateLogin($ns->appversion,getenv('REMOTE_ADDR'));
            $u = new App_User($c->getUserId());
            $ns->email = $u->getEmail();

            $c->updateExtInfo('iPhone',
                              $ns->extinfo["ip_address"],
                              $ns->extinfo["osid"],
                              $ns->extinfo["systemversion"],
                              $ns->extinfo["appversion"]);

            list($name,$domain) = explode('@',$u->getEmail());
            $mname = preg_replace('/^(.).+(.)$/',"$1****$2",$name) . '@' . preg_replace('/^(.).+(.....)$/',"$1****$2",$domain);


$result = array();
            $result['result']['status']                 = 'success';
            $result['result']['data']                   = "";

            App_DataUtils::commit();

            return $result;

    }

}
