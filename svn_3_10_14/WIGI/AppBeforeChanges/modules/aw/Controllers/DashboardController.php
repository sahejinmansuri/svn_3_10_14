<?php

include(__DIR__ . '/WebController.php');

class Aw_DashboardController extends Aw_WebController {

    public function homeAction() {
        $this->view->pageid = "dashboard";
        $this->view->lastlogin = "N/A";
        $this->view->lastip = "127.0.0.1";
        $this->view->name = "test";

		$this->getUserSummary();
		$this->getTransactionSummary();
		$this->getWigiFinanceSummary();
        $this->getSystemStats();
    }

	protected function getUserSummary()
	{
        $now = time();
        $last1 = $now - (1 * 24 * 60 * 60);
        $last7 = $now - (7 * 24 * 60 * 60);
        $last30 = $now - (30 * 24 * 60 * 60);
        $last365 = $now - (365 * 24 * 60 * 60);

        $lastOneDayData = App_User::getUserCounts(date(DateTime::ISO8601, $last1));
        $lastWeekData = App_User::getUserCounts(date(DateTime::ISO8601, $last7));
        $lastMonthData = App_User::getUserCounts(date(DateTime::ISO8601, $last30));
        $lastYearData = App_User::getUserCounts(date(DateTime::ISO8601, $last365));

		$user_summary = array('consumer','merchant','posuser');
		$results=array();	
		foreach($user_summary as $id=>$data2)
		{
			$tmp=array();
			$tmp['last1']=0;
			$tmp['last7']=0;
			$tmp['last30']=0;
			$tmp['last365']=0;

			foreach($lastOneDayData as $id=>$data)
			{
				if($data['user_type'] == $data2)
				{
					$tmp['last1']=$data['counts'];
				}
			}

			foreach($lastWeekData as $id=>$data)
			{
				if($data['user_type'] == $data2)
				{
					$tmp['last7']=$data['counts'];
				}
			}

			foreach($lastMonthData as $id=>$data)
			{
				if($data['user_type'] == $data2)
				{
					$tmp['last30']=$data['counts'];
				}
			}

			foreach($lastYearData as $id=>$data)
			{
				if($data['user_type'] == $data2)
				{
					$tmp['last365']=$data['counts'];
				}
			}

			$tmp['label']=ucwords(strtolower($data2));	
			$results[$data2]=$tmp;
		}
		
		$this->view->userSummaryData = $results;
		return $results;
	}


	protected function getTransactionSummary()
	{
        $now = time();
        $last1 = $now - (1 * 24 * 60 * 60);
        $last7 = $now - (7 * 24 * 60 * 60);
        $last30 = $now - (30 * 24 * 60 * 60);
        $last365 = $now - (365 * 24 * 60 * 60);

        $lastOneDayData = App_Transaction_Transaction::getTransactionCounts(date(DateTime::ISO8601, $last1));
        $lastWeekData = App_Transaction_Transaction::getTransactionCounts(date(DateTime::ISO8601, $last7));
		//print_r($lastWeekData); die();
        $lastMonthData = App_Transaction_Transaction::getTransactionCounts(date(DateTime::ISO8601, $last30));
        $lastYearData = App_Transaction_Transaction::getTransactionCounts(date(DateTime::ISO8601, $last365));

		$trans_direction = array('CREDIT','DEBIT','INFO');
		$results=array();	
		foreach($trans_direction as $id=>$data2)
		{
			$tmp=array();
			$tmp['last1']=0;
			$tmp['last7']=0;
			$tmp['last30']=0;
			$tmp['last365']=0;

			foreach($lastOneDayData as $id=>$data)
			{
				if($data['direction'] == $data2)
				{
					$tmp['last1']=$data['counts'];
				}
			}

			foreach($lastWeekData as $id=>$data)
			{
				if($data['direction'] == $data2)
				{
					$tmp['last7']=$data['counts'];
				}
			}

			foreach($lastMonthData as $id=>$data)
			{
				if($data['direction'] == $data2)
				{
					$tmp['last30']=$data['counts'];
				}
			}

			foreach($lastYearData as $id=>$data)
			{
				if($data['direction'] == $data2)
				{
					$tmp['last365']=$data['counts'];
				}
			}

			$tmp['label']=ucwords(strtolower($data2));	
			$results[$data2]=$tmp;
		}
		
		$this->view->transactionsData = $results;
		return $results;
		//print_r($results);die();

	}

