<?php

class App_Event_Cw_DashboardController_home extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => 0
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
                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     
                $pview->pageid = "dashboard";

                $uid  = $session_data->identity['userid'];
                $user = new App_User($uid);

                $cellphones = $user->getFmtCellphones();

                $pview->tzpref = $session_data->prefs["system"]["timezone"];

                $allusers = Array();
                $u = new App_Models_Db_Wigi_User();
                $udb = $u->fetchAll();
                foreach ($udb as $urow) {
                        $allusers[$urow['user_id']] = $urow;
                }
                $pview->allusers = $allusers;

                $country_code = $user->getCountryCode();
                $allcells = Array();
                $c = new App_Models_Db_Wigi_UserMobile();
                $cdb = $c->fetchAll();
                foreach ($cdb as $crow) {
                        $allcells[$crow['mobile_id']] = $crow;
                }
                $pview->allcellphones = $allcells;
                $pview->countrycode = $country_code;

                $p = Array();
                $p["USER_ID"] = $uid;

                $t = new App_Transaction_Transaction();
                $r = $t->search($p,$session_data->prefs["system"]["timezone"]);

                $res = array();
                foreach ($r as $row) {
                        $res[] = $row;
                }

                $pview->trans = $res;

                //$lastlogin = strtotime($session_data->identity['lastlogin']);

                try {
                        $lastlogin_a = $user->getLastLogin();
                        $pview->lastlogin = App_DataUtils::date2human($lastlogin_a["stamp"],$session_data->prefs["system"]["timezone"]);
                        $pview->lastip    = $lastlogin_a['ip'];
                } catch (Exception $e) {
                        $pview->lastlogin = "Never";
                        $pview->lastip    = "";
                }

                if ($user->getPasswordNeedsChanging()) {
                        $user->setPasswordNeedsChanging(false);
                        $cthis->redirect('forceeditpassword', 'profile', 'cw');
                }
                App_DataUtils::commit();
    }
}
