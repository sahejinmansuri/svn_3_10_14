<?php

/**
 * This is a utility class / namespace used to work
 * with different formats coming from the SOAP Services
 * 
 * @author rramirez
 */
class App_Ws_Utils
{

    /**
     * Casts a SimpleXmlElement to string
     *
     * @param SimpleXmlElement $xmlNode
     */
    public static function wsToString($xmlNode)
    {
        $str = (string) $xmlNode;
        if (!($xmlNode instanceof SimpleXmlElement)) {
            return $str;
        }

        $tagName = $xmlNode->getName();

        switch ($tagName) {
            case 'SSN':
            case 'AppendSSN':
                return preg_replace('/(\w\w\w).*(\w\w).*(\w\w\w\w)/', '$1-$2-$3', $str);
                break;
        }

        return $str;
    }

    /**
     * Casts a SimpleXmlElement to string
     *
     * @param SimpleXmlElement $xmlNode
     */
    public static function wsSsnToString($xmlNode, $mask=null)
    {
        $str = (string) $xmlNode;

        if ($mask == 'all') {
            return 'xxx-xx-xxxx';
        } else if ($mask == 'first5') {
            return preg_replace('/(\w\w\w).*(\w\w).*(\w\w\w\w)/', 'xxx-xx-$3', $str);
        } else if ($mask == 'none') {
            return preg_replace('/(\w\w\w).*(\w\w).*(\w\w\w\w)/', '$1-$2-$3', $str);
        }

        // defaults to last 4
        return preg_replace('/(\w\w\w).*(\w\w).*(\w\w\w\w)/', '$1-$2-xxxx', $str);
    }

    /**
     * Takes a date from the WS output in the form of
     * a SimpleXML and returns a US format date string
     * 
     * @param SimpleXML $xmlDate
     * @return string
     */
    public static function wsDateToString($xmlDate)
    {
        $date = (string) new App_Ws_Types_Date($xmlDate);
        return $date;
    }

    public static function wsDobToString($xmlDate, $mask=null)
    {
        $ret = '';
        $date = (string) new App_Ws_Types_Date($xmlDate);
        if (preg_match('/(\w\w)\/(\w\w)\/(\w\w\w\w)/', $date)) {
            // mask mm/dd/yyyy format
            $ret = self::wsDobToStringMonDayYear($date, $mask);
        } else {
            // mask mm/yyyy format
            $ret = self::wsDobToStringMonYear($date, $mask);
        }

        return $ret;
    }

    private static function wsDobToStringMonDayYear($date, $mask)
    {
        if ($mask == 'all') {
            return 'xx/xx/xxxx';
        } else if ($mask == 'none') {
            return $date;
        } else if ($mask == 'year') {
            return preg_replace('/(\w\w)\/(\w\w)\/(\w\w\w\w)/', '$1/$2/xxxx', $date);
        } else if ($mask == 'month') {
            return preg_replace('/(\w\w)\/(\w\w)\/(\w\w\w\w)/', 'xx/$2/$3', $date);
        }


        // defaults to day
        return preg_replace('/(\w\w)\/(\w\w)\/(\w\w\w\w)/', '$1/xx/$3', $date);
    }

    private static function wsDobToStringMonYear($date, $mask)
    {
        if ($mask == 'all') {
            return 'xx/xxxx';
        } else if ($mask == 'none') {
            return $date;
        } else if ($mask == 'year') {
            return preg_replace('/(\w\w)\/(\w\w\w\w)/', '$1/xxxx', $date);
        } else if ($mask == 'month') {
            return preg_replace('/(\w\w)\/(\w\w\w\w)/', 'xx/$2', $date);
        }

        // defaults to masking day... don't need to mask since day is not given
        return $date;
    }

    public static function wsPhoneToString($xmlPhone)
    {
        if (($xmlPhone instanceof SimpleXmlElement)) {
            $xmlPhone = (string) $xmlPhone;
        }

        return $xmlPhone;
    }

    /**
     * Takes an address from the WS output in the form of
     * a SimpleXML and returns a US format address string
     * 
     * @param SimpleXML $xmlAddress
     * @return string
     */
    public static function wsAddressToString($xmlAddress)
    {
        return (string) new App_Ws_Types_Address($xmlAddress);
    }

    /**
     * Takes a Name structure from the WS output in the form of
     * a SimpleXML and returns a full name string
     * 
     * @param SimpleXML $xmlAddress
     * @return string
     */
    public static function wsNameToString($xmlName)
    {
        return (string) new App_Ws_Types_Name($xmlName);
    }

    /**
     * Takes a formated string address and returns an
     * associative array with the keys 'lat' and 'lng'
     * corresponding to latutude and longitude respectively
     * 
     * @param string $strAddress
     * @return array
     */
    public static function getGeoCoordinates($xmlAddr)
    {
        $coord = self::getGeoCoordinatesArr(array($xmlAddr));
        return $coord[0];
    }

