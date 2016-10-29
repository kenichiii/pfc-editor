<?php

namespace PFC\Editor;       

//do login if login form is submited
$login = \filter_input(\INPUT_POST, 'login');
$passw = \filter_input(\INPUT_POST, 'pwd');
$pin = \filter_input(\INPUT_POST, 'pin');

    if($login && $passw && AppLogin::verify($login, $passw, $pin)) {
        AppLogin::setUserLoggedIn($login, $passw);    
        AppSess::set('pfc-login', true);
         
        echo \json_encode(['succ' => 'yes']);
    
    } elseif(AppLogin::isFreeForLoging()) {       
             echo \json_encode([
               'succ' => 'no',
               'reason' => 'creditials'
             ]);
             
    } else {
             echo \json_encode([
               'succ' => 'no',
               'reason' => 'banned',
               'bannedToTime' => \date('G:i:s', AppLogin::getBannedToTime())
             ]);       
    }


