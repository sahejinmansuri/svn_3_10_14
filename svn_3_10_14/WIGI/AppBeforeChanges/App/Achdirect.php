<?php

class App_Achdirect
{
    private $MerchantID    = "132977";
    private $ApiLoginID = "3qUEK3d01l";
    private $SecureTransactionKey = "51McRQt6";
 


    public function __construct()
    {
        /*if (empty($this->MerchantID) || empty($this->ApiLoginID) || empty($this->SecureTransactionKey) )
        {
            throw new App_AchdirectCMIException("You have not configured your Payments Gateway login credentials.");
        }*/
        
        //use the BasicHttpBinding endpoint located at CMIService.svc/Basic
        $this->url = "https://ws.paymentsgateway.net/Service/v1/Transaction.wsdl";
        $this->location = "https://ws.paymentsgateway.net/Service/v1/Transaction.svc/Basic";
    }


    
    public function hmac ($key, $data)
{
// RFC 2104 HMAC implementation for php.
// Creates an md5 HMAC.
// Eliminates the need to install mhash to compute a HMAC
// Hacked by Lance Rushing

$b = 64; // byte length for md5
if (strlen($key) > $b) {
$key = pack("H*",md5($key));
}
$key = str_pad($key, $b, chr(0x00));
$ipad = str_pad('', $b, chr(0x36));
$opad = str_pad('', $b, chr(0x5c));
$k_ipad = $key ^ $ipad ;
$k_opad = $key ^ $opad;

return md5($k_opad . pack("H*",md5($k_ipad . $data)));
}
    
    public function getTransactions($date,$page,$size)
    {

    $time = time();
$multiplied = $time * 10000000; //adjust to microseconds
$addedtime = $multiplied + 621355968000000000; //adjust date from epoch to .net. not exact but close.
$time = time() + 62135596800;
$addedtime = $time . '0000000';
        $Authentication = new App_Authentication();
        $Authentication->APILoginID = $this->ApiLoginID;
        $Authentication->SecureTransactionKey = $this->SecureTransactionKey;
        
        
        $Authentication->TSHash = $this->hmac($this->SecureTransactionKey,$this->ApiLoginID . "|" . $addedtime);
        $Authentication->UTCTime = $addedtime;
        
        try
        {
            $client = new SoapClient($this->url, array("location" => $this->location));
            
    
            
            $params = array("ticket" => $Authentication, 
                            "MerchantID" =>$this->MerchantID, 
                            "Day" => "$date", 
                            "PageIndex" => $page,
                            "PageSize" => $size  );
        
            $response = $client->getSettleDetail($params);
            return $response;
        }
        catch (Exception $e)
        {            
            echo $e->getMessage();
        }
    }

}

class App_Authentication
{    
    public $APILoginID;
    public $SecureTransactionKey;
}


?>
