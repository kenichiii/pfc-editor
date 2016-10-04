

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/


(function(window,$){
    
    $.pfcEditor = {        
      
        sections: [],
        getSection: function(sel) {
          
          for(var i=0;i<this.sections.length;i++)
          {              
              
              if(this.sections[i].o.secid==sel)
                  return this.sections[i].o;
          }
        },
        
        pages: [],
        getPage: function(pageid) {
          for(var i=0;i<this.pages.length;i++)
          {              
              if(this.pages[i].o.pageid==pageid)
                  return this.pages[i].o;
          }
        },
        
        tools: [],
        getToolsSection: function(sel) {
          for(var i=0;i<this.tools.length;i++)
          {              
              if(this.tools[i].o.secid==sel)
                  return this.tools[i].o;
          }
        },
        
        
        addPage: function(selector,page,ext) {

            this.pages.push({s:selector,o:page});
            
          $(function(){  
            $(selector).click(function(){
                $.pfcEditor.editor.addPage(page,ext);
                return false;
            });
          });
        }, //addPage
        
        addSection: function(selector,section) {
            this.sections.push({s:selector,o:section});            
            var that = this;
          $(function(){                          
            $(selector).click(function(){
                
              if($('.pfc-editor-section:visible').not('#pfc-editor-tools').length)
              that.getSection( $('.pfc-editor-section:visible').not('#pfc-editor-tools').first().attr('id') ).blur();
              
                    $('.pfc-editor-section').not('#pfc-editor-tools').hide();
                    $('#pfc-editor-head a').removeClass('pfc-editor-active-section-href');
                    $(selector).addClass('pfc-editor-active-section-href');   
                    
                    $("#pfc-editor").css('margin-left','295px');
                    $($(selector).attr('href')).show();
                    section.setSectionHeaderHolderWidth();
                    $($(selector).attr('href')).hide();
                    $($(selector).attr('href')).slideDown(function(){
                      that.getSection( $('.pfc-editor-section:visible').not('#pfc-editor-tools').first().attr('id') ).focus();
                    });
              
              
              
                return false;
            });          
          });
        }, //addSection

        addToolsSection: function(selector,section) {
            this.tools.push({s:selector,o:section});            
          /*  
          $(function(){                          
            $(selector).click(function(){
                    $('.pfc-editor-tools-section').hide();
                    $('#pfc-editor-tools-head a').removeClass('pfc-editor-tools-active-section-href');
                    $(selector).addClass('pfc-editor-tools-active-section-href');                    
                    $($(selector).attr('href')).slideDown();
                return false;
            });           
          });
          */
          
        }, //addToolsSection        
        
        showSection: function(selector) {
            alert($('.pfc-editor-section:visible').attr('id'));
            $('.pfc-editor-section').hide();
            $(selector).show();
        },
        
        externalPagesCounter:0,
        addExternalPages: function() {
            $(function(){                          
                $('.pfc-editor-external-link').click(function(){
                        
                    
                        var href = $(this).attr('href');
                        
                        var template = $('#pfc-editor-external-page-template').html();
                        var pageid = 'expage_'+niceName(href);//+$.pfcEditor.externalPagesCounter+"";
                        var content = '<object width="100%" name="obj_'+pageid+'" type="text/html" data="'+href+'"/>';
                        $.pfcEditor.externalPagesCounter++;
                        
                if($('#'+pageid).hasClass('pfc-editor-dialog'))
                {
                       $.pfcEditor.editor.activateTab(pageid);
                }
                else {
                        
                        $.pfcEditor.editor.addActiveDialogTab($(this).text(),pageid);
                    
                        
                    
                        $.pfcEditor.editor.ui.removeActiveState();                        
                        
                        
                        var body = $(template);
                        
                        body.find('.page-preview-browser').append(content);
                        body.attr('id',pageid);
                        body.hide();
                        
                        $('#pfc-editor-body').prepend(
                            body    
                        );
                
                
                        $('#'+pageid).show();
                
                        $('#'+pageid+' .page-preview-browser-holder').first().width((parseInt($('#pfc-editor-body').width())-50)+"px");    
                
                         $('#'+pageid+' .page-preview-browser-holder').first().resizable();
                    
                        $.pfcEditor.editor.ui.openDialogsTabsListeners({pageid:pageid,close:function(){}});
                        
                        $.pfcEditor.editor.activateTab(pageid);
                    }
                    
                    return false;
                });
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
                    $.pfcEditor.ui.setSectionsHeight();
                    $('.CodeMirror').css('height',$.pfcEditor.editor.ui.setFileEditorHeight());
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
                   
                   if($.pfcEditor.getSection($(this).closest('.pfc-editor-section').attr('id')) && 
                     typeof $.pfcEditor.getSection($(this).closest('.pfc-editor-section').attr('id')).focus === 'function')
                   $.pfcEditor.getSection($(this).closest('.pfc-editor-section').attr('id')).focus();
                 }
                
                   return false;
               });
               
            },

            toolsHrefListener: function(){
               $('#pfc-editor-tools-href').click(function(){
                   $("#pfc-editor").css('margin-right','295px');
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
            
            init: function() {            
                this.initSounds();
                this.setSectionsHeight();
                this.onresizeListener();
                this.sectionsHeadMenuListeners();
                this.toolsHrefListener();
                this.sectionsMinimalizeListener();
            },
            
            
            initSounds: function() {
                 $("#pfc-editor-head").find('a').mouseover(function(){
                   //pfcSoundsManager.play('sound-menu-over');
                 }).click(function(){
                   pfcSoundsManager.play('sound-menu-click');
                 });
            },
          
            showWaitingBox: function() {
                $('#pfc-editor-waiting-box').show();
            },

            hideWaitingBox: function() {
                $('#pfc-editor-waiting-box').hide();
            },
            
            alert: function(text,settings) {
                $.pfcAlert(text,settings);  
              if(!settings.type)
                 pfcSoundsManager.play('sound-ui-alert');
              else if(settings.type && settings.type=='err')
                pfcSoundsManager.play('sound-ui-error');
                //alert(text.replace("<br>","\n"));
            },
            
            confirm: function(question,yesfunction,params) {
                $.pfcConfirm(question,yesfunction,params);  
                //if(window.confirm(question.replace("<br>","\n")))
                //{
                //    success();
                //}
            },
          
            prompt: function(result) {                
                var res = window.prompt();
                result(res);
            },
            
            dialog: function(url,options) {
               $.pfcDialog(url,options);  
            }
            
        }, //end ui                
        
        init: function() {
            

            this.ui.init();
            
            this.editor.init(); 
             
             //boot sections          
             for(var i=0; i < this.sections.length; i++)
             {
                this.sections[i].o.init();
             }

             //boot tools
             for(var j=0; j < this.tools.length; j++)
             {
                this.tools[j].o.init();
             }            
            

             this.addExternalPages();
            
             
        } //init                                   
                        
    }; //end pfcEditor

}(window,jQuery));

