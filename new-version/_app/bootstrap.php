<?php

namespace PFC\Editor;

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
 

 
         /*
         * SET USER_DATA_PATHS
         */            
                      defined('\PFC\Editor\USER_DATA_PATH')
                        || define('PFC\Editor\USER_DATA_PATH', DATA_PATH.
                                '/users/'.AppLogin::getLoggedUserLogin()
                            );
                            
                      defined('\PFC\Editor\USER_DATA_SANDBOX_PATH')
                        || define('PFC\Editor\USER_DATA_SANDBOX_PATH', USER_DATA_PATH.
                                '/sandbox'
                            );
                      
                      defined('\PFC\Editor\USER_DATA_HOME_PATH')
                        || define('PFC\Editor\USER_DATA_HOME_PATH', USER_DATA_PATH.
                                '/my-home'
                            );

                      defined('\PFC\Editor\USER_DATA_NOTES_TXT_PATH')
                        || define('PFC\Editor\USER_DATA_NOTES_TXT_PATH', USER_DATA_PATH.
                                '/my-home/_my_notes.txt'
                            );         

 
 
 
  //if user is logged or nologin mode  
  if((AppLogin::isLogged()) 
    //or public services        
    || Router::isServerTimeRequest() || Router::isLoginActionRequest()    
    ) {                                               
                      
        /*
         * GET WANTED FILE AS CONTROLLER
         */                    
        if(Router::isSandboxRequest()) {                        
            //include requested file from sandbox
    	    require Router::getSandboxRequestFilePath();    
            exit;
            
        } else {
            //get controller class from request
            $controllerClassName = Router::getRequestControllerClass();           
        }
        
    } else { //not logged user                     
        $controllerClassName = '\\pfcEditor\\Layout\\login';           
    }
     
    
/*
 * RUN MCV APP LOGIC
 */    
            //initialize controller                           
            $controller = new $controllerClassName;
         
            //get current view
            $view = $controller->dispatch();
         
            //send current HTTP headers
            $view->headers();
         
            //render view to client as string
            echo $view->render();
            


