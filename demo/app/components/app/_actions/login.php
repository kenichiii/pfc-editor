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
     AppFile::sendRedirectHeaders(preg_replace('/(login\.action)$/','',$_SERVER['REQUEST_URI']));
}
     else
       AppFile::sendRedirectHeaders(preg_replace('/(login\.action)$/','',$_SERVER['REQUEST_URI']).'?wrong-creditials');


