<?php

 error_reporting(E_ALL|E_STRICT);
    //ini_set('display_errors',true); 
    ini_set('memory_limit', '256M');

    $libBase = '/var/www/html/incash/svn/Phplib';
    set_include_path(get_include_path(). PATH_SEPARATOR . $libBase );	
    $pathBase = '/var/www/html/incash/svn/';
    set_include_path(get_include_path(). PATH_SEPARATOR . $pathBase );	
    $appName = 'WIGI';
    set_include_path(get_include_path(). PATH_SEPARATOR . $pathBase . $appName  );	
	
//ini_set('include_path', '/var/www/html/incash/svn/Phplib/');
    appSetup();
    expireCodes();

function expireCodes(){
	$w = new App_WigiEngine();
     
	//$params = array('USER_ID'=>'692');
	$user_detail = App_User::searchAllConsumerInfo($params);
	if (count($user_detail) != 0) {
		foreach($user_detail as $key1=>$val1){
			$user_id = $val1['user_id'];
			$mobile_id = $val1['mobile_id'];
			//echo $user_id."====".$mobile_id."\n";
			$c = new App_Cellphone($mobile_id);
			$document = $c->getDocuments();
			foreach($document as $row) {
				$doc_expiration  = $row->expiration;
				$doc_description  = $row->description;
				$doc_doc_type  = $row->doc_type;
				if($doc_expiration != ""){
					$doc_expiration_time = strtotime($doc_expiration);
					if($doc_expiration_time > 0){
						$time_start = time();
						$time_end = $time_start + (24 * 60 * 60);
						$doc_send_mail_time = $doc_expiration_time - (6 * 24 * 60 * 60);
						if(($time_start <= $doc_send_mail_time) && ($time_end > $doc_send_mail_time)){
							//echo $time_start."===".$doc_send_mail_time."===".$time_end;
							//echo "\n";
							$message_send = "<span style='font-family:tahoma'>InCashMe&trade;: </span>";
							$message_send .= "Your ".$doc_doc_type." \"".$doc_description."\" will be expired within a week";
							$message_sub = "InCashme : Document Expiration";
							$c_to = new App_Cellphone($mobile_id);
							$c_to->sendMessage($message_send, $message_sub);
						}
					}
				}
			}
			//echo "\n";
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

    //$config = new Zend_Config_Ini('/etc/apache2/apps/conf/wigi.cfg', 'main');
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
