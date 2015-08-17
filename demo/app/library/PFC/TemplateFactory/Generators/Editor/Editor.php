<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace PFC\TemplateFactory\Generators\Editor;

    use \PFC\Editor\Config as AppConfig;
    use \PFC\Editor\AppSess;
	use \PFC\Editor\AppCryptor;
	use \PFC\Editor\AppLogin;
            
    
class Editor extends \PFC\TemplateFactory\TemplateFactory
{
    public static function writeConfigFile($_params,$line='<br>')
    {
        
                foreach ($_params as $key=>$value)
                {                
                    if(is_array($key)) 
                    {            
                        ${$key} = $key;
                    }
                    else    
                    ${$key} = $value;
                }
                
                $_return = "";    
              

                $salt = isset($salt) ? $salt : AppConfig::$SALT;
                $name  = isset($name) ? $name : AppConfig::$name;
                $assetsurl= isset($assetsurl) ? $assetsurl : AppConfig::$assetsUrl;
				$sounds = isset($sounds) ? $sounds : (AppConfig::$sounds?'true':'false');

                $webmasterauthemail = isset($webmasterauthemail) ? $webmasterauthemail : AppConfig::$authEmail;    
                $webmasterauthlogin = isset($webmasterauthlogin) ? $webmasterauthlogin : AppConfig::$authLogin;    
                
                $webmasterauthpin = isset($webmasterauthpin) ? $webmasterauthpin : AppConfig::$authPin;    

                $crypting = isset($crypting) ? $crypting : AppConfig::$crypting  ; 
                $bcryptrounds = isset($bcryptrounds) ? $bcryptrounds : AppConfig::$BcryptRounds;  
      
      
                $displayerrors = isset($displayerrors) ? $displayerrors : AppConfig::$displayErrors;
                $errorreportimg = isset($errorreportimg) ? $errorreportimg : (AppConfig::$errorReporting == 32767 ? 'E_ALL' : AppConfig::$errorReporting);
                $upload_max_filesize = isset($upload_max_filesize) ? $upload_max_filesize : AppConfig::$upload_max_filesize;
                $post_max_size = isset($post_max_size) ? $post_max_size : AppConfig::$post_max_size;
                $default_timezone = isset($default_timezone) ? $default_timezone : AppConfig::$default_timezone;
                $session_cache_expire = isset($session_cache_expire) ? $session_cache_expire : AppConfig::$session_cache_expire;         

	if(isset($webmasterauthpwd) && $webmasterauthpwd!="")
  	{
      if($webmasterauthpwd!=$webmasterauthpwd2) return 'PASSWORDS DONT MATCH';
    }
                
                if(AppSess::encodeSessionName($name,$salt)!=AppSess::getSessionName())
                {
                    $_SESSION[AppSess::encodeSessionName($name,$salt)]=AppSess::ins();    
                }
                
      			if($crypting!=AppConfig::$crypting)
                {
                  AppLogin::setUserLoggedIn($webmasterauthpwd);
                	$webmasterauthpwd = $crypting == AppCryptor::USE_Simple
                      ? AppCryptor::getSimple()->hash($webmasterauthpwd)
                      : AppCryptor::getBcrypt()->hash($webmasterauthpwd)
                    ;      
                  
                }
				elseif(isset($webmasterauthpwd) && $webmasterauthpwd!="")
                {
                    AppLogin::setUserLoggedIn($webmasterauthpwd);
                	$webmasterauthpwd = AppCryptor::getIns()->hash($webmasterauthpwd);
                }
				else {
                  	$webmasterauthpwd = AppConfig::$authPwd;
                }
                            //TEST PHP INI
                            ini_set('upload_max_filesize', $upload_max_filesize);
                            $upload_max_filesize_test = ini_get('upload_max_filesize');
                            if($upload_max_filesize_test!=$upload_max_filesize&&intval($upload_max_filesize_test)<intval($upload_max_filesize)) 
                                $_return .= "{$line} ERROR PHP INI upload_max_filesize is set to {$upload_max_filesize_test} {$line}{$line}";

                            ini_set('post_max_size', $post_max_size);
                            $post_max_size_test = ini_get('post_max_size');
                            if($post_max_size_test!=$post_max_size&&intval($post_max_size_test)<intval($post_max_size)) 
                                $_return .= "{$line} ERROR PHP INI upload_max_filesize is set to {$post_max_size_test} {$line}{$line}";

                            date_default_timezone_set(AppConfig::$default_timezone);
                            $default_timezone_test = date_default_timezone_get();

                                    if($default_timezone_test!=$default_timezone) {
                                        $_return .= "{$line} ERROR PHP INI date_default_timezone is set to {$default_timezone_test} {$line}{$line}";
                                    }

                                    ini_set('session.cache_expire', intval($session_cache_expire));
                                    $session_cache_expire_test = ini_get('session.cache_expire');
                                    if($session_cache_expire_test!=intval($session_cache_expire))
                                        $_return .=  "{$line} ERROR PHP INI session.cache_expire is set to {$session_cache_expire_test} {$line}{$line}";

                                    ini_set('display_errors',$displayerrors);
                                    $displayerrors_test = ini_get('display_errors');
                                    if($displayerrors_test!=intval($displayerrors)) 
                                        $_return .= "{$line} ERROR PHP INI display_errors is set to {$displayerrors_test} {$line}{$line}";



                    //WRITE CONFIG FILE
                    ob_start();

                        require self::getTemplateFile('config/Editor.php');

                    $code = ob_get_contents();
                    ob_end_clean();

                    $code = self::decodeTemplate(self::translatePHP($code));
                    
                    if(file_put_contents(\PFC\Editor\APPLICATION_PATH.'/config/Editor.php', $code))
                    {
                        $_return .= "{$line}Config file has been written{$line}You should reload page to see changes{$line}";

                        //App::cache()->clean();
                    }
                    else $_return .= "{$line}ERROR - writing config file{$line}{$line}";
            
        return $_return;
    }
}    

