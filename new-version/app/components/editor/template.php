


        <section id="pfc-editor">                
               <header id="pfc-editor-dialogs-heads-holder">
                        <div id="pfc-editor-dialogs-heads">
                            
                            
                            <br style="clear: both">
                        </div>                                               
               </header>                                                                           
                <div id="pfc-editor-body">
                    
                </div>
                                                  
         </section> <!-- pfc-editor --> 


      <div id="pfc-editor-templates">
           
        <div id="pfc-editor-contextmenu-template">
            <div class="pfc-editor-contextmenu-holder">     
                 <div class="pfc-editor-contextmenu-head"></div>
                  <div class="pfc-editor-contextmenu-section pfc-editor-contextmenu-tab-actions">  
                    <a class="pfc-editor-contextmenu-btn pfc-editor-btn-close-this " href="#">Close this</a>  
                    <a class="pfc-editor-contextmenu-btn pfc-editor-btn-close-others " href="#">Close others</a>
                    <a class="pfc-editor-contextmenu-btn pfc-last pfc-editor-btn-close-all " href="#">Close all</a>
                 </div>           
                 <!--div class="pfc-editor-contextmenu-section pfc-editor-contextmenu-tab-actions">
                    <a class="pfc-editor-contextmenu-btn pfc-last pfc-editor-btn-reload" href="#">Reload</a>
                  </div-->  
                 <div class="pfc-editor-contextmenu-section pfc-editor-contextmenu-tab-actions">  
                    <a class="pfc-editor-contextmenu-btn pfc-last pfc-editor-btn-maximalize " href="#">Maximalize</a>                     
                 </div>   
            </div>
        </div>  
          
          
          
            <div id="pfc-editor-open-dialog-tab-template">
                    <div class="pfc-editor-dialog-tab pfc-editor-dialog-tab-active"> 
                        <a href="#" class="pfc-editor-dialog-tab-close">[X]</a>
                        <a href="" class="pfc-editor-dialog-tab-title"></a>                        
                        <div class="pfc-editor-dialog-info"></div>
                    </div>            
            </div> <!-- pfc-editor-open-dialog-tab-template -->

            <div id="pfc-editor-external-page-template">
              <div class="pfc-editor-dialog">
                      <!--div class="page-preview-browser-holder"--> 
                          <div class="page-preview-browser">
                              
                          </div>
                      <!--/div-->
              </div>    
            </div> <!-- pfc-editor-external-page-content-template -->            

            <div id="pfc-editor-page-template">
              <div class="pfc-editor-dialog">
               <div class="pfc-editor-dialog-page">   

               </div>    
              </div>    
            </div> <!-- pfc-editor-page-content-template -->
            
            
            <div id="pfc-editor-file-template">
              <div class="pfc-editor-dialog">
               <div class="pfc-editor-file">   
               <div class="pfc-editor-file-actions-holder">  
                <div class="pfc-editor-file-actions" style="color:#ddd">
                 
                 &nbsp;&nbsp;<a href="#" class="pfc-editor-file-encoding"></a>
                  <span class="pfc-editor-file-encoding-chooser" style="display:none">
                  	<select style="width:auto" class="pfc-editor-file-encoding-select">
                      <?php foreach( mb_list_encodings() as $key=>$enc ) { ?>
                        <option value="<?php echo $enc; ?>"><?php echo $enc; ?></option>
                      <?php } ?>
                    </select>
                  </span>
                   &nbsp;&nbsp;<span class="pfc-editor-file-actions-lu" style=""></span> 
                  &nbsp;&nbsp;   <button class="pfc-editor-file-button-save">Save</button>
                  <span class="pfc-editor-file-actions-php" style="display:none">
                    &nbsp;&nbsp;&nbsp; <span class="pfc-editor-file-check">Checking</span>
                  </span>  
                  <span class="pfc-editor-file-actions-sandbox" style="display:none">
                    &nbsp;&nbsp;&nbsp; <button class="pfc-editor-file-button-run">Run</button> 
                    <input type="checkbox" class="pfc-editor-file-option-run-blank">blank
                  </span>  
                  <span>
                    &nbsp;&nbsp; <button class="pfc-editor-file-button-undo">&lt;</button>
                     <button class="pfc-editor-file-button-redo">&gt;</button>
                    
                    &nbsp; <button class="pfc-editor-file-button-goto">goto</button>
                    &nbsp;&nbsp;<button class="pfc-editor-file-button-search">search</button>
                     <button class="pfc-editor-file-button-search-prev">&lt;</button>
                     <button class="pfc-editor-file-button-search-next">&gt;</button>                    
                    &nbsp; <button class="pfc-editor-file-button-replace">replace</button>
                    &nbsp;<button class="pfc-editor-file-button-replace-all">replace all</button>
                    &nbsp;&nbsp;<button class="pfc-editor-file-button-insert">-nor-</button>
                    
                  </span>
                </div>
               </div>  
                <div class="pfc-editor-file-editor">
                    <textarea class="pfc-editor-file-code-editor" id=""></textarea>
                </div>                   
               </div>    
              </div>    
            </div> <!-- pfc-editor-file-content-template -->
            
            
        </div> <!-- pfc-editor-templates -->
         
        