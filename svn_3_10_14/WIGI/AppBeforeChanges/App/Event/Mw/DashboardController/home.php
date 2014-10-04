<?php

class App_Event_Mw_DashboardController_home extends App_Event_WsEventAbstract  {
	
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
		
		$pview->pageid = "dashboard";
		
		$uid  = $session_data->identity['userid'];
		$user = new App_User($uid);

                $pview->is_npo = false;
                if ($user->getBusinessType() == 5) $pview->is_npo = true;
		
		$pview->businessname = $user->getBusinessName();
		if (is_file("/u/data/logos/$uid/logo")) {
			$haslogo = true;
		} else {
			$haslogo = false;
		}
		$pview->haslogo = $haslogo;
		
		/*DAILY POS TOTALS*/
		$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
		$w = new App_WigiEngine();

		//$tz = App_DataUtils::extractTZ('0');
		$zd = new Zend_Date();
		//$zd->setTimezone( $tz );
		$a = $zd->toArray();
		$a["month"] = sprintf('%02s', $a["month"]);
		$a["day"]   = sprintf('%02s', $a["day"]);

		foreach ($user->getCellphones() as $cellrow) {

			$totals = array();
			try {
				$totals = $w->getHistory($cellrow->mobile_id,"0","1000000",$a["year"] . "-" . $a["month"] . "-" . $a["day"]);
			} catch (Exception $e) {}
	
			$stats[$cellrow->mobile_id]["grand_total"]    = 0;
			$stats[$cellrow->mobile_id]["charge_total"]   = 0;
			$stats[$cellrow->mobile_id]["tax_total"]      = 0;
			$stats[$cellrow->mobile_id]["tip_total"]      = 0;
	
			foreach ($totals as $row) {
				$stats[$cellrow->mobile_id]["grand_total"]    += $row["amount"];
				$stats[$cellrow->mobile_id]["charge_total"]   += $row["raw_amount"];
				$stats[$cellrow->mobile_id]["tax_total"]      += $row["tax"];
				$stats[$cellrow->mobile_id]["tip_total"]      += $row["tip"];
			}

		}
		/*END DAILY POS TOTALS*/	
		
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
		
		$pview->postotals = $stats;
		
		$ucells = new App_Models_Db_Wigi_UserMobile();
		$cellphones = $ucells->fetchAll($ucells->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
		$pview->cellphones = $cellphones;
		
		$p = Array();
                $users = $user->getPosUsers();
                $r = array($uid);
                foreach ($users as $row) { array_push($r,$row->user_id); }
                $p["USER_ID_MULTIPLE"] = $r;

		
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
			$cthis->redirect('forceeditpassword', 'profile', 'mw');
		}
	

                App_DataUtils::commit();
	
	}
	
}

?>
