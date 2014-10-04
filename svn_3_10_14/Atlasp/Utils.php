<?php

class Atlasp_Utils {
    private static $uob;

    private function __construct(){}

    public static function inst(){
	if (!isset(self::$uob)) {
	    $c = __CLASS__;
	    self::$uob = new $c;
	}
	return self::$uob;	
    }
   
    public function startTimer(){
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public function endTimer($begin){
	if(!$begin) return 0;
        list($usec, $sec) = explode(" ", microtime());
        return sprintf("%01.4f",  ((float)$usec + (float)$sec) - ((float)$begin) );
    }
    
    public function encryptPassword($pwd){
        return md5(sha1($pwd) . $pwd);
    }

    public function getUid($dbstr, $tableName,$mysql=0){
	$db = Zend_Registry::get($dbstr);
	if($mysql ==1){
	   $stmt=$db->prepare("call esp_getlock ('".$tableName."')");
	} else {    
	   $stmt=$db->prepare("esp_getlock '".$tableName."'");
	}
	$b = Atlasp_Utils::inst()->startTimer();
        try {
		$stmt->execute();
	} catch (Exception $e){
	    $t=Zend_Registry::get('times');
	    $t['UID'] = Atlasp_Utils::inst()->endTimer($b);
	    Zend_Registry::set('times',$t);
	    #return 0;
            throw new Atlasp_Exp_DbException(2001,'DB Error', $e, 1);
	}
	$t=Zend_Registry::get('times');
	$t['UID'] = Atlasp_Utils::inst()->endTimer($b);
	Zend_Registry::set('times',$t);
	$res = $stmt->fetchAll();
	$stmt->closeCursor();
	return $res[0]['next_id'];
    }

    

    // ipInRange
    // This function takes 2 arguments, an IP address and a "range" in several
    // different formats.
    // Network ranges can be specified as:
    // 1. Wildcard format:     1.2.3.*
    // 2. CIDR format:         1.2.3/24  OR  1.2.3.4/255.255.255.0
    // 3. Start-End IP format: 1.2.3.0-1.2.3.255
    // The function will return true if the supplied IP is within the range.
    // Note little validation is done on the range inputs - it expects you to
    // use one of the above 3 formats.
    public function ipInRange($ip, $range) {
	if (strpos($range, '/') !== false) {
	    // $range is in IP/NETMASK format
	    list($range, $netmask) = explode('/', $range, 2);
	    if (strpos($netmask, '.') !== false) {
		// $netmask is a 255.255.0.0 format
		$netmask = str_replace('*', '0', $netmask);
		$netmask_dec = ip2long($netmask);
		return ( (ip2long($ip) & $netmask_dec) == (ip2long($range) & $netmask_dec) );
	    } else {
		// $netmask is a CIDR size block
		// fix the range argument
		$x = explode('.', $range);
		while(count($x)<4) $x[] = '0';
		list($a,$b,$c,$d) = $x;
		$range = sprintf("%u.%u.%u.%u", empty($a)?'0':$a, empty($b)?'0':$b,empty($c)?'0':$c,empty($d)?'0':$d);
		$range_dec = ip2long($range);
		$ip_dec = ip2long($ip);

		# Strategy 1 - Create the netmask with 'netmask' 1s and then fill it to 32 with 0s
		#$netmask_dec = bindec(str_pad('', $netmask, '1') . str_pad('', 32-$netmask, '0'));

		# Strategy 2 - Use math to create it
		$wildcard_dec = pow(2, (32-$netmask)) - 1;
		$netmask_dec = ~ $wildcard_dec;

		return (($ip_dec & $netmask_dec) == ($range_dec & $netmask_dec));
	    }
	} else {
	    // range might be 255.255.*.* or 1.2.3.0-1.2.3.255
	    if (strpos($range, '*') !==false) { // a.b.*.* format
		// Just convert to A-B format by setting * to 0 for A and 255 for B
		$lower = str_replace('*', '0', $range);
		$upper = str_replace('*', '255', $range);
		$range = "$lower-$upper";
	    }

	    if (strpos($range, '-')!==false) { // A-B format
		list($lower, $upper) = explode('-', $range, 2);
		$lower_dec = (float)sprintf("%u",ip2long($lower));
		$upper_dec = (float)sprintf("%u",ip2long($upper));
		$ip_dec = (float)sprintf("%u",ip2long($ip));
		return ( ($ip_dec>=$lower_dec) && ($ip_dec<=$upper_dec) );
	    }

	    #echo 'Range argument is not in 1.2.3.4/24 or 1.2.3.4/255.255.255.0 format';
	    return false;
	}

    }


}

?>
