<?php

class Atlasp_App_Perm
{
	const PERSON_SEARCH_INDEX = 0;
	const ASSESSMENT_SEARCH_INDEX = 1;
	const DEEDS_SEARCH_INDEX = 2;
	const DL_SEARCH_INDEX = 3;
	const MV_SEARCH_INDEX = 4;
	const FAA_PILOT_SEARCH_INDEX = 5;
	const DA_BASIC_SEARCH_INDEX = 6;
	const DA_REVERSE_SEARCH_INDEX = 7;
	const CORP_SEARCH_INDEX = 8;
	const UCC_SEARCH_INDEX = 9;
	const BANKRUPTCY_SEARCH_INDEX = 10;
	const LIEN_SEARCH_INDEX = 11;
	const COURT_SEARCH_INDEX = 12;
	const BUS_SEARCH_INDEX = 13;
	const ADDR_REPORT_INDEX = 14;
	const BUS_REPORT_INDEX = 15;
	const VESSEL_SEARCH_INDEX = 16;
	const WHOIS_SEARCH_INDEX = 17;
	const ACCIDENT_SEARCH_INDEX = 18;
	const CRIM_SEARCH_INDEX = 19;
	const MAPQUEST_REPORT_INDEX = 20;
	const AIRCRAFT_SEARCH_INDEX = 21;
	const WATCHDOG_INDEX = 22;
	const PROF_LICENSE_SEARCH_INDEX = 23;
	const PATRIOTACT_SEARCH_INDEX = 24;
	const VARIETY_BUNDLE_INDEX = 25;
	const CIVIL_COURT_SEARCH_INDEX = 26;
	const COMP_REPORT_INDEX = 27;
	const LOCATOR_REPORT_INDEX = 28;
	const SEXPREDATOR_SEARCH_INDEX = 29;
	const HUNTING_LICENSE_SEARCH_INDEX = 30;
	const CONCEALED_WEAPON_SEARCH_INDEX = 31;
	const VOTER_REGISTRATION_SEARCH_INDEX = 32;
	const FIREARMS_SEARCH_INDEX = 33;
	const COMPREHENSIVE_REPORT_INDEX = 34;
	const SUMMARY_REPORT_INDEX = 35;
	const ASSET_REPORT_INDEX = 36;
	const PEOPLE_FINDER_REPORT_INDEX = 37;
	const DEA_SEARCH_INDEX = 38;
	const OFFICIAL_RECORDS_SEARCH_INDEX = 39;
	const D_AND_B_SEARCH_INDEX = 40;
	const DELCO_SEARCH_INDEX = 41;
	const PAW_SEARCH_INDEX = 42;
	const MARRIAGE_SEARCH_INDEX = 43;
	const GRAPHVIEW_INDEX = 44;
	const FORECLOSURE_SEARCH_INDEX = 45;
	const ADV_SEARCH_INDEX = 46;
	const MVR_REPORT_INDEX = 47;
	const NEWS_SEARCH_INDEX = 48;
	const BUS_NEWS_SEARCH_INDEX = 49;
	const SATELLITE_IMAGE_REPORT_INDEX = 50;
	const RATE_EVASION_REPORT_INDEX = 51;
	const RATE_EVASION_REPORT_BATCH_INDEX = 52;
	const EMSI_SEARCH_INDEX = 53;
	const INSTANT_ID_REPORT_INDEX = 54;
	const SEC_SEARCH_INDEX = 55;
	const EXPERIAN_SEARCH_INDEX = 56;
	const TRADEMARK_SEARCH_INDEX = 57;
	const FICTIOUS_SEARCH_INDEX = 58;
	const TODAYS_NEWS_SEARCH_INDEX = 59;
	const US_NEWS_SEARCH_INDEX = 60;
	const NON_US_NEWS_SEARCH_INDEX = 61;
	const ARCHIVED_NEWS_SEARCH_INDEX = 62;
	const BUS_INSTANT_ID_REPORT_INDEX = 63;
	const PROVIDER_SEARCH_INDEX = 64;
	const SANCTION_SEARCH_INDEX = 65;
	const FED_CIVIL_COURT_SEARCH_INDEX = 66;
	const FED_CRIM_COURT_SEARCH_INDEX = 67;
	const PSPR_SEARCH_INDEX = 68;
	const OSHA_SEARCH_INDEX = 69;
	const DBGLOBAL_SEARCH_INDEX = 70;
	const DO_NEWS_SEARCH_INDEX = 71;
	const MEDICAL_LICENSE_SEARCH_INDEX = 72;
	const INSTOPICS_NEWS_SEARCH_INDEX = 73;
	const OABMS_SEARCH_INDEX = 74;
	const MP_HOSPITALS_SEARCH_INDEX = 75;
	const MP_PROVIDERS_SEARCH_INDEX = 76;
	const MP_SPECIALITIES_SEARCH_INDEX = 77;
	const COURT_CASE_SEARCH_INDEX = 78;
	const DA_WIRELESS_SEARCH_INDEX = 79;
	const CARFAX_REPORT_INDEX = 80;
	const LOCATE_PLUS_SEARCH_INDEX = 81;
	const RELATIVES_SEARCH_INDEX = 82;
	const PRE_LIT_REPORT_INDEX = 83;
	const ALSO_FOUND_REPORT_INDEX = 84;
	const BUS_CREDIT_SEARCH_INDEX = 85;
	const AVM_SEARCH_INDEX = 86;
	const BUS_CREDIT_REPORT_INDEX = 87;
	const EQUIFAX_RECOVERY_REPORT_INDEX = 88;
	const NEIGHBORS_SEARCH_INDEX = 89;
	const ASSOCIATES_SEARCH_INDEX = 90;
	const DEATH_SEARCH_INDEX = 91;
	const CONTACT_CARD_REPORT_INDEX = 92;
	const RESULTS_FOUND_REPORT_INDEX = 93;
	const PRUDENTIAL_REPORT_INDEX = 94;
	const PHONE_FEEDBACK_ALLOW_INDEX = 95;
	const ENTITY_ALERTING_INDEX = 96;
	const SEXPREDATOR_ALERTING_INDEX = 97;
	const EMAIL_SEARCH_INDEX = 98;
	const EQUIFAX_CREDIT_REPORT_INDEX = 99;
	const CANADIAN_PHONES_SEARCH_INDEX = 100;
	const BUS_ALSO_FOUND_REPORT_INDEX = 101;
	const PHONE_FEEDBACK_DISPLAY_INDEX = 102;
	const RT_MVR_SEARCH_INDEX = 103;
	const RT_PERSON_SEARCH_INDEX = 104;
	const RT_PHONE_SEARCH_INDEX = 105;
	const CARRIER_DISCOVERY_REPORT_INDEX = 106;
	const FEIN_SEARCH_INDEX = 107;
	const BASIC_PLUS_ASSOCIATES_REPORT_INDEX = 108;
	const IND_QUALIFIER_REPORT_INDEX = 109;
	const BUS_QUALIFIER_REPORT_INDEX = 110;
	const IND_FR_QUALIFIER_REPORT_INDEX = 111;
	const BUS_FR_QUALIFIER_REPORT_INDEX = 112;
	const ENTITLEMENTS_REPORT_INDEX = 113;
	const BLJ_SEARCH_INDEX = 114;
	const REAL_PROPERTY_SEARCH_INDEX = 115;
	const CLAIMS_DISCOVERY_REPORT_INDEX = 116;
	const MV_WILDCARD_SEARCH_INDEX = 117;
	const LOCATION_SEARCH_INDEX = 118;
	const BUSINESS_AFFILIATE_SEARCH_INDEX = 119;
	const ADDRESS_ASSOCIATES_SEARCH_INDEX = 120;
	const LN_NEGATIVE_NEWS_SEARCH_INDEX = 121;
	const INSTANTID_INTERNATIONAL_SEARCH_INDEX = 122;
	const FRADUPOINT_REPORT_SEARCH_INDEX = 123;
	const ESRI_MAPPING_SEARCH_INDEX = 124;
	const BUSINESS_SUMMARY_SEARCH_INDEX = 125;
	const MORTGAGE_FRAUD_REPORT_SEARCH_INDEX = 126;
	const MILITARY_PERSONNEL_SEARCH_INDEX = 127;
	const STATEWIDE_PERSON_SEARCH_INDEX = 128;
	const STATE_CIVIL_CRIMINAL_FILINGS_SEARCH_INDEX = 129;
	const US_CIVIL_CRIMINAL_FILINGS_SEARCH_INDEX = 130;
	const JURY_VERDICTS_AND_SETTLEMENTS_SEARCH_INDEX = 131;
	const FINANCIAL_SANCTION_SEARCH_INDEX = 132;
	const LN_BANKERS_NEWS_SEARCH_INDEX = 133;
	const LN_BANKERS_ALMANAC_SEARCH_INDEX = 134;
	const LN_THOMSON_DIRECTORIES_SEARCH_INDEX = 135;
	const STATEWIDE_BUSINESS_SEARCH_INDEX = 136;
	const LN_D_AND_B_MINORITY_AND_WOMEN_OWNER_BUSINESSES_SEARCH_INDEX = 137;
	const LN_D_AND_B_PRIV_COMP_SEARCH_INDEX = 138;
	const LN_CORP_AFFILIATIONS_SEARCH_INDEX = 139;
	const LN_HOOVER_SEARCH_INDEX = 140;
	const LN_MERGERSTAT_SEARCH_INDEX = 141;
	const LN_S_AND_P_CORP_DECISIONS_SEARCH_INDEX = 142;
	const LN_UK_COMPANY_INFO_SEARCH_INDEX = 143;
	const LN_UK_DISQUALIFIED_PERSONS_SEARCH_INDEX = 144;
	const LN_ADMIN_LAW_DECISIONS_SEARCH_INDEX = 145;
	const LN_FED_BANKING_CODE_SEARCH_INDEX = 146;
	const LN_FED_REGISTER_SEARCH_INDEX = 147;
	const LN_CONG_RECORD_SEARCH_INDEX = 148;
	const LN_FDIC_RES_TRUST_CORP_SEARCH_INDEX = 149;
	const LN_FEDERAL_RESERVE_SEARCH_INDEX = 150;
	const LN_GAO_REPORTS_SEARCH_INDEX = 151;
	const LN_COMP_CURRENCY_SEARCH_INDEX = 152;
	const LN_THRIFT_SUPERVISION_SEARCH_INDEX = 153;
	const LN_US_PUBLIC_LAWS_SEARCH_INDEX = 154;
	const LN_BANKS_TITLE_12_SEARCH_INDEX = 155;
	const OFFLINE_CIV_CRIM_SEARCH_INDEX = 156;
	const DEEP_SKIP_SEARCH_INDEX = 157;
	const ARCHIVE_SEARCH_SEARCH_INDEX = 158;
	const ARCHIVE_RRPORT_SEARCH_INDEX = 159;
	const SOURCE_DOCS_INFO_INDEX = 160;
	const SKIP_TRACE_SEARCH_INDEX = 161;
	const POLICE_RECORDS_SEARCH_INDEX = 162;
	const SMALLBUSRISK_SEARCH_INDEX = 163;
	const PROPHIST_SEARCH_INDEX = 164;
	const GUIDESTAR_SEARCH_INDEX = 165;
	const WORLDCHECK_SEARCH_INDEX = 166;
	const ALLCOMPANY_SEARCH_INDEX = 167;
	const PASSPORT_SEARCH_INDEX = 168;
	const POWER_BOOLEAN_SEARCH_INDEX = 169;
	const SOC_REPORT_INDEX = 170;
	const CASE_AUDIT_INDEX = 171;
	const BUS_CONTACT_CARD_REPORT_INDEX = 172;
	const PHONE_HISTORY_REPORT_INDEX = 173;
	const JAILBOOKING_SEARCH_INDEX = 174;
	const WORKPLACE_SEARCH_INDEX = 175;
	const INSTANT_VERIFY_SEARCH_INDEX = 176;
	const FEDERAL_AND_STATE_CASES_COMBINED_SEARCH_INDEX = 177;
	const US_STATE_CODE_SEARCH_INDEX = 178;
	const US_CODE_SERVICE_SEARCH_INDEX = 179;
	const NUMBER_SEARCH_SECTIONS = 180;

