

(function(window,$){

var pfcEditorConfigPage = {

    pageid: 'free-pad_editor-config', 

    title: 'Editor Config',
        
    config: {
        url: ''
    },
    
    init: function() {
        init_app_config_form();
        var ft = $('#pfc-editor-config-accordicon .accordicon-footer').html();
        $('#pfc-editor-config-accordicon .accordicon-body').each(function(){
            $(this).append(ft);
        });
        
        $('#pfc-editor-config-accordicon .accordicon-head').click(function(){
            var s = $(this).attr('href');
            var sel = s.replace('#','#pfc-editor-config-accordicon .');            
            if($(sel).css('display')=="none")
            {
                $('#pfc-editor-config-accordicon .accordicon-head').removeClass('accordicon-head-active');
                $(this).addClass('accordicon-head-active');
                $('#pfc-editor-config-accordicon .accordicon-body').hide();
                $(sel).slideDown();
            }
            else {
                $('#pfc-editor-config-accordicon .accordicon-head').removeClass('accordicon-head-active');
                $(sel).slideUp();
            }
            
            return false; 
        });
        
        
    }
    
    
};

$.pfcEditor.addPage('#pfc-editor-config-href',pfcEditorConfigPage);


/*
 * CONFIG FORM LISTENERS
 */        
  function init_app_config_form() {
                            
                            var options = {
                                    success: form_editor_config,
                                    beforeSend:function() {
                                        $.pfcEditor.ui.showWaitingBox();
                                    },
                                    error: function(response, status, err){
                                        $.pfcEditor.ui.hideWaitingBox();
                                        $.pfcEditor.ui.alert('action-error',{type:'err'});
                                    }
                              //      dataType:  'json'
                            };
                            
                           $('#pfc-editor-config').ajaxForm(options);
    
                           var $firstPwd =  $('#pfc-editor-config').find("input[name='webmasterauthpwd']").first();
                           var $secPwd =  $('#pfc-editor-config').find("input[name='webmasterauthpwd2']").first();
    
                          $secPwd.blur(function(){
                          if($firstPwd.val()!=$secPwd.val())
                            {
                              $.pfcEditor.ui.alert('Passwords dont match',{type:'err'});
                            }
                        });
    
    } //init_app_config_form
    
    
    

    
                    function form_editor_config(res)
                    {
                        //$.pfcEditor.ui.hideWaitingBox();
                        $.pfcEditor.ui.hideWaitingBox();
                        if(res === "PASSWORDS DONT MATCH")
                          {
                            $.pfcEditor.ui.alert(res.replace("\n","<br>"),{autohide:false,type:'err'}); 
                          }
                        else
                           $.pfcEditor.ui.alert(res.replace("\n","<br>"),{autohide:false});
                    }    
    
    

}(window,jQuery));
