<?php

use \PFC\Editor\Config as AppConfig;
use \PFC\Editor\AppCryptor;
use \PFC\Editor\AppLogin;
use \PFC\Editor\App;

?>

<!DOCTYPE html>
    <head>
            <head>
                <meta charset="utf-8">   
                <style>
                    body {
                        background-color: black;
                        color: #ddd;
                    }
                    input {
                        background-color: #303030;
                        color: lightskyblue;
                    }
                    
                </style>    
            </head>  
          <body>  
              
            <h1>pfc editor login</h1>
            <div>
            server time: <span class="pfc-editor-server-time"><?php echo date('j.n.Y G:i:s'); ?></span>
            </div>
            <?php if(AppConfig::$crypting==AppCryptor::USE_Bcrypt
                    && !\PFC\Crypting\Bcrypt::isEnabled()) { ?>
                    <h4>BCRYPTING IS TURN ON, BUT NOT SUPPORTED BY SERVER</h4>
                    reset password
                    <?php } ?>
            <br>
            <?php 
              AppLogin::setFreeForLogingAccess();
            
              if( isset($_GET['wrong-creditials']) && AppLogin::isFreeForLoging() ) 
              {
                  //echo date('j.n.y G:i:s');                  
                  ?><div>wrong creditials provided</div><br><?php 
              }
              elseif( isset($_GET['wrong-creditials']) && !AppLogin::isFreeForLoging() )             
              {
                  ?>
                  <div>
                    banned until <?php echo date('G:i:s',AppLogin::getBannedToTime()); ?> 
                    - too much tryies 
                  </div><br>  
                  <?php 
              }
	
            ?>
           <div>  
            <div id="pfc-editor-login-form-holder">   
            <form method="post" action="login.action">                
                 Login: <input type="text" name="login"> 
                 Password: <input type="password" name="pwd">
                 Pin: <input type="password" name="pin">
                <input type="submit" value="login">
            </form>  
            <br>   
            <!--a href="#">Forgotten password?</a-->                  
            </div>    
            <div id="pfc-editor-forgotten-form-holder" style="display:none">   
            <form method="post" action="<?php echo App::applinkaction('forgotten'); ?>">                
                 Email: <input type="text" name="email">
                <input type="submit" value="Reset password">
            </form>  
            <br>   
            <a href="#">Login form</a>                  
            </div>                   
           </div>
              
                <script type="text/javascript" src="<?php echo AppConfig::$assetsUrl; ?>assets/libs/jquery/jquery.js"></script>
                <script type="text/javascript">
                    function refreshServerTime() {
                        $.get("<?php echo App::applinkajax('server-time'); ?>",{},function(data){
                            $('.pfc-editor-server-time').html(data);
                            setTimeout(function(){
                                refreshServerTime();
                            },400);
                        }).fail(function(){
                                refreshServerTime();
                        });
                    }
                    
                    $(function(){
                        refreshServerTime();
                    });
                </script>                      
                  
          </body>  
        </html>    
        
        