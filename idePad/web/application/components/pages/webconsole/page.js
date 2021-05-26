


(function(window,$){


var pfcEditorWebterminalPage = {
    pageid: 'webconsole',
    title: 'SHELL TERMINAL',
    config: {
        url: ''
    },
    
    init: function() {
           //set iframe holder height
        $('.webterminal-iframe-holder').parent().css('margin','0').css('padding','0').css('padding-right','5px');
        var height = parseInt($("#pfc-editor-body").height()) - 18;
        $('.webterminal-iframe-holder').css('height',height+"px"); 
        $(window).resize(function(){
            var height = parseInt($("#pfc-editor-body").height()) - 18;
            $('.webterminal-iframe-holder').css('height',height+"px");             
        });
    }
    
    
}

$.pfcEditor.addPage('#pfc-editor-webterminal-href',pfcEditorWebterminalPage);


}(window,jQuery));