	const MAX_MASK_LENGTH = 181; // 180 is a string of 181 chars

	/**
	 * 
	 * @var Zend_Db_Adapter_Abstract
	 */
	protected $db;
	protected $companyid;
	protected $userid;
    protected $_log;
	private $mask = null;

	// Map searches that are only visible for companies with special entries in the tag_table in the DB,
	// Category: COMPANY SECURITY
	// SubCategory: values(%$enable_by_tag_table)
	protected $enable_by_tag_table = array(
	    'ALLOW POWER BOOLEAN'		=> self::POWER_BOOLEAN_SEARCH_INDEX,
	    'REAL TIME PHONE'			=> self::RT_PHONE_SEARCH_INDEX,
	    'REAL TIME PERSON'			=> self::RT_PERSON_SEARCH_INDEX,
	    'CARRIER DISCOVERY CONTRIBUTOR'	=> self::CARRIER_DISCOVERY_REPORT_INDEX,
	    'ALLOW ENTITLEMENTS REPORT'		=> self::ENTITLEMENTS_REPORT_INDEX,
	    'ALLOW WILDCARD MV'			=> self::MV_WILDCARD_SEARCH_INDEX,
	    'CRU MAP'				=> self::POLICE_RECORDS_SEARCH_INDEX,
	    'ALLOW SKIP TRACE'			=> self::SKIP_TRACE_SEARCH_INDEX,
	    'ALLOW CASE AUDIT'			=> self::CASE_AUDIT_INDEX
	);



