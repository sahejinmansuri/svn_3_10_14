<?php

class App_DataUtils {

    public static function getStates() {
      return array (
 'AP' => 'Andhra Pradesh',
 'AR' => 'Arunachal Pradesh',
 'AS' => 'Assam',
 'BR' => 'Bihar',
 'CT' => 'Chhattisgarh',
 'GA' => 'Goa',
 'GJ' => 'Gujarat',
 'HR' => 'Haryana',
 'HP' => 'Himachal Pradesh',
 'JK' => 'Jammu & Kashmir',
 'JH' => 'Jharkhand',
 'KA' => 'Karnataka',
 'KL' => 'Kerala',
 'MP' => 'Madhya Pradesh',
 'MH' => 'Maharashtra',
 'MN' => 'Manipur',
 'ML' => 'Meghalaya',
 'MZ' => 'Mizoram',
 'NL' => 'Nagaland',
 'OR' => 'Odisha',
 'PB' => 'Punjab',
 'RJ' => 'Rajasthan',
 'SK' => 'Sikkim',
 'TN' => 'Tamil Nadu',
 'TR' => 'Tripura',
 'UK' => 'Uttarakhand',
 'UP' => 'Uttar Pradesh',
 'WB' => 'West Bengal',
 'AN' => 'Andaman & Nicobar',
 'CH' => 'Chandigarh',
 'DN' => 'Dadra and Nagar Haveli',
 'DD' => 'Daman & Diu',
 'DL' => 'Delhi',
 'LD' => 'Lakshadweep',
 'PY' => 'Puducherry',
);
    }

    public static function beginTransaction() {

        $dbh_wigi     = Zend_Registry::get('wigi');
        $dbh_wigi_log = Zend_Registry::get('wigi_log');
        $dbh_wigi_safe= Zend_Registry::get('wigi_safe');

        $dbh_wigi->beginTransaction();
        $dbh_wigi_log->beginTransaction();
        $dbh_wigi_safe->beginTransaction();

    }

    public static function commit() {

        $dbh_wigi     = Zend_Registry::get('wigi');
        $dbh_wigi_log = Zend_Registry::get('wigi_log');
        $dbh_wigi_safe= Zend_Registry::get('wigi_safe');

        $dbh_wigi->commit();
        $dbh_wigi_log->commit();
        $dbh_wigi_safe->commit();

    }

    public static function getStateFromZip($zip) {

        $shortzip = substr($zip,0,3);
        $table = new App_Models_Db_Wigi_ZipCodes();
        $row = $table->fetchRow( $table->select()->where('zip LIKE ?', "$shortzip%") );
        if (count($row) == 0) { throw new App_Exception_WsException('Zip code is invalid'); }
        return $row['full_state'];
    }

    public static function passwordStrength($value) {

        $isValid = true;

        if (strlen($value) < 8) {
            $isValid = false;
        }

        if (strlen($value) > 16) {
            $isValid = false;
        }

        if (!preg_match('/[A-Z]/', $value)) {
            $isValid = false;
        }

        if (!preg_match('/[a-z]/', $value)) {
            $isValid = false;
        }

        if (!preg_match('/\d/', $value)) {
            $isValid = false;
        }

        return $isValid;


    }


    public static function getVersion() {

        $table = new App_Models_Db_Wigi_BeVersion();
        $row = $table->fetchRow( $table->select() );
        return $row['be_version'];
    }


  static function removeFromArrayByValue($array,$value) {
    $result = array();
    foreach ($array as $val) {
      if ($value !== $val) {
        array_push($result,$val);
      }
    }
    return $result;
  }

  static function blankarray(&$array) {
    foreach($array as $key => $val) {
      $array[$key] = "";
    }
  }

  static function generateUniqueRandoms($min, $max, $count)  {
    $numArray = array();

    for ($i=0; $i < $count; $i++) {
      do {
        $matched = false;
        $testrand = mt_rand($min,$max);
        foreach ($numArray as $val) {
          if ($testrand == $val) {
            $matched = true;
          }
        }
      } while ($matched == true);
      array_push($numArray,$testrand);
    }

    return $numArray;
  }

  static function fmtphone($string) {
    return preg_replace("/(\d\d\d)(\d\d\d)(\d\d\d\d)/","($1)$2-$3",$string);
  }

