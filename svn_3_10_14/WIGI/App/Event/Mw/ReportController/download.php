<?php

class App_Event_Mw_ReportController_download extends App_Event_WsEventAbstract  {
	
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
                                'SUMMARY_TYPE' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CDATE' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CTYPE' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CNAME' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CADDRESS' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CPHONE' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CEMAIL' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CAMOUNT' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                                'CDESCRIPTION' => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),

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

		$pview->pageid = "report";

                $uid  = $session_data->identity['userid'];
		
		$getpage = $this->_request->getParam('P');
		$getamountfrom = $this->_request->getParam('AF');
		$getamountto = $this->_request->getParam('AT');
		$gettype = $this->_request->getParam('T');
		$getdatefrom = $this->_request->getParam('DF');
		$getdateto = $this->_request->getParam('DT');
		$getmobileid = $this->_request->getParam('M');
                $include_headers = $this->_request->getParam('INCLUDE_HEADERS');
                $summary_type = $this->_request->getParam('SUMMARY_TYPE');
                $showfields_input = array('DATE','TYPE','NAME','ADDRESS','PHONE','EMAIL','AMOUNT','DESCRIPTION');
                $showfields = array();		

                $params = $this->_request->getParams();
 
                foreach ($showfields_input as $val) {
                  if (array_key_exists('C' . $val,$params)) {
                    $showfields[$val] = true;
                  }
                }
		
		$p = Array();
	
		$user = new App_User($uid);	
		$users = $user->getPosUsers();
		$r = array($uid);
		foreach ($users as $row) { array_push($r,$row->user_id); }
		$p["USER_ID_MULTIPLE"] = $r;
		
		if ($getamountfrom > 0) {
			$p["AMOUNT_FROM"] = $getamountfrom;
		} 
		if ($getamountto > 0) {
			$p["AMOUNT_TO"] = $getamountto;
		} 
	
                $filename = "";
	
		if ($gettype != null) {
                        $filename .= App_Transaction_Type::getConstName($gettype) . " Report ";
			$p["TRANSACTION_TYPE"] = $gettype;
		} 
	
		if ($getdatefrom != null) {
                        $filename .= str_replace('/','',$getdatefrom);
			$p["DATE_FROM"] = App_DataUtils::fmtdate_human2db($getdatefrom);
          
		}
		if ($getdateto != null) {
                        $filename .= " - " . str_replace('/','',$getdateto);
			$p["DATE_TO"] = App_DataUtils::fmtdate_human2db($getdateto);
		}
	
                if ($summary_type === "topusers") {
                        $p["GROUP_BY"] = "USER";
                }

                if ($include_headers == "yes") $include_headers = true; else $include_headers = false;
	
		$t = new App_Report();
		$r = $t->search($p,$session_data->prefs["system"]["timezone"],$showfields,false,true,$include_headers);
		header("Content-type: text/plain");
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename.csv");
                header("Content-Transfer-Encoding: binary");
	        echo $r;


	}
	
}

?>
