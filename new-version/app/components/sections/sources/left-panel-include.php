
                <header class="pfc-editor-section-header">
                  <div class="pfc-editor-section-header-inner">
                    <a class="pfc-editor-section-minify-href" title="Minimalize" href="#">X</a>                  
                    <ul>
                        <?php 
                              $ki=0;  
                              foreach(\PFC\Editor\Config\Sources::$paths as $k=>$s) 
                              { 
                                if($s['section']=='include') {  
                                    ?>
                        <li class="directory"><a rel="<?php echo $s['path']; ?>" class="<?php if($ki===0)echo 'pfc-editor-section-active '; ?>pfc-sources-main-href" href="#pfc-sources-<?php echo $s['name']; ?>"><?php echo $s['title']; ?></a></li>
                                    <?php
                                    $ki++;
                                }
                              }
                        ?>
                    </ul>
                   </div> 
                    <br style="clear: both">
                    
                </header>
				<div class="pfc-editor-section-updater"></div> 
                <div class="pfc-editor-section-panel">
                        <?php 
                              $ki=0;  
                              foreach(\PFC\Editor\Config\Sources::$paths as $k=>$s) 
                              { 
                                if($s['section']=='include') {  
                                    ?>
    
                    <div id="pfc-sources-<?php echo $s['name']; ?>" <?php if($ki>0)echo 'style="display:none;"'; ?> class="pfc-editor-section-panel-body">
                        Loadings dir...
                    </div>

                                    <?php
                                    $ki++;
                                }
                              }
                        ?>
                    
                </div> <!-- pfc-editor-section-panel -->
                
