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
 AppSess::start();
 
 require_once 'bootstrap/plugins.php';
  
  
  
 //public services   
  if(App::isServerTimeRequest())
    {            
    	require App::getRequestFilePath();    
    }  

  elseif(App::isLoginActionRequest())
    {                             
    	require App::getLoginActionFilePath();    
    }
  
  //application
  else
    {
    
    
      //show only login form for non-logged user
      if( ! AppLogin::isLogged() )
      {                     
          require 'layout/login.php';
      }
      else
      {
        
        if(isset($_GET['after-login']))
          {
            AppFile::sendRedirectHeaders(str_replace('?after-login','',$_SERVER["REQUEST_URI"]));
          }
        else {
          
          
          
            //get runable file
             require App::getRequestFilePath();  
          
        }
        

      }
    }
  
} //end namespace


