<?php

namespace pfcEditor\Component\Action\app;

use PFC\Editor\Component\ActionController;
use PFC\Editor\AppLogin;
use PFC\Editor\AppFile;

class logout extends ActionController
{
    
   public function indexAction() 
   {     
       AppLogin::logout();
       
       return self::redirect('__HOME__');       
   }
}

