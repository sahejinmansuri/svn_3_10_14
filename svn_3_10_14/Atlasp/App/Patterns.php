<?php
class Atlasp_App_Patterns
{
    const SUCCESS        = 2000;
    const NO_VALIDATION  = 2001;
    const INVALID_FORMAT = 3000;
    const REQUIRED_FIELD = 3001;
    const SIZE_TOO_LONG  = 3002;
    const UNKNOWN_ERROR  = 3003;

    /**
     * Allows size to be of any length. Removes size constraint.
     */
    const SIZE_ANY = -1;


    private $Patterns = array();
    protected $_request;

    public function __construct(Zend_Controller_Request_Abstract $request)
    {
        $this->_request = $request;

        // 05/18/06 : 05/18/2006
        $this->Patterns['date_a']['regexp'] = '/^\d\d?\/\d\d?\/\d\d(?:\d\d)?$/'; 
        $this->Patterns['date_a']['size'] = 10;   
    
        // Feb 12 2006  7:54:58:000PM
        $this->Patterns['date_b']['regexp'] = '/^[a-zA-Z]{3}\s+\d\d?\s+\d{4}\s+\d\d?:\d\d?:\d\d?:\d{3}[AP]M/';
        $this->Patterns['date_b']['size'] = 30;

        // 2006-02-13 18:24:57
        $this->Patterns['date_c']['regexp'] = '/^\d{4}-\d\d-\d\d?\s+\d\d?:\d\d?:\d\d?$/';
        $this->Patterns['date_c']['size'] = 20;
    
        // 12-31-2006 / 12/31/2006
        $this->Patterns['date_d']['regexp'] = '/^\d\d?[-\/]\d\d?[-\/]\d{4}$/';
        $this->Patterns['date_d']['size'] = 20;
   
        // 2006-02-13
        $this->Patterns['date_e']['regexp'] = '/^\d\d\d\d-\d\d-\d\d$/';
        $this->Patterns['date_e']['size'] = 10;

 
        // Day of Month < 31
        $this->Patterns['day_a']['regexp'] = '/^0?[1-9]$|^[12]\d$|^3[01]$/';
        $this->Patterns['day_a']['size'] = 2;

        // Month of Year < 12
        $this->Patterns['month_a']['regexp'] = '/^0?[1-9]$|^1[012]$/';
        $this->Patterns['month_a']['size'] = 2;

        // Year Pretty much any 2 or 4 digits
        $this->Patterns['year_a']['regexp'] = '/^\d\d(?:\d\d)?$/';
        $this->Patterns['year_a']['size'] = 4;

        // Zip
        $this->Patterns['zip']['regexp'] = '/^\d{5}(?:-?\d{4})?$/';
        $this->Patterns['zip']['size'] = 10;

        // IPs
        $this->Patterns['ip']['regexp'] = '/^[0-2]*\d?\d(?:\.[0-2]*\d?\d){3}$/';
        $this->Patterns['ip']['size'] = 16;

        // IP_block
        $this->Patterns['ip_block']['regexp'] = '/^25[0-5]$|^[01]\d?\d?$|^2\d?$|^2[0-4]\d$|^\d\d?$/';
        $this->Patterns['ip_block']['size'] = 3;

        // Amount
        $this->Patterns['amount']['regexp'] = '/^[\d,]+(?:\.\d+)?$/';
        $this->Patterns['amount']['size'] = 12;

        // Session Id
        $this->Patterns['session']['regexp'] = '/^[a-zA-Z0-9]{32}$/';
        $this->Patterns['session']['size'] = 32;

        // Database Key ids
        $this->Patterns['dbid']['regexp'] = '/^\d{1,10}$/';
        $this->Patterns['dbid']['size'] = 11;
    
        // Bank Routing Number
        $this->Patterns['b_routing']['regexp'] = '/^\d{1,9}$/';
        $this->Patterns['b_routing']['size'] = 9;

        // Bank Account Number
        $this->Patterns['b_account']['regexp'] = '/^[0-9A-Za-z]{1,20}$/';
        $this->Patterns['b_account']['size'] = 20;

        // Credit Card Number
        $this->Patterns['creditc']['regexp'] = '/^\d{15,16}$/';
        $this->Patterns['creditc']['size'] = 16;

        // Phone Num
        $this->Patterns['phone']['regexp'] = '/^\(?\d{3}\)?[- .]?\d{3}[- .]?\d{4}$/';
        $this->Patterns['phone']['size'] = 20;

        // Phone Num - 7 digit+
        $this->Patterns['phone7_plus']['regexp'] = '/^\(?(\d{3})?\)?[- .]?\d{3}[- .]?\d{4}$/';
        $this->Patterns['phone7_plus']['size'] = 20;
        
        // OTP Id
        $this->Patterns['otp']['regexp'] = '/^\d{6}$/';
        $this->Patterns['otp']['size'] = 6;

        // User Id
        $this->Patterns['userid']['regexp'] = '/^[0-9]+$/';
        $this->Patterns['userid']['size'] = 8;

        // Application Type
        $this->Patterns['apptype']['regexp'] = '/^\w{2,5}$/';
        $this->Patterns['apptype']['size'] = 5;

        // Login Id
        $this->Patterns['loginid']['regexp'] = '/^.{1,20}$/';
        $this->Patterns['loginid']['size'] = 20;

        // Password
        $this->Patterns['password']['regexp'] = '/^.{1,33}$/';
        $this->Patterns['password']['size'] = 33;

        // Small Num consisiting of upto 4 digits
        $this->Patterns['small_num']['regexp'] = '/^\d{1,4}$/';
        $this->Patterns['small_num']['size'] = 4;

        // Zero Or One
        $this->Patterns['zo']['regexp'] = '/^[01]$/';
        $this->Patterns['zo']['size'] = 1;

        // Zero Or One or Yes or No
        $this->Patterns['zo_yn']['regexp']  = '/^[01YNyn]$/';
        $this->Patterns['zo_yn']['size'] = 1;

        // Yes or No
        $this->Patterns['yn']['regexp'] = '/^(?:yes|no)$/';
        $this->Patterns['yn']['size'] = 3;
    
        // State
        // $this->Patterns['state']['regexp'] = '/^[A-Za-z ]{2}$/';
        $this->Patterns['state']['regexp'] = '/^AK|AL|AR|AZ|CA|CO|CT|DC|DE|FL|GA|GU|HI|IA|ID|IL|IN|KS|KY|LA|MA|MD|ME|MI|MN|MO|MS|MT|NC|ND|NE|NH|NJ|NM|NV|NY|OH|OK|OR|PA|PR|RI|SC|SD|TN|TX|UT|VA|VI|VT|WA|WI|WV|WY$/i';
        $this->Patterns['state']['size'] = 2;
    
        // Name
        $this->Patterns['name']['regexp'] = '/^[\w\s\.\',&\/\\\(\)!-]+$/';
        $this->Patterns['name']['size'] = 60;
    
        // Title
        $this->Patterns['title']['regexp'] = '/^[A-Za-z\.\s\/]+$/';
        $this->Patterns['title']['size'] = 100;
    
        // Address
        $this->Patterns['address']['regexp'] = '/^[0-9A-Za-z\.,\s#\/\\:\(\)\/&-]+$/';
        $this->Patterns['address']['size'] = 50;

        // Company
        $this->Patterns['company']['regexp'] = '/^[\w\d\s\.\',&\/\\\(\)\!\]\[\+\;\-\#]+$/';
        $this->Patterns['company']['size'] = 100;

        // City
        $this->Patterns['city']['regexp'] = '/^[\'A-Za-z .-]+$/';
        $this->Patterns['city']['size'] = 60;

        // Characters. size will be provided by inputs.
        $this->Patterns['char']['regexp'] = '/^[A-Za-z_]+$/';
        $this->Patterns['char']['size'] = 10;
    
        // Digits. size will be provided by inputs.
        $this->Patterns['digit']['regexp'] = '/^[0-9]+$/';
        $this->Patterns['digit']['size'] = 4;

        // Real Num. size will be provided by inputs.
        $this->Patterns['realnum']['regexp'] = '/^-?[0-9]+$/';
        $this->Patterns['realnum']['size'] = 5;

        // Charcters + Digits. size will be provided by inputs.
        $this->Patterns['char_digit']['regexp'] = '/^[A-Za-z_0-9]+$/';
        $this->Patterns['char_digit']['size'] = 10;
        
        // Report-Relationship id
        $this->Patterns['report_rel']['regexp'] = '/^\d+-\d+$/';
        $this->Patterns['report_rel']['size'] = 18;
        
        // Event
        $this->Patterns['event']['regexp'] = '/^[\w\/\~\._-]+$/';
        $this->Patterns['event']['size'] = 60;

        // SSN
        $this->Patterns['ssn']['regexp'] = '/^\d{3}-?\d{2}-?\d{4}$/';
        $this->Patterns['ssn']['size'] = 14;

        // FEIN
        $this->Patterns['fein']['regexp'] = '/^\d{2}-?\d{7}$/';
        $this->Patterns['fein']['size'] = 10;

        // Anything goes. A regexp which returns 1 always. Size will be provided by the inputs. default 50
        // $this->Patterns['generic']['regexp'] = '/.*/ms;
        $this->Patterns['generic']['regexp'] = '/.*/';
        $this->Patterns['generic']['size'] = 150;

        $this->Patterns['email']['regexp'] = '/^[a-zA-Z0-9][\'\w\.-]*[a-zA-Z0-9]*@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]*\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/';
        $this->Patterns['email']['size'] = 60;
    
        // RECID
        $this->Patterns['recid']['regexp'] = '/^[0-9]+$/';
        $this->Patterns['recid']['size'] = 5;

        // _SSV
        $this->Patterns['cookie']['regexp'] = '/^[\d\w_\|\;\:\=]+$/';
        $this->Patterns['cookie']['size'] = 500;
        
        // Device Identifier
        $this->Patterns['device_id']['regexp'] = '/^[\w-]+$/';
        $this->Patterns['device_id']['size'] = 100;

        // Country Code
        $this->Patterns['countrycode']['regexp'] = '/^\d+$/';
        $this->Patterns['countrycode']['size'] = 3;

        // Wigi Code
        $this->Patterns['wigicode']['regexp'] = '/^\d\d\d-{0,1}\d\d-{0,1}\d\d\d\d$/';
        $this->Patterns['wigicode']['size'] = 15;

        // Merchant ID
        $this->Patterns['merchantid']['regexp'] = '/^\d-\d\d\d-\d\d\d\d\d\d\d$/';
        $this->Patterns['merchantid']['size'] = 15;

        // Merchant ID
        $this->Patterns['int']['regexp'] = '/^\d+$/';
        $this->Patterns['int']['size'] = 25;
   
        // PIN
        $this->Patterns['pin']['regexp'] = '/^\d{6,10}$/';
        $this->Patterns['pin']['size'] = 10;
     
    }
    
