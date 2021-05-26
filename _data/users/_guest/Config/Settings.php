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
        const lang = "en";
        
    /*
    *  System passwords
    */
    const authName = 'Just Guest';    
    const authEmail = 'some@email.dom';        
    const authLogin = '_guest';        
    const authPwd = '';
    const authPin = '';        
    
  /**
   *  ADMINER
   */ 
   const isAdminerMultiPage = true;
 
   /**
    * TERMINAL
    */
   const isWebConsoleMultiPage = false;
   
}

