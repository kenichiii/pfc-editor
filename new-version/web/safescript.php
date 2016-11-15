<?php 

namespace {
 
 require_once '../../../_app/config/Editor.php';
 require_once '../../../_app/library/PFC/Editor/AppSess.php';
 require_once '../../../_app/library/PFC/Editor/AppLogin.php';

 //shortcut App 
 use PFC\Editor\AppLogin;
 use PFC\Editor\AppSess;
 
 //start private session
 session_start();
 AppSess::start();
  
  if(!AppLogin::isLogged()) {
      die('NOT ALLOWED - NO USER');
  }
  
  
}

