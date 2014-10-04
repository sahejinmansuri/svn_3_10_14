<?php

class Atlasp_Db_StoredProc 
{ 
    const SYBASE = 'pdo_mssql';
    const MYSQL  = 'pdo_mysql';

    protected $_dbHandle = null;
    protected $_dbType = null;
    protected $_spClass = null;

    public function __construct($dbHandle,$dbType) 
    {
        $m = __METHOD__ . '(): ';
        $this->_dbHandle = $dbHandle;
        $this->_dbType = $dbType;

        switch ($this->_dbType) 
        {
            case self::SYBASE:
                $this->_spClass = Atlasp_Db_StoredProc_Sybase::getInstance();
                break;
            case self::MYSQL:
                $this->_spClass = Atlasp_Db_StoredProc_MySql::getInstance();
                break;
            default:
                trigger_error($m . 'Unknown database handle.', E_USER_ERROR);
                break;
        }
    }

    public function call($name, $inparam, $outparam, $spretval)
    {
        $outValue = $this->_spClass->call($this->_dbHandle,
                                          $name,
                                          $inparam,
                                          $outparam,
                                          $spretval);
 
        return $outValue;
    }   
}
