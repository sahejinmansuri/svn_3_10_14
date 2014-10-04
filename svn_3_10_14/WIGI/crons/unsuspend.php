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
    unsuspend();

function unsuspend(){
     App_User::bulkUnsuspend();
     App_Cellphone::bulkUnsuspend();
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