	public function __construct($db, $companyid, $userid)
	{
		$this->db = $db;
		$this->companyid = $companyid;
		$this->userid = $userid;
        
        //
        $this->_log = Zend_Registry::get('log');
	}
	
	
	
	/**
	 * 
	 * Checks if a particular constant is allowed or disallowed.
	 * It factors in the Disable Search Mask & The corresponding
	 * tags as applied by _getDbPermMask.
	 * 
	 * @param int $const
	 * @return bool
	 */
	public function isAllowedMaskFlag($const)
	{
        $mask = $this->getMask();
        $bit = isset($mask[$const]) ? $mask[$const] : null;
        return ($bit == '0');
    }
	
	/**
	 *
	 * Gets the Disable Search Map and computes 
	 * the available tags into the mask.  Then returns
	 * the Disabled Search Map with the tags applied.
	 * 
	 * This method is the cached version of _getDbPermMask(),
	 * it can be called many without hitting the database
	 * multiple times.
	 * 
	 * 
	 * @return string
	 */
	public function getMask()
	{
		if (is_null($this->mask))
		{
			$this->mask = $this->_getDbPermMask();
		}
		return $this->mask;
	}


    /**
     * Gets web service options permissions map
     * 
     * @return array 
     */
    public function getWebServiceOptionsPermissionsMap()
    {
        $this->_log->debug(__METHOD__ . '() Loading Options Permissions');
        
        //  Common complex permission  
        $properties = $this->isAllowedMaskFlag(self::ASSESSMENT_SEARCH_INDEX) || $this->isAllowedMaskFlag(self::DEEDS_SEARCH_INDEX);
        
        //
        $optionsMap = array(
            'addr' => array(
                'addr-driving-lic'    => $this->isAllowedMaskFlag(self::DL_SEARCH_INDEX),
                'addr-motor-vehicles' => $this->isAllowedMaskFlag(self::MV_SEARCH_INDEX),
                'addr-properties'     => $properties,
                'addr-businesses'     => $this->isAllowedMaskFlag(self::CORP_SEARCH_INDEX),
                'addr-bankruptcy'     => $this->isAllowedMaskFlag(self::BANKRUPTCY_SEARCH_INDEX),
                'addr-liens'          => $this->isAllowedMaskFlag(self::LIEN_SEARCH_INDEX),
            ),
            'comp' => array(
                'driver-license'        => $this->isAllowedMaskFlag(self::DL_SEARCH_INDEX),
                'motor-vehicles'        => $this->isAllowedMaskFlag(self::MV_SEARCH_INDEX),
                'property'              => $properties,
                'corp-affiliation'      => $this->isAllowedMaskFlag(self::CORP_SEARCH_INDEX),
                'bankruptcy'            => $this->isAllowedMaskFlag(self::BANKRUPTCY_SEARCH_INDEX),
                'liens'                 => $this->isAllowedMaskFlag(self::LIEN_SEARCH_INDEX),
                'accident'              => $this->isAllowedMaskFlag(self::ACCIDENT_SEARCH_INDEX),
                'criminal-records'      => $this->isAllowedMaskFlag(self::CRIM_SEARCH_INDEX),
                'sexpredator'           => $this->isAllowedMaskFlag(self::SEXPREDATOR_SEARCH_INDEX),
                'uccs'                  => $this->isAllowedMaskFlag(self::UCC_SEARCH_INDEX),
                'variety-bundle'        => $this->isAllowedMaskFlag(self::VARIETY_BUNDLE_INDEX),
                'professional-licenses' => $this->isAllowedMaskFlag(self::PROF_LICENSE_SEARCH_INDEX),
                'watercraft'            => $this->isAllowedMaskFlag(self::VESSEL_SEARCH_INDEX),
                'people-at-work'        => $this->isAllowedMaskFlag(self::PAW_SEARCH_INDEX),
                'phones-plus'           => $this->isAllowedMaskFlag(self::DA_WIRELESS_SEARCH_INDEX),
                'email-address'         => $this->isAllowedMaskFlag(self::EMAIL_SEARCH_INDEX),
            ),
            'bus' => array(
                'corporate-filings' => $this->isAllowedMaskFlag(self::CORP_SEARCH_INDEX),
                'contacts'          => $this->isAllowedMaskFlag(self::CORP_SEARCH_INDEX),
                'uccs'              => $this->isAllowedMaskFlag(self::UCC_SEARCH_INDEX),
                'motor-vehicles'    => $this->isAllowedMaskFlag(self::MV_SEARCH_INDEX),
                'properties'        => $properties,
                'bankruptcy'        => $this->isAllowedMaskFlag(self::BANKRUPTCY_SEARCH_INDEX),
                'liens'             => $this->isAllowedMaskFlag(self::LIEN_SEARCH_INDEX),
                'domains'           => $this->isAllowedMaskFlag(self::WHOIS_SEARCH_INDEX),
                'd_and_b'           => $this->isAllowedMaskFlag(self::D_AND_B_SEARCH_INDEX),
                'merchant-vessels'  => $this->isAllowedMaskFlag(self::VESSEL_SEARCH_INDEX),
                'faa-aircraft'      => $this->isAllowedMaskFlag(self::AIRCRAFT_SEARCH_INDEX),
                'experian-br'       => $this->isAllowedMaskFlag(self::BUS_CREDIT_REPORT_INDEX),
                //  TODO: add OR condition to experian-br check, equivalent of below:
                //  !($app->app_type_custom_check('enable_experian_br'))) ? 1 : 0,
            ),
            'phone' => array(
                'phone-property' => $properties,
            ),
            'also_found' => array(
                'motor-vehicles'         => $this->isAllowedMaskFlag(self::MV_SEARCH_INDEX),
                'property'               => $properties,
                'corporate-affiliations' => $this->isAllowedMaskFlag(self::BUS_SEARCH_INDEX),
                'professional-licenses'  => $this->isAllowedMaskFlag(self::PROF_LICENSE_SEARCH_INDEX),
                'phones-plus'            => $this->isAllowedMaskFlag(self::DA_WIRELESS_SEARCH_INDEX),
                'driver-license'         => $this->isAllowedMaskFlag(self::DL_SEARCH_INDEX),
                'relatives'              => $this->isAllowedMaskFlag(self::RELATIVES_SEARCH_INDEX),
                'associates'             => $this->isAllowedMaskFlag(self::ASSOCIATES_SEARCH_INDEX),
                'ppl-at-work'            => $this->isAllowedMaskFlag(self::PAW_SEARCH_INDEX),
                'email-addresses'        => $this->isAllowedMaskFlag(self::EMAIL_SEARCH_INDEX),
            ),
            'contact_card' => array(
                'phones-plus-data' => $this->isAllowedMaskFlag(self::DA_WIRELESS_SEARCH_INDEX),
            ),
            'bus_also_found' => array(
                'motor-vehicles'    => $this->isAllowedMaskFlag(self::MV_SEARCH_INDEX),
                'property'          => $properties,
                'corporate-filings' => $this->isAllowedMaskFlag(self::CORP_SEARCH_INDEX),
                'uccs'              => $this->isAllowedMaskFlag(self::UCC_SEARCH_INDEX),
                'contacts'          => $this->isAllowedMaskFlag(self::CORP_SEARCH_INDEX),
            ),
        );
        
        return $optionsMap;
    }
    
