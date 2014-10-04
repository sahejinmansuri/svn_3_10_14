<?php

require_once 'ControllerAbstract.php';

class Bps_RestController extends Bps_ControllerAbstract
{

    /**
     * @var App_Login_Ips
     */
    protected $login = null;
    /**
     * Array with permissions information. Key => Values pairs.
     * - Key = method name that requires permission check
     * - Value = session permission property name
     * 
     * @var array 
     */
    protected $_permissionsMap = array();

    /**
     * Dispatches only actions that _permissionsMap allows
     * 
     * @param string $action
     */
    public function dispatch($action)
    {
        //
        $isAllowed = true;

        //  Check if permissions map is not empty and enforces on current action
        if ($this->_permissionsMap && isset($this->_permissionsMap[$action])) {
            $this->log->debug(__METHOD__ . "() Checking Permissions Map for $action");
            //  Get method name
            $property = $this->_permissionsMap[$action];
            //  make sure session flag exists
            if (isset($this->ns->permissions->$property)) {
                //  Update the flag
                $isAllowed = $this->ns->permissions->$property;
            } else {
                $this->log->debug(__METHOD__ . "() Session does not have property named $property");
            }
        }

        if ($isAllowed) {
            parent::dispatch($action);
        } else {
            $this->_setResponseAccessNotAllowed();
        }
    }

    /**
     *
     * Checks for session unless we are calling
     * the authentication action
     */
    public function init()
    {
        parent::init();
        
        //  Set Response Headers
        $this->_response->setHeader('Content-type', 'application/json');
        $this->getHelper('ViewRenderer')->setNoRender();

        // login handler
        $this->login = new App_Login_Bps();
        $this->login->setDbHandler(Zend_Registry::get('syb'));

        if (isset($this->ns->identity) && isset($this->cfg->demo->loginids)) {
            $this->isDemoAccount();
        }

        // REST NON-Authentication
        $action = $this->getRequest()->getActionName();
        if ($action != 'auth') {
            //  If user is not logged in set error and terminate application
            if (!$this->login->isLogged()) {
                $this->_setResponseLoginRequired();
                exit();
            }
            
            //  Make sure device identifier matches the one used for login
            $helper = $this->getHelper('SessionHopping');
            /* @var $helper Helpers_SessionHopping */
            if (!$helper->isCorrectIdentifier()) {
                $helper->sendInvalidIdentifierNotification();
                $this->_setResponseInvalidDevice();
                exit();
            }

            //  Force masking
            if (isset($this->ns->identity)) {
                $this->applyMaskingRules();
            }
        }
    }

