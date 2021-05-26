<?php

namespace PFC\WebApp;

class AppCryptor
{
    const USE_Bcrypt = 'bcrypt';
    const USE_Simple = 'simple';    
    
    protected static $cry=null;
    public static function getIns() {
        $appname = APPNAME;
        $config = "\\{$appname}\\Config\\WebAppConfig";
        
        if(self::$cry===null)
        {
            if($config::crypting == self::USE_Bcrypt && \PFC\Crypting\Bcrypt::isEnabled())
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
        $appname = APPNAME;
        $config = "\\{$appname}\\Config\\WebAppConfig";
        
        return new \PFC\Crypting\Simple($config::SALT());
    }
  
    public static function getBcrypt() {
        $appname = APPNAME;
        $config = "\\{$appname}\\Config\\WebAppConfig";
        
        return new \PFC\Crypting\Bcrypt($config::BcryptRounds());
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

