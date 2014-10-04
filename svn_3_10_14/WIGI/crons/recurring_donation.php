<?php
	error_reporting(E_ALL|E_STRICT);
    ini_set('display_errors',true); 
    ini_set('memory_limit', '256M');

    $libBase = '/var/www/html/incash/svn/Phplib';
    set_include_path(get_include_path(). PATH_SEPARATOR . $libBase );	
    $pathBase = '/var/www/html/incash/svn/';
    set_include_path(get_include_path(). PATH_SEPARATOR . $pathBase );	
    $appName = 'WIGI';
    set_include_path(get_include_path(). PATH_SEPARATOR . $pathBase . $appName  );	
	
    appSetup();
    recurring_donation();

function recurring_donation(){
    $w = new App_WigiEngine();
	 
	$params = array();
	$user_detail = App_User::searchAllConsumerInfo($params);
	if (count($user_detail) != 0) {
		foreach($user_detail as $key1=>$val1){
			$user_id = $val1['user_id'];
			$mobile_id = $val1['mobile_id'];
			$results = $w->sendRecurringDonation($mobile_id,$user_id);
				if (count($results) != 0) {
					foreach($results as $key=>$val){
						$time_end = strtotime($val['donate_end_date']);
						$order_id = $val['order_id'];
						
						$dr = new App_Models_Db_Wigi_DonateRecurring();
						$select_order = $dr->select()->from(array('t' => 'donate_recurring'), array('donate_date'));
						$select_order->where('order_id = ?',$order_id);
						$raws_order_time = $dr->fetchAll($select_order);
						$max_time = 0;
						foreach($raws_order_time as $key_time=>$row_time){
							$time_current = $row_time['donate_date'];
							if($max_time < $time_current){
								$max_time = $time_current;
							}
						}
						$time_diff = time() - $max_time;
						//echo time()."===".$max_time."===".$time_diff."\n";
						if($val['donate_frequency'] == "Weekly"){
							$time_dff_check = (7 * 24 * 60 * 60); //7 days timestamp
							//$time_dff_check = (1 * 60 * 60); //1 hour
						}
						else if($val['donate_frequency'] == "Biweekly"){
							$time_dff_check = (7 * 24 * 60 * 60) / (2); //3.5 days timestamp
							//$time_dff_check = (1 * 60 * 60) / (2); //0.5 hour
						}
						else if($val['donate_frequency'] == "Monthly"){
							//$time_dff_check = (7 * 24 * 60 * 60) / (2); 
							$date_fetch = date("d-M-Y H:i:s",$max_time);
							$date = strtotime(date("d-M-Y H:i:s", strtotime($date_fetch)) . " +1 Month");
							$time_dff_check = $date - $max_time;
						}
						else if($val['donate_frequency'] == "Biyearly"){
							$time_dff_check = (365 * 24 * 60 * 60) / (2);
						}
						else if($val['donate_frequency'] == "Yearly"){
							$time_dff_check = (365 * 24 * 60 * 60) / (2);
						}
						
						//echo $time_diff."=======".$time_dff_check."\n";
						$time_diff = $time_diff + 10;
						if($time_diff >= $time_dff_check){
							if(($val['donate_frequency'] != "") && ($time_end >= time())){
							
								$extinfo = array();
								$extinfo['osid'] = '';
								$extinfo['devicetod'] = '';
								$extinfo['appversion'] = '';
								$extinfo['devicemodel'] = '';
								$extinfo['systemname'] = '';
								$extinfo['systemversion'] = '';
								$extinfo['gps'] = '';
								$extinfo['language'] = '';
								$extinfo['ip_address'] = '';
								$extinfo['user_description'] = '';
								$extinfo['server_datetime'] = '';
								$extinfo['client_datetime'] = '';
								$extinfo['appname'] = '';
								$extinfo['browser_string'] = '';
								$extinfo['os'] = '';
								
								$select = $dr->select();
								$select->where('order_id = ?',$order_id);
								$raw = $dr->fetchAll($select);
								
								foreach($raw as $key2=>$extinfo_val){
									$extinfo['osid']   			= $extinfo_val['osid'];  			
									$extinfo['devicetod'] 		= $extinfo_val['devicetod'];
									$extinfo['appversion'] 		= $extinfo_val['appversion']; 		
									$extinfo['devicemodel'] 	= $extinfo_val['devicemodel']; 	
									$extinfo['systemname'] 		= $extinfo_val['systemname']; 		
									$extinfo['systemversion'] 	= $extinfo_val['systemversion']; 	
									$extinfo['gps'] 			= $extinfo_val['gps'];
									$extinfo['language'] 		= $extinfo_val['language']; 		
									$extinfo['ip_address'] 		= $extinfo_val['ip_address']; 		
									$extinfo['user_description']= $extinfo_val['user_description'];
									$extinfo['server_datetime'] = $extinfo_val['server_datetime']; 
									$extinfo['client_datetime'] = $extinfo_val['client_datetime']; 
									$extinfo['appname'] 		= $extinfo_val['appname']; 		
									$extinfo['browser_string'] 	= $extinfo_val['browser_string']; 	
									$extinfo['os'] 				= $extinfo_val['os']; 				
								}
								$from_id = $val['consumer_mobile_id'];
								$u_to = new App_User($val['merchant_user_id']);
								$to_id = $u_to->getDefaultCellphone();
								$amount = $val['price'];
								
								$w->sendMoney($extinfo,$from_id,$to_id,$amount,"Donation");
								
								$insert_data = array(
									'order_id' => $order_id,
								   'donate_date'  => time(),
								   'osid' => $extinfo['osid'],
								   'devicetod'  => $extinfo['devicetod'],
								   'appversion' => $extinfo['appversion'],
								   'devicemodel'    => $extinfo['devicemodel'],
								   'systemname' => $extinfo['systemname'],
								   'systemversion' => $extinfo['systemversion'],
								   'gps' => $extinfo['gps'],
								   'appname' =>  $extinfo['appname'],
								   'language' => $extinfo['language'],
								   'ip_address' => $extinfo['ip_address'],
								   'server_datetime' => $extinfo['server_datetime'],
								   'client_datetime' => $extinfo['client_datetime'],
								   'os' => $extinfo['os'],
								   'browser_string' => $extinfo['browser_string'],
								   'user_description' => $extinfo['user_description'],
								);
								$dr->insert($insert_data);
$c_from = new App_Cellphone($from_id);
$c_from->checkConstraint($amount,'1');
$c_from->checkConstraint($amount,'3');	
	
$c_to = new App_Cellphone($to_id);
$c_to->checkConstraint($amount,'7',false);
				
$c_from->sendMessage("InCashMe&trade;: You have sent ₹$amount to $to_id", 'InCashMe : Send Money');
$c_to->sendMessage("InCashMe&trade;: You have received ₹$amount from " . $c_from->getCellphone() . " Message: $message", 'InCashMe : Recieve Money');
								
								echo $from_id."=".$to_id."=".$amount."="."Donation\n";
								//echo strtotime($val['donate_start_date'])."=============".$time_end."===".time()."\n";
								//print_r($val);
							}
						}
					}
                }
		}
	}
}

