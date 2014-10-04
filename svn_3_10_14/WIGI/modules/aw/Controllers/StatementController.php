<?php

include(__DIR__ . '/WebController.php');

class Aw_StatementController extends Aw_WebController {

    public function homeAction() {
        $this->view->pageid = "statement";
        $this->view->lastlogin = "N/A";
        $this->view->lastip = "127.0.0.1";
        $this->view->name = "test";

		$this->getStatement();
    }
	
	public function viewAction(){
        $getdatefrom = $this->_request->getParam("from");
        $getdateto = $this->_request->getParam("to");

        $allusers = Array();
        $u = new App_Models_Db_Wigi_User();
        $udb = $u->fetchAll();
        foreach ($udb as $urow) {
                $allusers[$urow['user_id']] = $urow;
        }
        $this->view->allusers = $allusers;

        $country_code = "";
        $allcells = Array();
        $c = new App_Models_Db_Wigi_UserMobile();
        $cdb = $c->fetchAll();
        foreach ($cdb as $crow) {
                $allcells[$crow['mobile_id']] = $crow;
        }
        $this->view->allcellphones = $allcells;
        $this->view->countrycode = $country_code;

        
		$timezone = '5.5';

        $w = new App_WigiEngine();

        $statement = $w->getStatementAdmin($getdatefrom, $getdateto, $timezone);

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

        $this->view->totalending = $total;
        $this->view->totaltransactions = $transactions;

        $this->view->datefull = date("F, Y", strtotime($getdatefrom));
        $this->view->datefrom = date("M d, Y", strtotime($getdatefrom));
        $this->view->dateto = date("M d, Y", strtotime($getdateto));

        $this->view->email = $session_data->identity['email'];
        $this->view->statement = $statement;
        $this->view->tzpref = $timezone;
	
	}
	
	public function downloadAction(){
				header("Content-type: text/csv");
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=InCashMe-Statement.csv");
                header("Content-Transfer-Encoding: binary");
        $getdatefrom = $this->_request->getParam("from");
        $getdateto = $this->_request->getParam("to");

        $allusers = Array();
        $u = new App_Models_Db_Wigi_User();
        $udb = $u->fetchAll();
        foreach ($udb as $urow) {
                $allusers[$urow['user_id']] = $urow;
        }
        $this->view->allusers = $allusers;

        $country_code = "";
        $allcells = Array();
        $c = new App_Models_Db_Wigi_UserMobile();
        $cdb = $c->fetchAll();
        foreach ($cdb as $crow) {
                $allcells[$crow['mobile_id']] = $crow;
        }
        $this->view->allcellphones = $allcells;
        $this->view->countrycode = $country_code;

        
		$timezone = '5.5';

        $w = new App_WigiEngine();

        $statement = $w->getStatementAdmin($getdatefrom, $getdateto, $timezone);

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

        $this->view->totalending = $total;
        $this->view->totaltransactions = $transactions;

        $this->view->datefull = date("F, Y", strtotime($getdatefrom));
        $this->view->datefrom = date("M d, Y", strtotime($getdatefrom));
        $this->view->dateto = date("M d, Y", strtotime($getdateto));

        $this->view->email = $session_data->identity['email'];
        $this->view->statement = $statement;
        $this->view->tzpref = $timezone;
	
	}
	
	protected function getStatement()
	{
        $w = new App_WigiEngine();
                        $timezone = $prefs["system"]["timezone"];

                        $uinfo = new App_Models_Db_Wigi_User();
                        $uinfof = $uinfo->fetchAll($uinfo->select());
						//echo "<pre>";
						//print_r($uinfof);
						//exit();

                        //$accountcreated = strtotime($uinfof['date_added']);
						$accountcreated = '1388617200';
						
						$dates = Array();
                        $datescount = Array();
                        $m = new Zend_Date();
						$i = 0;
						//echo "<pre>";
					//foreach($uinfof as $ky=>$val){
						//if($i == 0){
						//if($val['user_id'] == 692){
							//print_r($val);
							//exit();
							
							$uid = $val['user_id'];
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
											$statement = $w->getStatementAdmin($datefrom, $dateto, $timezone);
											$statement_count = 0;
											foreach ($statement as $s) {
													$statement_count += count($s['transactions']);
											}
											$dates[$date['year']][] = $date;
											$datescount[$date['year']][] = $statement_count;
									}
							}
						//}
						//$i++;
					//}

                        $this->view->dates = $dates;
                        $this->view->datescount = $datescount;	
		//return $results;
	}
	
}
