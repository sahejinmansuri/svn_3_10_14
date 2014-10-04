<?php

class Atlasp_Db_OtpToken extends Atlasp_Db_Table_Abstract
{

    protected $_name = 'otp_token_info';
    protected $_primary = 'otp_token_info_id';

    /**
     * Loads OTP token
     * 
     * @param int $companyId
     * @param int $userId
     * @param int $type (optional)
     * @return array 
     */
    public function getToken($companyId, $userId, $type=null)
    {
        //
        $row = null;
        $companyId = (int) $companyId;
        $userId = (int) $userId;

        //
        if (!$companyId || !$userId) {
            $msg = "() Invalid Args - CompanyId [$companyId] / UserId [$userId]";
            $this->_log->debug(__METHOD__ . $msg);
            throw new Exception('Illegal Arguments');
        }


        try {
            //  Create Select Statement
            $select = $this->getAdapter()->select()
                    ->from($this->_name)
                    ->where('companyid = ?', $companyId)
                    ->where('userid = ?', $userId);
            
            if (is_int($type)){
                $select->where('token_type = ?', $type);
            }
            
            //  
            $row = $this->getAdapter()->fetchRow($select);
        } catch (Exception $e) {
            $msg = __METHOD__ . '(): Exception thrown - ' . $e->getMessage();
            $this->_log->err($msg);
        }

        //
        return $row;
    }

}

