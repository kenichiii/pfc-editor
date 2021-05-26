<?php 

namespace {

     defined('\PFC\WebApp\APPLICATION_PATH')
        || define('PFC\WebApp\APPLICATION_PATH', realpath(dirname(__FILE__) ).
                '/../_app'
                );
     
         defined('\PFC\WebApp\LIBRARY_PATH')
        || define('PFC\WebApp\LIBRARY_PATH', realpath(dirname(__FILE__) ).
                '/../_app/library'
                );
    
 require_once \PFC\WebApp\APPLICATION_PATH . '/config/EditorConfig.php';
 require_once \PFC\WebApp\LIBRARY_PATH . '/PFC/WebApp/AppSess.php';
 require_once \PFC\WebApp\LIBRARY_PATH . '/PFC/WebApp/AppLogin.php';

 //shortcut App 
 use PFC\WebApp\AppLogin;
 use PFC\WebApp\AppSess;
 use freePad\Config\freePadConfig;
 
 //start private session
 @session_start();
 AppSess::start();
  
  if(!freePadConfig::nologin() && !AppLogin::isLogged()) {
      die('NOT ALLOWED - NO USER');
  }
  
  
}

