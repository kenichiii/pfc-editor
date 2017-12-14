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
    const authName = 'Yours full name';    
    const authEmail = 'your@email.com';        
    const authLogin = 'default-user';        
    const authPwd = '$2a$12$5hF7n5EtZXP/I8yiXzzUIOoDM1IFhslbK/dhw8DPQrsoqWP5DL2Nu';
    const authPin = 'pfc[G][i]';        
    
  /**
   *  ADMINER
   */ 
   const isAdminerMultiPage = true;
 
   /**
    * TERMINAL
    */
   const isWebConsoleMultiPage = false;
   
}

