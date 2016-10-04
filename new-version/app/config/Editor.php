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
    const SALT = 'fdsjpoghJHASMPOHhHdsgio sgaiyssadagysgys2434082373648-593529ěřšá=řěšéýá=šěžčíéšžčžščí';    
    const name = 'pfc-v0.1beta';
    
    /*
    *  Assets address
    */
    const assetsUrl = './';
    
    /*
 	*  Sounds
	*/
	const sounds = true;     
/*
 * THEME
 */
        const theme = "dark";
/*
 * SOURCES
 */
  const SourcesLastModificationChecker = true;
  const SourcesLastModificationCheckerInterval = 1700;      
        
 /*
  * EDITOR
  */       
   const editor =  "codemirror";
   const EditorLastModificationChecker = true;
   const EditorLastModificationCheckerInterval = 8000; //ms
   
   
    /*
    *  System passwords
    */
    const authEmail = 'your@email.com';        
    const authLogin = 'webmaster';        
    const authPwd = '$2a$12$5bjLZS7ENKTYRA84N3KuK.xcV1P5kIix6fRnT5S91SVn85j2ph77q';
    const authPin = 'dev[G][i]';
    
    const crypting = "bcrypt";
    
    const BcryptRounds = 12;
    
    
        
   /*
    * APP error reporting
    */      
    const displayErrors = 1;
    const errorReporting = E_ALL;  
   
                
   /*
    *  PHP INI UPLOADS 
    */
    const upload_max_filesize = "2M";
    const post_max_size = "8M";

    
    /*
     * SERVER TIMEZONE
     */
    const default_timezone = "Europe/Prague";    


    /*
     * PHP INI session cache expire
     */
    const session_cache_expire = 180;         
                       
}
