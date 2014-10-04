<?php
class App_Ws_RestApi extends App_Ws_Search
{
	/**
	 * 
	 * @var Zend_Log
	 */
	protected $logger;
	
	public function __construct($evt_data)
	{
		$this->logger = Zend_Registry::get('log');
		return parent::__construct($evt_data);
	}
		
	
	protected function _addSoapInputs($reqData, $soapInput)
	{
		$soapInput['Options']['StartingRecord'] = $reqData['STARTRECORD'];
		$soapInput['Options']['ReturnCount'   ] = $reqData['RETCOUNT'];
		return $soapInput;
	}
	
	protected function _xpathFetchOne($simplexml, $xpath)
	{
		$arr = $simplexml->xpath($xpath);
		if (count($arr)) {
			return $arr[0];
		}
		//return new SimpleXMLElement(""); //empty element
		return null;
	}
}
