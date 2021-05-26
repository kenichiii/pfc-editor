<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace PFC\Editor;

use \PFC\Editor\Config as AppConfig;

class AppSess {
    
    public static function encodeSessionName($name,$salt) {
        return md5($name.'_'.$salt);
    }
    
    public static function getSessionName() {
        return self::encodeSessionName(AppConfig::$name,AppConfig::$SALT);
    }
    
    public static function set($index,$value) {      
         $_SESSION[self::getSessionName()][$index]=$value;        
    }
    
    public static function ins() {
       
        return $_SESSION[self::getSessionName()];
    }
    
    public static function start() {
        if(!isset($_SESSION[self::getSessionName()]))                    
           $_SESSION[self::getSessionName()]=array(
               'pfc-login'=>false
           );
    }
}
