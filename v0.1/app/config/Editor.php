<?php

/*

  THIS FILE IS GENERATED USING TOP RIGHT MENU CONFIG!!!
  
  Do not change manualy - only if you really sure what you are doing

*/

namespace PFC\Editor;

class Config
{
    /*
    *   Project
    */
    public static $SALT = 'fdsjpoghJHASMPOHhHdsgio sgaiyssadagysgys2434082373648-593529ěřšá=řěšéýá=šěžčíéšžčžščí';    
    public static $name = 'pfc-v0.1beta';
    
    /*
    *  Assets address
    */
    public static $assetsUrl = './';
    
    /*
 	*  Sounds
	*/
	public static $sounds = true;     

    /*
    *  System passwords
    */
    public static $authEmail = 'your@email.com';        
    public static $authLogin = 'webmaster';        
    public static $authPwd = '$2a$12$5bjLZS7ENKTYRA84N3KuK.xcV1P5kIix6fRnT5S91SVn85j2ph77q';
    public static $authPin = 'dev[G][i]';
    
    public static $crypting = "bcrypt";
    
    public static $BcryptRounds = 12;
    
    
        
   /*
    * APP error reporting
    */      
    public static $displayErrors = 1;
    public static $errorReporting = E_ALL;  
   
                
   /*
    *  PHP INI UPLOADS 
    */
    public static $upload_max_filesize = "2M";
    public static $post_max_size = "8M";

    
    /*
     * SERVER TIMEZONE
     */
    public static $default_timezone = "Europe/Prague";    


    /*
     * PHP INI session cache expire
     */
    public static $session_cache_expire = 180;         
                       
}
