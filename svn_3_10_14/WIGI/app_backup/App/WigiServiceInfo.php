<?php

/*
 * This class represents the Wigi service information
 */

/**
 *
 * @author nhenehan 1st rev
 */
class WigiServiceInfo {

    private $httplog;
    private $modules;
    private $modmap;
    private $curstats;

    public function __construct() {
        date_default_timezone_set('EST');
        $this->httplog = "/u/logs/error_log";
        $this->modules = array("mobws", "cw", "posws", "mw");
        $this->modmap = array('mobws' => "IPhone Webservice", 'cw' => "Consumer Web", 'posws' => "POS Webservice", 'mw' => "Merchant Web");
        $curstats = array();

        foreach ($this->modules as $module) {
            $curstats[$module]["num"] = 1;
            $curstats[$module]["avg"] = 1;
            $curstats[$module]["max"] = 0;
            $curstats[$module]["maxevt"] = 1;
            $curstats[$module]["totaltime"] = 0;
            $curstats[$module]["uip"] = array();
        }

        if (preg_match("/client (.*?)\].*Times.*\|MOD\|.*EVENT\|(.*?)\|.*TOTAL\(.*?)\|/", $this->httplog, $module)) {
            $this->curstats[$module[2]]["num"]++;
            $this->curstats[$module[2]]["totaltime"]+=$module[4];
            if (!array_key_exists($module[1], $curstats[$module[2]]['uip'])) {
                $this->curstats[$module[2]]['uip'][$module[1]] = 0;
            }
            $this->curstats[$module[2]]['uip'][$module[1]]++;
            if ($this->curstats[$module[2]]["max"] < $module[4]) {
                $this->curstats[$module[2]]["max"] = $module[4];
                $this->curstats[$module[2]]["maxevt"] = $module[3];
            }
        }
    }
    
    public function getNumberOfRequests( $module ){
        return $this->curstats[$module]["num"];
    }
    public function getAverageReqTime( $module ){
        return $this->curstats[$module]["avg"];
    }
    public function getLongestReqTime( $module ){
        return $this->curstats[$module]["max"];
    }
    public function getUniqueClients( $module ){
        return $this->curstats[$module]["num"];
    }
    public function getLongestEvtTime( $module ){
        arsort( $this->curstats[$module]["uip"] );
        return $this->curstats[$module]["uip"];
    }
}

?>
