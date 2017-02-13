<?php

namespace PFC\WebApp;

class AppSess {
    
    public static function encodeSessionName($name,$salt) {
        return md5($name.'_'.$salt);
    }
    
    public static function getSessionName() {
        $appname = APPNAME;
        $config = "\\{$appname}\\Config\\WebAppConfig";
        return self::encodeSessionName($config::name(),$config::SALT());
    }
    
    public static function set($index,$value) { 
         if (!isset($_SESSION[self::getSessionName()]) || !is_array($_SESSION[self::getSessionName()])) {
             $_SESSION[self::getSessionName()] = [];
         }
             
         $_SESSION[self::getSessionName()][$index]=$value;        
    }
    
    public static function ins() {       
        return $_SESSION[self::getSessionName()];
    }
    
    public static function start() {
        if (!isset($_SESSION[self::getSessionName()]) || !is_array($_SESSION[self::getSessionName()])) {                                    
           $_SESSION[self::getSessionName()]=['pfc-login'=>false];           
        }
    }
}
