<?php

use \PFC\Editor\Config as AppConfig;
use \PFC\Editor\AppCryptor;
use \PFC\Editor\AppLogin;
use \PFC\Editor\App;

?>

<!DOCTYPE html>
<html>
    
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
            <div class="caps-info" style="font-size:1.2em;font-weight:bold"><br></div>
            <div>
            server time: <span class="pfc-editor-server-time"><?php echo date('j.n.Y G:i:s'); ?></span>
            </div>
            <?php if(AppConfig::$crypting==AppCryptor::USE_Bcrypt
                    && !\PFC\Crypting\Bcrypt::isEnabled()) { ?>
                    <h4>BCRYPTING IS TURN ON, BUT NOT SUPPORTED BY SERVER</h4>
                    reset password
                    <?php } ?>
            <br>
            
            <div class="error" style="display:none;color:lightred;">
              wrong creditials provided<br><br>
            </div>

                  <div class="banned" style="display:none;color:lightred;">
                    banned until <span class="bannedToTime"></span>                    
                    - too much tryies 
                    <br> <br> 
                  </div>            
            
            <?php 
       /*
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
	          elseif(isset($_GET['after-login']))
                {
                  ?>
            		<div>your creditials were right, but session was not stored</div>
                  <?php
                }
		*/
            ?>
           <div>  
            <div id="pfc-editor-login-form-holder">   
            <form id="pfc-editor-login-form" method="post" action="?_app=true&action=login">                
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
              <div>ADD DETECTION OF SYSTEM + AVAILABLE FUNCTIONS => TERMINAL</div>
            <!--div>
             <?php echo date('G:i:s').'  => '; var_dump($_SESSION); ?>
            </div-->
            
            
                <script type="text/javascript" src="<?php echo AppConfig::$assetsUrl; ?>assets/libs/jquery/jquery.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::$assetsUrl; ?>assets/libs/jquery_form/jquery.form.js"></script>
            
            
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
                    
                    function login_form(json) {
                      $('.error').hide();
                      $('.banned').hide();
                      
                      if(json.succ === 'yes')
                        {
                          $('.redirect').show();
                          window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>?after-login';
                        }
                      else if(json.reason === 'banned')
                        {
                          $('.banned .bannedToTime').html(json.bannedToTime);
                          $('.banned').show();
                        }
                      else if(json.reason === 'creditials') 
                        {
                          $('.error').show();
                        }
                      else
                        {
                          alert('unknowen login error');
                        }
                    }
                  
                    $(function(){
            
                           var options = {
                                    success: login_form,
                                    beforeSend:function() {
                                        
                                    },
                                    error: function(response, status, err){
                                        
                                        alert('http error when running form');
                                    },
                                    dataType:  'json'
                            };
                            
                           $('#pfc-editor-login-form').ajaxForm(options);
                      
                           
                      
                      
                      $(window).keypress(function(e) { 
                        $('.caps-info').html('<br>');
                          var s = String.fromCharCode( e.which );
                          if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
                              $('.caps-info').html('CAPS LOCK IS ON');
                          }
                        else {
                          
                        }
                      });
                      
                        refreshServerTime();
                    });
                </script>                      
                  
          </body>  
        </html>    
        
        