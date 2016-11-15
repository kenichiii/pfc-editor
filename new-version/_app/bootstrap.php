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
 
//get application autoload, settings and libraries
 require_once 'bootstrap/master.php';        
  
 //start private session
 session_start();
 AppSess::start();
  
 //check if is installed 
  
 //public services   
  if(AppLogin::isLogged() 
    || App::isServerTimeRequest() || App::isLoginActionRequest()
    ) {       
      
                      defined('\PFC\Editor\SANDBOX_PATH')
                        || define('PFC\Editor\SANDBOX_PATH', PFC\Editor\DATA_PATH.
                                '/users/default-user/sandbox'
                            );
      
        if(Router::isSandboxRequest()
          || Router::isAjaxRequest() || Router::isActionRequest()      
                ) {                        
            //include requested file from sandbox
    	    require App::getRequestFilePath();    
            exit;
            
        } else {
            //get controller class from request
            $controllerClassName = App::getRequestControllerClass();           
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


