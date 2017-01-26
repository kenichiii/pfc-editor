<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

//get global namespace
namespace {

 //shortcut App 
 use PFC\Editor\App;
 use PFC\Editor\AppLogin;
 use PFC\Editor\AppSess;
 use PFC\Editor\Router;
 use PFC\Editor\Config;
 
//get application autoload, settings and libraries
 require_once 'bootstrap/master.php';        
  
 //start private session
 session_start();
 AppSess::start();  
 
 //check if is installed 
 
 //set no login username
 if(Config::nologin) {
    AppSess::set('pfc-login-username', 'default-user');    
 }
 
 //public services   
  if((AppLogin::isLogged()) 
    || Router::isServerTimeRequest() || Router::isLoginActionRequest()
    ) {       

                      defined('\PFC\Editor\USER_DATA_PATH')
                        || define('PFC\Editor\USER_DATA_PATH', PFC\Editor\DATA_PATH.
                                '/users/'.AppLogin::getLoggedUserLogin()
                            );
      
                      defined('\PFC\Editor\SANDBOX_PATH')
                        || define('PFC\Editor\SANDBOX_PATH', PFC\Editor\USER_DATA_PATH.
                                '/sandbox'
                            );

                      defined('\PFC\Editor\MY_HOME_PATH')
                        || define('PFC\Editor\MY_HOME_PATH', PFC\Editor\USER_DATA_PATH.
                                '/my-home'
                            );

                      defined('\PFC\Editor\MY_NOTES_TXT_PATH')
                        || define('PFC\Editor\MY_NOTES_TXT_PATH', PFC\Editor\USER_DATA_PATH.
                                '/my-home/_notes.txt'
                            );
                      
        if(Router::isSandboxRequest()) {                        
            //include requested file from sandbox
    	    require Router::getRequestFilePath();    
            exit;
            
        } else {
            //get controller class from request
            $controllerClassName = Router::getRequestControllerClass();           
        }
    }      
  else {                     
          $controllerClassName = '\\pfcEditor\\Layout\\login';           
    }
     
            //initialize controller                           
            $controller = new $controllerClassName;
         
            //get current view
            $view = $controller->dispatch();
         
            //send current HTTP headers
            $view->headers();
         
            //render view to client as string
            echo $view->render();
            
} //end namespace


