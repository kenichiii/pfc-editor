



(function(window,$){


var pfcEditorPhpInfoPage = {
    pageid: 'phpinfo',
    title: 'phpinfo',
    config: {
        url: ''
    },
    
    init: function() {
        $('#phpinfo').find('style').remove();
    }
    
    
}

$.pfcEditor.addPage('#pfc-editor-phpinfo-href',pfcEditorPhpInfoPage)


}(window,jQuery));