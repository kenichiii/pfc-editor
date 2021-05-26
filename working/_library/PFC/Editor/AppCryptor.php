<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/


namespace PFC\Editor;

use \PFC\Editor\Config as AppConfig;

class AppCryptor
{
    const USE_Bcrypt = 'bcrypt';
    const USE_Simple = 'simple';    
    
    protected static $cry=null;
    public static function getIns() {
        if(self::$cry===null)
        {
            if(\PFC\Editor\Config::crypting == self::USE_Bcrypt && \PFC\Crypting\Bcrypt::isEnabled())
            {
                    self::$cry = self::getBcrypt();
            }
            else {
                    self::$cry = self::getSimple();
            }
        }
        return self::$cry;
    }

    public static function getSimple() {
        return new \PFC\Crypting\Simple(AppConfig::SALT);
    }
  
    public static function getBcrypt() {
        return new \PFC\Crypting\Bcrypt(AppConfig::BcryptRounds);
    }
    
    public static function verifyDateFloatingPin($input, $auth) {
        return $input == self::getDateFloatingPin($auth) || $input == self::getDateFloatingPinSave($auth);
    }
    
    public static function getDateFloatingPin($auth) { 
        $pin = $auth;
        $pin = str_replace('[G]', date('G'), $pin);
        $pin = str_replace('[i]', date('i'), $pin);
        return $pin;         
    }
    
    public static function getDateFloatingPinSave($auth) { 
        $pin = $auth;
        $mins = (intval(date('i'))+1);
        if($mins<10) 
        {
            $mins = "0".$mins;
        }
        else $mins = "{$mins}";
        
        $pin = str_replace('[G]', date('G'), $pin);
        $pin = str_replace('[i]', $mins, $pin);
        return $pin;         
    }

}

