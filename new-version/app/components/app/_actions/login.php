<?php

namespace PFC\Editor;
//use \PFC\Editor\AppLogin;
//use \PFC\Editor\AppFile;
//use \PFC\Editor\AppSess;         

//do login if login form is submited
if( isset($_POST['pwd']) &&  isset($_POST['login'])
        && AppLogin::verify($_POST['login'],$_POST['pwd'],$_POST['pin'])        
  )
{
  
  
     AppLogin::setUserLoggedIn($_POST['pwd']);    
     AppSess::set('pfc-login',true);
     
     echo json_encode(array(
       'succ' => 'yes'
     ));
  
     //AppFile::sendRedirectHeaders(str_replace('?_app=true&action=login','',$_SERVER['REQUEST_URI']).'?after-login');

}
     else
     {
       if( AppLogin::isFreeForLoging() ) {       
         echo json_encode(array(
           'succ' => 'no',
           'reason' => 'creditials'
         ));
       } else {
         echo json_encode(array(
           'succ' => 'no',
           'reason' => 'banned',
           'bannedToTime' => date('G:i:s',AppLogin::getBannedToTime())
         ));       
       }
       //AppFile::sendRedirectHeaders(str_replace('?_app=true&action=login','',$_SERVER['REQUEST_URI']).'?wrong-creditials');
     }