    private function _setupValidationCriteria($patternName, $size)
    {
        $regexp = null;

        if (!isset($this->Patterns[$patternName]['regexp'])) {
            $errorMessage = "Could not find regular expression for '{$patternName}'.";
            trigger_error($errorMessage, E_USER_ERROR);
        } else {
            $regexp = $this->Patterns[$patternName]['regexp'];

            if (null === $size) {
                if (!isset($this->Patterns[$patternName]['size'])) {
                    $errorMessage = "Could not find size for '{$patternName}'.";
                    trigger_error($errorMessage, E_USER_ERROR);
                } else {
                    $size = $this->Patterns[$patternName]['size'];
                }
            }
        }

        return array($regexp, $size);
    }

    /**
     * Validates given request parameter by specified rules
     * 
     * @param string $postParam
     * @param string $patternName
     * @param int $required
     * @param int $size
     * @return int validation status code
     */
    public function validate($postParam, $patternName, $required, $size = null)
    {
        $status = self::NO_VALIDATION;
        $formValue = $this->_request->getParam($postParam);

        if (!$formValue && (1 === $required)) {
            $status = self::REQUIRED_FIELD;
        } elseif ((trim($formValue) == '') && (1 === $required)) {
            $status = self::REQUIRED_FIELD;
        } elseif ((trim($formValue) == '') && (0 === $required)) {
            $status = self::NO_VALIDATION;
        } else {
            list($regexp, $size) = $this->_setupValidationCriteria($patternName, $size);

            $status = self::SUCCESS;

            //  Make sure size validation is not set to ANY Size
            //  And legth of user input is within validation limits
            if ($size != self::SIZE_ANY && strlen($formValue) > $size) {
                $status = self::SIZE_TOO_LONG;
            } elseif (!preg_match($regexp, $formValue)) {
                $status = self::INVALID_FORMAT;
            }
        }

        return $status;
    }
}