  static function getCronExtInfo() {
            $extinfo["osid"]          = "";
            $extinfo["devicetod"]     = "";
            $extinfo["appversion"]    = "";
            $extinfo["devicemodel"]   = "";
            $extinfo["systemname"]    = "";
            $extinfo["systemversion"] = "";
            $extinfo["gps"]           = "";
            $extinfo["appname"]       = "";
            $extinfo["language"]      = "";
            $extinfo["ip_address"]    = "";
            $extinfo["server_datetime"]    = "";
            $extinfo["client_datetime"]    = "";
            $extinfo["os"]    = "";
            $extinfo["browser_string"]    = "";

            return $extinfo;
  }

  static function getDBHandle($dbname="") {
    return Zend_Registry::get($dbname);
  }

  static function log($string) {
    $fp = fopen('/tmp/wigi.log', 'a');
    fwrite($fp, "$string \n");
    fclose($fp);
  }

  static function shift_datetime($datetime, $timezone, $daysoff=0) {

    $tz = App_DataUtils::extractTZ($timezone);
    $zd = new Zend_Date();
    $zd->setTimezone( App_DataUtils::extractTZ($timezone) );
    $zd->set($datetime, Zend_Date::ISO_8601);
    $zd->setTimezone('GMT');
    if ($daysoff > 0) {
      $zd->add($daysoff, Zend_Date::DAY);
    }
    $a = $zd->toArray();

    return $a["year"] . "-" . $a["month"] . "-" . $a["day"] . " " . $a["hour"] . ":" . $a["minute"] . ":" . $a["second"];

    //return gmdate("Y-m-d H:i:s", $zd->getTimestamp());

  }

  static function datetime_fmtdate($datetime,$timezone) {
    /*preg_match('/(\d\d\d\d)-(\d\d)-(\d\d) (\d\d):(\d\d):(\d\d)/',$datetime,$m);
    $year  = $m[1];
    $month = $m[2];
    $day   = $m[3];
    $hour  = $m[4];
    $min   = $m[5];
    $sec   = $m[6];

    return "$month-$day-$year";*/

    $tz = App_DataUtils::extractTZ($timezone);
    $zd = new Zend_Date($datetime, Zend_Date::ISO_8601);

    if ($timezone !== "") {
      $zd->setTimezone( App_DataUtils::extractTZ($timezone) );
    }

    $a = $zd->toArray();

    return $a["month"] . "-" . $a["day"] . "-" . $a["year"];


  }

  static function datetime_fmttime($datetime,$timezone) {
    /*preg_match('/(\d\d\d\d)-(\d\d)-(\d\d) (\d\d):(\d\d):(\d\d)/',$datetime,$m);
    $year  = $m[1];
    $month = $m[2];
    $day   = $m[3];
    $hour  = $m[4];
    $min   = $m[5];
    $sec   = $m[6];

    return "$hour:$min:$sec";*/

    $tz = App_DataUtils::extractTZ($timezone);
    $zd = new Zend_Date($datetime, Zend_Date::ISO_8601);
    $zd->setTimezone( App_DataUtils::extractTZ($timezone) );
    $a = $zd->toArray();

    return $a["hour"] . ":" . $a["minute"] . ":" . $a["second"];


  }

  static function fmttime_datetime($fmttime) {
    preg_match('/(\d\d)-(\d\d)-(\d\d\d\d)/',$fmttime,$m);
    $year   = $m[3];
    $month  = $m[1];
    $day    = $m[2];

    return "$year-$month-$day";
  }


  static function date2human($datetime,$timezone,$dateonly=false) {

    $tz = App_DataUtils::extractTZ($timezone);
    $zd = new Zend_Date($datetime, Zend_Date::ISO_8601);
    $zd->setTimezone( App_DataUtils::extractTZ($timezone) );

    if ($dateonly) {
      return $zd->get(Zend_Date::MONTH_NAME_SHORT . " " . Zend_Date::DAY . ", " . Zend_Date::YEAR);
    } else {
      return $zd;
    }

  }

