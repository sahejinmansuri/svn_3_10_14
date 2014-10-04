<?php
class App_Types_Merchant
{
    const INDIVIDUAL          = 1; 
    const SOHO                = 2; 
    const SMALL_BUSINESS      = 3; 
    const LARGE_BUSINESS      = 4; 
    const NON_PROFIT          = 5; 
    const GOVERNMENT          = 6; 
    const ASSOCIATION         = 7;
    
    private function  __construct() {}
    
    public static function getConstName($c=0) {
        $stat = array();
        $stat[self::INDIVIDUAL                   ] = 'Individual'; 
        $stat[self::SOHO                         ] = 'SOHO';
        $stat[self::SMALL_BUSINESS               ] = 'Small Business';
        $stat[self::LARGE_BUSINESS               ] = 'Large Business';
        $stat[self::NON_PROFIT                   ] = 'Non-Profit';
        $stat[self::GOVERNMENT                   ] = 'Government';
        $stat[self::ASSOCIATION                  ] = 'Association';

        return ($c)?$stat[$c]:$stat;
   }



}
