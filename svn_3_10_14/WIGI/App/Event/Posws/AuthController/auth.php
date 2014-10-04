<?php

class App_Event_Posws_AuthController_auth extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'OSID' => array('generic', 50, 0, App_Constants::getFormLabel('OSID')),
                'LOGIN' => array('generic', 50, 0, App_Constants::getFormLabel('LOGIN')),
                'PASSWD' => array('generic', 50, 0, App_Constants::getFormLabel('PASSWD')),
                'MERCHANTID' => array('generic', 50, 0, App_Constants::getFormLabel('MERCHANTID')),
                'DNAME' => array('generic', 50, 0, App_Constants::getFormLabel('DNAME')),
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

             


                $osid             = $this->_request->getParam('OSID');
                $username         = $this->_request->getParam('LOGIN');
                $passwd           = $this->_request->getParam('PASSWD');
                $merchantid       = ''; //$this->_request->getParam('MERCHANTID');
                $dname            = ''; //$this->_request->getParam('DNAME');

                $login = new App_Login_Posws();
                
                $login->doLogin(array( 'LOGIN'=> $username, 'PASSWD'=> $passwd,  'OSID'=>$osid, 'MERCHANTID'=>$merchantid));

					
                $countrycode = "";
                $mid = "";
                $parentuid = "";
                //Admin users are an email address
               //Basic users will just be something like "jsmith"
               if ( strpos($username, "@")  ) {
                   $uid = App_User::getUserIdFromEmail($username);
                   $puser = new App_User($uid);
                   $countrycode = $puser->getCountryCode();
                   $mid = $puser->getDefaultCellphone();
                   $parentuid = $uid;
               } else {
                   $uid = App_User::getUserIdFromEmail($username);
                   $u = new App_User($uid);
                   $parentid = $u->getParentUserId();
                   $parentuid = $parentid;
                   $puser = new App_User($parentid);
                   $countrycode = $puser->getCountryCode();
                   $mid = $puser->getDefaultCellphone();
               }



                        $cthis->getHelper('SessionHopping')->setDeviceIdentifier();
                        $login->createSession();
                        $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                        $idm = $login->getIdentity();

                        $uid = App_User::getUserIdFromEmail($username);
                        $user = new App_User($uid);
                        $ns->userid    = $idm['userid'];
                        $ns->parentid  = $parentuid;
                        $ns->mobileid  = $mid;
                        $ns->osid      = $osid;
                        $ns->type      = 'pos';
                        $c = new App_Cellphone($mid);
                        $ns->dname = $c->getAlias();

                    $ns->extinfo["osid"]          = "";//$cthis->_request->getParam("OSID");
                    $ns->extinfo["devicetod"]     = "";//$cthis->_request->getParam("DEVICETOD");
                    $ns->extinfo["appversion"]    = "";//$cthis->_request->getParam("APPVERSION");
                    $ns->extinfo["devicemodel"]   = "";//$cthis->_request->getParam("DEVICEMODEL");
                    $ns->extinfo["systemname"]    = "";//$cthis->_request->getParam("SYSTEMNAME");
                    $ns->extinfo["systemversion"] = "";//$cthis->_request->getParam("SYSTEMVERSION");
                    $ns->extinfo["gps"]           = "";//$cthis->_request->getParam("GPS");
                    $ns->extinfo["appname"]       = "";//$cthis->_request->getParam("APPNAME");
                    $ns->extinfo["language"]      = "English";//$cthis->_request->getParam("LANGUAGE");
                    $ns->extinfo["ip_address"]    = getenv("REMOTE_ADDR");
                    $ns->extinfo["pos_name"]      = $dname;


                    $ns->extinfo["server_datetime"]    = "";
                    $ns->extinfo["client_datetime"]    = "";
                    $ns->extinfo["os"]    = "";
                    $ns->extinfo["browser_string"]    = "";
                    $ns->login_type = "pos";
  $c = new App_Cellphone($ns->mobileid);
                $data = array();

                $uid = $ns->userid;
                $mid = $ns->mobileid;

                $p = new App_Prefs();
                $prefs = $p->getCellphonePrefs($uid,$mid);
                    $result['result']['status']  = 'success';
                    $result['result']['data']    = Zend_Session::getId();
                    //$result['result']['prefs']   = $ns->prefs ;
                    $result['result']['prefs']   = $prefs ;
                    $result['result']['dname']   = $c->getAlias();
                    $result['result']['loginid'] = $user->getEmail();
                    $result['result']['mobileid'] = $mid;
                    $result['result']['user_id'] = $parentuid;
                   // $result["menu"] = $prefs["menu"] ;
                    

                    App_DataUtils::commit();

                    return $result;
                    
  }

}
