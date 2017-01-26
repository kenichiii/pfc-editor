<?php 
    use PFC\Editor\Router;
?>
			<nav>
                <a id="pfc-editor-logo" href="#">[[:pfc <em>lite</em></a>
                <ul id="pfc-editor-menu">                    
                    <li><a class="pfc-editor-active-section-href" id="pfc-sources-sources-href" href="#pfc-sources-sources"><?php echo _('sources'); ?></a></li>

                    <li><a id="pfc-sources-sandbox-href"  href="#pfc-sources-sandbox"><?php echo _('sandbox'); ?></a></li>                    
                  
                    <li><a id="pfc-editor-adminer-href" class="pfc-editor-page-href" href="#"><?php echo _('adminer'); ?></a></li>
                    
                    <li><a id="pfc-editor-webterminal-href" class="pfc-editor-page-href" href="#"><?php echo _('terminal'); ?></a></li>
                    
                    <li><a id="pfc-editor-notestxt-href" class="pfc-editor-file-href" href="#"><?php echo _('notes.txt'); ?></a></li>
                    
                    <li><a id="pfc-sources-my-home-href" href="#pfc-sources-my-home"><?php echo _('my home'); ?></a></li>
                </ul>            
              	<span style="float:right;display:block;padding-right:10px;color:#ddd">:]]</span>
                <a id="pfc-editor-logout-href" class="pfc-editor-page-href" href="<?php echo Router::applinkaction('logout'); ?>"><?php echo _('logout'); ?></a>
                <a id="pfc-editor-help-href" class="pfc-editor-page-href pfc-editor-help-href" href="#"><?php echo _('help'); ?></a>
                
                <a id="pfc-editor-tools-href" class="pfc-editor-page-href"  href="#pfc-editor-tools"><?php echo _('tools'); ?></a>
                <a id="pfc-editor-config-href" class="pfc-editor-page-href" href="#"><?php echo _('settings'); ?></a>          
              
                
              <a id="pfc-sources-editor-href" class="pfc-editor-page-href" href="#pfc-sources-editor"><?php echo _('editor'); ?></a>
              
                <br style="clear: both">
			</nav>