	/**
	 * 
	 * Gets the Disable Search Map and computes 
	 * the available tags into the mask.  Then returns
	 * the Disabled Search Map with the tags applied.
	 * 
	 * @return string
	 */
	protected function _getDbPermMask()
	{
		try
		{
			$sql = "SELECT
				category, detail1,  detail2
			FROM
				tag_table 
			WHERE
				". $this->db->quoteInto("companyid = ?", $this->companyid) ."
				AND 
				subcategory='Disable Search Map' 
				AND
				(
					".$this->db->quoteInto("userid = ? AND category = 'User Options' ", $this->userid)."
					OR
					(userid IS NULL AND category = 'COMPANY SECURITY')
				)";
	
			$maskFromSql = $this->db->fetchAll($sql);
			$masks = array();
			foreach ($maskFromSql as $row)
			{
			    $masks[strtoupper($row['category'])] = $row['detail1'] . $row['detail2'];
			}
			//

			// set mask if any is empty
			if (!count($masks)) { $masks['USER OPTIONS'] = str_pad('', self::MAX_MASK_LENGTH, '1', STR_PAD_RIGHT); }
			if ( empty($masks['COMPANY SECURITY']) ) { $masks['COMPANY SECURITY'] = $masks['USER OPTIONS']; }
			if ( empty($masks['USER OPTIONS']) ) { $masks['USER OPTIONS'] = $masks['COMPANY SECURITY']; }
	
			// paddd masks to the same length
			$masks['COMPANY SECURITY']	= str_pad($masks['COMPANY SECURITY'],	self::MAX_MASK_LENGTH, '1', STR_PAD_RIGHT);
			$masks['USER OPTIONS']		= str_pad($masks['USER OPTIONS'],	self::MAX_MASK_LENGTH, '1', STR_PAD_RIGHT);

			//
			// OR the disable maps
			$tags		= $this->_getCompanyMaskTags();

			
			//
			// merge company and user mask
			$mask = '';
			for ($i = 0; $i < self::MAX_MASK_LENGTH; $i++)
			{
				$c = (int) $masks['COMPANY SECURITY'][$i];
				$u = (int) $masks['USER OPTIONS'][$i];
				$mask .= (($c == 0) && ($u == 0)) ? 0 : 1;
			}

			
			// if tag is disable, then disable in mask
			foreach ($tags as $tag => $val)
			{
				if (! array_key_exists($tag, $this->enable_by_tag_table)) continue; // not a mask related tag
				$pos = $this->enable_by_tag_table[$tag];
				if ($pos >= self::MAX_MASK_LENGTH) continue; // position is larger than current bitmask, try next tag
				
				// if enalbe, continue
				if ($val == 1) { continue; }
				
				
				// disable
				$mask[$pos] = 1;
			}
		}
		catch (Exception $e)
		{
			Zend_Registry::get('log')->warn(__METHOD__.' Exception: ' . $e);
			$mask = str_pad('', self::MAX_MASK_LENGTH, '1', STR_PAD_RIGHT);  // 1 to disable everything
		}
		
		return $mask;
	}

