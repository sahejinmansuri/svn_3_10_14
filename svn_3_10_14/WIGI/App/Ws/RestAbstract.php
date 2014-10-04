<?php

abstract class App_Ws_RestAbstract extends Atlasp_Ws_Searchbase
{
    const REPORT_FULL = 'full';

    /**
     * @var Zend_Controller_Request_Abstract
     */
    protected $_request;
    /**
     * @var Zend_Log
     */
    protected $logger;
    /**
     * @var Zend_Config_Ini
     */
    protected $_config;
    /**
     * 
     * @var array
     */
    protected $evt_data;
    /**
     *
     * @var Zend_Session_Namespace
     */
    protected $ns;

    /**
     * Index identifying report permission for user
     * @var string
     */
    protected $_wsPermissionsInx;

    /**
     * Index identifying report user preferences section
     * @var string
     */
    protected $_userPreferencesIdx;

    /**
     * @param array $evt_data 
     */
    public function __construct(Zend_Controller_Request_Abstract $request)
    {
        parent::__construct($request);
        
        //  Assign values from parent class
        $this->logger = $this->_log;
        $this->ns = $this->_namespace;
        
        //
        $this->init();
    }

    protected abstract function init();

    /**
     * 
     * @return array
     */
    public function getEvtData()
    {
        return $this->evt_data;
    }

    /**
     * Gets formatted report.
     * 
     * If section name is specified - section report will
     * be returned, otherwise summary report will be returned.
     * 
     * If invalid section name is specified error will be set results will 
     * be empty with count of 0.
     * 
     * @param App_Ws_Types_Report $report Beautified report object
     * @param array $subject
     * @param string $sectionName Name of report section
     * @return array Multi-dimentional array with following indexes:
     *               - Summary : (count:int, sections:array)
     *               - Report  : (count:int, results:array, error?:string) 
     */
    protected function _getFormattedReport(App_Ws_Types_Report $report, array $subject, $sectionName=null)
    {
        //  Response object
        $response = new App_Ws_Types_Response();


        //  Check section name
        if ($sectionName === null) {
            //  If section name is not set return summary report
            $sections = $report->getSummary();

            //  Set the response
            $response->setCount($report->count());
            $response->setSections($sections);
        } else {
            //  Retrieve section by name
            $section = $report->getSection($sectionName);
            //  Make sure returned value is of correct type
            if ($section instanceof App_Ws_Types_ReportSection) {
                $response->setCount($section->count());
                $response->setResult($section->toArray());
            } else if (is_string($sectionName) && strtolower($sectionName) == self::REPORT_FULL) {
                $response->setCount($report->count());
                $response->setResult($report->toArray());
            } else {
                //  Set Error Message if section is not of correct type
                $response->setError(App_Ws_Types_Response::ERRNO_INVALID_SECTION);
            }
        }

        //
        $report = $response->toArray();
        $report['subject'] = $subject;

        //
        return $report;
    }

    /**
     * Gets response object with internal error set
     * 
     * @return App_Ws_Types_Response 
     */
    protected function _getInternalErrorResponse()
    {
        $response = new App_Ws_Types_Response();
        $response->setError(App_Ws_Types_Response::ERRNO_INTERNAL);
        return $response;
    }

    // for pagination
    protected function _addSoapInputs($reqData, $soapInput)
    {
        $soapInput['Options']['StartingRecord'] = $reqData['STARTRECORD'];
        $soapInput['Options']['ReturnCount'] = $reqData['RETCOUNT'];
        return $soapInput;
    }

    protected function _xpathFetchOne($simplexml, $xpath)
    {
        $arr = $simplexml->xpath($xpath);
        if (count($arr)) {
            return $arr[0];
        }
        return null;
    }

    public function setEvtData($evt_data)
    {
        $cfg = Zend_Registry::get('config');

        //
        $evt_data['soap_input']['Options']['Blind'] = 'BLIND';
        $evt_data['soap_input']['Options']['Encrypt'] = 'ENCRYPT';
        
        //
        $evt_data['soap_input']['User']['LoginHistoryId'] = 'LOGINHISTORYID';
        $evt_data['soap_input']['User']['GLBPurpose'] = 'GLB';
        $evt_data['soap_input']['User']['DLPurpose'] = 'DPPA';
        $evt_data['soap_input']['User']['BillingCode'] = 'LOGINID';
        $evt_data['soap_input']['User']['CompanyId'] = 'COMPANYID';
        $evt_data['soap_input']['User']['ReferenceCode'] = 'REFERENCE';
        $evt_data['soap_input']['User']['SSNMask'] = 'SSNMASK';
        $evt_data['soap_input']['User']['DOBMask'] = 'DOBMASK';
        $evt_data['soap_input']['User']['DLMask'] = 'DLMASK';
        $evt_data['soap_input']['User']['DataRestrictionMask'] = 'DATARESTRICTIONMASK';
        $evt_data['soap_input']['User']['DataPermissionMask'] = 'DATAPERMISSIONMASK';
        $evt_data['soap_input']['User']['DebitUnits'] = 'DEBITUNITS';
        $evt_data['soap_input']['User']['IndustryClass'] = 'INDUSTRYCLASS';

        //
        $t = $evt_data['esp_data']['type'];
        $evt_data['esp_data']['ns'] = "http://webservices.seisint.com/$t";
        $evt_data['esp_data']['uname'] = $cfg->$t->esp->uname;
        $evt_data['esp_data']['passwd'] = $cfg->$t->esp->passwd;
        $evt_data['esp_data']['wsdl'] = $cfg->paths->wsdl . '/' . $t . '/' . $evt_data['esp_data']['wsdl'];
        $evt_data['esp_data']['vmap'] = $this->getVersionMap();
        $evt_data['esp_data']['endpoint'] = $cfg->$t->esp->endpoint;
        if (isset($evt_data['xsl'])) {
            $evt_data['xsl'] = $cfg->paths->xsl . '/' . $evt_data['xsl'];
        }

        $evt_data = $this->_applyPermPrefsInputMapping($evt_data);
        $this->evt_data = $evt_data;
    }

