<?php

class App_Event_Mw_HistoryController_download extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'AF' => array('amount', 25, 0, App_Constants::getFormLabel('AMOUNT')),
				'AT' => array('amount', 25, 0, App_Constants::getFormLabel('AMOUNT')),
				'T' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
				'DF' => array('date_d', 25, 0, App_Constants::getFormLabel('DATE')),
				'DT' => array('date_d', 25, 0, App_Constants::getFormLabel('DATE')),
				'M' => array('int', 25, 0, App_Constants::getFormLabel('PHONE')),
                                'INCLUDE_HEADERS' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CDATE' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CTYPE' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CNAME' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CADDRESS' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CPHONE' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CEMAIL' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CAMOUNT' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CDESCRIPTION' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CDEVICE' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),

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
		
		$pview->pageid = "history";

        $uid  = $session_data->identity['userid'];
		$user = new App_User($uid);
		
		$pview->businessusertype = $user->getBusinessType();
		
		$cellphones = $user->getCellphones();
		$pview->cellphones = $cellphones;

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
		
		$getpage = $this->_request->getParam('P');
		$getamountfrom = $this->_request->getParam('AF');
		$getamountto = $this->_request->getParam('AT');
		$gettype = $this->_request->getParam('T');
		$getdatefrom = $this->_request->getParam('DF');
		$getdateto = $this->_request->getParam('DT');
		$getmobileid = $this->_request->getParam('M');
		
		
		$p = Array();
		
		if ($getmobileid > 0) {
			$cellobj = new App_Cellphone($getmobileid);
			if ($cellobj->getUserId() != $uid) {
				throw new App_Exception_WsException('You do not own this device.');
			}
			$p["CELLPHONE_FROM"] = $getmobileid;
			$pview->selectedcell = $getmobileid;
		} else {
			$users = $user->getPosUsers();
			$r = array($uid);
			foreach ($users as $row) { array_push($r,$row->user_id); }
			$p["USER_ID_MULTIPLE"] = $r;
			$pview->selectedcell = "";
		}
		
		if ($getamountfrom > 0) {
			$p["AMOUNT_FROM"] = $getamountfrom;
			$pview->selectedamountfrom = $getamountfrom;
		} else {
			$pview->selectedamountfrom = "";
		}
		if ($getamountto > 0) {
			$p["AMOUNT_TO"] = $getamountto;
			$pview->selectedamountto = $getamountto;
		} else {
			$pview->selectedamountto = "";
		}
		
		if ($gettype != null) {
			$p["TRANSACTION_TYPE"] = $gettype;
			$pview->selectedtype = $gettype;
		} else {
			$pview->selectedtype = "";
		}
		
		if ($getdatefrom != null) {
			$p["DATE_FROM"] = App_DataUtils::fmtdate_human2db($getdatefrom);
			$pview->selecteddatefrom = ($getdatefrom);
		} else {
			$pview->selecteddatefrom = "";
		}
		if ($getdateto != null) {
			$p["DATE_TO"] = App_DataUtils::fmtdate_human2db($getdateto);
			$pview->selecteddateto = ($getdateto);
		} else {
			$pview->selecteddateto = "";
		}
		
		$t = new App_Transaction_Transaction();
		$r = $t->search($p,$session_data->prefs["system"]["timezone"]);
		$allpages = ceil(($t->search($p,$session_data->prefs["system"]["timezone"],true))/$results_per_page);
		
		$res = array();
		foreach ($r as $row) {
			$res[] = $row;
		}
		
		$resinfo = Array();
		foreach ($res as $r) {
			$t = new App_Transaction_Transaction($r['transaction_id'],$session_data->prefs["system"]["timezone"]);
			$resinfo[$r['transaction_id']] = $t->getInfo();
		}
		
		$pview->trans     = $res;
		$pview->transinfo = $resinfo;
		$pview->pages     = $allpages;
		$pview->page      = $page;
		

                App_DataUtils::commit();

	}
	
}

?>
