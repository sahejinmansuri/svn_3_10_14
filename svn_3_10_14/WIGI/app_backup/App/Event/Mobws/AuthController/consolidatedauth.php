<?php

class App_Event_Mobws_AuthController_consolidatedauth extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CELLPHONE' => array('phone', 15, 1, App_Constants::getFormLabel('CELLPHONE')),
                'CCODE' => array('countrycode', 3, 1, App_Constants::getFormLabel('CCODE')),
                'PIN' => array('pin', 10, 1, App_Constants::getFormLabel('PIN')),
                'OSID' => array('generic', 100, 1, App_Constants::getFormLabel('OSID')),
                'DEVICETOD' => array('generic', 100, 1, App_Constants::getFormLabel('DEVICETOD')),
                'APPVERSION' => array('generic', 100, 1, App_Constants::getFormLabel('APPVERSION')),
                'DEVICEMODEL' => array('generic', 100, 1, App_Constants::getFormLabel('DEVICEMODEL')),
                'SYSTEMNAME' => array('generic', 100, 1, App_Constants::getFormLabel('SYSTEMNAME')),
                'SYSTEMVERSION' => array('generic', 100, 1, App_Constants::getFormLabel('SYSTEMVERSION')),
                'GPS' => array('generic', 100, 1, App_Constants::getFormLabel('GPS')),
                'APPNAME' => array('generic', 100, 0, App_Constants::getFormLabel('APPNAME')),
                'LANGUAGE' => array('generic', 100, 0, App_Constants::getFormLabel('LANGUAGE')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$cthis){

        App_DataUtils::beginTransaction();

        $cellphone = $this->_request->getParam('CELLPHONE');
        $ccode     = $this->_request->getParam('CCODE');
        $pin       = $this->_request->getParam('PIN');
        $osid      = $this->_request->getParam('OSID');

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

            $result['result']['status']                 = 'success';
            $result['result']['data']                   = "";
            $result['result']['data']['key']            = Zend_Session::getId();
            $result['result']['data']['prefs']          = $c->getPrefs();
            $result['result']['data']['messages']       = App_Message::getNewMessageCount( $idm['mobileid'] );
            $result['result']['data']['be_version']     = App_DataUtils::getVersion();
            $result['result']['data']['masked_email']   = $mname;
            $result['result']['data']['is_default']   = $idm['is_default'];

            App_DataUtils::commit();

            return $result;

    }
}
