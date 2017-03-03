<?php

namespace PFC\WebApp;

class AppLogin
{
    const BAN_TIME_LENGTH = 600; //60*10
    
    public static function getLoggedUserLogin()
    {
        $appname = APPNAME;
        $config = "\\{$appname}\\Config\\WebAppConfig";
        
         //set no login username
        if($config::nologin()) {
            return $config::default_username();    
        }
        
        if(Router::isLoginActionRequest()
           && is_dir(DATA_PATH.'/'.filter_input(INPUT_POST, 'login'))     
            ) {         
            return filter_input(INPUT_POST, 'login');
        }
        
        return isset(AppSess::ins()['pfc-login-username'])
            ? AppSess::ins()['pfc-login-username']
            : '_guest';
    }
    
    public static function verify($login,$pwd,$pin)
    {
        $appname = APPNAME;                
        $user_config = "\\{$appname}\\Config\\UserData\Account";
                
      	  //AppSess::set('pfc-login', false);   	
      
          AppLogin::checkLoginTryies(); 
     
          AppLogin::setFreeForLogingAccess();  
        
      return   
        $login == $user_config::authLogin()
        && AppCryptor::getIns()->verify($pwd, $user_config::authPwd()) 
        && AppCryptor::verifyDateFloatingPin($pin, $user_config::authPin())
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
      $appname = APPNAME;
      $config = "\\{$appname}\\Config\\WebAppConfig";
      
      if($config::nologin()) {
          return true;
      }  
        
      $sess = AppSess::ins();  
              
        $test = isset($sess['pfc-login']) && $sess['pfc-login'] ? true : false;
                                
        return $test; 
    }
    
    public static function logout() {
        self::setLoginTryies([]);   
        AppSess::set('pfc-login', false);
        AppSess::set('pfc-login-username', null);
    }
}

