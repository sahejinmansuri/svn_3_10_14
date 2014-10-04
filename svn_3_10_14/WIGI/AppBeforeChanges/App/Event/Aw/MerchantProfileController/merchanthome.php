<?php

class App_Event_Aw_MerchantProfileController_merchanthome extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
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
	
	public function execute(&$userid,&$pview,&$cthis){
		$userdata = new App_User($userid);
		$pview->pageid = "merchantprofile";
        $pview->pageid = "customer";
		
		$uid = $userdata->getUid();
        $email = $userdata->getEmail();
		$user = new App_User($uid);
        $pview->cur_merc = $user;
		
        $cthis->getWigiUserData('LOGIN_HISTORY',$email);
        $cthis->getWigiUserData('CONSUMERS_CREDIT_CARD',$uid);
        $cthis->getWigiUserData('CONSUMERS_BANK_ACCOUNTS',$uid);
        $cthis->loadPreferences($uid,'mw');
        $cthis->loadCellPhoneInfo($uid,'posws');
        $cthis->loadPOSUsersInfo($uid);

		$us = new App_Models_Db_Wigi_WigiMerchantSettings();
		$a = $us->fetchAll($us->select()->from($us,array('category', 'value','datecreated'))->where('user_id = ?',$uid)->where('status = ?','A')->where('category = ?','wigi billing'));
		$res1 = $a->toArray(); 
		$str = '999-F-10';
		if(isset($res1[0])){ $str = $res1[0]['value'];}
		$pview->wigi_merchant_billing = App_Transaction_WigiCharges::prepareUserBillingData($str);

        // Set Special Billing Info
        $pview->curr_year = date('Y');
        $pview->curr_month = date('F');
        $pview->month_plus1 = date('F', strtotime('1 month'));
        $pview->month_plus2 = date('F', strtotime('2 month'));
        $pview->month_plus3 = date('F', strtotime('3 month'));
        $pview->mid = $uid;

        $cthis->loadMerchantTransactions($uid);

	}
	
}

/*
$business_types = Array(
    1 => "Individual",
    2 => "SOHO",
    3 => "Small Business",
    4 => "Large Business",
    5 => "Non-Profit",
    6 => "Government",
    7 => "Assocation",
    8 => "TBD",
    9 => "TBD"
);
$uaddr = new App_Models_Db_Wigi_UserAddress();
$uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
    array('addr_line1', 'addr_line2', 'city', 'state', 'zip')
)->where('user_id = ?', $uid));
$pview->mercaddress = $uaddrf;

$ucc = new App_Models_Db_Wigi_UserCreditCard();
$creditcards = $ucc->fetchAll($ucc->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
$pview->credit_cards = $creditcards;

$uba = new App_Models_Db_Wigi_UserBankAccount();
$bankaccounts = $uba->fetchAll($uba->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
$pview->bank_accounts = $bankaccounts;

$bankaccountsr = array();
$ubar = new App_Models_Db_Wigi_RoutingNumberInfo();
foreach ($bankaccounts as $ba) {
    $bankaccountsr[$ba['user_bank_account_id']] = $ubar->fetchRow($ubar->select()->from($ubar, array("description"))->where('routing = ?', $ba['routing']));
}
$pview->bank_accounts_r = $bankaccountsr;*/

/*$uprefs = new App_Prefs();
$ucells = new App_Models_Db_Wigi_UserMobile();
$cellphones = $ucells->fetchAll($ucells->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
$pview->cellphones = $cellphones;

$cellpreferences = Array();
foreach ($cellphones as $cell) {
    $mid = $cell['mobile_id'];
    $cellpreferences[$mid] = $uprefs->getCellphonePrefs($uid, $mid,"posws");
    $pview->cellpreferences = $cellpreferences;
}

$users = $user->getPosUsers();
$pview->users = $users;
$pos_devices = array();
foreach ($users as $row) {
    $mu = new App_User($row->user_id);
    $pos_devices[$row->user_id] = $mu->getPosDevices();
}
$pview->userdevices = $pos_devices;
//print_r($pos_devices);die();
*/


?>
