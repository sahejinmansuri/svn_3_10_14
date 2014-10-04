<?php

require_once 'HelperAbstract.php';

class Helpers_Sms2Fa extends Helpers_HelperAbstract
{

    /**
     * @var Zend_Session_Namespace 
     */
    protected $_smsAuth;

    /**
     * Default Constructor
     */
    public function __construct()
    {
        parent::__construct();

        //  Create special namespace for SMS 2 Factor Authorization
        $this->_smsAuth = new Zend_Session_Namespace('Sms2Fa');
    }

    /**
     * Generates new auth code and sends it to the user
     */
    public function sendAuthCode()
    {
        //
        $user = $this->_session->identity;
        $code = $this->_generateNewAuthCode();
        $fromAddress = $this->_cfg->sms2fa->from_email;
        $toAddress = $this->_getUserSmsEmail($user->companyid, $user->userid);
        $message = sprintf($this->_cfg->sms2fa->message, $code);

        //  Verify user email address
        $val = new Zend_Validate_EmailAddress();
        if (!$toAddress) {
            $this->_log->debug(__METHOD__ . '() SMS address cannot be empty');
            return false;
        } elseif (!$val->isValid($toAddress)) {
            $this->_log->debug(__METHOD__ . "() $toAddress is not valid SMS email address");
            return false;
        }

        //  Generate and send message
        $mail = new Zend_Mail();
        $mail->setFrom($fromAddress)
                ->addTo($toAddress)
                ->setBodyText($message)
                ->send();

        //  Log
        $this->_log->debug(__METHOD__ . "() Sent new auth code [$code] to $toAddress");

        return true;
    }

    /**
     * Checks to see if session auth code is same as user specified auth code
     * 
     * @param string $authCode
     * @return bool true on success
     */
    public function isCorrectAuthCode($authCode)
    {
        //  
        $isCorrect = ($authCode && $this->_getAuthCode() == $authCode);
        if ($isCorrect) {
            //  Destroy current code
            $this->_setAuthCode(null);
        }

        //  Log
        $status = $isCorrect ? 'Correct' : 'Incorrect';
        $this->_log->debug(__METHOD__ . "() Auth code [$authCode] is $status");

        //
        return $isCorrect;
    }

    /**
     * Checks to see if SMS Auth is required for currently logged in user
     * 
     * @param Atlasp_App_Perm $permHandler
     * @return bool
     */
    public function isRequired($permHandler)
    {
        //
        $isSmsAuthRequired = false;
        $enabledCompanyOtp = $permHandler->getOtpStatus();
        $enabledCompanySms2Fa = $permHandler->getSms2FaStatus();
        $enabledUserOtp = $permHandler->isUserOtpEnabled();

        //
        $isSmsAuthRequired = ($enabledCompanyOtp && $enabledCompanySms2Fa && $enabledUserOtp);
        
        //
        $status = $isSmsAuthRequired ? '' : 'not';
        $this->_log->debug(__METHOD__ . "() SMS Auth is $status required");

        //
        return $isSmsAuthRequired;
    }

    /**
     * Generates new auth code
     * 
     * @return string 
     */
    protected function _generateNewAuthCode()
    {
        $authCode = '';
        $codeLength = (int) $this->_cfg->sms2fa->code_length;

        //  Generate random integer code
        for ($i = 0; $i < $codeLength; $i++) {
            $authCode .= rand(0, 9);
        }

        //  Set the code
        $this->_setAuthCode($authCode);

        //  
        $this->_log->debug(__METHOD__ . "() Generated new Auth Code [$authCode]");

        //
        return $authCode;
    }

    /**
     * Gets Auth code
     * 
     * @return string
     */
    protected function _getAuthCode()
    {
        return isset($this->_smsAuth->code) ? $this->_smsAuth->code : null;
    }

    /**
     * Gets user sms email address
     * 
     * @param int $companyId
     * @param int $userId
     * @return string
     */
    protected function _getUserSmsEmail($companyId, $userId)
    {
        $token = $this->_getUserOtpToken($companyId, $userId);
        return isset($token) ? $token['token_id'] : null;
    }

    /**
     * Gets user OTP Token Record
     * 
     * @staticvar array $token
     * @param int $companyId
     * @param int $userId
     * @return array
     */
    protected function _getUserOtpToken($companyId, $userId)
    {
        static $token = null;

        if (is_null($token)) {
            try {
                $model = new Atlasp_Db_OtpToken(array('db' => 'syb'));
                $token = $model->getToken($companyId, $userId, 2);
            } catch (Exception $e) {
                $this->_log->err(__METHOD__ . '() Exception: ' . $e->getMessage());
            }
        }

        return $token;
    }

    /**
     * Sets auth code
     * 
     * @param string $code 
     */
    protected function _setAuthCode($code)
    {
        $this->_smsAuth->code = $code;
    }

}
