

(function(window,$){


var pfcEditorAdminerPage = {
    pageid: 'adminer',
    title: 'ADMINER',
    
    multi: true,
    counter: 0,
    
    config: {
        url: ''
    },
    
    init: function() {
        //set iframe holder height
        $('.adminer-iframe-holder').parent().css('margin','0').css('padding','0').css('padding-right','5px');
        var height = parseInt($("#pfc-editor-body").height()) - 8;
        $('.adminer-iframe-holder').css('height',height+"px");
    }
    
    
}

$.pfcEditor.addPage('#pfc-editor-adminer-href',pfcEditorAdminerPage)


}(window,jQuery));