    public function getVersionMap()
    {
        return array('1' => '1.2', 'default' => '1.2');
    }

    public function _isAssoc($arr)
    {
        return array_keys($arr) != range(0, count($arr) - 1);
    }

    protected function _purgeEmptyValues($arr)
    {
        $res = array();
        foreach ($arr as $i => $row) {
            foreach ($row as $k => $v) {
                $v = trim($v);
                if (empty($v)) {
                    unset($row[$k]);
                }
            }

            $res[$i] = $row;
        }
        return $res;
    }

    /**
     * Sets mapping rules for permissions and preferences
     * 
     * @see Atlasp_App_Perm::getWebServiceOptionsPermissionsMap
     * @see Atlasp_Models_Db_Preferences::getUserPreferences
     * @param string $wsPermsIdx Index for User Permissions. Disabled map.
     * @param string $userPrefsIdx Index for User Preferences
     */
    protected function _setMappingRules($wsPermsIdx, $userPrefsIdx)
    {
        $this->_wsPermissionsInx = $wsPermsIdx;
        $this->_userPreferencesIdx = $userPrefsIdx;
    }
    
    /**
     * Applies permissions/prereferences mapping to soap_input options
     * 
     * @param type $evt_data
     * @return type 
     */
    protected function _applyPermPrefsInputMapping($evt_data)
    {
        if (isset($evt_data['soap_input']) && is_array($evt_data['soap_input'])) {
            $inputs = &$evt_data['soap_input'];
            $inputs = $this->_applyRecursiveMapping($inputs);
        }

        return $evt_data;
    }
    
    /**
     * Maps specified option either to specified source.
     * If 'map' is used key is mapped to perms first and if option is not set in 
     * disabled map to user preferences.
     * 
     * @see App_Ws_Report_ReportAbstract::_setMappingRules
     * 
     * @param string $source type of mapping 
     *                       - map   - applies perms first, then prefs
     *                       - perms - applies permissions first
     *                       - prefs - applies preferences first
     * @param string $key
     * @param mixed $value Default value 
     * @return mixed
     */
    private function _mapOption($source, $key, $value=0)
    {
        //
        if (is_null($this->_wsPermissionsInx) && is_null($this->_userPreferencesIdx)) {
            $this->logger->debug(__METHOD__ . '() Unable to map users perms/prefs. Mapping Rules not set.');
            return $value;
        }

        //
        $usePerms = in_array($source, array('map', 'perms'));
        $usePrefs = in_array($source, array('map', 'prefs'));
        $perms = $this->_getWebServiceOptionsPerms();
        $prefs = $this->_getUserPreferences();

        //  Check if Map Permission can be used and key is set
        if ($usePerms && isset($perms[$key])) {
            $value = $perms[$key];
        }
        //  Check if user permission can be used and key is set
        else if ($usePrefs && isset($prefs[$key])) {
            $value = $prefs[$key];
        }

        //  Make sure value is visible when in string, casting to int works good
        //  because 0=false, 1=true
        if (is_bool($value)) {
            $value = (int) $value;
        }

        //  Default return value
        return "c: $value";
    }

    /**
     * Gets enabled map permissions for current report type  or returns
     * empty array if section does not exist.
     * 
     * The values are of disabled map, just inversed 
     * 
     * @see Atlasp_App_Perm::getWebServiceOptionsPermissionsMap
     * @access private
     * @return array
     */
    private function _getWebServiceOptionsPerms()
    {
        $section = $this->_wsPermissionsInx;
        $wsPerms = $this->_namespace->wsPerms;
        return isset($wsPerms [$section]) ? $wsPerms[$section] : array();
    }

    /**
     * Gets specified user preferences for report type or return empty array if 
     * 
     * @see Atlasp_Models_Db_Preferences::getUserPreferences
     * @access private
     * @return array
     */
    private function _getUserPreferences()
    {
        $section = $this->_userPreferencesIdx;
        $userPerms = $this->_namespace->userPrefs;
        return isset($userPerms[$section]) ? $userPerms[$section] : array();
    }

    /**
     * Applies mapping to users options/permissions recursively. 
     * This allows support for nested complex types.
     * 
     * @param array $options
     * @return array
     */
    private function _applyRecursiveMapping(array $options)
    {
        //  Allowed option mappings
        $optionsMap = array('map', 'pref', 'perm');

        foreach ($options as &$elem) {
            if (is_array($elem)) {
                $elem = $this->_applyRecursiveMapping($elem);
            }
            // if regular element
            elseif (is_string($elem)) {
                $kv = preg_split('/\s*:\s*/', $elem);
                if (count($kv) == 2 && in_array($kv[0], $optionsMap)) {
                    //  
                    $source = $kv[0];
                    $key = $kv[1];
                    $default = null;
                    
                    //  Check if default value is set for mapping
                    $hasDefValue = 0;
                    $key = trim(str_replace(array('[', ']'), '', $key , $hasDefValue));
                    if ($hasDefValue){
                        $mapKV = preg_split('/\s*,\s*/', $key);
                        if (count($mapKV) == 2){
                            $key = $mapKV[0];
                            $default = $mapKV[1];
                        }
                    }
                    
                    //  Map option
                    $elem = $this->_mapOption($source, $key, $default);
                }
            }
        }

        return $options;
    }


}