    public function getSystemStats() {
        date_default_timezone_set('EST');

        $log_file_name = "/u/logs/error_log";

        $result = array();
        $app_modules = array("mobws", "cw", "posws", "mw", "aw");
        $app_labels = array('mobws' => "Mobile Webservice",
            'posws' => "POS Webservice",
            'cw' => "Consumer Web",
            'mw' => "Merchant Web",
            'aw' => "Admin Web");

        foreach ($app_modules as $module) {
            $result[$module] = array();
            $result[$module]['label'] = $app_labels[$module];
// var_dump($app_labels[$module]);
            $result[$module]['num'] = 1;
            $result[$module]['avg'] = 1;
            $result[$module]['max'] = 0;
            $result[$module]['maxevt'] = 1;
            $result[$module]['totaltime'] = 0;
            $result[$module]['uip'] = array();
        }

        foreach (file($log_file_name) as $line) {
            if (preg_match("/client (.*?)\].*Times.*\|MOD\|(.*?)\|.*EVENT\|(.*?)\|.*TOTAL\|(.*?)\|/", $line, $module)) {
                //// var_dump($module);
                if(!array_key_exists($module[2],$app_labels)){
                  continue;
                }
                $result[$module[2]]['num']++;
                $result[$module[2]]['totaltime']+= $module[4];
                if (!array_key_exists($module[1], $result[$module[2]]['uip']))
                    $result[$module[2]]['uip'][$module[1]] = 0;
                $result[$module[2]]['uip'][$module[1]]++;
                if ($result[$module[2]]['max'] < $module[4]) {
                    $result[$module[2]]['max'] = $module[4];
                    $result[$module[2]]['maxevt'] = $module[3];
                }
                $result[$module[2]]['label'] = $app_labels[$module[2]];
            }
        }

		$finalResults=array();
		foreach($result as $id=>$data)
		{
			$tmp=array();
			$tmp['module_name']=$data['label'];
			$tmp['total_requests']=$data['num'];
			$tmp['avg_request_time']=round($data['totaltime']/$data['num'],2);
			$tmp['longest_request_time']=round($data['max'],2);
			$tmp['longest_event_time']=$data['maxevt'];

			$finalResults[]=$tmp;
		}

        $this->view->stat_results = $finalResults;
    }

    public function getRecentUsers() {
        $recentusers = array();
        $recentusers["consumer"] = App_User::getRecentlyAddedUsers('consumer', '20');
        $recentusers["merchant"] = App_User::getRecentlyAddedUsers('merchant', '20');
        $this->view->recentusers = $recentusers;
    }

	protected function getWigiFinanceSummary()
	{
        $now = time();
        $last1 = $now - (1 * 24 * 60 * 60);
        $last7 = $now - (7 * 24 * 60 * 60);
        $last30 = $now - (30 * 24 * 60 * 60);
        $last365 = $now - (365 * 24 * 60 * 60);

		$code_str='300,301,302,303,304,305';

        $lastOneDayData = App_Transaction_Transaction::getAmountCountsForTypes($code_str, date(DateTime::ISO8601, $last1));
        $lastWeekData = App_Transaction_Transaction::getAmountCountsForTypes($code_str, date(DateTime::ISO8601, $last7));
        $lastMonthData = App_Transaction_Transaction::getAmountCountsForTypes($code_str, date(DateTime::ISO8601, $last30));
        $lastYearData = App_Transaction_Transaction::getAmountCountsForTypes($code_str, date(DateTime::ISO8601, $last365));

		$codeArr=explode(",",$code_str);
		$typesArr = App_Transaction_Type::getConstName();

		foreach($codeArr as $id=>$data)
		{
				$tmp['label']=$typesArr[$data];
				$tmp['ONE']='0.00';
				$tmp['WEEK']='0.00';
				$tmp['MONTH']='0.00';
				$tmp['YEAR']='0.00';

				foreach($lastOneDayData as $id2=>$data2)
				{
						if($data2['type']==$data)
						{
							$tmp['ONE']=$data2['total_amount'];
						}
				}

				foreach($lastWeekData as $id2=>$data2)
				{
						if($data2['type']==$data)
						{
							$tmp['WEEK']=$data2['total_amount'];
						}
				}

				foreach($lastMonthData as $id2=>$data2)
				{
						if($data2['type']==$data)
						{
							$tmp['MONTH']=$data2['total_amount'];
						}
				}

				foreach($lastYearData as $id2=>$data2)
				{
						if($data2['type']==$data)
						{
							$tmp['YEAR']=$data2['total_amount'];
						}
				}

			$finalRes[$data]=$tmp;
		}


		$this->view->financeDashboard = $finalRes;
		return $finalRes;

		/*$finalRes=array();
			foreach($codeArr as $id=>$data)
			{
				$tmp[$data]='0.0';
				foreach($lastOneDayData as $id2=>$data2)
				{
						if($data2['type']==$data)
						{
							$tmp[$data]=$data2['total_amount'];
						}
				}
			}
			$tmp['label']='Last 24 hours';
			$finalRes['DAY']=$tmp;

			foreach($codeArr as $id=>$data)
			{
				$tmp[$data]='0.0';
				foreach($lastWeekData as $id2=>$data2)
				{
						if($data2['type']==$data)
						{
							$tmp[$data]=$data2['total_amount'];
						}
				}
			}
			$tmp['label']='Last Week';
			$finalRes['WEEK']=$tmp;

			foreach($codeArr as $id=>$data)
			{
				$tmp[$data]='0.0';
				foreach($lastMonthData as $id2=>$data2)
				{
						if($data2['type']==$data)
						{
							$tmp[$data]=$data2['total_amount'];
						}
				}
			}
			$tmp['label']='Last Month';
			$finalRes['MONTH']=$tmp;

			foreach($codeArr as $id=>$data)
			{
				$tmp[$data]='0.0';
				foreach($lastYearData as $id2=>$data2)
				{
						if($data2['type']==$data)
						{
							$tmp[$data]=$data2['total_amount'];
						}
				}
			}
			$tmp['label']='Last Year';
			$finalRes['YEAR']=$tmp;

		$this->view->financeDashboard = $finalRes;
		return $finalRes;*/
	}

}
