<?php

use idePad\Config\WebAppConfig;
use idePad\Config\SourcesConfig;
use idePad\Config\UserData\Settings;
use idePad\Config\UserData\Account;

use PFC\Crypting\Bcrypt;

use PFC\WebApp\AppCryptor;
use PFC\WebApp\AppLogin;
use PFC\WebApp\App;
use PFC\WebApp\Router;

?>

<!DOCTYPE html>
<html>
    
            <head>
                <title>idePad <?php echo _tr('login'); ?></title>
                <meta charset="utf-8">   
                <link type="text/css" rel="stylesheet" href="application/theme/login.css" />
            </head>  
          <body class="pfc-editor-layout-login">  
          <div id="login-wrapper">  
                <div id="pfc-lang-switcher-holder" style="width:245px;text-align: right;">
                    <?php echo _tr('language'); ?>: 
                        <?php foreach(App::ins()->getLanguages() as $key=>$lang) { ?>
                            <?= $key > 0 ? ' | ' : ''; ?><a href="<?php echo Router::applinkajax('set-app-lang')?>&amp;lang=<?php echo $lang; ?>" class="<?= $lang === App::ins()->getLang() ? 'active' : ''; ?>">
                                <?php echo $lang; ?>
                            </a>
                        <?php } ?>                    
                </div>  
              
            <h1><em>ide</em><span>Pad</span> <?php echo _tr('login'); ?></h1>
            
            <br>
            <div>
                <?php echo _tr('server time'); ?>: <span class="pfc-editor-server-time"><?php echo date('j.n.Y G:i:s'); ?></span>
            </div>
            <?php if(WebAppConfig::crypting() === AppCryptor::USE_Bcrypt && !Bcrypt::isEnabled()) { ?>
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
                     <div style="margin-bottom:5px;display:none;"><span style="float:left;display:block;width:60px"><?php echo _tr('Login'); ?>:</span> <input type="text" value="default-user" name="login"></div>
                     <div style="margin-bottom:5px"><span style="float:left;display:block;width:90px"><?php echo _tr('Password'); ?>:</span> <input type="password" name="pwd"></div>
                     <div style="margin-bottom:10px"><span style="float:left;display:block;width:90px"><?php echo _tr('Pin'); ?>:</span> <input type="password" name="pin"></div>
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
                          alert('<?php echo _tr('unknowen login error'); ?>');
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
        
        
