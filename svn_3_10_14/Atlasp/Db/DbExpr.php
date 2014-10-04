<?php

class Atlasp_Db_DbExpr
{
	const MYSQL = 1;
	const SYBASE = 2;
	private $_adapterType = 0;
	
	public function __construct(Zend_Db_Adapter_Abstract $adapter)
	{
		$this->setAdapter($adapter);
	}
	
	public function get_int_expr($int)
	{
		$int = (int) $int;
		
		if ($this->_adapterType == self::MYSQL)
		{
			return $int;
		}
		elseif ($this->_adapterType == self::SYBASE)
		{
			return new Zend_Db_Expr("convert(int, $int)");
		}
		
		throw new Exception('Unknown adapter type');
	}
	
	public function get_dateadd_days_expr($expr_or_column, $days=0)
	{
		$days = (int) $days;
		
		if ($this->_adapterType == self::MYSQL)
		{
			return new Zend_Db_Expr("ADDDATE(". $expr_or_column .", INTERVAL $days DAY)");
		}
		elseif ($this->_adapterType == self::SYBASE)
		{
			return new Zend_Db_Expr("DATEADD(day, $days, ". $expr_or_column .")");
		}
		
		throw new Exception('Unknown adapter type');
	}
	
	public function get_now_expr()
	{
		return $this->get_getdate_expr();
	}
	public function get_getdate_expr()
	{
		if ($this->_adapterType == self::MYSQL)
		{
			return new Zend_Db_Expr('NOW()');
		}
		elseif ($this->_adapterType == self::SYBASE)
		{
			return new Zend_Db_Expr('GETDATE()');
		}
		
		throw new Exception('Unknown adapter type');
	}
	
	/**
	 * 
	 * @param Zend_Db_Adapter_Abstract $adapter
	 */
	public function setAdapter(Zend_Db_Adapter_Abstract $adapter)
	{
		if ($this->_adapterType > 0)
		{
			return $this->_adapterType;
		}
		
		$adapterType = get_class($adapter);
		if (stristr($adapterType, 'mysql') !== false)
		{
			// MYSQL
			$this->_adapterType = self::MYSQL;
		}
		else if (stristr($adapterType, 'sybase') !== false)
		{
			// SYBASE
			$this->_adapterType = self::SYBASE;
		}
		else if (stristr($adapterType, 'mssql') !== false)
		{
			// SYBASE
			$this->_adapterType = self::SYBASE;
		}
		else
		{
			throw new Exception('Unknown adapter type');
		}
	}
	
	public function isMysql()
	{
		if ($this->_adapterType == self::MYSQL)
		{
			return true;
		}
		return false;
	}
	
	public function isSybase()
	{
		if ($this->_adapterType == self::SYBASE)
		{
			return true;
		}
		return false;
	}
}
