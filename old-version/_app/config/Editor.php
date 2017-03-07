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
     * NOLOGIN
     */
    const nologin = true;        
    const defaultUsername = 'default-user'; 
       
    /*
     *  System passwords
     */    
    const crypting = "simple";    
    const BcryptRounds = 12;
                
   /*
    * APP error reporting
    */      
    const displayErrors = 1;
    const errorReporting = E_ALL;  
                   
    /*
     * SERVER TIMEZONE
     */
    const default_timezone = "Europe/Prague";       
 
    

    /*
     * SOURCES
     */
      const SourcesLastModificationChecker = true;
      const SourcesLastModificationCheckerInterval = 1700;      

     /*
      * EDITOR
      */       
       const EditorLastModificationChecker = true;
       const EditorLastModificationCheckerInterval = 8000; //ms

}
