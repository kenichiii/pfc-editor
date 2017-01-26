<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace PFC\Editor;

use PFC\Editor\AppSess;
use PFC\Editor\AppCryptor;
use pfcUserData\Config\Settings as settings;

class AppLogin
{
    const BAN_TIME_LENGTH = 600; //60*10
    
    public static function getLoggedUserLogin()
    {
        return isset(AppSess::ins()['pfc-login-username'])
            ? AppSess::ins()['pfc-login-username']
            : '__GUEST__';
    }
    
    public static function verify($login,$pwd,$pin)
    {
      	  //AppSess::set('pfc-login', false);   	
      
          AppLogin::checkLoginTryies(); 
     
          AppLogin::setFreeForLogingAccess();  
        
      return   
        $login == settings::authLogin
        && AppCryptor::getIns()->verify($pwd, settings::authPwd) 
        && AppCryptor::verifyDateFloatingPin($pin)
        && self::isFreeForLoging()
       ;
    }    
    
    protected static $freeForLoging = true;
    
    public static function isFreeForLoging() {
        return self::$freeForLoging;
    }
    
    public static function isNotBanned() {
      $sess = AppSess::ins();
        return (!isset($sess['pfc-login-bannedTo'])
          || $sess['pfc-login-bannedTo'] < time());
    }
    
    public static function setFreeForLogingAccess() {
        //check too much login lock   
        
        if (self::isNotBanned()) {            
            self::$freeForLoging = true;
        } else { 
            self::$freeForLoging = false;
        }
    }
    
    public static function getBannedToTime() {
      $sess = AppSess::ins();
      return $sess['pfc-login-bannedTo'];
    }
    public static function setBannedToTime($t) {
        AppSess::set('pfc-login-bannedTo',$t);    
    }
    
    public static function getLoginTryies() {
       $sess = AppSess::ins();
      
       if (!isset($sess['pfc-login-tryies']) || !is_array($sess['pfc-login-tryies'])) {
         self::setLoginTryies([]);
       }            
      
       return isset($sess['pfc-login-tryies']) ? $sess['pfc-login-tryies'] : [];
    }
    
    public static function setLoginTryies($v) {
        return AppSess::set('pfc-login-tryies',$v);
    }
    
    public static function checkLoginTryies() {

     $logintryies = self::getLoginTryies();       
     
     $logintryies []= time();
     
     $now = time();
     
     foreach ($logintryies as $key=>$logintry) {
       		if ($now-$logintry>60*5) {
                    unset($logintryies[$key]);
                }
     }     
     
     self::setLoginTryies($logintryies);   
          
     if ( count($logintryies) > 5 ) {
         self::setBannedToTime((time()+600));         
     }

    }
    
    public static function setUserLoggedIn($login, $pwd) {
        AppSess::set('pfc-login', true);   
        AppSess::set('pfc-login-username', $login);   
    }
    
    public static function isLogged() {
      
      if(Config::nologin) {
          return true;
      }  
        
      $sess = AppSess::ins();  
              
        $test = isset($sess['pfc-login']) && $sess['pfc-login'] ? true : false;
                                
        return $test; 
    }
    
    public static function logout() {
        self::setLoginTryies([]);   
        AppSess::set('pfc-login',false);
    }
}

