<?php

    appSetup();
    test();


function test(){
$myarray = Array();
$myarray["DIRECTION"] = "DEBIT";
$myresult = App_Transaction_Transaction::search($myarray);
Zend_Debug::dump($myresult);

//  $a = new App_Auth();
//  $a->auth1('consumer','256','password');
}



function appSetup(){
    $libBase  = '/u/latest/Phplib';
    $pathBase = '/u/latest/';
    $appName  = 'WIGI';
    set_include_path(get_include_path(). PATH_SEPARATOR . $libBase );	
    set_include_path(get_include_path(). PATH_SEPARATOR . $pathBase );	
    set_include_path(get_include_path() . PATH_SEPARATOR . $pathBase . $appName);

    require_once 'Zend/Loader/Autoloader.php';
    $autoloader = Zend_Loader_Autoloader::getInstance();
    $autoloader->registerNamespace('Atlasp');
    $autoloader->registerNamespace('Models');
    $autoloader->registerNamespace('App');

    $config = new Zend_Config_Ini('/etc/apache2/apps/conf/wigi.cfg', 'main');
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
