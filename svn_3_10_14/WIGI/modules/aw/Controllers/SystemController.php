<?php
include(__DIR__ . '/WebController.php');

class Aw_SystemController extends Aw_WebController {
	
    public function homeAction(){
    	$this->view->pageid = "system";
		$this->view->system_message='';

		$message = $this->getRequest()->getParam("MESSAGE");
		if($message)
		{
			$this->view->system_message=$message;
		}

        // Get Back up Details
        $dbackup = new App_WigiDbBackUp();
        $backupInfo = $dbackup->getDbBackUp();
        $this->view->db_backup_info = $backupInfo;
        $curr_time = date('m/d/Y H:i:s');
		$this->view->curr_sys_time = $curr_time;
		$this->view->hour_dd = $this->getHourDropDown();
		$this->view->mins_dd = $this->getMinsDropDown();

        $sm = new App_WigiSystemMaintainence();
        $system_maintainence_info = $sm->getAllMaintainenceInfo();
        $this->view->system_maintainence_info = $this->modifySMData($system_maintainence_info);

		$currentMaintainence = $this->getCurrentMaintainence();
        $this->view->current_maintainence_data= $this->modifyCurrentSMData($currentMaintainence);
	}


    public function editmaintainenceAction(){
		$app = $this->getRequest()->getParam("app");
		$schedule_action = $this->getRequest()->getParam("schedule_action");

        $cfg = Zend_Registry::get('config');
        $maintainence_file = $cfg->paths->systemmaintainence;
		$currMaintainence=array();
		$dataArr=array();
		if(file_exists($maintainence_file))
		{
			$curr_time = strtotime(date('m/d/Y H:i:s'));
			$handle = fopen($maintainence_file, 'r');
			$data = fread($handle,filesize($maintainence_file));		
			$mData = explode("\n",$data);

			foreach($mData as $id=>$rec)
			{
				if($rec)
				{
					$recData=explode("|",$rec);
					if((count($recData) > 6) and ($curr_time > $recData[7]) and ($curr_time < $recData[9]))
					{
						if($app == $recData[1])
						{
							$recData[5]=$schedule_action;
								if($schedule_action == 'BACK_UP')
								{
									$recData[9] = $recData[7];//Make the END TIME same as START TIME
								}
							$recStr = implode("|",$recData);							
						}
						else
						{
							$recStr = implode("|",$recData);
						}
					}
					else
					{
						$recStr = implode("|",$recData);
					}

					$dataArr[]=$recStr;
				}else
				{
					$dataArr[]=$rec;
				}
			}
		
			fclose($handle);

			$handle = fopen($maintainence_file, 'w') or die('Cannot open file:  '.$maintainence_file);
			foreach($dataArr as $id=>$data)
			{
				fwrite($handle, $data);
				fwrite($handle,"\n");
			}

			fclose($handle);
		}

		//echo $app."	 |	 ".$schedule_action;
		$a["MESSAGE"] = 'Record Updated.';
		$this->redirect('home','system','aw',$a);
	}

	protected function getHourDropDown()
	{
		return array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24');
	}

	protected function getMinsDropDown()
	{
		return array('00','15','30','45');
	}

	protected function getApps($id=null)
	{
		$app=array(
			'aw'=>'InCashMe&trade; Admin',
			'mw'=>'InCashMe&trade; Merchant',
			'cw'=>'InCashMe&trade; Consumer',
			'posws'=>'InCashMe&trade; Pos',
			'mobws'=>'InCashMe&trade; Mobile',
			'wsafe'=>'InCashMe&trade; Safe',
		);

		return $id?$app[$id]:$app;
	}

	protected function modifySMData($a)
	{
		//$t1 = date("m/d/Y h:i:s A T",$timestr);
		$res=array();
		foreach($a as $id=>$data)
		{
			$data['start_time'] = date("m/d/Y h:i:s A T",$data['start_time']);
			$data['end_time'] = date("m/d/Y h:i:s A T",$data['end_time']);
			$data['app_desc'] = $this->getApps($data['app']);
			$res[] = $data;
		}

		return $res;
	}

	protected function modifyCurrentSMData($a)
	{
		$results=array();
		foreach($a as $id=>$data)
		{
			$tmp['app']=$data[1];
			$tmp['start_time']=date("m/d/Y h:i:s A T",$data[7]);
			$tmp['end_time']=date("m/d/Y h:i:s A T",$data[9]);
			$tmp['schedule_action']=$data[5];
			$tmp['user_message']=$data[11];
			$tmp['app_desc'] = $this->getApps($data[1]);

			$results[]=$tmp;
		}

		return $results;
	}

    public function clearzendcacheAction() {
	try {

        	$this->view->pageid = "system";

        	if ($this->getRequest()->getParam("doaction") != null) {
			`rm /u/logs/apps/wigi/tmp/templates_c/`;
        	}
                $a["MESSAGE"] = 'Cache Cleared.';
		$this->redirect('home','system','aw',$a);

        } catch (Exception $e) {
		$this->view->error = $e->getMessage();
		$a["MESSAGE"] = $e->getMessage();
		$this->redirect('usererror','usererror','cw',$a);
	}

    }    


