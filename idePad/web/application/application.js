(function(window,$){
                
    $.idePad = $.pfc.webapp("idePad", null, {        
      
        sections: [],
        getSection: function(sel) {
          
          for(var i=0;i<this.sections.length;i++)
          {              
              
              if(this.sections[i].secid === sel)
                  return this.sections[i];
          }
        },
        
        pages: [],
        getPage: function(pageid) {
          for(var i=0;i<this.pages.length;i++)
          {              
              if(this.pages[i].pageid === pageid)
                  return this.pages[i];
          }
        },
        
        tools: [],
        getToolsSection: function(sel) {
          for(var i=0;i<this.tools.length;i++)
          {              
              if(this.tools[i].secid === sel)
                  return this.tools[i];
          }
        },
        
        
        editorBar: [],
        addToEditorBar: function(bean) {
            this.editorBar.push(bean);
            this.writeImage();
        },
        removeFromEditorBar: function(index) {
            this.editorBar.remove(index);    
            this.writeImage();
        },
        
        open: function(type, bean, params) {
           if(type === 'page') {
               this.editor.addPage(bean);
           } else if(type === 'external-page') {
               this.editor.addExternalPage(bean.href);
           } else if(type === 'file') {
               this.editor.openfile(bean.path, bean.root, bean.ext, bean.fileid,bean.realpath);
           } 
        },
        
        initPagesHrefsListeners: function() {
            $('.freePad-ide-page-href').click(function(){
                var page = this.getPage($(this).attr('href'));
                $.idePad.open('page', page);
                return false;
            });
        },
        addPage: function(page) {
          this.pages.push(page);
        }, //addPage
        
        initSectionsHrefsListeners: function() {
            var selector = '.freePad-ide-section-href';
            var that = this;
            
            $(selector).click(function(){
                
              if($('.pfc-editor-section:visible').not('#pfc-editor-tools').length)
              that.getSection( $('.pfc-editor-section:visible').not('#pfc-editor-tools').first().attr('id') ).blur();
              
                    $('.pfc-editor-section').not('#pfc-editor-tools').hide();
                    $('#pfc-editor-head a').removeClass('pfc-editor-active-section-href');
                    $(selector).addClass('pfc-editor-active-section-href');   
                    
                    $("#pfc-editor").css('margin-left','395px');
                    $($(selector).attr('href')).show();
                    section.setSectionHeaderHolderWidth();
                    $($(selector).attr('href')).hide();
                    $($(selector).attr('href')).slideDown(function(){
                      that.getSection( $('.pfc-editor-section:visible').not('#pfc-editor-tools').first().attr('id') ).focus();
                    });
                    
                return false;
            }); 
        },
        addSection: function(section) {
            this.sections.push(section);            
        }, //addSection

        addToolsSection: function(section) {
            this.tools.push(section);                      
        }, //addToolsSection        
        
        
        externalPagesCounter:0,
        initExternalPagesHrefsListeners: function() {
            var that = this;
            $('.pfc-editor-external-link').click(function(){
                that.open('external-page', {
                   href: $(this).attr('href') 
                });
            });
        },
        addExternalPage: function(href) {
                        
                        var template = $('#pfc-editor-external-page-template').html();
                        var pageid = 'expage_'+niceName(href);//+$.pfcEditor.externalPagesCounter+"";
                        var content = '<object width="100%" name="obj_'+pageid+'" type="text/html" data="'+href+'"/>';
                        $.idePad.externalPagesCounter++;
                        
                if($('#'+pageid).hasClass('pfc-editor-dialog'))
                {
                       $.idePad.editor.activateTab(pageid);
                }
                else {
                        
                        $.idePad.editor.addActiveDialogTab($(this).text(),pageid);
                    
                        
                    
                        $.idePad.editor.ui.removeActiveState();                        
                        
                        
                        var body = $(template);
                        
                        body.find('.page-preview-browser').css('width','100%').css('height',parseInt($("#pfc-editor-body").height()) - 5 +"px").append(content);
                        
                        $(window).resize(function(){
                            body.find('.page-preview-browser').css('height','100%').css('height',parseInt($("#pfc-editor-body").height()) - 5 +"px")
                        });
                        
                        body.attr('id',pageid);
                        body.hide();
                        
                        $('#pfc-editor-body').prepend(
                            body    
                        );
                
                
                        $('#'+pageid).show();
                
                       //$('#'+pageid+' .page-preview-browser-holder').first().width((parseInt($('#pfc-editor-body').width())-50)+"px");    
                
                        //$('#'+pageid+' .page-preview-browser-holder').first().resizable();
                    
                        $.idePad.editor.ui.openDialogsTabsListeners({pageid:pageid,close:function(){}});
                        
                        $.idePad.editor.activateTab(pageid);
                    }                                
        },
        
        initStandaloneFilesHrefsListeners: function() {
            var that = this;
            $('.pfc-editor-file-href').click(function(){
                that.open('file',{
                   path: $(this).attr('path'), 
                   root: $(this).attr('root'),
                   ext: $(this).attr('ext'),
                   fileid: $(this).attr('fileid'),
                   realpath: $(this).attr('realpath')
                });
                
                return false; 
            }); 
        },
        
        
        getPageFormOptions: function(success) {
                 return     {
                                    success: success,
                                    beforeSend:function() {
                                        $.pfcEditor.ui.showWaitingBox();
                                    },
                                    error: function(response, status, err){
                                        $.pfcEditor.ui.hideWaitingBox();
                                        $.pfcEditor.ui.alert('action-error',{type:'err'});
                                    },
                                    dataType:  'json'
                            };  
        },
        
        
        ui: {
            
            setSectionsHeight: function() {
                
                var fo = document.getElementById('pfc-editor-footer').offsetTop;
                
                var hh = parseInt($('#pfc-editor-head').height());                                                
                
                var ph = 28;//section header
                
                var sh = fo - hh - ph - (3+5+5+2);
                
                $('.pfc-editor-section-panel').css('height',(sh-20)+'px');
                //$('.pfc-editor-section-panel-body').css('height',(sh-50)+'px');
                $('#pfc-editor-body').css('height',(sh-23)+'px'); //scrollbar
                $('#pfc-editor-tools-body').css('height',(sh)+'px');
                
            }, //setSectionsHeight            
            
            onresizeListener: function() {
               var that = this; 
                $(window).resize(function(){
                    $.idePad.ui.setSectionsHeight();                    
                });
            },
            
            
            sectionsHeadMenuListeners: function() {               
               $('.pfc-editor-section-header li a').unbind('click').click(function(){                 
                 if(!$(this).hasClass('pfc-editor-section-active'))  
                 {                   
                   
                   $(this).closest('.pfc-editor-section-header').find('a').removeClass('pfc-editor-section-active');
                   $(this).addClass('pfc-editor-section-active');
                   $(this).closest('.pfc-editor-section').find('.pfc-editor-section-panel-body').hide();
                   $($(this).attr('href')).slideDown();
                   
                   if($.idePad.getSection($(this).closest('.pfc-editor-section').attr('id')) && 
                     typeof $.idePad.getSection($(this).closest('.pfc-editor-section').attr('id')).focus === 'function')
                   $.idePad.getSection($(this).closest('.pfc-editor-section').attr('id')).focus();
                 }
                
                   return false;
               });
               
            },

            toolsHrefListener: function(){
               $('#pfc-editor-tools-href').click(function(){
                   $("#pfc-editor").css('margin-right','395px');
                   $('#pfc-editor-tools').slideDown();
                   return false;
               });  
            },
            
            sectionsMinimalizeListener: function(){
                $('a.pfc-editor-section-minify-href').click(function(){
                    var secid = $(this).closest('.pfc-editor-section').attr('id');
                    if(secid=='pfc-editor-tools')
                    {
                        $("#pfc-editor").css('margin-right','5px');
                        $('#pfc-editor-tools').hide();
                    }
                    else {
                        $("#pfc-editor").css('margin-left','5px');
                        $('#pfc-editor-head a').removeClass('pfc-editor-active-section-href');
                        $('#'+secid).hide();
                    }
                    
                    return false;
                });
            },            
            initSounds: function() {
                 $("#pfc-editor-head").find('a').mouseover(function(){
                   //pfcSoundsManager.play('sound-menu-over');
                 }).click(function(){
                   pfcSoundsManager.play('sound-menu-click');
                 });
            },
            init: function() {            
                this.initSounds();
                this.setSectionsHeight();
                this.onresizeListener();
                this.sectionsHeadMenuListeners();
                this.toolsHrefListener();
                this.sectionsMinimalizeListener();
            }
                                    
        }, //end ui                
        
        
        
        
        getLocalStorageImageKey: function() {
          return "__freePadEditorImageKey" + this.user.GUID; 
        },
        getLocalStorageImage: function() {
          if(localStorage && localStorage.getItem(this.getLocalStorageImageKey())) {
              return JSON.parse( localStorage.getItem(this.getLocalStorageImageKey()) );
          } else {
              return null;
          } 
        },
        writeImage: function() {
            var image = {
                editorBar: this.editorBar,
                activeEditorBarTab: $('.pfc-editor-dialog-tab-active').first().index(),
                activeSection: $('.pfc-editor-active-section-href').length ? $('.pfc-editor-active-section-href').first().attr('id') : null
                //activeSectionTab:
                //activeToolsSection:
                //activeToolsSectionTab:
                //activeStandaloneApps: []
            };
            
            if(localStorage) {
                localStorage.setItem(this.getLocalStorageImageKey(),  JSON.stringify(image));    
            }
            
        },

        
        init: function(callback) {
            

            this.ui.init();
            
            this.editor.init(); 
             
            this.initExternalPagesHrefsListeners();
            this.initPagesHrefsListeners();
            this.initSectionsHrefsListeners();
            this.initStandaloneFilesHrefsListeners();
             
            /* MAKE ONDEMAND TO DO INIT 
             //boot sections          
             for(var i=0; i < this.sections.length; i++)
             {
                this.sections[i].init();
             }

             //boot tools
             for(var j=0; j < this.tools.length; j++)
             {
                this.tools[j].init();
             }            
            */
            
             //set ASYNC MODE
             $.ajaxSetup({
                    async: true
                    });
            
            var image = this.getLocalStorageImage();
            if(image) {                                    
                
                //open code editor, pages, expages to middle editor
                for(var li = 0; li < image.editorBar.length; li++) {
                  if(image.editorBar[li].type && image.editorBar[li].bean) {  
                    this.open(image.editorBar[li].type, image.editorBar[li].bean, image.editorBar[li].params);
                  }
                }
                
                //set active activeEditorBarTab -> CHANGE TO FILEID OR PAGEID OR EXPAGE ID
                $('.pfc-editor-dialog-tab').eq(image.activeEditorBarTab).find('a').eq(1).trigger('click');
                
                //set active left-panel
                if(image.activeSection) {
                    console.log(image.activeSection)
                    setTimeout(function(){
                        $('#'+image.activeSection).trigger('click');
                    },500);                    
                } else {
                    //all display none -> change margin-left
                    $('#pfc-sources-sources-href').trigger('click');                    
                }
                
                
                //set active ?tools
                
                //visible applications
                                
            } else {
                //open welcome page
                $('#pfc-editor-logo').trigger('click');
                $('#pfc-editor-dialogs-heads a[href="#free-pad_ide-home"]').text('Welcome');
            
                //trigger opened left panel
                $('#pfc-sources-sources-href').trigger('click');
            }
            
             return callback.call(this);
         }

                        
    }); //end freePad IDE
                      
    
})(window,jQuery);
