<?php

class App_Event_Mw_StatementController_download extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'from' => array('generic', 100, 0, App_Constants::getFormLabel('DATE')),
				'to' => array('generic', 100, 0, App_Constants::getFormLabel('DATE')),
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

                header("Content-type: text/csv");
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=WiGime-Statement.csv");
                header("Content-Transfer-Encoding: binary");

                $uid  = $session_data->identity['userid'];

                $getdatefrom = $this->_request->getParam("from");
                $getdateto = $this->_request->getParam("to");

                $allusers = Array();
                $u = new App_Models_Db_Wigi_User();
                $udb = $u->fetchAll();
                foreach ($udb as $urow) {
                        $allusers[$urow['user_id']] = $urow;
                }
                $pview->allusers = $allusers;

                $allcells = Array();
                $c = new App_Models_Db_Wigi_UserMobile();
                $cdb = $c->fetchAll();
                foreach ($cdb as $crow) {
                        $allcells[$crow['mobile_id']] = $crow;
                }
                $pview->allcellphones = $allcells;

                $p = new App_Prefs();
                $prefs = $p->getWebUserPrefs($uid);
                $timezone = $prefs["system"]["timezone"];

                $w = new App_WigiEngine();

                $statement = $w->getStatement($uid, $getdatefrom, $getdateto, $timezone);

                $total = 0;
                $transactions = 0;
                foreach ($statement as $s) {
                        $i = 0;
                        foreach ($s['transactions'] as $t) {
                                if ($i == 0) {
                                        if ($t['balance'] > 0) {
                                                $total += $t['balance'];
                                        }
                                        $i++;
                                }
                                $transactions += $t['amount'];
                        }
                }

                $pview->totalending = $total;
                $pview->totaltransactions = $transactions;

                $pview->datefull = date("F, Y", strtotime($getdatefrom));
                $pview->datefrom = date("M d, Y", strtotime($getdatefrom));
                $pview->dateto = date("M d, Y", strtotime($getdateto));

                $pview->email = $session_data->identity['email'];
                $pview->statement = $statement;
                $pview->tzpref = $timezone;
	
                App_DataUtils::commit();

	}
	
}

?>
