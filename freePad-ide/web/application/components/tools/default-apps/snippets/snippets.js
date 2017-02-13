


(function(window,$){

var pfcEditorToolsSnippets = {
    sescid: 'pfc-editor-tools-templates',        
    config: {
        getTemplateSourceUrl:'?tools=default/snippets&ajax=get-template-src'
    },
    
    init: function() {
        var that = this;
 
        that.initTemplatesFromAjax();
        
        
    }, //init
    
    pasteCodeToEditor: function(code) {
            var at = $('.pfc-editor-dialog-tab-active .pfc-editor-dialog-tab-title').first().attr('href');
            var eid = at.replace('#file_','');
            if($.pfcEditor.editor.ceditors[eid])
            {
                var doc = $.pfcEditor.editor.ceditors[eid].inst;
                     
                doc.insert(code);
               // doc.focus();
            }
            else {
                $.pfcEditor.ui.alert('Select file to paste template in');
            }  
    },
    
    initTemplatesFromAjax: function() {
        var that = this;
        $('a.pfc-templates-ajax').click(function(){
              $.pfcEditor.ui.showWaitingBox();
              $.get(that.config.getTemplateSourceUrl,{template:$(this).attr('href')},function(res){
                  $.pfcEditor.ui.hideWaitingBox();
                  that.pasteCodeToEditor(res);
              });
        });
    }    
};

$.pfcEditor.addToolsSection('#pfc-editor-tools-templates-href',pfcEditorToolsSnippets);

}(window,jQuery));