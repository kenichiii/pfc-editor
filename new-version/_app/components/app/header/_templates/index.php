<?php 
    use PFC\Editor\Router;
?>
			<nav>
                <a id="pfc-editor-logo" href="#">[[:pfc <em>lite</em></a>
                <ul id="pfc-editor-menu">                    
                    <li><a class="pfc-editor-active-section-href" id="pfc-sources-sources-href" href="#pfc-sources-sources">sources</a></li>

                    <li><a id="pfc-sources-sandbox-href"  href="#pfc-sources-sandbox">sandbox</a></li>                    
                  
                    <li><a id="pfc-editor-adminer-href" class="pfc-editor-page-href" href="#">adminer</a></li>
                    
                    <li><a id="pfc-editor-webterminal-href" class="pfc-editor-page-href" href="#">terminal</a></li>
                </ul>            
              	<span style="float:right;display:block;padding-right:10px;color:#ddd">:]]</span>
                <a id="pfc-editor-logout-href" class="pfc-editor-page-href" href="<?php echo Router::applinkaction('logout'); ?>">logout</a>
                <a id="pfc-editor-help-href" class="pfc-editor-page-href pfc-editor-help-href" href="#">help</a>
                
                <a id="pfc-editor-tools-href" class="pfc-editor-page-href"  href="#pfc-editor-tools">tools</a>
                <a id="pfc-editor-config-href" class="pfc-editor-page-href" href="#">settings</a>          
              
                
              <a id="pfc-sources-editor-href" class="pfc-editor-page-href" href="#pfc-sources-editor">editor</a>
              
                <br style="clear: both">
			</nav>
