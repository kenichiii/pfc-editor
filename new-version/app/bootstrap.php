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
 use PFC\Editor\AppFile;      
    
 //get application autoload, settings and libraries
 require_once 'bootstrap/master.php';        
  
 //start private session
 session_start();
 AppSess::start();
  
 //check if is installed 
  
 //public services   
  if(App::isServerTimeRequest() || App::isLoginActionRequest())
    {            
    	require App::getRequestFilePath();    
    }      
  else //application
    {        
      //show only login form for non-logged user
      if( ! AppLogin::isLogged() )
      {                     
          require 'layout/login.php';
      }
      else
      {
            //get runable file
            require App::getRequestFilePath();  
      }
    }
  
} //end namespace


