<?php

class Atlasp_Soap_Call
{
    private $soap;

    public function __construct($edata){
	$opts = array( 'trace'  => 1, "exceptions" => 1,);
	$wsdl = $edata['wsdl'];
	$this->soap = new SOAPClient($wsdl, $opts);
	if(isset($edata['endpoint'])){
	    $this->soap->__setLocation($edata['endpoint']);    
	}
    }   
    
    public function addHeaders($headers){
	$this->soap->__setSoapHeaders($headers);
    }

    public function getXML($method, $inputs,$preserveExp=0){
	$begin = Atlasp_Utils::inst()->startTimer();
	try{
	    #echo "inputs is "; print_r($inputs);
            $response = $this->soap->$method($inputs);
	}
	catch(Exception $e){ 
	    $t = Zend_Registry::get('times');
	    $t['ESP'] = Atlasp_Utils::inst()->endTimer($begin);
	    Zend_Registry::set('times',$t);
	    //var_dump($e); 
	    if($preserveExp == 1){
		throw $e;
	    }	else {
	        throw new Atlasp_Exp_WsException(2001,'Ws Error', $e, 1);
	    }	
	}
	$t = Zend_Registry::get('times');
	$t['ESP'] = Atlasp_Utils::inst()->endTimer($begin);
	Zend_Registry::set('times',$t);
	$this->dumpToFile( $this->soap->__getLastRequest()); 
	return $this->soap->__getLastResponse();
    }

    public function getResponse($method, $inputs,$preserveExp=0 ){
	$begin = Atlasp_Utils::inst()->startTimer();
	#var_dump($inputs);
	try{
            $response = $this->soap->$method($inputs);
	}
	catch(Exception $e){
	    $t = Zend_Registry::get('times');
	    $t['ESP'] = Atlasp_Utils::inst()->endTimer($begin);
	    Zend_Registry::set('times',$t);
	    if($preserveExp == 1){
		throw $e;
	    }	else {
	        throw new Atlasp_Exp_WsException(2001,'Ws Error', $e, 1);
	    }	
	}
	$this->dumpToFile( $this->soap->__getLastRequest()); 
	$t = Zend_Registry::get('times');
	$t['ESP'] = Atlasp_Utils::inst()->endTimer($begin);
	Zend_Registry::set('times',$t);
	return $response;
    }

    private function dumpToFile($xml){
	$cfg = Zend_Registry::get('config');
	$file = $cfg->paths->tmp."soap.xml";
	$handle = fopen($file, 'w') ;
	fwrite($handle, $xml); 
	fclose($handle); 
    }
    
}


