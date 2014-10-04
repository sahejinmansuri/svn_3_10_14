<?php

class App_Event_Mw_StatementController_home extends App_Event_WsEventAbstract  {
	
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
		
	                $pview->pageid = "statements";

                        $uid  = $session_data->identity['userid'];

                        $p = new App_Prefs();
                        $prefs = $p->getWebUserPrefs($uid);

                        $w = new App_WigiEngine();
                        $timezone = $prefs["system"]["timezone"];

                        $uinfo = new App_Models_Db_Wigi_User();
                        $uinfof = $uinfo->fetchRow($uinfo->select()->from($uinfo,
                                array('date_added')
                        )->where('user_id = ?', $uid));

                        $accountcreated = strtotime($uinfof['date_added']);

                        $dates = Array();
                        $datescount = Array();
                        $m = new Zend_Date();
                        for ($i=0; $i<12; $i++) {
                                $m->subMonth(1);
                                $lastday = $m->get(Zend_Date::MONTH_DAYS);
                                $m->set($lastday, Zend_Date::DAY);
                                $m->set('23:59:59', Zend_Date::TIMES);
                                if ($m->get(Zend_Date::TIMESTAMP) >= $accountcreated) {
                                        $date = $m->toArray();
                                        if (!array_key_exists($date['year'] , $dates)) {
                                                $dates[$date['year']] = Array();
                                                $datescount[$date['year']] = Array();
                                        }
                                        $datefrom = $date['year']."-".$date['month']."-1";
                                        $dateto = $date['year']."-".$date['month']."-".$date['day'];
                                        $statement = $w->getStatement($uid, $datefrom, $dateto, $timezone);
                                        $statement_count = 0;
                                        foreach ($statement as $s) {
                                                $statement_count += count($s['transactions']);
                                        }
                                        $dates[$date['year']][] = $date;
                                        $datescount[$date['year']][] = $statement_count;
                                }
                        }

                        $pview->dates = $dates;
                        $pview->datescount = $datescount;
                        
                        App_DataUtils::commit();
	
	}
	
}

?>
