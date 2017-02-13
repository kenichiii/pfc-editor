<?php

use PFC\Editor\Config as AppConfig;
use PFC\Editor\AppCryptor;
use PFC\Crypting\Bcrypt;
use PFC\Editor\AppLogin;
use PFC\Editor\App;
use PFC\Editor\Router;

?>

<!DOCTYPE html>
<html>
    
            <head>
                <title>freePad <?php echo _tr('login'); ?></title>
                <meta charset="utf-8">   
                <link type="text/css" href="application/theme/login.css">
            </head>  
          <body class="pfc-editor-layout-login">  
            <br><br>
                <div id="pfc-lang-switcher-holder" style="width:500px;text-align: right;">
                    <select id="pfc-lang-switcher">
                        <?php foreach(App::ins()->getLanguages() as $lang) { ?>
                            <option value="<?php echo $lang; ?>"><?php echo $lang; ?></option>
                        <?php } ?>
                    </select>
                </div>  
              
            <h1><em>free</em><span>Pad</span> <?php echo _tr('login'); ?></h1>
            
            <br>
            <div>
                <?php echo _tr('server time'); ?>: <span class="pfc-editor-server-time"><?php echo date('j.n.Y G:i:s'); ?></span>
            </div>
            <?php if(AppConfig::crypting==AppCryptor::USE_Bcrypt
                    && !Bcrypt::isEnabled()) { ?>
                    <h4><?php echo _tr('BCRYPTING IS TURN ON, BUT NOT SUPPORTED BY SERVER'); ?></h4>
                    <?php echo _tr('reset password'); ?>
                    <?php } ?>
            <br>
            
            <div class="error">
              <?php echo _tr('wrong creditials provided'); ?><br><br>
            </div>

                  <div class="banned">
                    <?php echo _tr('banned until'); ?> <span class="bannedToTime"></span>                    
                    - <?php echo _tr('too much tryies'); ?> 
                    <br> <br> 
                  </div>            
            
           <div>  
           
            <div id="pfc-editor-login-form-holder">   
                <form id="pfc-editor-login-form" method="post" action="<?php echo Router::applinkaction('login'); ?>">                
                     <?php echo _tr('Login'); ?>: <input type="text" name="login"> 
                     <?php echo _tr('Password'); ?>: <input type="password" name="pwd">
                     <?php echo _tr('Pin'); ?>: <input type="password" name="pin">
                    <input type="submit" value="<?php echo _tr('login'); ?>">
                </form>  
                <br>   
                <!--a href="#">Forgotten password?</a-->                  
            </div>    
            
            <div id="pfc-editor-forgotten-form-holder" style="display:none">   
                <form method="post" action="<?php echo Router::applinkaction('forgotten'); ?>">                
                     <?php echo _tr('Email'); ?>: <input type="text" name="email">
                    <input type="submit" value="<?php echo _tr('Reset password'); ?>">
                </form>  
                <br>   
                <a href="#"><?php echo _tr('Login form'); ?></a>
            </div>                   
            
            
                <script type="text/javascript" src="vendor/jquery/jquery.js"></script>
                <script type="text/javascript" src="vendor/jquery_form/jquery.form.js"></script>
            
            
                <script type="text/javascript">
                    function refreshServerTime() {
                        $.get("<?php echo Router::applinkajax('server-time'); ?>",{},function(data){
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
                          alert('<?php echo _tr('unknowen login error'); ?>';
                        }
                    }
                  
                    //$(function(){
            
                           var options = {
                                    success: login_form,
                                    beforeSend:function() {
                                        
                                    },
                                    error: function(response, status, err){
                                        
                                        alert('<?php echo _tr('http error when running form'); ?>');
                                    },
                                    dataType:  'json'
                            };
                            
                           $('#pfc-editor-login-form').ajaxForm(options);
                                                 
                      
                        refreshServerTime();
                    //});
                </script>                      
                  
          </body>  
        </html>    
        
        