	public function addmaintainenceAction()
	{
			$curr_time = strtotime(date('m/d/Y H:i:s'));
			$app = $this->getRequest()->getParam("app");

			$a['schedule_now'] = $this->getRequest()->getParam("schedule_now");
			$a['schedule_action'] = $this->getRequest()->getParam("schedule_action");
			$a['user_message'] = $this->getRequest()->getParam("user_message");
			$a['notes'] = $this->getRequest()->getParam("notes");
			$a['user_id'] = $this->ns->identity['userid'];
			$a['dateadded']=new Zend_Db_Expr('NOW()');
			$a['status']='A';

			// build time now 
			$start_time = $this->getRequest()->getParam("start_date").' '.$this->getRequest()->getParam("start_hour").':'.$this->getRequest()->getParam("start_mins").':00';
			$end_time = $this->getRequest()->getParam("end_date").' '.$this->getRequest()->getParam("end_hour").':'.$this->getRequest()->getParam("end_mins").':00';
			
			//$t1 = date("m/d/Y h:i:s A T",$timestr);

			$sdate = strtotime($start_time);
			$edate = strtotime($end_time);

			if(!$a['schedule_now'] and ($edate - $sdate) <= 0)
			{
				$m["MESSAGE"] = 'Invalid Dates';
				$this->redirect('home','system','aw',$m);
			}

			if(!$a['schedule_now'] and ($edate<$curr_time))
			{
				$m["MESSAGE"] = 'End date should be greater than now.';
				$this->redirect('home','system','aw',$m);
			}

			if($a['schedule_now'])
			{
				$a['start_time'] = $curr_time;
				$a['end_time'] = $curr_time+30*60;
			}
			else
			{
				$a['start_time'] = $sdate;
				$a['end_time'] = $edate;
			}

			if($app=='all')
			{
				$appArr = $this->getApps();
				foreach($appArr as $id=>$data)
				{
					$this->scheduleMaintainence($a, $id);
				}
			}else
			{
					$this->scheduleMaintainence($a, $app);
			}

			$m["MESSAGE"] = 'System Maintainence request inserted';
			$this->redirect('home','system','aw',$m);
	}


	protected function scheduleMaintainence($a, $app)
	{
		$a['app']=$app;
		// write to file 
        $config = $this->cfg;
        $maintainence_file = $config->paths->systemmaintainence;
		if(file_exists($maintainence_file))
		{
			$handle = fopen($maintainence_file, 'a') or die('Cannot open file:  '.$maintainence_file);
			$data = 'app|'.$a['app'].'|schedule_now|'.$a['schedule_now'].'|schedule_action|'.$a['schedule_action'].'|start_time|'.$a['start_time'].'|end_time|'.$a['end_time'].'|user_message|'.$a['user_message']."\n";
			fwrite($handle, $data);
			fclose($handle);
		}

		// write to db
		$sm = new App_WigiSystemMaintainence();
		$sm_id = $sm->insert($a);
	}

	public function dbbackupAction()
	{
			$dbArray=array('wigidb','wlogdb','wsafedb','sessdb');

			$dbname = $this->getRequest()->getParam("dbname");
            $m["MESSAGE"] = 'Please select a Database';
            if(!$dbname)
            {
                $this->redirect('home','system','aw',$m);
            }
			
			if($dbname=='all')
			{
				foreach($dbArray as $id=>$data)
				{
					$this->mysqlbackup($data);
				}
			}else
			{
				$this->mysqlbackup($dbname);
			}

			$m["MESSAGE"] = $dbname.' Database Backed up';
			$this->redirect('home','system','aw',$m);
	}


    public function clearsvnfilesAction() {
        try {

                $this->view->pageid = "system";

                if ($this->getRequest()->getParam("doaction") != null) {
                        `find /u/latest -type d -name .svn|xargs rm -rf`;
                }

        } catch (Exception $e) {
                $this->view->error = $e->getMessage();
                $a["MESSAGE"] = $e->getMessage();
                $this->redirect('usererror','usererror','cw',$a);
        }

    }

 

    protected function mysqlbackup($dbname)
    {
        //$dbname='wigidb';

        $config = $this->cfg;
        $outputDir = $config->paths->dbbackup;
        $filename = $dbname.'_'.date("YmdHis").'.sql';

        $file=$outputDir."/".$filename;

        $username = $config->$dbname->username;
        $password = $config->$dbname->password;
        $dbName = $config->$dbname->database;


        $command = sprintf("
            mysqldump -u %s --password=%s -d %s --skip-no-data > %s",
            escapeshellcmd($username),
            escapeshellcmd($password),
            escapeshellcmd($dbName),            
            escapeshellcmd($file)
        );
        exec($command);
        $a['notes'] = $this->getRequest()->getParam("notes");
        $a['user_id'] = $this->ns->identity['userid'];
        $a['status']='P';
        $a['filename']=$filename;
        $a['dbname']=$dbname;
        $a['backup_time']=new Zend_Db_Expr('NOW()');
        
        $dbackup = new App_WigiDbBackUp();
        $dbackup->insert($a);
    }

}
