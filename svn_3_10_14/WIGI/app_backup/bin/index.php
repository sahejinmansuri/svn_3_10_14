<?php
    
    error_reporting(0);
    //error_reporting(E_ALL|E_STRICT);
    ini_set('display_errors',false);
    ini_set('memory_limit', '128M');

    $libBase = '/home/incash/svn/Phplib';
    set_include_path(get_include_path(). PATH_SEPARATOR . $libBase );	
    $pathBase = '/home/incash/svn/';
    set_include_path(get_include_path(). PATH_SEPARATOR . $pathBase );	
    $appName = 'WIGI';
    set_include_path(get_include_path(). PATH_SEPARATOR . $pathBase . $appName  );	
  
    require_once 'Zend/Loader/Autoloader.php';
    $autoloader = Zend_Loader_Autoloader::getInstance();
    $autoloader->registerNamespace('Atlasp');
    $autoloader->registerNamespace('Models');
    $autoloader->registerNamespace('App');

    
    $cfile = '/home/incash/svn/WIGI/cfg/wigi-dev.cfg';
    if(! file_exists($cfile)) $cfile = $pathBase.$appName. '/'. 'cfg/wigi.cfg';
    
    $config = new Atlasp_Config_Ini($cfile, 'main',array('allowModifications' => true));
    Zend_Registry::set('config', $config);
    date_default_timezone_set( $config->timezone );
    
    $logger = new Zend_Log(new Zend_Log_Writer_Stream($config->logging->file));
    Zend_Registry::set('log', $logger);
    Zend_Registry::set('name', $appName);

    error_log('request is '. $_SERVER['REQUEST_URI'] );
    
    $webapp = new Atlasp_WebApp($logger);
    //if($webapp->isValidRequest() == false) $webapp->sendNotFound();
    $dbArray = array('sessdb',  'wigidb', 'wlogdb', 'wsafedb');
    $webapp->initializeDbs($dbArray);
    $webapp->setDefaultDb('sess');
    $webapp->initializeSession($config);
    $webapp->setControllerDirs( $appName, $pathBase  );
    $webapp->overRideConfig();

    $controller = Zend_Controller_Front::getInstance();
    $controller->registerPlugin(new Atlasp_Plugins_ModuleParamValidator());
    $controller->registerPlugin(new Atlasp_Plugins_ErrorControllerSelector() );
    
    $vr = new Zend_Controller_Action_Helper_ViewRenderer();
    $vr->setView(new Atlasp_HtmlDisplay());
    $vr->setViewSuffix('tpl');
    Zend_Controller_Action_HelperBroker::addHelper($vr);


    $controller->dispatch();
    $webapp->printTimings($controller->getRequest()->getControllerName().'/'.$controller->getRequest()->getActionName());
