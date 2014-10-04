<?php

class Atlasp_WebApp {
    private $_loaders;
    protected $begin;
    
    public function __construct($logger)
    {
        $logger->debug(PHP_EOL . str_pad('', 100, '-'));
        $logger->debug('Creating  a new instance of Atlasp_Webapp ' . getmypid());
        $this->init();
    }

    private function init()
    {
        $this->begin = Atlasp_Utils::inst()->startTimer();
        $times = array();
        Zend_Registry::set('times', $times);
        $this->initErrMessages();

        // Add helpers prefixed with Helpers in Helpers/
        Zend_Controller_Action_HelperBroker::addPrefix('Helpers');
    }

    public function initializeDbs($dbList){
        $cfg = Zend_Registry::get('config');	
	foreach ($dbList as $dname){
	    $params = array(
	         'host'     => $cfg->get($dname)->get('hostname'),
			 'username' => $cfg->get($dname)->get('username'),
			 'password' => $cfg->get($dname)->get('password'),
			 'dbname'   => $cfg->get($dname)->get('database'),
			 'pdoType'  => $cfg->get($dname)->get('pdo')     ,
	              );  

	    if ($cfg->get($dname)->get('port')){
		$params['port'] = $cfg->get($dname)->get('port');
	    }
  
	    $db = Zend_Db::factory($cfg->$dname->type ,$params);
	    #$db->query('select 1');
	    Zend_Registry::set($cfg->$dname->handle, $db);
	}
	
    }
    
    public function setDefaultDb($type){
	Zend_Db_Table::setDefaultAdapter( Zend_Registry::get($type) );
    }

    public function initializeSession($cfg)
    {
   
        $mod = $this->getModuleName();
       $sessionOptions = array(
            'name' => $cfg->session->$mod->cookie,
            'use_cookies' => (int) $cfg->session->use_cookies
        );

        //  Set up Session
        Zend_Session::setSaveHandler(new Atlasp_SessionHandler(array('name' => $cfg->sessdb->table)));
        Zend_Session::setOptions($sessionOptions);

        //  Pick correct session
        $sessionKey = $this->_getRequestedSessionKey();
        if ($sessionKey) {
            Zend_Session::setId($sessionKey);
        }
	
        
	//  Start Session
        Zend_Session::start();
        
 
        //  Set main namespace expiration
        $sessionTimeout = (int) $cfg->session->timeout;
        if ($sessionTimeout) {
            $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
            $ns->setExpirationSeconds($sessionTimeout);
        }

        //  Log Info
        $log = Zend_Registry::get('log');
        $log->debug('Does session exist ' . Zend_Session::sessionExists());
        $log->debug('session id is      ' . Zend_Session::getId());
        if ($sessionTimeout) {
            $log->debug('session will expire at ' . date('Y-m-d H:i:s', time() + $sessionTimeout));
        }
    }

    public function initErrMessages(){
        $err = array(
	   'esp'    => '<br><br>We are experiencing techinical difficulties. Please try at a later time. Code : 2001',
	   'mysql'  => '<br><br>We are experiencing techinical difficulties. Please try at a later time. Code : 3001',
	   'xslt'   => '<br><br>We are experiencing techinical difficulties. Please try at a later time. Code : 4001',
	);	
	Zend_Registry::set('errors', $err);
    }

 
    public function setControllerDirs($appName, $pathBase){
		$controller = Zend_Controller_Front::getInstance();
		$config     = Zend_Registry::get('config');
		$modules = array_keys($config->modules->toArray());
		array_shift($modules);
		if (!empty($modules)) {
		    $autoloader = Zend_Loader_Autoloader::getInstance();
		    $moduleIncPath = array();
		    $controllerPath['default'] = $pathBase .  $appName. '/Controllers';
		    foreach ($modules as $module) {
			$mcpath = $pathBase . $appName. '/modules/'.  $module. '/Controllers';
			$modulepath = $pathBase . $appName. '/modules/'.  $module. '/Models/';
			$controllerPath[$module]=$mcpath;
			if (file_exists($modulepath)) {
			    $moduleIncPath[] = $modulepath;
			    $autoloader->registerNamespace(ucfirst($module));
			}
		    }
	            set_include_path(join(PATH_SEPARATOR, $moduleIncPath) . PATH_SEPARATOR . get_include_path());
		    $controller->setControllerDirectory($controllerPath);
		    unset($controllerPath);
	    	    unset($moduleIncPath);
	
		} else {
		    $controller->setControllerDirectory($pathBase .  $appName. '/Controllers');
		}
		unset($modules);

		// added to autoload models in modules
	    $this->_loaders = array(); 
		foreach ($controller->getControllerDirectory() as $module => $directory) { 
	    	$this->_loaders[$module] = new Zend_Application_Module_Autoloader(array( 
	        	'namespace' => ucfirst($module), 
	        	'basePath'  => dirname($directory), 
	    	)); 
		} 
	}

    public function printTimings($evt)
    {
        $mod = $this->getModuleName();
        $str = 'Times:APP|' . Zend_Registry::get('name') . '|MOD|'.$mod.'|SID|' . Zend_Session::getId() . '|EVENT|' . $evt . '|';
        try {
            if (isset($s) && isset($s->identity) && isset($s->identity->loginid)) {
                $str.='LOGINID|' . $s->identity->loginid . '|';
            }
        } catch (Exception $e) {
            
        }
        foreach (Zend_Registry::get('times') as $k => $v) {
            $str.=$k . '|' . $v . '|';
        }
        $t = Atlasp_Utils::inst()->endTimer($this->begin);
        $str.='TOTAL|' . $t . '|' . 'UAGENT|';
        $str.=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'none';
        $str.='|';
		if($evt != 'cellphone/applicationsession'){
			error_log($str);
		}
    }

    /**
     * Gets requested session key
     * 
     * @return string
     */
    protected function _getRequestedSessionKey()
    {
        //  Try go get the key from POST
        if (isset($_POST['KEY'])) {
            return $_POST['KEY'];
        }

        //  If not in POST try to get it from Request URI 
        if (preg_match('/KEY\/([a-zA-Z0-9]+)/', $_SERVER['REQUEST_URI'], $matches)) {
            return $matches[1];
        }

        //
        return null;
    }
    
    public function overRideConfig(){
        $cfg =  Zend_Registry::get('config');    
        $m  = $this->getModuleName();
        $cfg->paths->templates = preg_replace( '/xxx/',$m, $cfg->paths->templates);
        //error_log("mod is $m and tpath is ". $cfg->paths->templates);
        Zend_Registry::set('config',$cfg);    
    }

    public function getModuleName(){
        $cfg =  Zend_Registry::get('config');
        if(strpos($_SERVER['REQUEST_URI'], $cfg->version)){
            preg_match('/\/.*?\/(.*?)\//',$_SERVER['REQUEST_URI'], $match);
        } else {
            preg_match('/\/(.*?)\//',$_SERVER['REQUEST_URI'], $match);
        }
        return $match[1];
    }

    public function isValidRequest(){
        $uri = $_SERVER['REQUEST_URI'];
        //error_log("is valid ? ".$uri);
        if(preg_match('/\.gif$|png$|css$|js$|jpg$|sql$/',$uri,$match) ) {
            return false;
        }else{
            return true;    
        }    
    }

    public function sendNotFound(){
        header('HTTP/1.0 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }

}