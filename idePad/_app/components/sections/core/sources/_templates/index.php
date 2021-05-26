
            <?php foreach($sections as $section => $paths) { ?>                          
            
                <section id="pfc-sources-<?php echo $section; ?>" class="pfc-editor-section">
                
                        <header class="pfc-editor-section-header">
                          <div class="pfc-editor-section-header-inner">
                              <a class="pfc-editor-section-minify-href" title="<?php echo _tr('Minimalize'); ?>" href="#">X</a>                  
                            <ul>
                                <?php 
                                      $ki=0;  
                                      foreach($paths as $k=>$s) { 
                                ?>
                                            <li class="directory">
                                                <a rel="<?php echo $s['path']; ?>" 
                                                   class="<?php if($ki===0)echo 'pfc-editor-section-active '; ?> pfc-sources-main-href" 
                                                   href="#pfc-sources-<?php echo $s['name']; ?>">
                                                       <?php echo _tr($s['title']); ?>
                                                </a>
                                            </li>
                                <?php
                                         $ki++;                        
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
                                      foreach($paths as $k=>$s) { 
                                ?>
                                            <div id="pfc-sources-<?php echo $s['name']; ?>" 
                                                 <?php if($ki>0)echo 'style="display:none;"'; ?> 
                                                 class="pfc-editor-section-panel-body">
                                                    <?php echo _tr('Loading dir...'); ?>
                                            </div>

                                <?php
                                         $ki++;                                
                                      }
                                ?>

                        </div> <!-- pfc-editor-section-panel -->                                                               
                
                </section> <!-- pfc-sources-<?php echo $section; ?> -->
                
            <?php } ?>

            <?php echo $this->template('context-menu'); ?>

            
