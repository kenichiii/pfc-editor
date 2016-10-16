(function(window,$){
    

$.pfcEditor.editor = {
        
        config: {
            appSaveFileUrl:'',
            checkPhpSyntaxUrl:'',
            getFileContentsUrl:'',
            
            checkLastModificationTimeCheckerUrl:'', 
          
            sandboxUrl:'',
          
            
            lastModificationTimeCheckerDelay:5000,
          
                  
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
            else if(code && code.name) {
                 pfcEditorEditorThat.addFile(code,file_path,root,ext);  
             }
             
           $.pfcEditor.ui.hideWaitingBox();       
      
          },'json').fail(function(){
                    $.pfcEditor.ui.hideWaitingBox();    
                    $.pfcEditor.ui.alert('ajax-error',{type:'err'});
                });  
        },
            
        
            
        ui: {
                setFileEditorHeight: function() {                                
                    
                    var body = parseInt($("#pfc-editor-body").height()) - 30 - 20;
                    return body+"px";
                },
                
                removeActiveState: function() {
                       $('.pfc-editor-dialog').not('#pfc-editor-templates .pfc-editor-dialog').hide();
                       $('.pfc-editor-dialog-tab').not('#pfc-editor-templates .pfc-editor-dialog-tab').removeClass('pfc-editor-dialog-tab-active');
                },
                
                openDialogsTabsListeners: function(obj,isPage,code,file_path,root,ext) {
                    
                       $('.pfc-editor-dialog-tab-close').first().unbind('click').click(function(){
                           var id = $(this).next().attr('href');
                           if(obj && typeof obj.close=='function') obj.close();
                           $.pfcEditor.editor.closeDialog(id.replace('#',''));
                           
                           return false;
                       });
                    
                       $('.pfc-editor-dialog-tab-title').first().unbind('click').click(function(){
                           
                           var id = $(this).attr('href');
                           $.pfcEditor.editor.ui.removeActiveState(); 
                           $.pfcEditor.editor.activateTab(id.replace('#',''));
                         
                           if(!isPage && $(this).parent().hasClass('file')) {
                              $.pfcEditor.editor.run_last_modification_checker(code,file_path,root,ext);                                                                                                           
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
                },
                
                
                init: function() {
                    
                    this.openDialogsTabsListeners();
                    this.initKeySaveFile();
                }
                
            }, //ui
            
            addPage: function(page,ext) {
                var params;
                
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
                if(!code || !code.name) return;
                
                var that = this;
                
                if($('#file_'+code.id).hasClass('pfc-editor-dialog'))
                {
                       that.activateTab('file_'+code.id);
                       
                       that.run_last_modification_checker(code,file_path,root,ext); 
                     
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
                    
                   
                   //chrome needs -30px, IE and FF not
                    $('#file_'+code.id+' .pfc-editor-file-actions-holder').css('width',parseInt($("#pfc-editor-body").width())-30+"px");
                  
                    $(window).resize(function(){
                      $('#file_'+code.id+' .ace_editor').css('width','100%').css('height',that.ui.setFileEditorHeight());
                      $('#file_'+code.id+' .pfc-editor-file-actions-holder').css('width',parseInt($("#pfc-editor-body").width())-30+"px");
                    });
                  
                    
                  
                    that.initFileActions(code,ext);
                  
                    $.pfcEditor.editor.ui.openDialogsTabsListeners({},false,code,file_path,root,ext);
                    
                    $.pfcEditor.editor.activateTab('file_'+code.id);                                         
                    
                     
                  
                  
                }//end else          
              
                that.run_last_modification_checker(code,file_path,root,ext); 
                
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
             /*     
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
              */
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
              
                      

                        that.getActiveCEditor().inst.execCommand('undo');
                        
                    return false;
                  });
              
                  $t.find('.pfc-editor-file-button-redo').click(function(){                  
              
                      
                        that.getActiveCEditor().inst.execCommand('redo');
                        
                    return false;
                  });
              
              
                  $t.find('.pfc-editor-file-button-goto').click(function(){                  
              
                      
                        that.getActiveCEditor().inst.execCommand('gotoline');
                        
                    return false;
                  });
              
                  $t.find('.pfc-editor-file-button-search').click(function(){                  
              
                     

                        that.getActiveCEditor().inst.execCommand('find');
                        
                    return false;
                  });

              
              
                  $t.find('.pfc-editor-file-button-replace').click(function(){                  


                        that.getActiveCEditor().inst.execCommand('replace');
                        
                    return false;
                  });
              
           
              
                  $t.find('.pfc-editor-file-button-insert').click(function(){                  
              
                      if($(this).html()==='-nor-') 
                        $(this).html('-ins-');
                      else $(this).html('-nor-');
                    
                        that.getActiveCEditor().inst.execCommand('overwrite');
                        
                    return false;
                  });              
                  
                  $t.find('.pfc-editor-file-button-settings').click(function(){                                
                    
                        that.getActiveCEditor().inst.showSettingsMenu();
                        
                    return false;
                  }); 
            },
       
            run_last_modification_checker: function(code,file_path,root,ext) {
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
                                            
                                             //alert('realod');
                                                     $('.pfc-editor-dialog-tab-active').find('.pfc-editor-dialog-tab-close').first().trigger('click');
                                            that.openfile(file_path,root,ext);
                                            
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
                                            
                                             
                                             //alert('closing');   
                                             $('.pfc-editor-dialog-tab-active').find('.pfc-editor-dialog-tab-close').first().trigger('click');
                                             
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
                                                  that.run_last_modification_checker(code,file_path,root,ext);                                     
                                         
                                          },that.config.lastModificationTimeCheckerDelay);  
                                       }              
                                  
                                },'json').fail(function(){
                                  $('#file_'+code.id+' .pfc-editor-file-actions-lu').html('http error');
                                     if(code.id===that.getActiveCEditorId())
                                       {
                                          setTimeout(function(){ 
                                              if(code.id===that.getActiveCEditorId())
                                                  that.run_last_modification_checker(code,file_path,root,ext);                                     
                                         
                                          },that.config.lastModificationTimeCheckerDelay);                               
                                       }                              
                                });
                                

                }              
              }
            }, 
       
            
            
            initFileCodeEditor: function(code) {
                var that = this;                                
                
                var modelist = ace.require("ace/ext/modelist");
                var filePath = code.name;
                var mode = modelist.getModeForPath(filePath).mode;
                var language = mode.split('/');
                
                $('#'+code.id+'_status_bar').html('mode: '+language[2]);
                $('#'+code.id).css('width','100%').css('height',that.ui.setFileEditorHeight());

                 that.ceditors[code.id].inst =  ace.edit(code.id);
                 
                 ace.require('ace/ext/settings_menu').init(that.ceditors[code.id].inst);                                  
                 ace.require("ace/ext/language_tools");
                 
                    var StatusBar = ace.require("ace/ext/statusbar").StatusBar;
                    // create a simple selection status indicator
                    var statusBar = new StatusBar(that.ceditors[code.id].inst, document.getElementById(code.id+'_status_bar')); 
                  
                that.ceditors[code.id].inst.setOptions(that.aceEditorOptions);                    
                that.ceditors[code.id].inst.session.setMode(mode); 
                 
                	that.ceditors[code.id].inst.commands.addCommands([{
                                    name: "showSettingsMenu",
                                    bindKey: {win: "Ctrl-q", mac: "Command-q"},
                                    exec: function(editor) {
                                            editor.showSettingsMenu();
                                    },
                                    readOnly: false
                            },{
                                name: "overwrite",
                                bindKey: {win:"Insert", mac: "Insert"},
                                exec: function(editor) {
                                        var $t = $('#file_'+code.id+' .pfc-editor-file-actions .pfc-editor-file-button-insert');
                                        if($t.html()==='-nor-') 
                                          $t.html('-ins-');
                                        else $t.html('-nor-');

                                        editor.toggleOverwrite();
                                },
                                readOnly: false
                            }]);
                
                if(that.aceEditorOptions.keyboardBindings !== 'default')                  
                that.ceditors[code.id].inst.setKeyboardHandler(ace.require("ace/keyboard/"+that.aceEditorOptions.keyboardBindings).handler);
                
                            that.ceditors[code.id].inst.getSession().on("change",function(ins,p){
                                $("#pfc-editor-dialogs-heads a[href='#file_"+code.id+"']").parent().addClass('pfc-editor-unsaved-file');                               
                            });
                            
                $('#file_'+code.id+' .ace_editor').css('width','100%').css('height',that.ui.setFileEditorHeight());
                
                that.ceditors[code.id].inst.resize();            
                
                //var fm = that.ceditors[code.id].inst.renderer.$textLayer.$fontMetrics;
                //"xiXbm".split("").map(fm.$measureCharWidth, fm);
                
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
                    //add context menu
                    tab.unbind("contextmenu").bind("contextmenu", function(event) {
                        event.preventDefault();
                
                        that.hideContextMenu();
                               
                        var cm = $($('#pfc-editor-contextmenu-template').html());                                                                                                          
                        cm.appendTo("body");
                    
                        cm.css({top: event.pageY + "px", left: event.pageX + "px"});
            
                        that.initContextMenu(tab);
                    });         
      
                    
                    $('#pfc-editor-dialogs-heads').prepend(
                            tab
                    );
                    
                    that.setEditorDialogsHeadsContainerWidth(); 
            },
            
            initContextMenu: function(tab) {
                    var that = this;
        
                    $(document).bind("click", function(event) {
                        that.hideContextMenu();
                    }); 
                    
                        //Close this
                        $('.pfc-editor-contextmenu-holder a.pfc-editor-btn-close-this').unbind('click').click(function(){
                                tab.find('.pfc-editor-dialog-tab-close').trigger('click');
                                that.hideContextMenu();
                            return false;
                        });
                        
                        //Close ALL
                        $('.pfc-editor-contextmenu-holder a.pfc-editor-btn-close-all').unbind('click').click(function(){
                                $('#pfc-editor-dialogs-heads').find('.pfc-editor-dialog-tab-close').trigger('click');
                                that.hideContextMenu();
                            return false;
                        });                        
                        
                        //Close OTHERS
                        $('.pfc-editor-contextmenu-holder a.pfc-editor-btn-close-others').unbind('click').click(function(){
                                $('#pfc-editor-dialogs-heads').find('.pfc-editor-dialog-tab-close')
                                    .not(tab.find('.pfc-editor-dialog-tab-close'))    
                                    .trigger('click');
                                that.hideContextMenu();
                            return false;
                        });           
                        
                        
                        //Close ALL
                        $('.pfc-editor-contextmenu-holder a.pfc-editor-btn-maximalize').unbind('click').click(function(){
                                $('.pfc-editor-section-minify-href').trigger('click');
                                
                                that.hideContextMenu();
                            return false;
                        });           
            },
            
            hideContextMenu: function() {
                    $('.pfc-editor-contextmenu-holder')
                        .not('#pfc-editor-contextmenu-template .pfc-editor-contextmenu-holder')
                        .remove(); 
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
                        
                        
                        body.find('.pfc-editor-file-code-editor').attr('id',id).val(content);
                        body.find('.pfc-editor-file-status-bar').attr('id',id+'_status_bar');
                        body.hide();
                        
                        $('#pfc-editor-body').prepend(
                            body    
                        );
                
                        $('#file_'+id).show();
            },            
            
            activateTab: function(id) {
                        
                        this.hideContextMenu();
                        
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
             
             this.setEditorDialogsHeadsContainerWidth(); 
         }   
            
} //editor


})(window,jQuery);



