




(function(window,$){

var pfcEditorToolsDefault = {
    sescid: 'pfc-editor-tools-default',        
    config: {
        
    },
    focus: function() {
      
    },
    blur: function() {
      
    },
    init: function() {
        
        this.colorPicker();
      
        this.calculator();      
        
        this.getKeyCodeKeypress();
      
        this.getKeyCodeKeydown();
        
    }, //init
    
    colorPicker: function() {
        $('.color-picker-holder').draggable();
        
        $('.color-picker-close').click(function(){
             $('.color-picker-holder').hide();
          return false;
        });
        
        $('.color-picker-main').colpick({
                colorScheme:'dark',
                flat:true,
                submit: 0
        });
        
        $('#pfc-tools-color-picker').click(function(){
            $('.color-picker-holder').show();
            return false;
        });
    },
  
    calculator: function() {
        $('.calc-holder').draggable();
        $('.calc-close').click(function(){
             $('.calc-holder').hide();
          return false;
        });
      /*
        $('.calc-key-back').click(function(){
              pfc_calculator_do_key_back();
          return false;
        });
      */
        $('#pfc-tools-calculator').click(function(){
            $('.calc-holder').show();
            return false;
        });
    },
  
  
    getKeyCodeKeypress: function() {
      $('#pfc-tools-js-keypress-code').click(function(){
        $.pfcEditor.ui.alert('<b>Press any key</b>,<br> it will be capcureda and returned',{modal:0,delayAutoHide:1,autohide:1,type:'info'});        
        $('#pfc-tools-js-key-code-helper').on("keypress",function(event){
           var x = (event.keyCode ? event.keyCode : event.which);                // Get the Unicode value
           var y = String.fromCharCode(x); 

            $.pfcEditor.ui.alert( "Unicode KEY code for keypress <b>"+y+"</b>:<br>" + x,{modal:0,autohide:0,type:'info'} );          
          
          $( this ).off( event );
        });        
        $('#pfc-tools-js-key-code-helper').trigger('focus');
      });
    },
  
    getKeyCodeKeydown: function() {
      $('#pfc-tools-js-keydown-code').click(function(){
        $.pfcEditor.ui.alert('<b>Press any key</b>,<br> it will be capcureda and returned',{modal:0,delayAutoHide:1,autohide:1,type:'info'});
        
        $('#pfc-tools-js-key-code-helper').on("keydown",function(event){
           var x = (event.keyCode ? event.keyCode : event.which);                // Get the Unicode value
           var y = String.fromCharCode(x); 

            $.pfcEditor.ui.alert( "Unicode KEY code for keydown/up <b>"+y+"</b>:<br>" + x,{modal:0,autohide:0,type:'info'} );          
            
          $( this ).off( event );
        });        
        $('#pfc-tools-js-key-code-helper').trigger('focus');
      });      
    }  
};

$.pfcEditor.addToolsSection('#pfc-editor-tools-default-href',pfcEditorToolsDefault);

}(window,jQuery));