    /**
     * Takes a formated string address and returns an
     * associative array with the keys 'lat' and 'lng'
     * corresponding to latutude and longitude respectively
     * 
     * @param string $strAddress
     * @return array
     */
    public static function getGeoCoordinatesArr($xmlAddrArr)
    {
        Zend_Registry::get('log')->info(__METHOD__ . '()');

        $log = Zend_Registry::get('log');
        $cfg = Zend_Registry::get('config');
        $wsdl = $cfg->paths->wsdl . '/AddressCleaner.wsdl';
        $uname = $cfg->wsutility->esp->uname;
        $passwd = $cfg->wsutility->esp->passwd;

        $ns = "http://webservices.seisint.com/WsUtility";
        $location = $cfg->wsutility->esp->endpoint . '/AddressCleaner?ver_=1.58&internal=1';
        $opts = array(
            'location' => $location,
            //'uri'=>$ns,
            'trace' => true
        );


        // Create Soap Client
        $soap = new SoapClient($wsdl, $opts);


        // Set Headers
        $header_tags = array(
            'Username' => new SOAPVar($uname, XSD_STRING, null, null, null, $ns),
            'Password' => new SOAPVar($passwd, XSD_STRING, null, null, null, $ns)
        );
        $utag = array('UsernameToken' => new SOAPVar($header_tags, SOAP_ENC_OBJECT));
        $headers = new SOAPHeader($ns, 'Security', new SOAPVar($utag, SOAP_ENC_OBJECT));
        $soap->__setSoapHeaders($headers);


        // Input
        $result = array();
        $addrArr = array();
        $i = 0;
        foreach ($xmlAddrArr as $xmlAddr) {
            $addr = new App_Ws_Types_Address($xmlAddr);
            $addrArr[] = array(
                'index' => $i,
                'AddressLine1' => $addr->getStreetLine(),
                'AddressLine2' => '',
                'City' => $addr->getCity(),
                'State' => $addr->getState(),
                'Zip' => $addr->getZip()
            );
            $result[$i] = array('lat' => 0, 'lng' => 0);
            $i++;
        }

        $in = array('Searches' => array('AddressCleanerSearchBy' => $addrArr));

        try {
            Zend_Registry::get('log')->info(__METHOD__ . '() calling ESP AddressCleaner Geo Locator');

            //
            $out = $soap->AddressCleaner($in);
            if (empty($out->response)) {
                return $result;
            }

            //
            $resp = $out->response;
            if (empty($resp->Records)) {
                return $result;
            }

            //
            $recs = $resp->Records;
            if (empty($recs->Record)) {
                return $result;
            }

            //
            if (empty($recs->Record)) {
                return $result;
            }
            /*
              echo '<pre>';
              print_r($recs->Record);
              exit;
             */

            //
            foreach ($recs->Record as $i => $rec) {
                //
                $idx = (!empty($rec->index) ? $rec->index : $i );

                //
                if (empty($rec->GeoLocationMatch)) {
                    $geo = new stdClass();
                    $geo->Latitude = 0;
                    $geo->Longitude = 0;
                } else {
                    $geo = $rec->GeoLocationMatch;
                }

                //
                $result[$idx] = array(
                    'lat' => @$geo->Latitude,
                    'lng' => @$geo->Longitude,
                );
            }
        } catch (Exception $e) {
            Zend_Registry::get('log')->warn(__METHOD__ . '() Exception thrown: ' . $e);
        }

        return $result;
    }

    /**
     * Takes a formated string address and returns an
     * associative array with the keys 'lat' and 'lng'
     * corresponding to latutude and longitude respectively
     * 
     * @param string $strAddress
     * @return array
     */
    public static function getGeoCoordinatesGoogle($strAddress, $fromCache=true)
    {
        static $cache = array();

        $log = Zend_Registry::get('log');

        $cacheKey = md5(strtolower(trim($strAddress)));
        if ($fromCache && array_key_exists($cacheKey, $cache)) {
            $log->debug(__METHOD__ . ': from cache ' . $cacheKey . ' : "' . $strAddress . '"');
            return $cache[$cacheKey];
        }


        $result = array('lat' => '', 'lng' => '');
        $strAddress = trim($strAddress);
        if (empty($strAddress)) {
            return $result;
        }

        $strAddressEscaped = urlencode($strAddress);
        $url = 'http://maps.google.com/maps/api/geocode/json?address=' . $strAddressEscaped . '&sensor=false';

        $log->debug(__METHOD__ . ': Geolocation on "' . $strAddress . '"');
        $jsonStr = file_get_contents($url);

        $json = Zend_Json::decode($jsonStr);
        if (!$json) {
            $log->warn(__METHOD__ . ' : Not able to parse JSON from GEO Location API');
            return $result;
        }

        $lat = @$json['results'][0]['geometry']['location']['lat'];
        $lng = @$json['results'][0]['geometry']['location']['lng'];
        if (empty($lat)) {
            $log->warn(__METHOD__ . ' : GEO Location Returned Nothing');
            return $result;
        }

        $result['lat'] = (double) $lat;
        $result['lng'] = (double) $lng;
        $cache[$cacheKey] = $result;

        return $result;
    }

    public static function wsIdentity2array($identity, $mask=null)
    {
        $sub = array(); //sub section
        $sub['Name'] = App_Ws_Utils::wsNameToString($identity->Name);
        $sub['Age'] = App_Ws_Utils::wsToString($identity->Age);
        $sub['DOB'] = App_Ws_Utils::wsDateToString($identity->DOB);
        $sub['SSN'] = App_Ws_Utils::wsSsnToString($identity->SSNInfo->SSN, $mask);
        $sub['Location'] = App_Ws_Utils::wsToString($identity->SSNInfo->IssuedLocation);
        $sub['Start Date'] = App_Ws_Utils::wsDateToString($identity->SSNInfo->IssuedStartDate);
        $sub['End Date'] = App_Ws_Utils::wsDateToString($identity->SSNInfo->IssuedEndDate);

        // unset empty entries in $sub
        foreach ($sub as $k => $v) {
            if (empty($v)) {
                unset($sub[$k]);
            }
        }
        return $sub;
    }

}