    /**
     * Iphone authentication
     */
    public function authAction()
    {
        $username = trim($this->getRequest()->getParam('USERNAME'));
        $password = trim($this->getRequest()->getParam('PASSWORD'));

        $this->login->setUsername($username);
        $this->login->setPassword($password);

        $response = new App_Ws_Types_Response();

        $code = $this->login->doLogin();
        if ($code == Atlasp_App_Login::RESULT_SUCCESS) {
            $this->log->debug(__METHOD__ . ' REST-Auth Successful: ' . Atlasp_App_Login::getConstName($code));

            //  Create login session
            $this->login->createLoginSession($this->checkDisableMultipleSessions());
            $identity = $this->login->getIdentity();
            $permHandler = $this->login->getPermissionHandler();
            
            //  Remember device identifier
            $this->getHelper('SessionHopping')->setDeviceIdentifier();

            //  Initialize Response results
            $result = array('key' => Zend_Session::getId());

            // Masking
            $this->_setDefaultMasking();

            // Set access permissions based on bit map
            $accessPermissions = (object) $this->_getBitMapPermissions();
            $this->ns->permissions = $accessPermissions;
            $result['permissions'] = $accessPermissions;

            // Set web service permissions and user preferences 
            $this->ns->wsPerms = $permHandler->getWebServiceOptionsPermissionsMap();
            $this->ns->userPrefs = $this->login->getUserPreferences();
            
            //
            // App Type (GLB & DPPA)
            //
			$applicationType = $this->login->getPermissionHandler()->getApplicationTypeTag();
            $this->log->debug(__METHOD__ . "() Current App Type = $applicationType");
            
            $this->ns->DPPA = -1;
            $this->ns->GLB = -1;
            $this->ns->applicationType = $applicationType;
            if ($applicationType == 'LE') {
                // Hard code GLB=2 and DPPA=1 for law enforcement
                $this->ns->DPPA = 1;
                $this->ns->GLB = 2;
                $this->log->debug(__METHOD__ . ' (LE) forcing DPPA 1 & GLB 2');
            }

            // allow only LE & GOV
            if ($applicationType != 'LE' && $applicationType != 'GOV') {
                Zend_Session::destroy();
                $response->setError(App_Ws_Types_Response::ERRNO_INVALID_APP_TYPE, "Invalid application type");
                $this->_response->setBody($response->toJson());
                return;
            }
            // App Type End
            //
           
            
            //  Free Trial
            $freeTrialTypes = array('F', 'R');
            $this->ns->debitUnits = (int) in_array($identity->company_status, $freeTrialTypes);


            //
            $result['rt'] = $this->ns->rt;
            $result['le'] = $applicationType == 'LE' ? 1 : 0;
            //  2 Factor SMS Authentication
            $result['sms2fa'] = (int) $this->_handeSms2Fa();

            // Response
            $response->setResult($result);
            $response->setCount(1);
        } else {
            $this->log->debug(__METHOD__ . ' REST-Auth FAILED: ' . Atlasp_App_Login::getConstName($code));
            if ($code == 999) {
                $response->setError(App_Ws_Types_Response::ERRNO_REQUIRE_PASSWORD_CHANGE, "Require Password Change, please login online and change your password before you access Accurint Mobile.");
            } else {
                $response->setError(App_Ws_Types_Response::ERRNO_LOGIN_FAILED, "Authentication failed");
            }
        }
        $this->_response->setBody($response->toJson());
    }

    /**
     * Destroy session
     */
    public function logoutAction()
    {
        // Logout and destroy session
        $this->login->logout();
        Zend_Session::destroy();
        
        // Set response
        $response = new App_Ws_Types_Response();
        $response->setCount(1);
        $response->setResult(array('success' =>  (int)Zend_Session::isDestroyed()));  
        
        // Send the response
        $this->_response->setBody($response->toJson());
        $this->_response->sendResponse();
        exit();
    }

    /**
     * This Action is colled when user selects GLB & DPPA on iphone
     * 
     */
    public function sessionAction()
    {
        $response = new App_Ws_Types_Response();
        $glb = (int) $this->getRequest()->getParam('GLB', $this->ns->GLB);
        $dppa = (int) $this->getRequest()->getParam('DPPA', $this->ns->DPPA);

        if ($this->ns->applicationType != 'LE') {
            $this->ns->GLB = $glb;
            $this->ns->DPPA = $dppa;
            $response->setCount(2);
            $response->setResult(array('GLB' => $glb, 'DPPA' => $dppa));
        } else {
            $response->setError(App_Ws_Types_Response::ERRNO_NOT_ALLOWED, 'Not allowed');
        }

        $this->_response->setBody($response->toJson());
    }

    public function authsms2faAction()
    {
        //
        $code = $this->_getParam('code');
        $isValidCode = $this->getHelper('Sms2Fa')->isCorrectAuthCode($code);
        $this->ns->isOtpVerified = $isValidCode;

        //  if sms auth code is valid
        if ($isValidCode) {
            //  Set user specific masking
            $this->_setDefaultMasking();
        }

        //
        $response = new App_Ws_Types_Response();
        $response->setCount(1);
        $response->setResult(array('success' => (int) $isValidCode));
        $this->_response->setBody($response->toJson());
    }

    public function changesms2faAction()
    {
        $isResent = (int) $this->_handeSms2Fa();

        //
        $response = new App_Ws_Types_Response();
        $response->setCount(1);
        $response->setResult(array('success' => $isResent));
        $this->_response->setBody($response->toJson());
    }

