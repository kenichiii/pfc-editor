[[:

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
    const SALT = '<?php echo $salt; ?>';    
    const name = '<?php echo $name; ?>';
    
    /*
    *  Assets address
    */
    const assetsUrl = '<?php echo $assetsurl; ?>';
    
    /*
     *  Sounds
     */
    const sounds = <?php echo $sounds; ?>;     
        
    /*
     *  THEME
     */
    const theme = "dark";

        
    /*
     *  THEME
     */
    const lang = "en";
    
    /*
     *  NO LOGIN
     */
    const nologin = true;    
     
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
    const authEmail = '<?php echo $webmasterauthemail; ?>';        
    const authLogin = '<?php echo $webmasterauthlogin; ?>';        
    const authPwd = '<?php echo $webmasterauthpwd; ?>';
    const authPin = '<?php echo $webmasterauthpin; ?>';
    
    const crypting = "<?php echo $crypting; ?>";
    
    const BcryptRounds = <?php echo $bcryptrounds; ?>;
    
    
        
   /*
    * APP error reporting
    */      
    const displayErrors = <?php echo $displayerrors; ?>;
    const errorReporting = <?php echo $errorreportimg; ?>;  
   
                
   /*
    *  PHP INI UPLOADS 
    */
    const upload_max_filesize = "<?php echo $upload_max_filesize; ?>";
    const post_max_size = "<?php echo $post_max_size; ?>";

    
    /*
     * SERVER TIMEZONE
     */
    const default_timezone = "<?php echo $default_timezone; ?>";    


    /*
     * PHP INI session cache expire
     */
    const session_cache_expire = <?php echo $session_cache_expire; ?>;         
                       
}
