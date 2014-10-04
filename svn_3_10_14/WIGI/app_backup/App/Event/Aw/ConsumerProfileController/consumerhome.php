<?php

class App_Event_Aw_ConsumerProfileController_consumerhome extends App_Event_WsEventAbstract  {

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
    
    public function execute(&$uid,&$pview,&$cthis){

        //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
        //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

        $user = new App_User($uid);
        $email = $user->getEmail();

        $country_code = $user->getCountryCode();
        $pview->user = $user;
       
        $uinfo = new App_Models_Db_Wigi_User();
        $uinfof = $uinfo->fetchRow($uinfo->select()->from($uinfo,
                array('alternate_email', 'alternate_phone', 'date_added', 'created_via')
        )->where('user_id = ?', $uid));

        $pview->userext = $uinfof;

        $uaddr = new App_Models_Db_Wigi_UserAddress();
        $uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
                array('addr_line1', 'addr_line2', 'city', 'state', 'zip')
        )->where('user_id = ?', $uid));

        $pview->useraddr = $uaddrf;

        $cthis->getWigiUserData('LOGIN_HISTORY',$email);
        $cthis->getWigiUserData('CONSUMERS_CREDIT_CARD',$uid);
        $cthis->getWigiUserData('CONSUMERS_BANK_ACCOUNTS',$uid);
        $cthis->loadCellPhoneInfo($uid);
        $cthis->loadConsumerTransactions($uid);
        $cthis->loadPreferences($uid);

        /*$uba = new App_Models_Db_Wigi_UserBankAccount();
        $bankaccounts = $uba->fetchAll($uba->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
        $pview->bank_accounts = $bankaccounts;
        $bankaccountsr = array();
        $ubar = new App_Models_Db_Wigi_RoutingNumberInfo();
        foreach ($bankaccounts as $ba) {
            $bankaccountsr[$ba['user_bank_account_id']] = $ubar->fetchRow($ubar->select()->from($ubar, array("description"))->where('routing = ?', $ba['routing']));
        }
        $pview->bank_accounts_r = $bankaccountsr;*/

        /*$ucells = new App_Models_Db_Wigi_UserMobile();
        $cellphones_raw = $ucells->fetchAll($ucells->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
        $cellphones = array();
        foreach ($cellphones_raw as $crow) {
          $crow->cellphone = preg_replace("/(\d\d\d)(\d\d\d)(\d\d\d\d)/", "($1)$2-$3",$crow->cellphone);
          array_push($cellphones,$crow);
        }
        $pview->cellphones = $cellphones;

        $cellpreferences = Array();
        foreach ($cellphones as $cell) {
                $mid = $cell['mobile_id'];
                $cellpreferences[$mid] = $uprefs->getCellphonePrefs($uid, $mid);
                $pview->cellpreferences = $cellpreferences;
        }*/

        $us = new App_Models_Db_Wigi_WigiUserSettings();
        $a = $us->fetchAll($us->select()->from($us,array('category', 'value','datecreated'))->where('user_id = ?',$uid)->where('status = ?','A')->where('category = ?','wigi billing'));
        $res1 = $a->toArray(); 
        $str = '999-F-10';
        if(isset($res1[0])){ $str = $res1[0]['value'];}
        $pview->wigi_user_billing = App_Transaction_WigiCharges::prepareUserBillingData($str);
    }
}