    /**
     * Handles SMS Auth
     * 
     * @return bool true if message sent
     */
    protected function _handeSms2Fa()
    {
        //  Make sure 2 Factor Sms Auth is enabled
        if ($this->cfg->sms2fa->enabled != 1) {
            return false;
        }

        //
        $identity = $this->ns->identity;
        $handler = $this->login->getPermissionHandler($identity->companyid, $identity->userid);

        try {
            //
            $Sms2Fa = $this->getHelper('Sms2Fa');
            /* @var $Sms2Fa Helpers_Sms2Fa */
            if ($Sms2Fa->isRequired($handler)) {
                $Sms2Fa->sendAuthCode();
                return true;
            }
        } catch (Exception $e) {
            $this->log->err(__METHOD__ . '() Exception: ' . $e->getMessage());
        }

        return false;
    }

    /**
     * Set user specific masking
     */
    protected function _setDefaultMasking()
    {
        $this->log->debug(__METHOD__ . '() Settings user specific masking rules');
        $permHandler = $this->login->getPermissionHandler();

        $this->ns->ssn_mask = $permHandler->getSsnMasking();
        $this->ns->dob_mask = $permHandler->getDobMasking();
        $this->ns->dl_mask = $permHandler->getDlMasking();
        $this->ns->data_permission_mask = $permHandler->getDataPermissionMask();
        $this->ns->data_restriction_mask = $permHandler->getDataRestrictionMask();
        $this->ns->blind = $permHandler->getBlindTag();
        $this->ns->encrypt = $permHandler->getEncryptTag();
        $this->ns->rt = $permHandler->isAllowedMaskFlag(Atlasp_App_Perm::RT_PHONE_SEARCH_INDEX) ? 1 : 0;
        $this->ns->login_history_id = $this->login->getLoginHistoryId();
        $this->ns->enable_mobile_access = $permHandler->hasMobileAccess();

        //
        $this->applyMaskingRules();
    }

