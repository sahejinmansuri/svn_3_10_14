<?php
class Atlasp_Models_Db_Company extends Zend_Db_Table_Abstract
{
    protected $_name    = 'COMPANY';
    protected $_primary = 'COMPANYID';

    public function validCompanyId($companyId)
    {
        $m = __METHOD__ . '(): ';
        $db = Zend_Registry::get('syb');
        $companyId = (integer) $companyId;
        $where = $db->quoteInto('COMPANYID = ?', $companyId);

        try
        {
            $result = $this->fetchRow($where);
            $validC = false;

            if (isset($result)) {
                $validC = true;
            }

            return $validC;
        }
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            Zend_Registry::get('log')->err($m . "Exception thrown - {$errorMsg}");
            return false;
        }  

        return false;
    }
}