function appSetup(){
    $libBase  = '/var/www/html/incash/svn/Phplib/';
    $pathBase = '/var/www/html/incash/';
    $appName  = 'WIGI';
    set_include_path(get_include_path(). PATH_SEPARATOR . $libBase );	
    set_include_path(get_include_path(). PATH_SEPARATOR . $pathBase );	
    set_include_path(get_include_path() . PATH_SEPARATOR . $pathBase . $appName);

    require_once 'Zend/Loader/Autoloader.php';
    $autoloader = Zend_Loader_Autoloader::getInstance();
    $autoloader->registerNamespace('Atlasp');
    $autoloader->registerNamespace('Models');
    $autoloader->registerNamespace('App');

	$config = new Zend_Config_Ini('/var/www/html/incash/svn/WIGI/cfg/wigi-dev.cfg', 'main');
    Zend_Registry::set('config', $config);
    Zend_Registry::set('name', $appName);
    date_default_timezone_set( $config->timezone );

    $format = '%timestamp% %priorityName% (%priority%): %username%, %clientIp%, %message%' . PHP_EOL;
    $formatter = new Zend_Log_Formatter_Simple($format);
    $writer = new Zend_Log_Writer_Stream($config->logging->file);
    $writer->setFormatter($formatter);
    $logger = new Zend_Log($writer)	;
    Zend_Registry::set('log', $logger);
	
    $webapp = new Atlasp_WebApp($logger);
    $dbArray = array('sessdb', 'wigidb', 'wlogdb', 'wsafedb');
    $webapp->initializeDbs($dbArray);
    $webapp->setDefaultDb('sess');
}