    /**
     * 
     * This method handles all REST responses.
     * 
     * - It takes a App_Ws_[Report|Search] object
     * - makes sure dppa & glb is set
     * - checks cache for previous ESP response
     * - calls ::getResponse() to get an ESP response
     * - calls ::bautify() to format response
     * - sends response to client
     * 
     * @param App_Ws_RestAbstract $sp
     * @param array $inputParams Parameters used to build cache checksum
     */
    protected function sendResponse($sp, $inputParams=array())
    {
        /* @var request Zend_Controller_Request_Abstract */
        $request = $this->getRequest();

        //
        // Make sure Glb DPPA are set
        //
		$dppa = $this->ns->DPPA;
        $glb = $this->ns->GLB;
        if ($dppa == -1 || $glb == -1) {
            $stdResponse = new App_Ws_Types_Response();
            $stdResponse->setError(App_Ws_Types_Response::ERRNO_INVALID_GLB_OR_DPPA, 'Invalid GLB or DPPA');
            $this->_response->setBody($stdResponse->toJson());
            return;
        }

        //
        // log
        //
		$this->log->debug(__METHOD__ . 'Running : ' . get_class($sp) . ' for: ' . $request->getParam('LOGINID') .
                '; DPPA: ' . $this->ns->DPPA . '; GLB: ' . $this->ns->GLB . '; ssn_mask: ' . $this->ns->ssn_mask . '; dob_mask: ' . $this->ns->dob_mask .
                '; dl_mask: ' . $this->ns->dl_mask . '; data_permission_mask: ' . $this->ns->data_permission_mask . '; data_restriction_mask: ' . $this->ns->data_restriction_mask);

        //
        // remove single quote from any input params
        //
		foreach ($inputParams as $paramKey) {
            $paramVal = $request->getParam($paramKey);
            if (is_null($paramVal))
                continue;

            $paramVal = str_replace("'", '', $paramVal); // remove single quote
            $request->setParam($paramKey, $paramVal);
        }


        //
        // Set some parameters from Session, required for ESP calls
        // ESP calls read request object
        //
		$request->setParam('DPPA', $this->ns->DPPA);
        $request->setParam('GLB', $this->ns->GLB);
        $request->setParam('SSNMASK', $this->ns->ssn_mask);
        $request->setParam('DOBMASK', $this->ns->dob_mask);
        $request->setParam('DLMASK', $this->ns->dl_mask);
        $request->setParam('COMPANYID', $this->ns->identity->companyid);
        $request->setParam('LOGINID', $this->ns->identity->loginid);
        $request->setParam('DATARESTRICTIONMASK', $this->ns->data_restriction_mask);
        $request->setParam('DATAPERMISSIONMASK', $this->ns->data_permission_mask);
        $request->setParam('BLIND', $this->ns->blind);
        $request->setParam('ENCRYPT', $this->ns->encrypt);
        $request->setParam('LOGINHISTORYID', $this->ns->login_history_id);
        $request->setParam('DEBITUNITS', $this->ns->debitUnits);
        $request->setParam('INDUSTRYCLASS', $this->ns->identity->industryclass);

        //
        // Default return count 50 24 and max of 500
        // STARTRECORD defaults to 1
        //
		$retCount = (int) $this->getRequest()->getParam('RETCOUNT', 25);
        if ($retCount > 500) {
            $retCount = 500;
        }
        $this->getRequest()->setParam('RETCOUNT', $retCount);
        $this->getRequest()->setParam('STARTRECORD', $this->getRequest()->getParam('STARTRECORD', 1));


        //
        //  setup checksum for cache
        //
		$cacheParams = $inputParams;
        $cacheParams[] = 'GLB';
        $cacheParams[] = 'DPPA';
        $cacheParams[] = 'LOGINID';
        $cacheParams[] = 'KEY';
        $cacheParams[] = 'RETCOUNT';
        $cacheParams[] = 'STARTRECORD';
        $cacheParams[] = 'SSNMASK';
        $cacheParams[] = 'DOBMASK';
        $cacheParams[] = 'DLMASK';
        $cacheParams[] = 'DATARESTRICTIONMASK';
        $cacheParams[] = 'DATAPERMISSIONMASK';
        $checkSum = $this->generateCacheCheckSum($cacheParams);


        //
        // Check CACHE
        // 
        $data = false;
        $seconds = (int) $this->cfg->rest->cache->seconds;
        $cache_enabled = ($this->cfg->rest->cache->enabled == 1) ? true : false;

        /* @var $cache Zend_Cache_Core */
        $cache = Zend_Cache::factory('Core', 'File', array('lifetime' => $seconds)); //throws Exception
        if ($cache_enabled) {
            try {
                $data = $cache->load($checkSum);
                if (!$data) {
                    $this->log->debug(__METHOD__ . ' Response not cached.');
                } else {
                    $this->log->debug(__METHOD__ . ' Response from cache!');
                }
            } catch (Exception $e) {
                // cache threw exception
                $this->log->debug($e);
            }
        }


        //
        // QUERY ESP if no cached data found or cache disabled
        //
		if (!$data) {
            //cache miss, send query
            $data = $sp->getResponse($this->getRequest());

            if ($cache_enabled) { // Save response to cache if enabled
                try {
                    $cache->save($data);
                } catch (Exception $e) {
                    // cache threw exception
                    $this->log->debug($e);
                }
            }
        }


        //
        // call beautify to get a nicely formatted response
        //
		$r = $sp->beautify($data);


        //
        // Output in JSON format
        //
		$json = Zend_Json::encode($r);
        $this->_response->setBody($json);
    }

    /**
     * 
     * This method generates a checksum based on the URL parameters passed.
     * 
     * @param Zend_Controller_Request_Abstract $request Request object
     * @param array $cacheParams Parameter names
     * @return string md5-checksum
     */
    protected function generateCacheCheckSum($cacheParams)
    {
        $request = $this->getRequest();

        // add Controller and Action to Key to decrease chances
        // of collision
        $cacheParams = array_merge(
                $cacheParams, array($request->getControllerKey(), $request->getActionKey())
        );


        // Transfor params into URL form
        asort($cacheParams);
        $arr = array();
        foreach ($cacheParams as $key) {
            $arr[] = $key . '=' . $request->getParam($key);
        }

        return md5(strtolower(implode('&', $arr))); // md5 of key1=val1&key2=val2
    }

    protected function isDemoAccount()
    {
        $this->log->debug(__METHOD__ . ' Checking for the DEMO account for login id - ' . $this->ns->identity->loginid);

        $cfg = $this->cfg;
        $demo_ids = $cfg->demo->loginids;
        $demo_ids_arr = explode(",", $demo_ids);
        if (in_array($this->ns->identity->loginid, $demo_ids_arr)) {
            $this->log->debug(__METHOD__ . ' Demo ID, pointing to demo esp.');
            $cfg->wsaccurint->esp->endpoint = $cfg->wsaccurint->demo->endpoint;
            $cfg->wsaccurint->esp->uname = $cfg->wsaccurint->demo->uname;
            $cfg->wsaccurint->esp->passwd = $cfg->wsaccurint->demo->passwd;
        }
    }

