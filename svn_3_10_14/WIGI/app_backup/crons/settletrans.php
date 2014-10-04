<?php

    appSetup();
    test();


function test(){
  for ($i=0; $i < 10; $i++) {
    $d = new Zend_Date();
    $d->sub($i, Zend_Date::DAY);
    $date = $d->toString('Y-'.Zend_Date::MONTH.'-d');
    $w = new App_WigiEngine();
    $w->bulkReleaseFunds($date);
  }
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