	/**
	 * Returns an array with sub-categories as keys and
	 * detail1 as int vlaues
	 * 
	 * @return array[string]int
	 */
	private function _getCompanyMaskTags()
	{
		$b = Atlasp_Utils::inst()->startTimer();
		
		$sql = $this->db->quoteInto("SELECT UPPER(subcategory), detail1
		FROM tag_table
		WHERE
		category = 'COMPANY SECURITY' AND
		companyid = ?", $this->companyid);
		$sql .= $this->db->quoteInto(" AND (userid IS NULL OR userid = ?) AND
		subcategory IN (
			'ALLOW POWER BOOLEAN',
			'REAL TIME PHONE',
			'REAL TIME PERSON',
			'CARRIER DISCOVERY CONTRIBUTOR',
			'ALLOW ENTITLEMENTS REPORT',
			'ALLOW WILDCARD MV',
			'CRU MAP',
			'ALLOW SKIP TRACE',
			'ALLOW CASE AUDIT'
		)", $this->userid);
		$dbTags = $this->db->fetchPairs($sql);
		
		$keys = array_keys($this->enable_by_tag_table);
		$values = array_fill(0, count($this->enable_by_tag_table), 0);
		$tags = array_combine($keys, $values);
		
		foreach ($dbTags as $k => $v) {
			$tags[$k] = (int) $v;
		}
		
		Zend_Registry::set( 'times', array_merge( Zend_Registry::get('times'), array('_getCompanyMaskTags'=> Atlasp_Utils::inst()->endTimer($b))));
		
		return $tags;
	}


	public static function constant($const_name_str)
	{
		return constant('Atlasp_App_Perm::'.$const_name_str);
	}

	public static function getConstName($num)
	{
		$r = new ReflectionClass('Atlasp_App_Perm');
		foreach ($r->getConstants() as $k => $v)
		{
			if ($v == $num)
			{
				return $k;
			}
		}
		
		return '';
	}

    /**
     * Gets user specific tags
     * 
     * @param string $category
     * @param string|array $subCategory
     * @return array
     */
    protected function _getUserTags($category=null, $subCategory=null)
    {
        $userTags = $this->_getTags($this->companyid, $this->userid, $category, $subCategory);
        return $userTags;
    }
    
	/**
     * Gets company specific tags 
     * 
	 * @param string $category
	 * @param string|array $subcategories
     * @return array
	 */
    protected function _getCompanyTags($category=null, $subCategory=null)
    {
        $companyTags = $this->_getTags($this->companyid, null, $category, $subCategory);
        return $companyTags;
    }

    /**
     * Common method to load tags
     * 
     * @param int $companyId
     * @param int $userId
     * @param string $category
     * @param string|array $subCategory
     * @return array
     */
    protected function _getTags($companyId, $userId, $category, $subCategory)
    {
        $b = Atlasp_Utils::inst()->startTimer();
        $result = array();

        try {
            $tagModel = new Atlasp_Db_TagTable($this->db);
            $rows = $tagModel->getTags($companyId, $userId, $category, $subCategory);

            foreach ($rows as $row) {
                $row = array_change_key_case($row);
                $detail1 = $row['detail1'];
                $detail2 = $row['detail2'];
                $category = strtoupper($row['category']);   // uppercase category key
                $subcat = strtoupper($row['subcategory']);  // uppercase sub category key
                $result[$category][$subcat] = array(
                    'detail1' => $detail1,
                    'detail2' => $detail2
                );
            }
        } catch (Exception $e) {
            Zend_Registry::get('log')->warn(__METHOD__ . " Exception thrown : " . $e);
        }

        $endTime = array(__FUNCTION__ => Atlasp_Utils::inst()->endTimer($b));
        Zend_Registry::set('times', array_merge(Zend_Registry::get('times'), $endTime));

        return $result;
    }

    protected function _getCachedUserTag($category, $subCategory, $defDetail1=null, $defDetail2=null)
    {
        static $tags = null;
        
        if (is_null($tags)) { 
            $tags = $this->_getUserTags();
        }
        
        //
        if (isset($tags[$category][$subCategory])){
            return $tags[$category][$subCategory];
        }
        
        //
        return array(
			'detail1' => $defDetail1,
			'detail2' => $defDetail2
		);;
    }
    
    
	/**
	 * This method calls _getCompanyTags for 'COMPANY SECURITY'
	 * category and stores the result internally. Only the following
	 * sub-categories are retrieved: 'SSN MASKING','DOB MASKING',
	 * 'DRIVER LICENSE MASKING', 'DATA PERMISSION MASK',
	 * 'DATA RESTRICTION MASK', 'BLIND USER / NO SEARCH CRITERIA LOGGED.', 
     * 'ENCRYPTED LOGGING', 'ENABLE OTP', 'ENABLE SMS 2FA', 'Application Type',
     * 'Disable Multiple Sessions'
	 * 
	 * Returns array of the form
	 * array(
	 *    'detail1' => '...',
	 *    'detail2' => '...',
	 * )
	 * 
	 * @param string $subcategory
	 * @param mixed $defDetail1
	 * @param mixed $defDetail2
	 * @return array
	 */
	private function _getCachedCompanySecurityTag($subcategory, $defDetail1, $defDetail2)
	{
		// cache
		static $cache = null;
		
		// uppercase params
		$category = 'COMPANY SECURITY';
		$subcategory = strtoupper($subcategory);
		
		//default return vals
		$defaultReturn = array(
			'detail1' => $defDetail1,
			'detail2' => $defDetail2
		);
		
		
		// 
		// Start cache: return from cache if query already ran
		//
		if (!is_null($cache))
		{
			if (isset($cache[$category][$subcategory]))
			{
				return $cache[$category][$subcategory];
			}
			return $defaultReturn;
		}
		// end cache
		
		
		//
		$compSecuritySubCategories = array(
			'SSN MASKING',
			'DOB MASKING',
			'DRIVER LICENSE MASKING',
			'DATA PERMISSION MASK',
			'DATA RESTRICTION MASK',
			'NO SEARCH CRITERIA LOGGED.',
			'ENCRYPTED LOGGING',
			'Application Type',
			'Enable Mobile Access',
            'Enable OTP',
            'Enable SMS 2FA',
			'Disable Multiple Sessions'
		);
		$cache = $this->_getCompanyTags($category, $compSecuritySubCategories); // QUERY
		
		if (isset($cache[$category][$subcategory]))
		{
			return $cache[$category][$subcategory];
		}
		return $defaultReturn;
	}

	/**
	 * 
	 * @return string
	 */
	public function getSsnMasking()
	{
	    // All | first5 | LAST4 | None | Yes

	    $arr = $this->_getCachedCompanySecurityTag('SSN MASKING', 'all', null);
	    $perm = $arr['detail1'];
	    return strtolower($perm);
	}

	/**
	 * 
	 * @return string
	 */
	public function getDobMasking()
	{
	    //ALL , day, NONE, YEAR
	    $arr = $this->_getCachedCompanySecurityTag('DOB MASKING', 'all', null);
	    $perm = $arr['detail1'];
	    return strtolower($perm);
	}

	/**
	 * 
	 * @return int
	 */
	public function getDlMasking()
	{
	    // 0, 1
	    $arr = $this->_getCachedCompanySecurityTag('DRIVER LICENSE MASKING', 1, null);
	    $perm = (int) $arr['detail1'];
	    return $perm;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getDataPermissionMask()
	{
	    $arr = $this->_getCachedCompanySecurityTag('DATA PERMISSION MASK', "", null);
	    return $arr['detail1'];
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getDataRestrictionMask()
	{
	    $arr = $this->_getCachedCompanySecurityTag('DATA RESTRICTION MASK', "", null);
	    return $arr['detail1'];
	}

	/**
	 * returns 0,1
	 * 
	 * @return int
	 */
	public function getBlindTag()
	{
	    $arr = $this->_getCachedCompanySecurityTag('NO SEARCH CRITERIA LOGGED.', 'n', null);
	    $val = strtolower($arr['detail1']);
	    if ( $val == 'y' )
	    {
	    	return 1;
	    }
	    return 0;
	}

	/**
	 * returns 0,1
	 * 
	 * @return int
	 */
	public function getEncryptTag()
	{
	    $arr = $this->_getCachedCompanySecurityTag('ENCRYPTED LOGGING', 'n', null);
	    $val = (int) $arr['detail1'];
	    return $val;
	}

	/**
	 * returns 0,1
	 * 
	 * @return int
	 */
	public function getDisableMultipleSessions($cid)
	{
		$this->companyid = $cid;
	    $arr = $this->_getCachedCompanySecurityTag('Disable Multiple Sessions', '1', null);
	    $val = (int) $arr['detail1'];
	    return $val;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getApplicationTypeTag()
	{
	    $arr = $this->_getCachedCompanySecurityTag('Application Type', 'n', null);
	    $val =  $arr['detail1'];
	    return $val;
	}

	/**
	 * 
	 * @return string
	 */
	public function hasMobileAccess()
	{
	    $arr = $this->_getCachedCompanySecurityTag('Enable Mobile Access', 0, null);
	    $val =  $arr['detail1'];
	    return $val;
	}
    
	/**
	 * Gets company tag for One Time Password
	 * 
     * @return bool
	 */
	public function getOtpStatus()
	{
        $tag = $this->_getCachedCompanySecurityTag('ENABLE OTP', false, null);
        return $tag['detail1'];
	}
    
	/**
	 * Gets company tag for 2 Factor SMS Authentication
     * 
	 * @return bool
	 */
	public function getSms2FaStatus()
	{
        $tag = $this->_getCachedCompanySecurityTag('ENABLE SMS 2FA', false, null);
        return $tag['detail1'];
	}

    /**
     * Checks if user mobile access is enabled
     * 
     * @return bool
     */
    public function isUserOtpEnabled()
    {
        $tag = $this->_getCachedUserTag('USER OPTIONS', 'ENABLE OTP');
        return $tag['detail1'];
    }
    
    /**
     * Checks to see if user mobile access is enabled
     * 
     * @return bool
     */
    public function isUserMobileAccessEnabled()
    {
        $tag = $this->_getCachedUserTag('USER OPTIONS', 'DISABLE MOBILE ACCESS');
        return !$tag['detail1'];
    }
    
}
