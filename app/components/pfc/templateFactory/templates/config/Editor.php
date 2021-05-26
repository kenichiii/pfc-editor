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
    public static $SALT = '<?php echo $salt; ?>';    
    public static $name = '<?php echo $name; ?>';
    
    /*
    *  Assets address
    */
    public static $assetsUrl = '<?php echo $assetsurl; ?>';
    
    /*
 	*  Sounds
	*/
	public static $sounds = <?php echo $sounds; ?>;     

    /*
    *  System passwords
    */
    public static $authEmail = '<?php echo $webmasterauthemail; ?>';        
    public static $authLogin = '<?php echo $webmasterauthlogin; ?>';        
    public static $authPwd = '<?php echo $webmasterauthpwd; ?>';
    public static $authPin = '<?php echo $webmasterauthpin; ?>';
    
    public static $crypting = "<?php echo $crypting; ?>";
    
    public static $BcryptRounds = <?php echo $bcryptrounds; ?>;
    
    
        
   /*
    * APP error reporting
    */      
    public static $displayErrors = <?php echo $displayerrors; ?>;
    public static $errorReporting = <?php echo $errorreportimg; ?>;  
   
                
   /*
    *  PHP INI UPLOADS 
    */
    public static $upload_max_filesize = "<?php echo $upload_max_filesize; ?>";
    public static $post_max_size = "<?php echo $post_max_size; ?>";

    
    /*
     * SERVER TIMEZONE
     */
    public static $default_timezone = "<?php echo $default_timezone; ?>";    


    /*
     * PHP INI session cache expire
     */
    public static $session_cache_expire = <?php echo $session_cache_expire; ?>;         
                       
}
