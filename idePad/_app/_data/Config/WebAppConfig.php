<?php

return [
    
    /*
     *   Project
     */
    'SALT' => md5('fdsjpoghJHASMPOHhHdsgio sgaiyssadagysgys2434082373648-593529ěřšá=řěšéýá=šěžčíéšžčžščí'),
    'name' => 'idePad-1.0beta',        
    
    /*
     * NOLOGIN
     */
    'nologin' => $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1' ? true : false,        
    'default_username' => 'default-user',
       
    /*
     *  System passwords
     */    
    'crypting' => "bcrypt", //bcrypt|simple
    'BcryptRounds' => 12,
                
   /*
    * APP error reporting
    */      
    'display_errors' => 1, //0
    'error_reporting' => E_ALL, //0
                   
    /*
     * SERVER TIMEZONE
     */
    'default_timezone' => "Europe/Prague",  
];

