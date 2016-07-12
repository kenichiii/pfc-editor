<?php

    use \PFC\Editor\Config as AppConfig;
    use \PFC\Editor\AppCryptor;
    use \PFC\Editor\App;    
               
                /*
            $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true:false;
            $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
            $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');    
            $request = str_replace(Project::$WEB_URL,'',$protocol.'://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);//we dont care about rewriting get part        
            $ret = explode('?',$request);
            $form_action = $ret[0]; 
            $site = str_replace('/pfc-config', '', $ret[0]);
              */          
?>
        <h2 style="padding-bottom: 5px">Editor Config</h2>
        <form id="pfc-editor-config" method="post" action="<?php echo App::pagelinkaction('editor-config','save-config') ?>">
          <div id="pfc-editor-config-accordicon">  
            <a class="accordicon-head" href="#pfc-editor-config-basic">Basic</a>
            <div class="pfc-editor-config-basic accordicon-body">

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Name:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="name" value="<?php echo AppConfig::name ?>">
                    </div>            
                   <div class="pfc-config-help">
                        used as session container name
                    </div>                    
                </div>  
                <br class="clear">                  

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        SALT:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="salt" value="<?php echo AppConfig::SA T ?>">
                    </div>            
                   <div class="pfc-config-help">
                        used for sessions, password 
                    </div>                    
                </div>  
                <br class="clear">                  
                
                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Sounds:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="radio" name="sounds" <?php echo AppConfig::sounds ? 'checked="checked"' : ''; ?> value="true"> YES
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sounds" <?php echo !AppConfig::sounds ? 'checked="checked"' : ''; ?> value="false"> NO
                    </div>  
                  <br style="clear:both">
                   <div class="pfc-config-help">
                        set sounds mode
                    </div>                    
                </div>  
                <br class="clear">                  
              
              
              
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Assets URL prefix:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="assetsurl" value="<?php echo AppConfig::assetsUrl; ?>">
                    </div>            
                   <div class="pfc-config-help">
                        used to generate inner links
                    </div>                    
                </div>  
                <br class="clear">                  
               
                                
        </div>

       <a class="accordicon-head" href="#pfc-editor-config-accs">Account</a>    
        <div class="pfc-editor-config-accs accordicon-body">   
            
            <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Auth email:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="webmasterauthemail" value="<?php echo AppConfig::authEmail ?>">
                    </div>            
                   <div class="pfc-config-help">
                        Email to forgotten password form
                   </div>                                                                    
                </div>  
                <br class="clear">                
                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Auth login:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="webmasterauthlogin" value="<?php echo AppConfig::authLogin ?>">
                    </div>            
                   <div class="pfc-config-help">
                        username used by pfc editor
                   </div>                                                                    
                </div>  
                <br class="clear">                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Auth pwd:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="password" name="webmasterauthpwd" value="">
                    </div>            
                   <div class="pfc-config-help">
                        password used by pfc editor
                   </div>                                                                                 
                </div>  
                <br class="clear">
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Auth pwd control:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="password" name="webmasterauthpwd2" value="">
                    </div>            
                </div>  
                <br class="clear">


                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Auth pin:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="webmasterauthpin" value="<?php echo AppConfig::authPin ?>">
                    </div>            
                   <div class="pfc-config-help">
                        pin used by pfc editor, [G] are hours, [i] are minutes
                   </div>                                                                                 
                </div>  
                <br class="clear">                
                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        Crypting:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input <?php echo \PFC\Crypting\Bcrypt::isEnabled() && AppConfig::crypting == AppCryptor::USE_Bcrypt ? '' : 'checked="checked"' ?> type="radio" name="crypting" value="<?php echo AppCryptor::USE_Simple ?>"> simple
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input <?php  
                                    if(\PFC\Crypting\Bcrypt::isEnabled() && AppConfig::crypting == AppCryptor::USE_Bcrypt )
                                    {
                                        echo 'checked="checked"';
                                    }
                                    elseif(\PFC\Crypting\Bcrypt::isEnabled())
                                    {
                                        
                                    }
                                    else {
                                       echo 'disabled="disabled"'; 
                                    }
                                ?>    
                           type="radio" name="crypting" value="<?php echo AppCryptor::USE_Bcrypt ?>"> Bcrypt 
                        <span <?php if (!\PFC\Crypting\Bcrypt::isEnabled()) { echo 'style="display:none"'; } ?>>
                        &nbsp; rounders: <input type="text" name="bcryptrounders" value="<?php echo AppConfig::BcryptRounds; ?>" style="width:100px">
                        </span> <?php if (!\PFC\Crypting\Bcrypt::isEnabled()) { echo 'NOT ENABLED ON SERVER'; } ?>
                        <br class="clear">
                    </div>    
                        <br class="clear">
                   <div class="pfc-config-help">
                        used crypting method for password protection
                   </div>                                                                                 
                </div>  
                <br class="clear">                
                
                
        </div>
        <a class="accordicon-head" href="#pfc-editor-config-php">PHP settings</a>    
        <div class="pfc-editor-config-php accordicon-body">   
            
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        display_errors:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="displayerrors" value="<?php echo AppConfig::displayErrors ?>">
                    </div>            
                        <div class="pfc-config-help">
                           1 show errors, 0 dont show - combine with next setting
                        </div>                                             
                </div>  
                <br class="clear">                                                          
                                
                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        error_reporting:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="errorreportimg" value="<?php echo AppConfig::errorReporting == 32767 ? 'E_ALL' : AppConfig::errorReporting ?>">
                    </div>            
                        <div class="pfc-config-help">
                           0 dont show, E_ALL or other supported const - but only one!
                        </div>                                             
                </div>  
                <br class="clear"> 

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        upload_max_filesize:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="upload_max_filesize" value="<?php echo AppConfig::upload_max_filesize ?>">
                    </div>            
                        <div class="pfc-config-help">
                           max allowed size of upload file through form
                        </div>                                             
                </div>  
                <br class="clear"> 

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        post_max_size:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="post_max_size" value="<?php echo AppConfig::post_max_size ?>">
                    </div>            
                        <div class="pfc-config-help">
                           max allowed size of post request through form, should be bigger than previos setting
                        </div>                                                                 
                </div>  
                <br class="clear">                 

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        date_default_timezone:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="default_timezone" value="<?php echo AppConfig::default_timezone ?>">
                    </div>            
                        <div class="pfc-config-help">
                           server timezone name, ie. Europe/Prague
                        </div>                                                                 
                </div>  
                <br class="clear">                                 

                <div class="fleft formPrimitiveRow">
                    <div class="fleft formPrimitiveTitle">
                        session.cache_expire:
                    </div>    
                    <div class="fleft formPrimitiveCell">
                        <input type="text" name="session_cache_expire" value="<?php echo AppConfig::session_cache_expire ?>">
                    </div>            
                        <div class="pfc-config-help">
                           session cache memory expire time in minutes
                        </div>                                                                                     
                </div>  
                
                <br class="clear">                                 
                
        </div>
        <div class="accordicon-footer">        
                  <div>
                      <button>Generate editor config file</button>
                  </div>
        </div>      
     </form>             
                