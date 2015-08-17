<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace PFC\Editor;

use \PFC\Editor\AppSess;
use \PFC\Editor\AppCryptor;
use \PFC\Editor\Config as AppConfig;

class AppLogin
{
    const BAN_TIME_LENGTH = 600; //60*10
  
    public static function verify($login,$pwd,$pin)
    {
      	  //AppSess::set('pfc-login', false);   	
      
          AppLogin::checkLoginTryies(); 
     
          AppLogin::setFreeForLogingAccess();  
        
      return   
        $login == AppConfig::$authLogin
        && AppCryptor::getIns()->verify($pwd,AppConfig::$authPwd) 
        && AppCryptor::verifyDateFloatingPin($pin)
        && self::isFreeForLoging()
        ;
    }    
    
    protected static $freeForLoging = true;
    
    public static function isFreeForLoging() {
        return self::$freeForLoging;
    }
    
    public static function isNotBanned() {
        return (!isset(AppSess::ins()['pfc-login-bannedTo'])
          || AppSess::ins()['pfc-login-bannedTo'] < time());
    }
    
    public static function setFreeForLogingAccess() {
        //check too much login lock   
        
        if( 
                self::isNotBanned()
          )
        {            
            self::$freeForLoging = true;
        }
        else
        { 
            self::$freeForLoging = false;
        }
    }
    
    public static function getBannedToTime() {
        return AppSess::ins()['pfc-login-bannedTo'];
    }
    public static function setBannedToTime($t) {
        AppSess::set('pfc-login-bannedTo',$t);    
    }
    
    public static function getLoginTryies() {
        if(!isset(AppSess::ins()['pfc-login-tryies']))
          self::setLoginTryies(array());
      
        return 
           AppSess::ins()['pfc-login-tryies'];
    }
    
    public static function setLoginTryies($v) {
        return AppSess::set('pfc-login-tryies',$v);
    }
    
    public static function checkLoginTryies() {

     $logintryies = self::getLoginTryies();       
     
     $logintryies []= time();
     
     $now = time();
     
     foreach($logintryies as $key=>$logintry)
		{
       		if($now-$logintry>60*5)
              unset($logintryies[$key]);
     	}     
     
     self::setLoginTryies($logintryies);   
     
     
     if( count($logintryies) > 5 )
     {
         self::setBannedToTime((time()+600));         
     }

    }
    
    public static function setUserLoggedIn($pwd) {
        AppSess::set('pfc-login', true);   
    }
    
    public static function isLogged() {
        
       if(!isset(AppSess::ins()['pfc-login']))
        {
            AppSess::set('pfc-login',false);
        }
        
        $test = (bool) AppSess::ins()['pfc-login'];
        
        
                
        return $test; 
    }
    
    public static function logout() {
        AppSess::set('pfc-login',null);
    }
}

