<?php

class App_Event_Mw_ProfileController_home extends App_Event_WsEventAbstract  {
	
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
	
	public function execute(&$session_data,&$pview,&$cthis){

                App_DataUtils::beginTransaction();
		
		$pview->pageid = "profile";
		
		$uid = $session_data->identity['userid'];
		$user = new App_User($uid);
		
		$country_code = $user->getCountryCode();
		$pview->country_code = $country_code;
		
		$pview->firstname = $session_data->identity['firstname'];
		$pview->lastname  = $session_data->identity['lastname'];
		$pview->email     = $session_data->identity['email'];
		
		if (is_file("/u/data/logos/$uid/logo")) {
			$haslogo = true;
		} else {
			$haslogo = false;
		}
		$pview->haslogo = $haslogo;
		
		$uinfo = new App_Models_Db_Wigi_User();
		$uinfof = $uinfo->fetchRow($uinfo->select()->from($uinfo,
			array('business_dba_name', 'business_name', 'business_type', 'business_tax_id', 'business_phone', 'state_of_inc', '501c', 'business_url', 'alternate_email', 'alternate_phone', 'date_added', 'created_via')
		)->where('user_id = ?', $uid));
		
		$pview->dba = $uinfof['business_dba_name'];
		$pview->altemail = $uinfof['alternate_email'];
		$pview->altphone = $uinfof['alternate_phone'];
		$pview->account_date = date("M j, Y", strtotime($uinfof['date_added']));
		$pview->account_device = $uinfof['created_via'];
		
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
		
		$pview->business_name = $uinfof['business_name'];
		$pview->business_type = $business_types[$uinfof['business_type']] . " (".$uinfof['business_type'].")";
		$pview->business_tax_id = $uinfof['business_tax_id'];
		$pview->business_phone = $uinfof['business_phone'];
		$pview->business_stateofinc = $uinfof['state_of_inc'];
		$pview->business_501c = $uinfof['501c'];
		$pview->business_url = $uinfof['business_url'];
		
		$uaddr = new App_Models_Db_Wigi_UserAddress();
		$uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
			array('addr_line1', 'addr_line2', 'city', 'state', 'zip')
		)->where('user_id = ?', $uid));
		
		$pview->zip      = $uaddrf['zip'];
		$pview->address  = $uaddrf['addr_line1'];
		$pview->address2 = $uaddrf['addr_line2'];
		$pview->city     = $uaddrf['city'];
		$pview->state    = $uaddrf['state'];
		
		$uinfo = new App_Models_Db_Wigi_User();
		$birthdate = $uinfo->fetchRow($uinfo->select()->where('user_id = ?', $uid));
		$pview->birthdate = date("M j, Y", strtotime($birthdate['birthdate']));
		
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
		$pview->bank_accounts_r = $bankaccountsr;
		
		$ucells = new App_Models_Db_Wigi_UserMobile();
		$cellphones = $ucells->fetchAll($ucells->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
		$pview->cellphones = $cellphones;
		
		$uprefs = new App_Prefs();
		$preferences = $uprefs->getWebUserPrefs($uid,'mw');
		$pview->preferences = $preferences;
		
		$cellpreferences = Array();
		foreach ($cellphones as $cell) {
			$mid = $cell['mobile_id'];
			$cellpreferences[$mid] = $uprefs->getCellphonePrefs($uid, $mid, "posws");
		}
		$pview->cellpreferences = $cellpreferences;
		
		$users = $user->getPosUsers();
		$pview->users = $users;
		$pos_devices = array();
		foreach ($users as $row) {
			$mu = new App_User($row->user_id);
			$pos_devices[$row->user_id] = $mu->getPosDevices();
		}
		$pview->userdevices = $pos_devices;
		

                App_DataUtils::commit();

	}
	
}

?>
