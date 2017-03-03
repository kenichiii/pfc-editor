(function(window,$){
    
    $.extend($.pfc, {

    webapp: function(name, parent, custom) {
          var bean = $.pfc.component(name, parent, $.extend({
              isDecentWebApp:true,
              __ctype: 'webapp',
              tag: 'body',                      
              
            user: {
              isLogged: false,  
              GUID:  "_unknowen", 
              name: "Unknowen Host",
              email: null,
              login: null
            },
                                    
            isSoundOn: true,
            playSound: function(name) {
              if(this.isSoundOn) {

              }  
            },
            sound: function(name) {
                
            },
            
        ui: {            
          
            showWaitingBox: function() {
                $('#pfc-editor-waiting-box').show();
            },

            hideWaitingBox: function() {
                $('#pfc-editor-waiting-box').hide();
            },
            
            alert: function(text,settings) {
              if(!settings.type)
                 pfcSoundsManager.play('sound-ui-alert');
              else if(settings.type && settings.type=='err')
                pfcSoundsManager.play('sound-ui-error');
                
                $.pfcAlert(text,settings);  
                //alert(text.replace("<br>","\n"));
            },
            
            confirm: function(question,yesfunction,params) {
                $.pfcConfirm(question,yesfunction,params);  
                //if(window.confirm(question.replace("<br>","\n")))
                //{
                //    success();
                //}
            },
          
            prompt: function(result,params) {                
                //var res = window.prompt();
                //result(res);
               $.pfcPrompt(result,params);
            },
            
            dialog: function(url,options) {
               $.pfcDialog(url,options);  
            }
            
        } //end ui               
        
          },custom ? custom : {}));                          
          
          return bean;
    
    } //webapp
       
    });


})(window, jQuery);


