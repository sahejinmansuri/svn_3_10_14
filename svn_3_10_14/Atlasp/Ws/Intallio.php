<?

class Atlasp_Ws_Intallio
{
    private $soap;
    private $edata;

    public function __construct($edata){
	$this->edata = $edata;

	$this->soap = new Atlasp_Soap_Call($edata);
	#$header_tags = array('Username' => new SOAPVar($edata['uname'], XSD_STRING, null, null, null, $edata['ns']),
	#	             'Password' => new SOAPVar($edata['passwd'], XSD_STRING, null, null, null, $edata['ns']));
	#$utag = array('UsernameToken' =>  new SOAPVar($header_tags, SOAP_ENC_OBJECT ));
	#$headers = new SOAPHeader($edata['ns'], 'Security', new SOAPVar($utag, SOAP_ENC_OBJECT) );
	#$this->soap->addHeaders($headers);
    }
    
    public function getXML($inputs){
	$method = $this->edata['method'];
	try {
           $response = $this->soap->getXML($method, $inputs);
	} catch(Exception $e){
	   throw $e;
	}
	#$pat[0] = '/\<soap.*?\<response/i';
	#$rep[0] = '<response';
	#$pat[1] = '/\<\/response\>.*/i';
	#$rep[1] = '</response>';
	#$response = preg_replace($pat,$rep,$response);

	$this->dumpResponseToFile($response);
	return $response;
    }    

    public function getResponse($inputs){
	$method = $this->edata['method'];
	try {
          $response = $this->soap->getResponse($method, $inputs, 1);
        } catch(Exception $e){
	   throw $e;   
	}
	return $response;
    }    


    private function dumpResponseToFile($xml){
	$cfg = Zend_Registry::get('config');
	$file = $cfg->paths->tmp."fo_response.xml";
	$handle = fopen($file, 'w');
	fwrite($handle, $xml); 
	fclose($handle); 
    }
    
}
