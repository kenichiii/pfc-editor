<?php

use PFC\Editor\Config as AppConfig;
use PFC\Editor\AppCryptor;
use PFC\Editor\AppLogin;
use PFC\Editor\App;

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
            <br>
            <div>
                server time: <span class="pfc-editor-server-time"><?php echo date('j.n.Y G:i:s'); ?></span>
            </div>
            <?php if(AppConfig::crypting==AppCryptor::USE_Bcrypt
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
            
            
                <script type="text/javascript" src="assets/vendor/jquery/jquery.js"></script>
                <script type="text/javascript" src="assets/vendor/jquery_form/jquery.form.js"></script>
            
            
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
                          window.location.href = '<?php echo filter_input(INPUT_SERVER, 'REQUEST_URI'); ?>';
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
                  
                    //$(function(){
            
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
                                                 
                      
                        refreshServerTime();
                    //});
                </script>                      
                  
          </body>  
        </html>    
        
        