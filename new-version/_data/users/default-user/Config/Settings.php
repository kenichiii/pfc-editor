<?php

namespace pfcUserData\Config;

class Settings
{

    
        /*
 	*  Sounds
	*/
	const sounds = true;     
/*
 * THEME
 */
        const theme = "classic-blue";

/*
 * LANGUAGE
 */
        const lang = "cz";
        
    /*
    *  System passwords
    */
    const authEmail = 'your@email.com';        
    const authLogin = 'default-user';        
    const authPwd = '6939775ef065962b6605cc17b1d38c46';
    const authPin = 'pfc[G][i]';        
    
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
   
  /**
   *  ADMINER
   */ 
   const isAdminerMultiPage = true;
 
   /**
    * TERMINAL
    */
   const isTerminalMultiPage = false;
   
}

