/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

(function(window,$){
     

var pfcEditorSources = {
    factory:function(options) {
    //secid: '',
    var src = {
    config: {
        
        getDirUrl: '?section=sources&ajax=get-dir',
      
        createFileBackupUrl:'?section=sources&action=create-backup-file',
        createNewFileUrl:'?section=sources&action=create-new-file',
        renameUrl:'?section=sources&action=rename',
        createNewFolderUrl:'?section=sources&action=create-new-folder',
        deleteUrl:'?section=sources&action=delete',
        downloadFileUrl:'?section=sources&ajax=download&path=',
        securityUrl:'?section=sources&action=security',  
      
        updaterUrl:'?section=sources&ajax=update',
        updaterTimeout: 900,
        lastModificationCheckerOn: true,
        
      
      opendirs: []
        
    }, //config
    
    panel:function() {        
        return '#'+this.secid;
    },            
            
    init: function() {
        this.setSectionHeaderHolderWidth();
        this.load_app_browser_tabs();
    }, //init
      
    isFocused:false,  
    focus: function() {
      this.isFocused = true;
      this.runUpdater();
    },
    blur: function() {
      this.isFocused = false;
    }, 

    runUpdater: function() {
     if(this.config.lastModificationCheckerOn) 
      {
       var that = this;
        
       $(this.panel).find('.pfc-editor-section-updater').html('checking...');
       var conn = setTimeout(function(){
         $(that.panel).find('.pfc-editor-section-updater').html('bad connection');
       },10000+that.config.updaterTimeout);
        
        var dir = {
         root:this.getActiveRoot(),
         path: this.getActiveRootPath(),
         openedDirs : []
       };
      
       $(this.getActivePanelBody()).find(".expanded").each(function(){
         dir.openedDirs.push({path:$(this).find('a').first().attr('rel')});
       });
      
      $(this.getActivePanelBody()).find('li').addClass('updateNotFounded');	                  
      
      var activeBody = $(that.getActivePanelBody());
      $.post(this.config.updaterUrl,{dir:JSON.stringify(dir)},function(htmltree) {
             
        if(conn) clearTimeout(conn);
        
          if(that.getActiveRoot()===dir.root && $(that.panel()).is(':visible'))
            {
        
                var actualTree = $(that.getActivePanelBody()).html();        
                var actualCursor = 'begin';                        
      
                
        
        
                $(htmltree).find('li').each(function(){
                  if( $(actualTree).find("a[rel='"+$(this).find('a').first().attr('rel')+"']").length )
                    {
                      $(that.getActivePanelBody()).find("a[rel='"+$(this).find('a').first().attr('rel')+"']").parent().removeClass('updateNotFounded');
                      actualCursor = $(that.getActivePanelBody()).find("a[rel='"+$(this).find('a').first().attr('rel')+"']").parent();
                    }
                  else
                    {
                      
                      var t = $(this);
                      if(actualCursor==='begin')
                        $(that.getActivePanelBody()).find('ul').first().append(t);
                      else
                      {
                       if(!$(actualCursor).hasClass('wait')) 
                         {
                          if($(actualCursor).hasClass('expanded'))
                            {
                              $(actualCursor).find('ul').first().prepend(t);      
                              
                            }
                          else 
                            {
                              $(actualCursor).after(t);      
                            }
                           
                        actualCursor = $(that.getActivePanelBody()).find("a[rel='"+$(t).find('a').first().attr('rel')+"']").parent();                           
                           
                         }

                      }
                    }
                });

               $(that.getActivePanelBody()).find('.updateNotFounded').each(function(){
                 $(this).remove(); 
               }); 
                             
              
               $(that.getActivePanelBody()).find('ul').first().fileTree({
                  bindonly:true,
                        root: dir.path, 
                        appfolder: dir.root,
                        script: that.config.getDirUrl, 
                        folderEvent: 'dblclick', 
                        click: function(e) {

                                that.hideContextMenu();

                                if (e.shiftKey) {
                                    alert("shift+click");                        
                                } 

                            return false;
                        },
                        expandSpeed: 1, 
                        callback: function(added,root) {
                            that.init_app_browser_files($(added).find('a'),root);  
                            if(typeof callback == 'function') callback();
                            else if(typeof that.folderLoadCallback == 'function') that.folderLoadCallback();
                        },
                        collapseSpeed: 1 }, 
                  
                            function(file,base) { 

                                that.openfile(file,base);
                            }
                  
                );
            
               if(!$(that.getActivePanelBody()).find('ul').length)
                 {
                   $(that.getActivePanelBody()).append('<ul class="jqueryTree"><li>Empty dir...</li></ul>');
                 }
              
      $(that.panel).find('.pfc-editor-section-updater').html('up to date');
        setTimeout(function(){
          if(that.getActiveRoot()===dir.root && $(that.panel()).is(':visible'))
            that.runUpdater();
        },that.config.updaterTimeout);
      
           } //end if activeRoot
        
      }).fail(function(){
        $(that.panel).find('.pfc-editor-section-updater').html('http error');
        setTimeout(function(){
          
          if(that.getActiveRoot()===dir.root && $(that.panel()).is(':visible'))
           that.runUpdater();
        },that.config.updaterTimeout);
           

      });
      
     }   
    },       
      
    getActiveRoot: function() {
      var h = $(this.panel()).find('.pfc-editor-section-active').first().attr('href');
      return h.replace('#pfc-sources-','');
    },  
      
    getActiveRootPath: function() {
      return $(this.panel()).find('.pfc-editor-section-active').first().attr('rel');
    },        
      
    getActivePanelBody: function() {
      return $($(this.panel()).find('.pfc-editor-section-active').first().attr('href'));
    },  
      
    setSectionHeaderHolderWidth: function() {
          var sw = 50;
          $(this.panel()+" header li a").each(function(){
              sw += parseInt($(this).width())+15;
          });
      
         $(this.panel()+" header .pfc-editor-section-header-inner").css('width',sw+"px");
    },  
      
    folderLoadCallback:null,

    load_app_browser_tabs: function() {
        
      for(var i=0;i<this.config.opendirs.length;i++)
           this.load_app_dir(this.config.opendirs[i].target,this.config.opendirs[i].root,this.config.opendirs[i].path);
    },

    load_app_dir: function(target,root,path,callback) {
        var that = this;
        
        //init header directories
        that.init_app_browser_files($(that.panel()+" header a[href='#pfc-sources-"+root+"']"),root);
        
        $(target).fileTree({ 
            root: path, 
            appfolder: root,
            script: that.config.getDirUrl, 
            folderEvent: 'dblclick', 
            click: function(e) {
                
                    that.hideContextMenu();
                                
                    if (e.shiftKey) {
                        alert("shift+click");                        
                    } 
                
                return false;
            },
            expandSpeed: 1, 
            callback: function(added,root) {
                that.init_app_browser_files($(added).find('a'),root);  
                if(typeof callback == 'function') callback();
                else if(typeof that.folderLoadCallback == 'function') that.folderLoadCallback();
            },
            collapseSpeed: 1 }, 
                function(file,base) { 
                    
                    that.openfile(file,base);
                }
            );        
    },
        
    init_app_browser_files: function(links,root)  
    {      
        var that = this;
           
      
             $(links).unbind("contextmenu").bind("contextmenu", function(event) {
                    event.preventDefault();
               
               		$('.pfc-sources-contextmenu-holder').not('#pfc-sources-contextmenu-template .pfc-sources-contextmenu-holder').remove();
               
                    var cm = $($('#pfc-sources-contextmenu-template').html());
                    
                    cm.find('.pfc-sources-contextmenu-head').prepend($(this).text());
                    if($(this).parent().hasClass('file')) {
                        cm.find('.pfc-sources-contextmenu-head').addClass('file').addClass('ext_'+$(this).attr('extension'));
                    } else {
                        cm.find('.pfc-sources-contextmenu-head').addClass('folder');
                    }
                    
                    if($(this).parent().hasClass('directory'))
                    cm.find('.pfc-sources-contextmenu-section-folder-actions').removeClass('pfc-sources-contextmenu-hidden');
                    
                    if($(this).parent().hasClass('file'))
                    cm.find('.pfc-sources-contextmenu-section-file-actions').removeClass('pfc-sources-contextmenu-hidden');
                    
                    
                    
                    cm.appendTo("body");
                    
                    var pt = event.pageY;
                    var cmh = parseInt(cm.height());
                    var wh = parseInt($(window).height());
                    //console.log(pt)
                    //console.log(cmh)
                    //console.log(wh)
                    if(wh<(pt+cmh)) {
                    cm
                    .css({bottom: "15px", left: event.pageX + "px"});                        
                    }
                    else  cm
                    .css({top: event.pageY + "px", left: event.pageX + "px"});
            
                 that.init_app_browser_context_menu($(this),$(this).parent(),root);
               
               return false;
             });             

              $("#pfc-sources-"+root).parent().unbind("contextmenu").bind("contextmenu", function(event) {
                    event.preventDefault();
                
                	$('.pfc-sources-contextmenu-holder').not('#pfc-sources-contextmenu-template .pfc-sources-contextmenu-holder').remove();
                
                    var obj = $(that.panel()+" header a[href='#pfc-sources-"+root+"']");
                    var parent = $(obj).parent();
               
                    var cm = $($('#pfc-sources-contextmenu-template').html());
                    
                    cm.find('.pfc-sources-contextmenu-head').prepend($(obj).text());
                    if($(obj).parent().hasClass('file')) {
                        cm.find('.pfc-sources-contextmenu-head').addClass('file').addClass('ext_'+obj.attr('extension'));
                    } else {
                        cm.find('.pfc-sources-contextmenu-head').addClass('folder');
                    }
              
      
                    cm.find('.pfc-sources-contextmenu-section-folder-actions').removeClass('pfc-sources-contextmenu-hidden');
                    
                    
                    cm.appendTo("body");
                    
                    var pt = event.pageY;
                    var cmh = parseInt(cm.height());
                    var wh = parseInt($(window).height());
                    //console.log(pt)
                    //console.log(cmh)
                    //console.log(wh)
                    if(wh<(pt+cmh)) {
                    cm
                    .css({bottom: "15px", left: event.pageX + "px"});                        
                    }
                    else  cm
                    .css({top: event.pageY + "px", left: event.pageX + "px"});
            
                 that.init_app_browser_context_menu(obj,parent,root);
             });         
      
    },
    
    init_app_browser_context_menu: function(obj,parent,root) {
        var that = this;
        
             $(document).bind("click", function(event) {
                 that.hideContextMenu();
             }); 
                   
             $('header a').on("click", function(event) {
                 that.hideContextMenu();
                 $(this).off(event);
             }); 
      
             this.initContextMenuReload(obj,parent,root);
    
             this.initContextMenuBackupFile(obj,parent,root);
        
             this.initContextMenuNewFile(obj,parent,root);
             
             this.initContextMenuNewFolder(obj,parent,root);
             
             this.initContextMenuDelete(obj,parent,root);
             
             this.initContextMenuRename(obj,parent,root);
                                       
             this.initContextMenuCopy(obj,parent,root);
             
             this.initContextMenuMove(obj,parent,root);
             
             this.initContextMenuImport(obj,parent,root);
      
             this.initContextMenuDownload(obj,parent,root);
      
             this.initContextMenuSecurity(obj,parent,root);
    },
    
    hideContextMenu: function() {
                      $('.pfc-sources-contextmenu-holder')
                        .not('#pfc-sources-contextmenu-template .pfc-sources-contextmenu-holder')
                        .remove();  
    },

    initContextMenuDownload: function(obj,parent,root) {
        var that = this;
        var wantedFilePath = $(obj).attr('rel');        
        var wantedRoot = root;
        $('.pfc-sources-contextmenu-holder a.pfc-editor-btn-download')
          .attr('href',that.config.downloadFileUrl+wantedFilePath+'&root='+wantedRoot)
          .attr('download',$(obj).text());
    },
      
    initContextMenuReload: function(obj,parent,root) {
        var that = this;
        $('.pfc-sources-contextmenu-holder a.pfc-editor-btn-reload').unbind('click').click(function(){
                that.reload_dir(obj,parent,root);            
                that.hideContextMenu();
            return false;
        });
    },

    initContextMenuBackupFile: function(obj,parent,root) {
        var pfcEditorSourcesThat = this;
        var wantedFilePath = $(obj).attr('rel');        
        var wantedRoot = root;
        var parentDirParent = $(obj).closest('.directory');
        var parentDirObj = $(parentDirParent).find('a').first();
        
        $('.pfc-sources-contextmenu-holder a.pfc-editor-btn-backup').unbind('click').click(function(){
            pfcEditorSourcesThat.hideContextMenu();
            
                    $.post(pfcEditorSourcesThat.config.createFileBackupUrl,{root:root,filepath:wantedFilePath},function(backupingFileActionRes){
                     if(!pfcEditorSourcesThat.config.lastModificationCheckerOn)   
                      pfcEditorSourcesThat.reload_dir(parentDirObj,parentDirParent,root);
                                if(backupingFileActionRes.succ=='yes')
                                {
                                    $(pfcEditorSourcesThat.panel()+" a[rel='"+wantedFilePath+"']").trigger('dblclick');
                                    $.pfcEditor.ui.alert(backupingFileActionRes.msg,{autohide:true,delayAutoHide:1,modal:0}); 
                                }
                                else {
                                   $.pfcEditor.ui.alert(backupingFileActionRes.msg,{type:'err'}); 
                                }                            
                         //   });
                    },'json').fail(function(){
                        pfcEditorSourcesThat.reload_dir(parentDirObj,parentDirParent,wantedRoot);
                        $.pfcEditor.ui.alert('action-error',{type:'err'});
                    });                            
            
            return false;
        });                    
    },            
            
    initContextMenuNewFile: function(obj,parent,root) {
        var pfcEditorSourcesThat = this;
        var newFilePath = $(obj).attr('rel');                                
        
        $('.pfc-sources-contextmenu-holder a.pfc-editor-btn-new-file').unbind('click').click(function(){
            pfcEditorSourcesThat.hideContextMenu();
            $.pfcEditor.ui.prompt(function(newFileName){
                    $.post(pfcEditorSourcesThat.config.createNewFileUrl,{path:newFilePath,filename:newFileName,root:root},function(newFileActionRes){
                      if(!pfcEditorSourcesThat.config.lastModificationCheckerOn)     
                       pfcEditorSourcesThat.reload_dir(obj,parent,root);
                                if(newFileActionRes.succ=='yes')
                                {                        
                                  /*
                                  setTimeout(function(){
                                    $(pfcEditorSourcesThat.panel()+" a[rel='"+newFilePath+newFileName+"']").trigger('dblclick');
                                  },pfcEditorSourcesThat.updaterTimeout+150);
                                    */
                                   var m = /.+\.([^.]+)$/.exec(newFileName);
                                   if ( m ) {
                                    $.pfcEditor.editor.openfile(newFilePath+newFileName,root,m[1]?m[1]:m[0]);
                                   }
                                  
                                   $.pfcEditor.ui.alert(newFileActionRes.msg,{autohide:true,delayAutoHide:1,modal:0}); 
                                }
                                else {
                                    $.pfcEditor.ui.alert(newFileActionRes.msg,{type:'err'});
                                }                            
                        //});
                    },'json').fail(function(){
                        pfcEditorSourcesThat.reload_dir(obj,parent,root);
                        $.pfcEditor.ui.alert('action-error',{type:'err'});
                    });                            
            },{question:'Enter new filename (with dot extension included)'});
            return false;
        });                    
    },
             
    initContextMenuNewFolder: function(obj,parent,root) {
        var pfcEditorSourcesThat = this;
        var newFolderPath = $(obj).attr('rel');                                
        
        $('.pfc-sources-contextmenu-holder a.pfc-editor-btn-new-folder').unbind('click').click(function(){
            pfcEditorSourcesThat.hideContextMenu();
            $.pfcEditor.ui.prompt(function(newFolderName){
                    $.post(pfcEditorSourcesThat.config.createNewFolderUrl,{path:newFolderPath,foldername:newFolderName,root:root},function(newFolderActionRes){
                     
                      if(!pfcEditorSourcesThat.config.lastModificationCheckerOn)     
                        pfcEditorSourcesThat.reload_dir(obj,parent,root);
                      
                                if(newFolderActionRes.succ=='yes')
                                {    
                                    $.pfcEditor.ui.alert(newFolderActionRes.msg,{autohide:true,delayAutoHide:1,modal:0});
                                    $(pfcEditorSourcesThat.panel()+" a[rel='"+newFolderPath+newFolderName+"/']").trigger('dblclick');
                                }
                                else {
                                    $.pfcEditor.ui.alert(newFolderActionRes.msg,{type:'err'});
                                }                            
                        
                    },'json').fail(function(){
                        pfcEditorSourcesThat.reload_dir(obj,parent,root);                       
                        $.pfcEditor.ui.alert('action-error',{type:'err'});
                    });                            
            });
            return false;
        });
    },
        
        
    initContextMenuRename: function(obj,parent,root) {
        var pfcEditorSourcesThat = this;
        //var parentDirParent = $(obj).closest('li').closest('ul').closest('li');
        var parentDirParent = $(parent).closest('ul').closest('.directory');
        //if($(parentDirParent))
        var parentDirObj = $(parentDirParent).find('a').first();
        console.log($(parentDirParent).hasClass('directory'));
        var wantedPath =  './';
        var oldName = $(obj).attr('rel'); 
        oldName = oldName.substring(2, oldName.length);
        if(oldName.substring(oldName.length - 1, oldName.length) == '/')
        {
            oldName = oldName.substring(0, oldName.length - 1);
        }
        if(oldName.lastIndexOf('/'))
        {
            wantedPath += oldName.substring(0, oldName.lastIndexOf('/') + 1);
            oldName = oldName.substring(oldName.lastIndexOf('/') + 1,oldName.length);              
        }
        
        $('.pfc-sources-contextmenu-holder a.pfc-editor-btn-rename').unbind('click').click(function(){
            pfcEditorSourcesThat.hideContextMenu();
            var newName = prompt(wantedPath, oldName);
            oldName = wantedPath + oldName;
            newName = wantedPath + newName;
            
                $.post(pfcEditorSourcesThat.config.renameUrl,{oldname:oldName,newname:newName,root:root},function(renameActionRes){
                  
                  if(!pfcEditorSourcesThat.config.lastModificationCheckerOn)         
                  pfcEditorSourcesThat.reload_dir(parentDirObj,parentDirParent,root);
                  
                                if(renameActionRes.succ=='yes')
                                {    
                                    $.pfcEditor.ui.alert(renameActionRes.msg,{autohide:true,delayAutoHide:1,modal:0});
                                    //$(pfcEditorSourcesThat.panel()+" a[rel='"+newFolderPath+newFolderName+"/']").trigger('dblclick');
                                }
                                else {
                                    $.pfcEditor.ui.alert(renameActionRes.msg,{type:'err'});
                                }                            
                        
                    },'json').fail(function(){
                        pfcEditorSourcesThat.reload_dir(obj,parent,root);                       
                        $.pfcEditor.ui.alert('action-error',{type:'err'});
                    });                            
            });
    },
             
    initContextMenuDelete: function(obj,parent,root) {
        var pfcEditorSourcesThat = this;
        var wantedPath = $(obj).attr('rel');        
        var parentDirParent = $(parent).closest('ul').closest('.directory');
        var parentDirObj = $(parentDirParent).find('a').first();
        var wantedRoot = root;
        
        $('.pfc-sources-contextmenu-holder a.pfc-editor-btn-delete').unbind('click').click(function(){
            pfcEditorSourcesThat.hideContextMenu();            
                $.pfcEditor.ui.confirm('Really delete '+wantedPath+'?',function(){
                            $.post(pfcEditorSourcesThat.config.deleteUrl,{root:wantedRoot,path:wantedPath},function(deletingActionRes){
                        
                              if(!pfcEditorSourcesThat.config.lastModificationCheckerOn)     
                              pfcEditorSourcesThat.reload_dir(parentDirObj,parentDirParent,wantedRoot);
                              
                                    if(deletingActionRes.succ=='yes')
                                    {
                                        //close file in editor
                                        $(pfcEditorSourcesThat.panel()+" a[rel='"+wantedPath+"']").closest('li').closest('ul').closest('li').trigger('dblclick');
                                        //$("a.pfc-editor-dialog-tab-title[href='"+deletingActionRes.fileTab+"']").closest('.expanded').trigger('dblclick');
                                        $.pfcEditor.ui.alert(deletingActionRes.msg,{autohide:true,delayAutoHide:1,modal:0});
                                    }
                                    else {
                                       $.pfcEditor.ui.alert(deletingActionRes.msg,{type:'err'}); 
                                    }                            
                                                                                       
                            },'json').fail(function(){
                                pfcEditorSourcesThat.reload_dir(parentDirObj,parentDirParent,wantedRoot);
                                $.pfcEditor.ui.alert('action-error',{type:'err'});
                            });                            
                 });
                 
            return false;
        });     
    },
                                       
    initContextMenuSecurity: function(obj,parent,root) {
        var pfcEditorSourcesThat = this;
        var wantedPath = $(obj).attr('rel');        
        var wantedRoot = root;        
        
        $('.pfc-sources-contextmenu-holder a.pfc-editor-btn-security').unbind('click').click(function(){
            //pfcEditorSourcesThat.hideContextMenu(); 
                $.post(pfcEditorSourcesThat.config.securityUrl,{root:wantedRoot,path:wantedPath,newright:'0',action:0},function(securityActionRes)
                {
                    if(securityActionRes.succ=='yes')
                    {
                        //$.pfcEditor.ui.alert(securityActionRes.perm,{autohide:true,delayAutoHide:1,modal:0});                           
                        
                        pfcEditorSourcesThat.securityDialog({title: 'Security', inright: securityActionRes.perm}, function(newRight)
                        {
                            if(securityActionRes.perm != newRight.newright)
                            {
                                $.post(pfcEditorSourcesThat.config.securityUrl,{root:wantedRoot,path:wantedPath,newright:newRight.newright,action:1},function(newSecurityActionRes)
                                {
                                    if(newSecurityActionRes.succ=='yes')
                                    {
                                        $.pfcEditor.ui.alert(newSecurityActionRes.msg,{autohide:true,delayAutoHide:1,modal:0});
                                    }
                                    else
                                    { 
                                        $.pfcEditor.ui.alert(newSecurityActionRes.msg,{type:'err'}); 
                                    }
                                },'json').fail(function()
                                {
                                    $.pfcEditor.ui.alert('action-error',{type:'err'});
                                });
                                return false;
                            }
                        });
                    }
                    else 
                    {
                        $.pfcEditor.ui.alert(securityActionRes.msg,{type:'err'}); 
                    } 
                },'json').fail(function()
                {
                    $.pfcEditor.ui.alert('action-error',{type:'err'});                           
                });             
            return false;
        });   
    },
                                       
    initContextMenuCopy: function(obj,parent,root) {},
             
    initContextMenuMove: function(obj,parent,root) {},
             
    initContextMenuImport: function(obj,parent,root) {},
    
    
    securityDialog: function (options, newRightFunction)
    {
        var right = securityCheckbox(options.inright);
        
        var security = $('<div></div>').appendTo('body');
                        security.html('\
                               owner<br>\
                               <input type="checkbox" '+ right[0] +' id="read1">&nbsp;read&nbsp;&nbsp;<input type="checkbox" '+ right[1] +' id="write1">&nbsp;write&nbsp;&nbsp;<input type="checkbox" '+ right[2] +' id="run1">&nbsp;run&nbsp;<br>\
                               <br>group<br>\
                               <input type="checkbox" '+ right[3] +' id="read2">&nbsp;read&nbsp;&nbsp;<input type="checkbox" '+ right[4] +' id="write2">&nbsp;write&nbsp;&nbsp;<input type="checkbox" '+ right[5] +' id="run2">&nbsp;run&nbsp;<br>\
                               <br>other<br>\
                               <input type="checkbox" '+ right[6] +' id="read3">&nbsp;read&nbsp;&nbsp;<input type="checkbox" '+ right[7] +' id="write3">&nbsp;write&nbsp;&nbsp;<input type="checkbox" '+ right[8] +' id="run3">&nbsp;run&nbsp;<br>\
                               ');
                        security.dialog(
                        {
                            modal: true,
                            title: options.title || 'Dialog', zIndex: 10000, autoOpen: true,
                            width: '240px', resizable: false,
                            buttons:
                            {
                                Ok: function () 
                                {     
                                    var newright = [];
                                    var y = 1;
                                    for(var x = 0; x < 3; x++)
                                    {
                                        newright[x] = 0;
                                        if($('#read'+ y).is(':checked'))
                                        {
                                            newright[x] += 4;
                                        }
                                        if($('#write'+ y).is(':checked'))
                                        {
                                            newright[x] += 2;
                                        }
                                        if($('#run'+ y).is(':checked'))
                                        {
                                            newright[x] += 1;
                                        }
                                        y += 1;
                                    }
                                    
                                    var right = options.inright.substring(0, options.inright.length - 3) + newright[0] + newright[1] + newright[2];
                                    $(this).dialog("close");
                                    newRightFunction({newright: right});                         
                                }
                            },
                            close: function (event, ui)
                            {
                                $(this).remove();
                                return false;
                            }
                           
                        });
                        return true;
                        
                        function securityCheckbox(inright)
                        {
                            var y = -1;
                            var right = [];
                            inright = inright.substring(inright.length - 3, inright.length);

                            for(var x = 0; x < 3; x++)
                            {
                                var nowright = inright.substring(x + 1, x);
                                switch (nowright)
                                {
                                    case '0':
                                        right[y += 1] = '';
                                        right[y += 1] = '';
                                        right[y += 1] = '';
                                        break;
                                    case '1':
                                        right[y += 1] = '';
                                        right[y += 1] = '';
                                        right[y += 1] = 'checked';
                                        break;
                                    case '2':
                                        right[y += 1] = '';
                                        right[y += 1] = 'checked';
                                        right[y += 1] = '';
                                        break;
                                    case '3':
                                        right[y += 1] = '';
                                        right[y += 1] = 'checked';
                                        right[y += 1] = 'checked';
                                        break;
                                    case '4':
                                        right[y += 1] = 'checked';
                                        right[y += 1] = '';
                                        right[y += 1] = '';
                                        break;
                                    case '5':
                                        right[y += 1] = 'checked';
                                        right[y += 1] = '';
                                        right[y += 1] = 'checked';
                                        break;
                                    case '6':
                                        right[y += 1] = 'checked';
                                        right[y += 1] = 'checked';
                                        right[y += 1] = '';
                                        break;
                                    case '7':
                                        right[y += 1] = 'checked';
                                        right[y += 1] = 'checked';
                                        right[y += 1] = 'checked';
                                        break;
                                } 
                            }
                            return right;
                        } 
    },
        
    
    reload_dir: function(obj,parent,root,callback) {
        var that = this;
            
            //we have call for main directory in header
            if(!$(parent).hasClass('directory'))
            {                            
                obj = $(that.panel()+" header a[href='#pfc-sources-"+root+"']");
            }
            
            if($(obj).hasClass('pfc-sources-main-href'))
            {
                for(var i=0;i<that.config.opendirs.length;i++)
                {
                    if(that.config.opendirs[i].root==root)
                    {
                     //   $(that.config.opendirs[i].target).html('Reloading dir...');
                        that.load_app_dir(that.config.opendirs[i].target,that.config.opendirs[i].root,that.config.opendirs[i].path,callback);
                    }
                }
                
            }
            else {
                $(parent).removeClass('expanded').addClass('collapsed').find('ul').remove();
                if(typeof callback == 'function')
                    that.folderLoadCallback = function() {
                        callback();
                        that.folderLoadCallback=null;
                    };
                $(obj).trigger('dblclick');
            }
  
    },
    
   openfile: function(f,b)  
    {
        var that = this;
        
        var ext = f.attr('extension');
        var lu =  f.attr('lastmodification');
        var file_path = f.attr('rel');
        var root = b;
        
        $.pfcEditor.editor.openfile(file_path,root,ext,lu);
    }    
    
        }; //end var src
        
     return $.extend(src,options);
    } //end factory

}; //pfcEditorSources


window.$pfcEditorSources = pfcEditorSources;


}(window,jQuery));

