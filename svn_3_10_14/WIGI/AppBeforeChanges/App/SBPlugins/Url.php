<?php

class App_SBPlugins_Url
{

    public static function getPlugin($url) {
       if (preg_match('/^http:\/\/wigime.com\/PTALA\/products\/096208770X\//',$url)) {
         $result = new App_SBPlugins_PTALA_PTALA($url);
         return $result;
       } 
    }

}