    //
    // Apply the new masking rules
    //
	protected function applyMaskingRules()
    {
        $ssn_mask = $this->login->getPermissionHandler()->getSsnMasking();
        $dob_mask = $this->login->getPermissionHandler()->getDobMasking();
        $dl_mask = $this->login->getPermissionHandler()->getDlMasking();

        if (!isset($this->ns->isOtpVerified) || !$this->ns->isOtpVerified) {
            $ssn_mask = ($ssn_mask == 'none') ? 'last4' : $ssn_mask;
            $dob_mask = ($dob_mask == 'none') ? 'day' : $dob_mask;
            $dl_mask = 'all';
        }

        // Mask SSN/DOB/DL at all times;
        $this->ns->ssn_mask = $ssn_mask;
        $this->ns->dob_mask = $dob_mask;
        $this->ns->dl_mask = $dl_mask;

        $this->log->debug(__METHOD__ . ' SSN Masking for user ' . $this->login->getIdentity()->loginid . ' is ' . $ssn_mask);
    }

    //
    // Check if disable multiple sessions is true. If so, kill other sessions
    //
	protected function checkDisableMultipleSessions()
    {
        $identity = $this->login->getIdentity();
        $disable_multiple_sessions = $this->login->getPermissionHandler($identity->companyid, $identity->userid)->getDisableMultipleSessions($identity->companyid);

        if ($disable_multiple_sessions == 1) {
            $this->log->debug(__METHOD__ . ' multiple sessions not allowed for companyid ' . $identity->companyid);
            return 1;
        }
        return 0;
    }

    /**
     * Gets bit map permissions for searches and reports
     * 
     * @return array
     */
    protected function _getBitMapPermissions()
    {
        $handler = $this->login->getPermissionHandler();

        $phones = array(
            'rt' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::RT_PHONE_SEARCH_INDEX),
            'pl' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::DA_WIRELESS_SEARCH_INDEX)
        );
        $phonesEnabled = in_array(true, $phones);

        $property = array(
            'real' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::REAL_PROPERTY_SEARCH_INDEX),
            'deed' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::DEEDS_SEARCH_INDEX),
            'assess' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::ASSESSMENT_SEARCH_INDEX)
        );

        //  Index has to be same as Action name
        $permissions = array(
            //  Searches
            'search_people' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::PERSON_SEARCH_INDEX),
            'search_enhancedPeople' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::PERSON_SEARCH_INDEX),
            'search_business' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::BUS_SEARCH_INDEX),
            'search_property' => $property['real'],
            'search_property_deeds' => ($property['real'] && $property['deed']),
            'search_property_assessment' => ($property['real'] && $property['assess']),
            'search_mvr' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::MV_SEARCH_INDEX),
            'search_phones' => $phonesEnabled,
            'search_phones_rt' => $phones['rt'],
            'search_phones_pl' => $phones['pl'],
            'search_dl' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::DL_SEARCH_INDEX),                   
            'search_email' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::EMAIL_SEARCH_INDEX), 
            'search_paw' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::WORKPLACE_SEARCH_INDEX),
            'search_foreclosure' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::FORECLOSURE_SEARCH_INDEX),
            'search_liens' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::LIEN_SEARCH_INDEX),
            'search_bankruptcy' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::BANKRUPTCY_SEARCH_INDEX),
            //  Reports
            'report_people' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::COMP_REPORT_INDEX),
            'report_business' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::BUS_REPORT_INDEX),
            'report_property' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::ADDR_REPORT_INDEX),
            'report_mvr' => $handler->isAllowedMaskFlag(Atlasp_App_Perm::MVR_REPORT_INDEX),
            'report_phones' => $phonesEnabled,
            'report_phones_rt' => $phones['rt'],
            'report_phones_plus' => $phones['pl']            
        );

        //  Convert all values to 1 and 0
        $permissions = array_map('intval', $permissions);

        //
        return $permissions;
    }

}