  static function extractTZ($timezone) {

    $result = "Asia/Kolkata";
 
    switch ($timezone) {
      case "0.0":
        $result = "GMT";
        break;
      case "-5.0":
        $result = "America/New_York";
        break;

      case "-6.0":
        $result = "America/Chicago";
        break;

      case "-7.0":
        $result = "America/Denver";
        break;

      case "-8.0":
        $result = "America/Los_Angeles";
        break;
		case "5.5":
        $result = "Asia/Kolkata";
        break;

    }

    return $result;
  }

  static function hoursAgo($hours) {
    return date("Y-m-d H:i:s",strtotime("$hours hours ago"));
  }

  static function fmtCode($code) {
    return preg_replace('/(\d\d\d)(\d\d)(\d\d\d\d)/', "$1-$2-$3", $code);
    //$ac = str_split($code);
    //return $ac[0] . $ac[1] . $ac[2] . "-" . $ac[3] . $ac[4] . "-" . $ac[5] . $ac[6] . $ac[7] . $ac[8];
  }

  public static function getRandAmt() {
    setlocale(LC_MONETARY, 'en_US');
    return money_format('%i', rand(1,15)/100);
  }

  public static function fmtMoney($amt) {
    setlocale(LC_MONETARY, 'en_US');
    return money_format('%i', $amt);
  }

  public static function fmtdate_human2db($date) {
    $ac = explode('/',$date);
    return $ac[2] . "-" . $ac[0] . "-" . $ac[1];
  }

  public static function userlog($type,$ref_id,$table,$description,$ip_address,$gps,$device_datetime,$server_datetime,$app_name,$app_version,$os_version,$device_model,$browser_string,$os_id,$cellphone,$email,$language) {

    $sp  = new App_Db_Sp_UserLog();
    $res = $sp->getSimpleResponse(array( 
					'TYPE' =>$type, 
					'REF_ID'=>$ref_id, 
                                        'TABLE'=>$table,
                                        'DESCRIPTION'=>$description,
                                        'IP_ADDRESS'=>$ip_address,
                                        'GPS'=>$gps,
                                        'DEVICE_DATETIME'=>$device_datetime,
                                        'SERVER_DATETIME'=>$server_datetime,
                                        'APP_NAME'=>$app_name,
                                        'OS_VERSION'=>$os_version,
                                        'DEVICE_MODEL'=>$device_model,
                                        'BROWSER_STRING'=>$browser_string,
                                        'OS_ID'=>$os_id,
                                        'CELLPHONE'=>$cellphone,
                                        'EMAIL'=>$email,
					'LANGUAGE'=> $language,
                                        'APP_VERSION'=>$app_version));

  }

  public static function userlogp($type,$ref_id,$table,$description) {
    $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
    App_DataUtils::userlog($type,
                           $ref_id,
                           $table,
                           $description,
                           getenv('REMOTE_ADDR'),
                           $ns->extinfo["gps"],
                           $ns->extinfo["devicetod"],
                           date("Y-m-d H:i:s"),
                           $ns->extinfo["appname"],
                           $ns->extinfo["appversion"],
                           $ns->extinfo["systemversion"],
                           $ns->extinfo["devicemodel"],
                           getenv('HTTP_USER_AGENT'),
                           $ns->extinfo["osid"],
                           $ns->countrycode . $ns->cellphone,
                           $ns->email,
                           $ns->extinfo["language"]);
  }

  public static function updateLogin($userid,$application,$ip,$browser,$client_type) {

    $sp  = new App_Db_Sp_LoginHistoryUpdate();
	if(!$application){
		$application = "";
	}
	if(!$browser){
		$browser = "";
	}
    $res = $sp->getSimpleResponse(array(
                                        'USERID' =>$userid,
                                        'APP'=>$application,
                                        'IP'=>$ip,
                                        'BROWSER'=>$browser,
                                        'CLIENT_TYPE'=> $client_type));

  }

  public static function rawobfuscate($string) {
    $key = '_';
    $array = str_split($string);
    $result = "";
    foreach($array as $char) {
      $result .= ($char ^ $key);
    }
    return $result;

  }

  public static function obfuscate($string) {
    $encstring = App_DataUtils::rawobfuscate($string);
    return base64_encode($encstring);
  }

  public static function unobfuscate($string) {
    $encstring = base64_decode($string);
    return App_DataUtils::rawobfuscate($encstring);
  }

}

?>
