<?php

namespace idePad\Component\Action\application;

use PFC\WebApp\Component\ActionController;
use PFC\WebApp\AppLogin;
use PFC\WebApp\AppFile;

class logout extends ActionController
{
    
   public function indexAction() 
   {     
       AppLogin::logout();
       
       return self::redirect('__HOME__');       
   }
}

