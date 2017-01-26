<?php 
    
    use PFC\Editor\Router;
    use PFC\Editor\App;
    use PFC\Editor\Config;
    
?>
	
            <nav>
                
                <a id="pfc-editor-logo" href="#">[[:pfc <em>editor</em></a>
                
                <ul id="pfc-editor-menu">                    
                    <li><a class="pfc-editor-active-section-href" id="pfc-sources-sources-href" href="#pfc-sources-sources"><?php echo _tr('sources'); ?></a></li>

                    <li><a id="pfc-sources-sandbox-href"  href="#pfc-sources-sandbox"><?php echo _tr('sandbox'); ?></a></li>                    
                  
                    <li><a id="pfc-editor-adminer-href" class="pfc-editor-page-href" href="#"><?php echo _tr('adminer'); ?></a></li>
                    
                    <li><a id="pfc-editor-webterminal-href" class="pfc-editor-page-href" href="#"><?php echo _tr('terminal'); ?></a></li>
                    
                    <li><a id="pfc-editor-notestxt-href" class="pfc-editor-file-href" href="#"><?php echo _tr('my notes'); ?></a></li>
                    
                    <li><a id="pfc-sources-my-home-href" href="#pfc-sources-my-home"><?php echo _tr('my home'); ?></a></li>
                </ul>            
              	
                <span id="pfc-editor-logo-close-tag">:]]</span>
                
                <?php if(!Config::nologin) { ?>
                <a id="pfc-editor-logout-href" class="pfc-editor-page-href" href="<?php echo Router::applinkaction('logout'); ?>"><?php echo _tr('logout'); ?></a>
                <?php } ?>
                
                <span id="pfc-lang-switcher-holder">
                    <select id="pfc-lang-switcher">
                        <?php foreach(App::ins()->getLanguages() as $lang) { ?>
                            <option value="<?php echo $lang; ?>"><?php echo $lang; ?></option>
                        <?php } ?>
                    </select>
                </span>
                
                <a id="pfc-editor-help-href" class="pfc-editor-page-href pfc-editor-help-href" href="#"><?php echo _tr('help'); ?></a>
                
                <a id="pfc-editor-tools-href" class="pfc-editor-page-href"  href="#pfc-editor-tools"><?php echo _tr('tools'); ?></a>
                <a id="pfc-editor-config-href" class="pfc-editor-page-href" href="#"><?php echo _tr('settings'); ?></a>          
              
                
              <a id="pfc-sources-editor-href" class="pfc-editor-page-href" href="#pfc-sources-editor"><?php echo _tr('editor'); ?></a>
              
                <br style="clear: both">
			</nav>
