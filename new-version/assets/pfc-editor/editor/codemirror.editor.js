(function(window,$){
    

$.pfcEditor.editor = {
        
        config: {
            appSaveFileUrl:'',
            checkPhpSyntaxUrl:'',
            getFileContentsUrl:'',
            
            checkLastModificationTimeCheckerUrl:'', 
          
            sandboxUrl:'',
          
            phpSyntaxCheckerDelay:1000,
            lastModificationTimeCheckerDelay:5000,
          
          phpSyntaxCheckerOn: true,          
          lastModificationCheckerOn: true          
        },    
        
        openfile:function(file_path,root,ext) {
            var pfcEditorEditorThat = this;
            
                  $.pfcEditor.ui.showWaitingBox();    

         $.post(pfcEditorEditorThat.config.getFileContentsUrl,{path:file_path,root:root},function(code){
                                                                                
           if(code.encoding==='UNKWN')
             {
                  $.pfcEditor.ui.confirm("FILE HAS UNKNOWN ENCODING!<br>Open anyway and risk wrong convert and save?",function(){
                      pfcEditorEditorThat.addFile(code,file_path,root,ext);         
                  });    
             }
           else if(code.saveToOpen=='no')
             {
                  $.pfcEditor.ui.confirm(root+" <b>"+file_path+"</b><br>FILE HAS "+code.encoding+" ENCODING!<br>File dont pass check to be converted to utf-8 and back.<br>Open anyway and most probably get wrong characters encoding convert?",function(){
                      pfcEditorEditorThat.addFile(code,file_path,root,ext);         
                  });    
             }
            else 
                 pfcEditorEditorThat.addFile(code,file_path,root,ext);  
            
           $.pfcEditor.ui.hideWaitingBox();       
      
          },'json').fail(function(){
                    $.pfcEditor.ui.hideWaitingBox();    
                    $.pfcEditor.ui.alert('ajax-error',{type:'err'});
                });  
        },
            
        codeMirror: {
            config: {
                modeUrl: {},
                ui: {}
            },
            
            initDefaults: function() {
                    function autoCloseSlash(cm) {
                        if (cm.getOption("disableInput")) return CodeMirror.Pass;
                        return autoCloseCurrent(cm, true);
                    }

                    CodeMirror.commands.closeTag = function(cm) { return autoCloseCurrent(cm); };

                    CodeMirror.modeURL = this.config.modeUrl+'/%N/%N.js';
            }
        },
            
        ui: {
                setFileEditorHeight: function() {
                    
                    
                  
                    var body = parseInt($("#pfc-editor-body").height()) - 30;
                    return body+"px";
                },
                
                removeActiveState: function() {
                       $('.pfc-editor-dialog').not('#pfc-editor-templates .pfc-editor-dialog').hide();
                       $('.pfc-editor-dialog-tab').not('#pfc-editor-templates .pfc-editor-dialog-tab').removeClass('pfc-editor-dialog-tab-active');
                },
                
                openDialogsTabsListeners: function(obj,isPage,code) {
                    
                       $('.pfc-editor-dialog-tab-close').first().unbind('click').click(function(){
                           var id = $(this).next().attr('href');
                           if(obj && typeof obj.close=='function') obj.close();
                           $.pfcEditor.editor.closeDialog(id.replace('#',''));
                           if(!isPage&&$(this).parent().hasClass('pfc-editor-dialog-tab-active')){
                               if($.pfcEditor.editor.phpChecker!==null) clearTimeout($.pfcEditor.editor.phpChecker);
                           }
                           
                           return false;
                       });
                    
                       $('.pfc-editor-dialog-tab-title').first().unbind('click').click(function(){
                           if($.pfcEditor.editor.phpChecker!==null) clearTimeout($.pfcEditor.editor.phpChecker);
                           var id = $(this).attr('href');
                           $.pfcEditor.editor.ui.removeActiveState(); 
                           $.pfcEditor.editor.activateTab(id.replace('#',''));
                         
                           if(!isPage && $(this).parent().hasClass('file')) {
                              $.pfcEditor.editor.run_last_modification_checker(code); 
                                  setTimeout(function(){
                                     $.pfcEditor.editor.getActiveCEditor().inst.focus();
                                     $.pfcEditor.editor.getActiveCEditor().inst.setCursor(
                                        $.pfcEditor.editor.getActiveCEditor().cursor.line,
                                        $.pfcEditor.editor.getActiveCEditor().cursor.char
                                     );
                                   },250);
                             
                             $.pfcEditor.editor.run_syntax_checker(code);
                             
                           }
                           return false;
                       });
                       
                       $('.pfc-editor-dialog-tab').first().mouseover(function(){
                           $(this).attr('id','active-dialog-tab');
                           var elem = document.getElementById('active-dialog-tab');
                           var top = elem.offsetTop+30;
                           var left =  elem.offsetLeft+20;
                           if($(this).find('.pfc-editor-dialog-info').first().html()!=="")
                           $(this).find('.pfc-editor-dialog-info').css('top',top+"px").css('left',left+"px").show();
                       }).mouseout(function(){
                            $(this).find('.pfc-editor-dialog-info').hide();
                            $(this).attr('id','');
                       });
                },
                
                initKeySaveFile: function() {
                    $(window).bind('keydown', function(event) {                                                
                        if (event.ctrlKey || event.metaKey) {
                            var key = String.fromCharCode(event.which).toLowerCase();
                            if(key=='s')
                            {
                                $.pfcEditor.editor.saveActiveFile();
                                return false;
                            }
                        }                                             
                    });
                    /*
                    $(document).keypress(function(e) {
                    if(e.ctrlKey) {        
                        if(e.key=="s"||e.key=="x")
                        {            
                            return $.pfcEditor.editor.saveActiveFile();
                        }
                    }
                    }); 
                    */
                },
                
                
                init: function() {
                    
                    this.openDialogsTabsListeners();
                    this.initKeySaveFile();
                }
                
            }, //ui
            
            addPage: function(page,ext) {
                var params;
                if(this.phpChecker!==null) clearTimeout(this.phpChecker);
                //test if already open
                if(page.multi)
                {
                    page.counter++;
                    $.pfcEditor.editor.addActiveDialogTab(page.title+' #'+page.counter,page.pageid+'_'+page.counter);
                    $.pfcEditor.ui.showWaitingBox();
                    params = page.config.urlParams?page.config.urlParams:{};
                    $.get(page.config.url,params,function(html){                        
                       
                       
                        $.pfcEditor.editor.ui.removeActiveState();                        
                        
                        $.pfcEditor.editor.addActivePageBody(page.pageid+'_'+page.counter,html);
                        
                        $.pfcEditor.editor.ui.openDialogsTabsListeners(page,true);
                        
                        page.init(page.pageid+'_'+page.counter);
                        $.pfcEditor.editor.activateTab(page.pageid+'_'+page.counter);
                        $.pfcEditor.ui.hideWaitingBox();
                    })
                    .fail(function(){
                        $.pfcEditor.editor.closeDialog(page.pageid+'_'+page.counter);
                        $.pfcEditor.ui.hideWaitingBox();
                        $.pfcEditor.ui.alert('ajax-error',{type:'err'});
                    });
                }
                else if($('#'+page.pageid).hasClass('pfc-editor-dialog'))
                {
                       $.pfcEditor.editor.activateTab(page.pageid);
                }
                else {
                  if($("#pfc-editor-dialogs-heads a[href='#"+page.pageid+"']").length===0)
                  {   
                    $.pfcEditor.editor.addActiveDialogTab(page.title,page.pageid,null,ext);
                    $.pfcEditor.ui.showWaitingBox();
                    params = page.config.urlParams?page.config.urlParams:{};
                    $.get(page.config.url,params,function(html){                        
                       
                       
                        $.pfcEditor.editor.ui.removeActiveState();                        
                        
                        $.pfcEditor.editor.addActivePageBody(page.pageid,html);
                        
                        $.pfcEditor.editor.ui.openDialogsTabsListeners(page,true);
                        
                        page.init();
                        $.pfcEditor.editor.activateTab(page.pageid);
                        $.pfcEditor.ui.hideWaitingBox();
                    })
                    .fail(function(){
                        $.pfcEditor.editor.closeDialog(page.pageid);
                        $.pfcEditor.ui.hideWaitingBox();
                        $.pfcEditor.ui.alert('ajax-error',{type:'err'});
                    });
                }
              }
            },
            
            reloadPage: function(page) {
                //test if already open
                if($('#'+page.pageid).hasClass('pfc-editor-dialog'))
                {
                   
                    $.pfcEditor.ui.showWaitingBox();
                    var params = page.config.urlParams?page.config.urlParams:{};
                    $.get(page.config.url,params,function(html){                        
                                                                                                                        
                        $('#'+page.pageid+' .pfc-editor-dialog-page').html(html);
                                                                        
                        page.init();
                        
                        $.pfcEditor.ui.hideWaitingBox();
                    })
                    .fail(function(){
                        $.pfcEditor.ui.hideWaitingBox();
                        $.pfcEditor.ui.alert('ajax-error',{type:'err'});
                    });
                }
            },
            
            ceditors:[],
            addFile: function(code,file_path,root,ext) {
                if(this.phpChecker!==null) clearTimeout(this.phpChecker);
                var that = this;
                
                if($('#file_'+code.id).hasClass('pfc-editor-dialog'))
                {
                       that.activateTab('file_'+code.id);
                       
                       that.run_last_modification_checker(code); 
                     setTimeout(function(){
                       that.getActiveCEditor().inst.focus();
                       that.getActiveCEditor().inst.setCursor(
                          that.getActiveCEditor().cursor.line,
                          that.getActiveCEditor().cursor.char
                       );
                     },250);
                }
                else
                {                    
                    
                    if(typeof that.ceditors[code.id] == "object")
                    {
                        code.id=that.get_ceditor_id(that.ceditors[code.id].id);
                    } 
                    
                    that.ceditors[code.id]={};
                    that.ceditors[code.id].id=code.id;
         
                    that.addActiveDialogTab(code.name,"file_"+code.id,'<b>'+root+'</b> '+file_path,ext);
                    
                    that.addActiveFileBody(code.id,file_path,root,code.code);

                    that.ceditors[code.id].path = code.path;                
                    that.ceditors[code.id].root = code.base;    
                    that.ceditors[code.id].ext = ext;    
                    that.ceditors[code.id].lu = code.lu;    
                    that.ceditors[code.id].encoding = code.encoding;    
                    that.ceditors[code.id].waitingReload = false;
                  
                  
                    that.initFileCodeEditor(code);
                                                                                    
                    $('#file_'+code.id+' .CodeMirror').css('height',that.ui.setFileEditorHeight());
                   //chrome needs -30px, IE and FF not
                    $('#file_'+code.id+' .pfc-editor-file-actions-holder').css('width',parseInt($("#pfc-editor-body").width())-30+"px");
                  
                    $(window).resize(function(){
                      $('#file_'+code.id+' .CodeMirror').css('height',that.ui.setFileEditorHeight());
                      $('#file_'+code.id+' .pfc-editor-file-actions-holder').css('width',parseInt($("#pfc-editor-body").width())-30+"px");
                    });
                  
                    that.initFileActions(code,ext);
                  
                    $.pfcEditor.editor.ui.openDialogsTabsListeners({},false,code);
                    
                    $.pfcEditor.editor.activateTab('file_'+code.id);                                         
                    
                    that.ceditors[code.id].inst.on('change',function(){                      
                         var cursor = {
                            line: that.ceditors[code.id].inst.getCursor().line,
                            char: that.ceditors[code.id].inst.getCursor().ch
                         };
                       that.ceditors[code.id].cursor = cursor; 
                    });	
                   that.ceditors[code.id].cursor = {line:0,char:0}; 
                  
                  
                }//end else          
              
                that.run_last_modification_checker(code); 
                that.run_syntax_checker(code);
            },
            
            getActiveDialogBody: function() {
                return $($('.pfc-editor-dialog-tab-active a.pfc-editor-dialog-tab-title').attr('href'));
            }, 
       
            get_ceditor_id: function(id,i) {
              var that = this;
              
                    if(typeof i === 'undefined') i = 1;
                    else i++;
              
                    if(typeof that.ceditors[id+i] == "object")
                    {
                        return that.get_ceditor_id(id,i);
                    } 
                    else return id;
            },
       
            getActiveCEditorId: function() {
                var key = $('.pfc-editor-dialog-tab-active a.pfc-editor-dialog-tab-title').first().attr('href');
                return key.replace('#file_','');
            },
       
            getActiveCEditor: function() {
                var that = this;
              
                var test = that.getActiveCEditorId(); 

                
              return that.ceditors[test];
            },
       
            initFileActions:function(code,ext) {
                 var that = this;
                 var $t = $('#file_'+code.id+' .pfc-editor-file-actions').addClass('file-actions-'+ext);
                 $t.find('.pfc-editor-file-encoding').html(code.encoding);
                 
                 $t.find('.pfc-editor-file-button-save').click(function(){
                   that.saveActiveFile();
                   return false;
                 });
              
                 if(code&&code.name.substr(code.name.length-3)=='php')
                   {
                        $t.find('.pfc-editor-file-actions-php').show();
                     if(!that.config.phpSyntaxCheckerOn)
                        $t.find('.pfc-editor-file-check').hide();
                   }
                 
                 if(code.base=='sandbox-src')
                   {
                        $t.find('.pfc-editor-file-actions-sandbox').show();
                     
                        $t.find('.pfc-editor-file-button-run').click(function(){
                          var ch = $t.find('.pfc-editor-file-option-run-blank').first();
                    
                           if(ch.checked)                
                           {
                              window.open(that.config.sandboxUrl+code.path);
                           } 
                          else
                          {
                             $.pfcEditor.ui.dialog(that.config.sandboxUrl+code.path,{modal:0,title:code.name});                                                          
                          }
                                           return false;
                                         });
                     
                   }
                  
                    that.getActiveCEditor().inst.on("change",function(){
                        if($t.find('.pfc-editor-file-button-insert').html()==='-nor-')      
                          {
                            that.getActiveCEditor().inst.toggleOverwrite(false);
                          }
                         else
                           {
                             that.getActiveCEditor().inst.toggleOverwrite(true);
                           }
                     });
              
                    $(window).bind('keydown', function(event) {                                                
                        if(event.which==45 && that.getActiveCEditor().id===code.id)
                         {
                           if($t.find('.pfc-editor-file-button-insert').html()==='-nor-')      
                                {
                                   $t.find('.pfc-editor-file-button-insert').html('-ins-');
                                }
                               else
                                {
                                    $t.find('.pfc-editor-file-button-insert').html('-nor-');
                                }
                                
                         }
                      
                    });
              
                  $t.find('.pfc-editor-file-encoding-select').on("change",function(){
                       var newenc = $(this).val();
                       that.ceditors[code.id].encoding = newenc;
                       $t.find('.pfc-editor-file-encoding').html(newenc).show();	
                       $t.find('.pfc-editor-file-encoding-chooser').hide();
                       $("#pfc-editor-dialogs-heads a[href='#file_"+code.id+"']").parent().addClass('pfc-editor-unsaved-file');
                       $t.find('.pfc-editor-file-encoding').trigger('click');                       
                  });
              
                  $t.find('.pfc-editor-file-encoding').bind('dblclick',function(){
                    $t.find('.pfc-editor-file-encoding').hide();
                    $t.find(".pfc-editor-file-encoding-chooser option[value='"+code.encoding+"']").attr('selected','selected');
                    $t.find('.pfc-editor-file-encoding-chooser').show();
                  });  
              
              
              //init code mirror search shortcuts                  
                  $t.find('.pfc-editor-file-button-undo').click(function(){                  
              
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );

                        that.getActiveCEditor().inst.execCommand('undo');
                        
                    return false;
                  });
              
                  $t.find('.pfc-editor-file-button-redo').click(function(){                  
              
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );

                        that.getActiveCEditor().inst.execCommand('redo');
                        
                    return false;
                  });
              
              
                  $t.find('.pfc-editor-file-button-goto').click(function(){                  
              
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );

                        that.getActiveCEditor().inst.execCommand('gotoLine');
                        
                    return false;
                  });
              
                  $t.find('.pfc-editor-file-button-search').click(function(){                  
              
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );

                        that.getActiveCEditor().inst.execCommand('find');
                        
                    return false;
                  });

                  $t.find('.pfc-editor-file-button-search-prev').click(function(){                  
              
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );

                        that.getActiveCEditor().inst.execCommand('findPrev');
                        
                    return false;
                  });

                  $t.find('.pfc-editor-file-button-search-next').click(function(){                  
              
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );

                        that.getActiveCEditor().inst.execCommand('findNext');
                        
                    return false;
                  });
              
              
                  $t.find('.pfc-editor-file-button-replace').click(function(){                  
              
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );

                        that.getActiveCEditor().inst.execCommand('replace');
                        
                    return false;
                  });
              
                  $t.find('.pfc-editor-file-button-replace-all').click(function(){                  
              
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );

                        that.getActiveCEditor().inst.execCommand('replaceAll');
                        
                    return false;
                  });              
              
                  $t.find('.pfc-editor-file-button-insert').click(function(){                  
              
                      if($(this).html()==='-nor-') 
                        $(this).html('-ins-');
                      else $(this).html('-nor-');
                    
                        that.getActiveCEditor().inst.focus();
                        that.getActiveCEditor().inst.setCursor(
                             that.getActiveCEditor().cursor.line,
                             that.getActiveCEditor().cursor.char
                        );
				
                        that.getActiveCEditor().inst.execCommand('toggleOverwrite');
                        
                    return false;
                  });              
              
            },
       
            run_last_modification_checker: function(code) {
            if(this.config.lastModificationCheckerOn)
            {
              var that = this;
              
              if(code.id===that.getActiveCEditorId())
                {
                                                  
                    $('#file_'+code.id+' .pfc-editor-file-actions-lu').html('checking...');
                  
                                $.post(that.config.checkLastModificationTimeCheckerUrl,{root:code.base,path:code.path,lu:that.ceditors[code.id].lu},function(json){
                                   //console.log(json);
                    
                                    if(json.uptodate==='no' && that.ceditors[code.id].ignore != 'no' && !that.ceditors[code.id].waitingReload && that.ceditors[code.id].lu!=json.actualTime)
                                      {
                                        that.ceditors[code.id].waitingReload = true;
                                        $.pfcEditor.ui.confirm('Actual file has changed on the background.<br>Reload file to last actual version?',
                                         function(){
                                          that.ceditors[code.id].waitingReload = false;
                                       alert('realod');
                                        },{modal:0,nofunction:function(){
                                           that.ceditors[code.id].ignore = 'no';
                                          that.ceditors[code.id].waitingReload = false;
                                            $('#file_'+code.id+' .pfc-editor-file-actions-lu').html('forced pass');
                                        }});
                                      }
                                     else if(json.uptodate==='not-exists' && that.ceditors[code.id].ignore != 'not-exists' && !that.ceditors[code.id].waitingClose)
                                       {
                                        that.ceditors[code.id].waitingClose = true; 
                                        $.pfcEditor.ui.confirm('Actual file has been deleted on the background.<br>Close file?',
                                         function(){
                                          that.ceditors[code.id].waitingClose = false;
                                         alert('closing');   
                                        },{modal:0,nofunction:function(){
                                          that.ceditors[code.id].waitingClose = false;
                                           that.ceditors[code.id].ignore = 'not-exists';
                                            $('#file_'+code.id+' .pfc-editor-file-actions-lu').html('forced pass');
                                        }});                                         
                                       }
                                     else if( that.ceditors[code.id].waitingReload && that.ceditors[code.id].ignore === 'after-save')
                                       {
                                            that.ceditors[code.id].waitingReload = false;
                                            that.ceditors[code.id].ignore = null;
                                       }
                                     else
                                       {
                                         $('#file_'+code.id+' .pfc-editor-file-actions-lu').html('up to date');
                                       }
                                  
                                      if(code.id===that.getActiveCEditorId())
                                       {  setTimeout(function(){ 
                                              if(code.id===that.getActiveCEditorId())	
                                                  that.run_last_modification_checker(code);                                     
                                         
                                          },that.config.lastModificationTimeCheckerDelay);  
                                       }              
                                  
                                },'json').fail(function(){
                                  $('#file_'+code.id+' .pfc-editor-file-actions-lu').html('http error');
                                     if(code.id===that.getActiveCEditorId())
                                       {
                                          setTimeout(function(){ 
                                              if(code.id===that.getActiveCEditorId())
                                                  that.run_last_modification_checker(code);                                     
                                         
                                          },that.config.lastModificationTimeCheckerDelay);                               
                                       }                              
                                });
                                

                }              
              }
            }, 
       
            phpChecker:null,
            
            run_syntax_checker: function(code){
                var that = this;
                         if(code&&code.name.substr(code.name.length-3)=='php')
                                     that.running_php_checker(code);                                     
                         else if(code&&code.name.substr(code.name.length-2)=='js')
                                     that.running_js_checker(code);      
              
                },
            
            running_js_checker: function(cc) { 
              /*
              var info;
              var valid = true;
              for (var i = 0; i <  this.ceditors[cc.id].inst.lineCount(); i++) {
                 //layoutCodeEditor.clearMarker(i);
                 info = this.ceditors[cc.id].inst.lineInfo(i);
                 console.log(info.gutterMarkers)
                 if(info.gutterMarkers)
                 console.log('test'+$(info.gutterMarkers)
                 if(info.gutterMarkers && info.gutterMarkers.className==='CodeMirror-lint-marker-error') valid = false;              
               }
                                    if(valid)
                                    $('#file_'+cc.id+' .pfc-editor-file-check').html('<span style="color:lightskyblue">valid js file</span>');   
                                        else
                                    $('#file_'+cc.id+' .pfc-editor-file-check').html('<span style="color:red">Errors parsing</span>');
              
              var that = this;
                    setTimeout(function(){
                      that.running_js_checker(cc);
                    },1500);
              */      
            },      
       
     makeErrorMarker: function(error) {
      var elem = document.createElement('div');
      elem.className = 'error-marker';
      elem.innerHTML = '<div style="background-color:red;border-radius:3px;padding-left:3px;padding-right:3px">X</div>';
      elem.setAttribute('title', error);
      return elem;
    },
       
            running_php_checker: function(cc) {
             if(this.config.phpSyntaxCheckerOn)
             {
              var that = this;  
              
              if(cc.id===that.getActiveCEditorId())
                {
                     that.phpChecker = setTimeout(function(){
                              var c = that.ceditors[cc.id].inst.getValue();
                              var tc = setTimeout(function(){
                                $('#file_'+cc.id+' .pfc-editor-file-check').html('<span>checking...</span>');   
                                tc = setTimeout(function(){
                                     $('#file_'+cc.id+' .pfc-editor-file-check').html('<span>bad connection</span>');   
                                },12000);    
                              },2000);
                                
                                $.post(that.config.checkPhpSyntaxUrl,{code:c},function(json){
                                  
                                  clearTimeout(tc);
                                  
                                  that.ceditors[cc.id].inst.clearGutter("error-gutter");
                                  
                                    if(json.errors=='FALSE')
                                      {
                                           $('#file_'+cc.id+' .pfc-editor-file-check').html('<span class="valid-file-text">valid php file</span>');       
                                      }                                    
                                     else 
                                     {
                                           $('#file_'+cc.id+' .pfc-editor-file-check').html('<span class="file-text-errors">Errors parsing</span>');
                                           
                                            var e = json.syntax.message;                                                                                                                                  
                                           
                                            that.ceditors[cc.id].inst.setGutterMarker(parseInt(e[1])-1, "error-gutter", that.makeErrorMarker(e[0]));
                                          
                                     }
                                    
                                                                        
                                         if(cc.id===that.getActiveCEditorId())
                                           {
                                             that.running_php_checker(cc);                                     
                                           }
                                                                                                                                                                                  
                                },'json').fail(function(){
                                    $('#file_'+cc.id+' .pfc-editor-file-check').html('<span>http error</span>');   
                                     if(cc.id===that.getActiveCEditorId())
                                       {
                                           that.running_php_checker(cc);                                     
                                       }                              
                                });
                                
                            },this.config.phpSyntaxCheckerDelay);  
                }
             }
            },
            
            initFileCodeEditor: function(code) {
                var that = this;
                var cfg = $.pfcEditor.editor.codeMirror.config.ui;
                
                if(code.name.substr(code.name.length-2)=='js'   || 
                   code.name.substr(code.name.length-3)=='css'  ||
                   code.name.substr(code.name.length-4)=='json'  )
                 {
                    cfg.gutters = ["CodeMirror-lint-markers"];
                    cfg.lint = false;                                        
                 }
                 
               
                that.ceditors[code.id].inst = CodeMirror.fromTextArea(
                        document.getElementById(code.id),
                        cfg
                 );
               
                
                           var val = code.name, m, mode, spec;
                           m = /.+\.([^.]+)$/.exec(val);
                            if ( m ) {
                                var info = CodeMirror.findModeByExtension(m[1]);
                                if (info) {
                                    mode = info.mode;
                                    spec = info.mime;
                                }
                            } else {
                                mode = spec = false;
                            }
                            
                            
                            
                            
                            if (mode) {
                                    that.ceditors[code.id].inst.setOption("mode", spec);
                                    CodeMirror.autoLoadMode(that.ceditors[code.id].inst, mode);                    
                            } else {
                               
                            }

                       
                
                            that.ceditors[code.id].inst.on("change",function(ins,p){
                                $("#pfc-editor-dialogs-heads a[href='#file_"+code.id+"']").parent().addClass('pfc-editor-unsaved-file');                               
                            });
                            
                            
                
                that.ceditors[code.id].inst.execCommand('goDocStart');
                that.ceditors[code.id].inst.focus();
                that.ceditors[code.id].inst.setCursor(35);
                that.ceditors[code.id].inst.focus();
                that.ceditors[code.id].inst.setCursor(0);
                
               if(code.name.substr(code.name.length-2)=='js' || 
                  code.name.substr(code.name.length-4)=='json')
                { that.ceditors[code.id].inst.setOption("mode", "javascript");
                  setTimeout(function(){
                   that.ceditors[code.id].inst.setOption("lint", true);
                  },2000);
                }
            
               /*if(code.name.substr(code.name.length-3)=='css')
                { that.ceditors[code.id].inst.setOption("mode", "css");
                that.ceditors[code.id].inst.setOption("lint", true);}*/
            },
            
            closeDialog: function(id) {
              var that = this;
              
                        $('#'+id).remove();
                        
                        $("#pfc-editor-dialogs-heads a[href='#"+id+"']")
                                .parent().remove();
                        
              that.setEditorDialogsHeadsContainerWidth(); 
                        //find nexr or prev
            },
            
            addActiveDialogTab: function(title,id,info,ext) {
              var that = this;
                        
                    var template = $('#pfc-editor-open-dialog-tab-template').html();
                    var tab = $(template);
                    
                    if(ext)
                    {
                      tab.addClass('file').addClass('ext_'+ext); 
                    }
                    else if(ext=='page')
                      {
                        tab.addClass('ext_page'); 
                      }
                    else
                      {
                        tab.addClass('editor-page'); 
                      }
              
                    tab.find('.pfc-editor-dialog-tab-title').attr('href','#'+id).html(title);
                    //add info
                    tab.find('.pfc-editor-dialog-info').html(info);
                    
                    $('#pfc-editor-dialogs-heads').prepend(
                            tab
                    );
                    
                    that.setEditorDialogsHeadsContainerWidth(); 
            },

            setEditorDialogsHeadsContainerWidth: function() {
                   var dw = 20;
                   $('.pfc-editor-dialog-tab').each(function(){
                       dw += parseInt($(this).width())+37;
                   });
                    $('#pfc-editor-dialogs-heads').css('width',dw+"px");
            },
       
            addActivePageBody: function(pageid,content) {
                        var template = $('#pfc-editor-page-template').html();
                        var body = $(template);
                        
                        body.find('.pfc-editor-dialog-page').html(content);
                        body.attr('id',pageid);
                        body.hide();
                        
                        $('#pfc-editor-body').prepend(
                            body    
                        );
                
                        $('#'+pageid).show();
            },
            
            addActiveFileBody: function(id,path,root,content) {
                        var template = $('#pfc-editor-file-template').html();
                        var body = $(template);
                        
                        body.attr('id','file_'+id);
                        
                        
                        body.find('textarea').attr('id',id).val(content);
                        
                        body.hide();
                        
                        $('#pfc-editor-body').prepend(
                            body    
                        );
                
                        $('#file_'+id).show();
            },            
            
            activateTab: function(id) {
                        
                        
                        
                        $.pfcEditor.editor.ui.removeActiveState();
                        
                        $('#'+id).show();
                        
                        $("#pfc-editor-dialogs-heads a[href='#"+id+"']")
                                .parent().addClass('pfc-editor-dialog-tab-active');  
            },
            
    saveActiveFile: function(confirmOverwrite)
    {
        var that = this;
        var at = $('.pfc-editor-dialog-tab-active .pfc-editor-dialog-tab-title').first().attr('href');
        
        if($('#pfc-editor-dialogs-heads').find('.pfc-editor-dialog-tab-active').length>0 && 
           $($('.pfc-editor-dialog-tab-active a').last().attr('href')).css('display')!='none' && 
           at.substr(0,6)=="#file_"
          )
        {
          
              $.pfcEditor.ui.showWaitingBox();
                
                var key = $('.pfc-editor-dialog-tab-active a.pfc-editor-dialog-tab-title').first().attr('href');
                var test = key.replace('#file_','');

                that.ceditors[test].waitingReload = true;
          
                $.post(that.config.appSaveFileUrl,{
                    code:that.ceditors[test].inst.getValue(),
                    path:that.ceditors[test].path,
                    root:that.ceditors[test].root,
                    encoding:that.ceditors[test].encoding,
                    confirmOverwrite: confirmOverwrite ? 'yes' : 'no'
                },function(res) {
                     if(res.succ=='yes')
                     {
                       
                         that.ceditors[test].ignore = 'after-save';
                       
                        that.ceditors[test].lu = res.lu;
                        $('#pfc-editor-dialogs-heads').find('.pfc-editor-dialog-tab-active').removeClass('pfc-editor-unsaved-file'); 
                        $.pfcEditor.ui.alert('File successfully saved',{autohide:true,delayAutoHide:1,modal:0});
                        
                     }
                     else if(res.succ=='waiting')
                     {
                       if(res.type === 'cant-succ-convert')
                         {
                           $.pfcEditor.ui.confirm(that.ceditors[test].root+" <b>"+that.ceditors[test].path+"</b><br>FILE HAS "+that.ceditors[test].encoding+" ENCODING.<br>File contents dont pass check to be converted to this and back to UTF-8.<br>Save anyway with most probably wrong encoded characters?",
                                         function(){
                             that.saveActiveFile(true);
                           });	
                         }
                     }
                     else {
                       $.pfcEditor.ui.alert(res.msg,{type:'err'});
                     }
                      
                     $.pfcEditor.ui.hideWaitingBox();
                     
                    return false;
                },'json').fail(function(){
                    $.pfcEditor.ui.hideWaitingBox();
                    
                    that.ceditors[test].ignore = 'after-save'; 
                  
                    $.pfcEditor.ui.alert('action-error',{type:'err'});
                });
                
        }
        else $.pfcEditor.ui.alert('No file is active to save',{type:'err'});
        
        return false;
    },
                
    
            
         init: function() {
             this.ui.init();
             this.codeMirror.initDefaults();
             this.setEditorDialogsHeadsContainerWidth(); 
         }   
            
} //editor


})(window,jQuery);
