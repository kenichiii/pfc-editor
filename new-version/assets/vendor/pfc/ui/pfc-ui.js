
 /*
  *  show href
  */
(function($){
$.fn.pfcShowHrefClass = function(callback) {
  
  this.each(function()  
  {  
    var href = $(this).attr('href');
    var selector = href.replace('#','.');
    $(selector).removeClass('pfcss-hidden').show(function(){
      if(typeof callback == 'function') callback($(selector),$(this));  
    });
    
  });
  
    return this;
};        
}(jQuery));

(function($){
$.fn.pfcShowHrefId = function(callback) {
  
  this.each(function()  
  {  
    var selector = $(this).attr('href');
    $(selector).removeClass('pfcss-hidden').show(function(){
      if(typeof callback == 'function') callback($(selector),$(this));  
    });
  });
  
    return this;
};        
}(jQuery));

(function($){
$.fn.pfcOnClickShowHrefClass = function(callback) {
  
  this.each(function()  
  {  
    $(this).click(function(){        
        var href = $(this).attr('href');
        var selector = href.replace('#','.');
        $(selector).removeClass('pfcss-hidden').show(function(){
      if(typeof callback == 'function') callback($(selector),$(this));  
    });
    });
  });
  
    return this;
};        
}(jQuery));

(function($){
$.fn.pfcOnClickShowHrefId = function(callback) {
  
  this.each(function()  
  {  
    $(this).click(function(){  
        var selector = $(this).attr('href');
        $(selector).removeClass('pfcss-hidden').show(function(){
      if(typeof callback == 'function') callback($(selector),$(this));  
    });
    });
  });
  
  return this;
};        
}(jQuery));

 /*
  *  UI TABS
  */
(function($){
    
$.fn.pfcTabs = function(options,data) {
        
    if( typeof options == 'object')
    {
        var settings = $.extend({
            firstTabOpen: true,
            tabsRules: [],            
            open: function(tabhref,tabsholder) {
                
            },
            api: {
                init:$.fn.pfcTabs.init,
                initTabs:$.fn.pfcTabs.initTabs,
                openTab:$.fn.pfcTabs.openTab,
                addRule:$.fn.pfcTabs.addRule
            }
        }, options );
                           
        this.data('settings',settings);   
        
        settings.api.init(this);             
    }
    else if( options == 'openTab' )
    {
        var settings = this.data('settings');
        settings.api.openTab(data,this);
    }
    else if( options == 'addRule' )
    {
        var settings = this.data('settings');
        settings.api.addRule(data,this);
    }    
    
    return this;
};//end $.fn.pfcTabs  




$.fn.pfcTabs.init = function(parent){
                var settings = parent.data('settings');
    
                    $.fn.pfcTabs.getWidth(parent);
                
                    parent.find('.pfc-tabs-head').first().find('.pfc-tab-menu').removeClass('active');
                    parent.find('.pfc-tabs').first().find('.pfc-tab').hide();
                    
                    $.fn.pfcTabs.initTabs(parent);
                 
                    if(settings.firstTabOpen) $.fn.pfcTabs.openTab(0,parent);
                
}; //init

$.fn.pfcTabs.getWidth = function(parent) {
                var tcw = parseInt(parent.css('width'));
                if(tcw>0)
                {
        
                    $.fn.pfcTabs.getWidthPure(parent);
                    
                    $(window).resize(function(){
                        $.fn.pfcTabs.getWidthPure(parent);
                    });
                    
                    setTimeout(function(){
                        $.fn.pfcTabs.getWidthPure(parent);
                    },500);
                }
};

$.fn.pfcTabs.getWidthPure =function(parent)
{
    /*
                    var maxwidth = parent.parent().width();
                    
                     
                    parent.css('width',maxwidth);
                    parent.find('.pfc-tabs-holder').not('.pfc-tab .pfc-tabs-holder').css('width',maxwidth);
                    
                 
                     var tbw = parseInt(maxwidth) - ( 
                       parseInt(parent.find('.pfc-tab').css('padding-left'))
                     + parseInt(parent.find('.pfc-tab').css('padding-right'))
                     + parseInt(parent.find('.pfc-tab').css('margin-left'))
                     + parseInt(parent.find('.pfc-tab').css('margin-right'))
                     );            
                     
                    parent.find('.pfc-tab').css('width',tbw+'px');
                    
                    var hw = parseInt(maxwidth) - ( 
                       parseInt(parent.find('.pfc-tabs-head').first().css('padding-left'))
                     + parseInt(parent.find('.pfc-tabs-head').first().css('padding-right'))
                     + parseInt(parent.find('.pfc-tabs-head').first().css('margin-left'))
                     + parseInt(parent.find('.pfc-tabs-head').first().css('margin-right'))
                     );    
        
                    parent.find('.pfc-tabs-head').css('width',hw+'px');    
                 
      */           
};

$.fn.pfcTabs.initTabs = function(parent) {
                  parent.find('.pfc-tabs-head').first().find('.pfc-tab-menu').unbind('click')
                            .click(function(){
                                var settings = parent.data('settings');
                                    
                                var wantedtab = $(this).attr('href');
                                wantedtab = wantedtab.replace('#','.');
                                
                                parent.find('.pfc-tabs').first().find('.pfc-tab').find('.pfc-tab-menu').removeClass('active');
                                parent.find('.pfc-tabs-head').first().find('.pfc-tab-menu').removeClass('active');
                                parent.find('.pfc-tabs').first().find('.pfc-tab').hide();
                                
                                parent.find('.pfc-tabs').first().find(wantedtab).show();                                
                                
                                
                                settings.open(this,parent);
                                
                                $(this).addClass('active');
                               
                                    for(var i=0;i<settings.tabsRules.length;i++)
                                    {  
                                        if( settings.tabsRules.href == $(this).attr('href') )
                                        { 
                                            settings.tabsRules.callback();  
                                        }
                                    }
                                    
                                    
                                return false;
                            });
}; //initTabs

$.fn.pfcTabs.openTab = function(index,parent) {

                parent.find('.pfc-tabs-head').find('.pfc-tab-menu').removeClass('active');
                parent.find('.pfc-tabs').first().find('.pfc-tab').hide();
                parent.find('.pfc-tabs').first().find('.pfc-tab').find('.pfc-tab-menu').removeClass('active');
    
                var active = parent.find('.pfc-tabs > .pfc-tab').eq(index);
                
                $(active).show();
                
                                var settings = parent.data('settings');
                                
                                settings.open(this,parent);
                                
                                $(active).addClass('active');

                                    for(var i=0;i<settings.tabsRules.length;i++)
                                    {  
                                        if( settings.tabsRules.href == $(active).attr('href') )
                                        { 
                                            settings.tabsRules.callback();  
                                        }
                                    }                
    
}; //openTab

$.fn.pfcTabs.addRule = function(rule,parent) {
                                var settings = parent.data('settings');
                                settings.tabsRules.push(rule);
                                parent.data('settings',settings);                                
    
}; //openTab


}(jQuery));
/*
 * END UI TABS
 */

/**
 * 
 * ALERTS
 */
(function($){

    var $front = $({});
    var ALERT_SHOW_TIMEOUT;
    
    $.pfcAlert = function(message,options) {
            var settings = {
                callback:function(){},
                type:"OK",//OK|err|info
                modal:null,//true|false
                autohide:null,//true|false
                buttonText:"OK",
                topMargin: 50,//pixels
                startFromMinus: 100,//pixels
                delayAutoHide: 2000,//ms
                delaySlideDownStartAni: 1000,//ms
                delaySlideUpEndAni: 500,//ms
                
                nested: false,
                
                container: '.pfc-popup-alert-holder',
                prefix:'pfc-popup-alert-',
                alertOk:'pfc-popup-alert-OK',
                alertErr:'pfc-popup-alert-err',
                alertInfo:'pfc-popup-alert-info',
                modal:'.pfc-popup-modal-holder',
                mbox:'.pfc-popup-alert-message-holder',
                btn:'.pfc-popup-alert-button'
            };

            $.extend( settings, options );
            
            if(settings.type=="err"&&settings.autohide===null) settings.autohide=false;
            if(settings.autohide===null) settings.autohide= true;       

            if(settings.type=="err"&&settings.modal===null) settings.modal=true;
            if(settings.modal===null) settings.modal = false;             
            
            
            
            
            var $alert = function(){                            
                
                clearTimeout(ALERT_SHOW_TIMEOUT);
                
                $(settings.container)
                        .removeClass(settings.alertOk)
                        .removeClass(settings.alertErr)
                        .removeClass(settings.alertInfo)
                    .addClass(settings.prefix+settings.type);                
            
                $(settings.mbox).html(message);    
            
                var pwidth = parseInt($(settings.container).css('width')); 

                var wwidth = $(window).width();
                var wheight = $(window).height();               
                var wscrolltop = $(window).scrollTop();

                var pendtop = ""+(wscrolltop+settings.topMargin)+"px"; 
                var pstarttop = ""+(wscrolltop-settings.startFromMinus)+"px";       
                var pleft;       
 
                if(wwidth>pwidth)
                {
                    //center
                    pleft = ""+(wwidth/2-pwidth/2)+"px";           
                }
                else if(wwidth<=pwidth)
                {
                    $(settings.container).css('width',""+(wwidth-20)+"px");           
                    pleft = "10%";
                }            

                
                     $(settings.btn).html(settings.buttonText).unbind('click').click(function(){
                            hideAlert();   
                            return false;
                        });
                
                
                    if(settings.modal)
                    {
                        $(settings.modal).css({'width':$(document).width(),'height':$(document).height()}).show();
                    }                    

                    $(settings.container)
                       .css({'top':pstarttop,'opacity':'0','left':pleft})
                       .show()
                       .animate({
                         opacity: 1,
                         top: pendtop
                         }, settings.delaySlideDownStartAni, function() {

                               if(settings.autohide) 
                                ALERT_SHOW_TIMEOUT = setTimeout(function(){
                                    hideAlert();
                                },settings.delayAutoHide);    
                         });

                    function hideAlert(silent)
                    {                       
                        settings.callback();
                        $(settings.modal).hide();
                        $(settings.container)
                                .animate({
                                    'opacity':'0',
                                    'top':pstarttop
                                  },settings.delaySlideUpEndAni
                                  ,function(){
                                           
                                            $front.dequeue();
                                        }
                                   );                
                    }                                
            }; //end $alert
            
            
            if(settings.nested)
            {                
                var newqueue = [];
                var fq = $front.queue();
                newqueue.push(fq[0]);
                newqueue.push($alert);
                for(var i = 0; i < fq.length;i++ )
                {
                    if(typeof fq[i] == 'function')
                        newqueue.push(fq[i]);
                }
                clearTimeout(ALERT_SHOW_TIMEOUT);                
                $front.queue(newqueue);
            }
            else $front.queue($alert);                        
            
            
    }; //end pfcAlert
    
    
$.pfcConfirm = function(question,yesfunction,params)
{
    var settings = {    
        buttonYes: 'YES',
        buttonNo: 'NO',
        topMargin: 50,//pixels
        startFromMinus: 100,//pixels
        delaySlideDownStartAni: 1000,//ms
        delaySlideUpEndAni: 500,//ms
        nofunction: function(){},
        
        nested: false,
        
        container:'.pfc-popup-confirm-holder',
        qbox: '.pfc-popup-confirm-question-holder',
        modal:".pfc-popup-modal-holder",
        yesBtn:'.pfc-popup-confirm-yes-button',
        noBtn:'.pfc-popup-confirm-no-button'
    };
        
    $.extend( settings, params );       
   
    var $confirm = function(){
        
       $(settings.qbox).html(question);        
        
       var pwidth = parseInt($(settings.container).css('width')); 
       
       var wwidth = $(window).width();
       var wheight = $(window).height();               
       var wscrolltop = $(window).scrollTop();
       
       var pendtop = ""+(wscrolltop+settings.topMargin)+"px"; 
       var pstarttop = ""+(wscrolltop-settings.startFromMinus)+"px";       
       var pleft;       
 
       if(wwidth>pwidth)
       {
           
           //center
           pleft = ""+(wwidth/2-pwidth/2)+"px";           
       }
       else if(wwidth<=pwidth)
       {
           $(settings.container).css('width',""+(wwidth-20)+"px");           
           pleft = "10%";
       }
       
        $(settings.yesBtn).unbind('click').click(function(){
            hideConfirm();         
            yesfunction();
            return false;
        }).html(settings.buttonYes);
        $(settings.noBtn).unbind('click').click(function(){
            hideConfirm();
            settings.nofunction();
            return false;
        }).html(settings.buttonNo);        
        
       $(settings.modal).css({'width':$(document).width(),'height':$(document).height()}).show();
                                
       $(settings.container)
          .css({'top':pstarttop,'opacity':'0','left':pleft})
          .show()
          .animate({
            opacity: 1,
            top: pendtop
            }, settings.delaySlideDownStartAni, function() {
                   
            });       
        
                  function hideConfirm() 
                  {                        
                          $(settings.modal).hide();
                          $(settings.container)
                               .animate({
                                   'opacity':'0',
                                   'top':pstarttop
                                 },settings.delaySlideUpEndAni
                                 ,function(){                                
                                    $front.dequeue();
                                });
                   }          
    }; //end confirm 
   
   
            if(settings.nested)
            {                
                var newqueue = [];
                var fq = $front.queue();
                newqueue.push(fq[0]);
                newqueue.push($confirm);
                for(var i = 0; i < fq.length;i++ )
                {
                    if(typeof fq[i] == 'function')
                        newqueue.push(fq[i]);
                }
                clearTimeout(ALERT_SHOW_TIMEOUT);                
                $front.queue(newqueue);
            }
            else $front.queue($confirm);
                      
    }; //end pfc confirm
    
  
$.pfcPrompt = function(yesfunction,params)
{
    var settings = {   
      	question: '',
        buttonOK: 'OK',
        buttonStorno: 'STORNO',
        topMargin: 50,//pixels
        startFromMinus: 100,//pixels
        delaySlideDownStartAni: 1000,//ms
        delaySlideUpEndAni: 500,//ms
        stornofunction: function(){},
        
        nested: false,
        
        container:'.pfc-popup-prompt-holder',
        qbox: '.pfc-popup-prompt-question-holder',
        input: '.pfc-popup-prompt-input',
        modal:".pfc-popup-modal-holder",
        okBtn:'.pfc-popup-prompt-ok-button',
        stornoBtn:'.pfc-popup-prompt-storno-button'
    };
        
    $.extend( settings, params );       
   
    var $confirm = function(){
        
       $(settings.qbox).html(settings.question);        
        
       var pwidth = parseInt($(settings.container).css('width')); 
       
       var wwidth = $(window).width();
       var wheight = $(window).height();               
       var wscrolltop = $(window).scrollTop();
       
       var pendtop = ""+(wscrolltop+settings.topMargin)+"px"; 
       var pstarttop = ""+(wscrolltop-settings.startFromMinus)+"px";       
       var pleft;       
 
       if(wwidth>pwidth)
       {
           
           //center
           pleft = ""+(wwidth/2-pwidth/2)+"px";           
       }
       else if(wwidth<=pwidth)
       {
           $(settings.container).css('width',""+(wwidth-20)+"px");           
           pleft = "10%";
       }
       
        $(settings.okBtn).unbind('click').click(function(){
            hidePrompt();         
            yesfunction($(settings.input).val());
          	$(settings.input).val('');
            return false;
        }).html(settings.buttonOK);
        $(settings.stornoBtn).unbind('click').click(function(){
            hidePrompt();
            settings.stornofunction();
          	$(settings.input).val('');
            return false;
        }).html(settings.buttonStorno);        
        
       $(settings.modal).css({'width':$(document).width(),'height':$(document).height()}).show();
                                
       $(settings.container)
          .css({'top':pstarttop,'opacity':'0','left':pleft})
          .show()
          .animate({
            opacity: 1,
            top: pendtop
            }, settings.delaySlideDownStartAni, function() {
                   
            });       
        
                  function hidePrompt() 
                  {                        
                          $(settings.modal).hide();
                          $(settings.container)
                               .animate({
                                   'opacity':'0',
                                   'top':pstarttop
                                 },settings.delaySlideUpEndAni
                                 ,function(){                                
                                    $front.dequeue();
                                });
                   }          
    }; //end prompt 
   
   
            if(settings.nested)
            {                
                var newqueue = [];
                var fq = $front.queue();
                newqueue.push(fq[0]);
                newqueue.push($confirm);
                for(var i = 0; i < fq.length;i++ )
                {
                    if(typeof fq[i] == 'function')
                        newqueue.push(fq[i]);
                }
                clearTimeout(ALERT_SHOW_TIMEOUT);                
                $front.queue(newqueue);
            }
            else $front.queue($confirm);
                      
    }; //end pfc prompt
    
}(jQuery));


/*
 * 
 * UI DIALOG
 */
(function ( $ ) {
var dcounter=0;  
$.pfcDialog = function(url,options) {

    var settings = {
        title: '',
        width: 1400,
        modal: true,
        onload:function(){},
        onclose: function(){}
    };
    
    $.extend(settings,options);
    
  
            var dialog = $('<div style="display:hidden"></div>').appendTo('body');
            // load remote content
            dialog.load(
                url,
                {},
                function (responseText, textStatus, XMLHttpRequest) {
                    dialog.dialog({ 
                            title: settings.title,
                            modal: settings.modal,
                            width: settings.width,
                            close: function(event, ui) {
                                
                                settings.onclose();
                                $(this).remove();
                                //tinymce
                            }
                    });
                    
                      var wh = parseInt($(window).height());
                      var dh = wh-55;
                      $('.ui-dialog-content').css({'min-height':'42px','max-height':dh+"px",'overflow':'auto'});

                    $(window).resize(function(){
                      var wh = parseInt($(window).height());
                      var dh = wh-55;
                      $('.ui-dialog-content').css({'min-height':'42px','max-height':dh+"px",'overflow':'auto'});
                    });
                  
                  
                    settings.onload();
                });
    
};
}( jQuery ));



/**
 * 
 * PFC AJAX FORM
 */
(function ( $ ) {
$.fn.pfcAjaxForm = function( options ) {
        
        var that = this;
        
        var settings = $.extend({            
                ajaxFormOptions: {
                    success: success,
                    dataType:  'json'
                },               
                onforminit: $.fn.pfcAjaxForm.forminit,
                succ: $.fn.pfcAjaxForm.succ,
                onerror: $.fn.pfcAjaxForm.error,
                onexception: $.fn.pfcAjaxForm.exception
            }, options );


    this.ajaxForm(settings.ajaxFormOptions);

    settings.onforminit(that);

    function success(json)
    {
        that.find(".form_err").remove();   
        that.find('.error').hide();

        if( json.succ == 'yes' ) {
                settings.succ(json,that);
        }
        else {                                    
            if ( typeof(json.errors) == 'object' ) 
            {                                    
              if(json.errors[0] && json.errors[0].el=='exception')
                   {
                      settings.onexception(json.errors[0].mess,that); 
                   }
                   else {
                      settings.onerror(json.errors,that); 
                    }
            }
            else settings.onexception('Error',that);  
        }
 
    }


                
    return this;
};//end $.fn.pfcAjaxForm

$.fn.pfcAjaxForm.forminit = function(form) {
        
}

$.fn.pfcAjaxForm.succ = function(json,f) {orm
        $.pfcAlert(json.succMsg);
}
    
$.fn.pfcAjaxForm.error = function(errors,form) {
                                    form.find('.error').fadeIn();
                                    
                                      for ( var i=0;i<errors.length;i++ ) 
                                      {
                                        if ( errors[i].el ) 
                                        {
                                          form.find("input[name='" + errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + errors[i].mess + '</div>');
                                          form.find("select[name='" + errors[i].el +"']")                                            
                                            .after('<div class="form_err">' + errors[i].mess + '</div>');
                                          form.find(".err-" + errors[i].el )                                            
                                            .after('<div class="form_err">' + errors[i].mess + '</div>');
                                         }
                                       } //end for      
}

$.fn.pfcAjaxForm.exception = function(text,form) {
        $.pfcAlert(text,{type:'err'});        
}

}( jQuery ));


/*
  *  DATATABLE
  */
(function($){
      
    
$.fn.pfcDatatable = function(options) {

    var that = this;
    
    if(typeof options == 'object'||typeof options == undefined)
    {
        var settings = $.extend({
            items: [],
            center: [],
            ajaxLoader:false,
            initFilters:function(holder) {return;},
            initCallback: function(holder) { return; },
            initStaticCallback: function(holder) { return; },
            loadCallback: function(holder) { return; },
            pagingCallback: function(holder) { return; },
            resetCallback: function(holder) { return; },
            api: {
                init:$.fn.pfcDatatable.init,
                initStatic:$.fn.pfcDatatable.initStatic,
                load:load,
                loading:loading,
                afterSearch:afterSearch,
                initUi:initUi,
                stripes:stripes,
                initHolder:initHolder
            }
        }, options );
    
        this.data('settings',settings);
    
        if(!settings.ajaxLoader)
        settings.api.initHolder()                
    
        return {
            initUi:settings.api.initUi,
            load: settings.api.load,
            stripes: settings.api.stripes,
            initHolder:settings.api.initHolder
        }
    }
    else if(options=='load')
    {
        var settings = this.data('settings');
        settings.api.load();
        return this;
    }
    else if(options=='initUi')
    {
        var settings = this.data('settings');
        settings.api.initUi();
        return this;
    }
    else if(options=='stripes')
    {
        var settings = this.data('settings');
        settings.api.stripes();
        return this;
    }

   
   function initHolder() {
        settings.api.initUi();
    
        settings.api.initStatic(that);
            
        settings.api.init(that);       
   }
   
   function loading() {
        that.find(".pfc-dt-list-holder").html('<div class="pfc-dt-loading"><span>'+that.find(".pfc-texts").first().find(".loading").val()+'</span></div>');
   } 
    
   function load() {
    
        settings.api.loading();
    
        that.find(".pfc-dt-list-holder").find(".pfc-dt-loading").css('width',that.find(".pfc-dt-row").first().css('width'));
        
        that.find(".pfc-dt-head").first().find("form").submit();
    
    }     
    
    function afterSearch(html) {
        that.find(".pfc-dt-ajaxlist-holder").html(html);
        settings.api.initUi();
        settings.api.init(that);
        settings.loadCallback(that);
    }
    
    function initUi() {
        
      //template TABLE  
      if(that.find('.pfc-dt-no-data').length==0)
      {
        var maxwidth = parseInt(that.parent().css('width'));
      
        that.find('.pfc-dt-row, .pfc-dt-filters-holder, .pfc-dt-ajaxlist-holder, .pfc-dt-head, .pfc-dt-header, .pfc-dt-list-item, .pfc-dt-paging-previos-holder, .pfc-dt-paging-holder').css('width',maxwidth+'px');
        for(var i=0;i<settings.items.length;i++)
        {
            that.find('.item-'+settings.items[i]).sameWidth();
        }
        var usedwidth = 0;
        that.find('.pfc-dt-list-item').first().find('.pfc-dt-collum').each(function(){
            usedwidth += parseInt($(this).css('width'));
            usedwidth += parseInt($(this).css('padding-left'));
            usedwidth += parseInt($(this).css('padding-right'));
        })
        that.find('.pfc-dt-row, .pfc-dt-filters-holder, .pfc-dt-ajaxlist-holder, .pfc-dt-head, .pfc-dt-header, .pfc-dt-list-item, .pfc-dt-paging-previos-holder, .pfc-dt-paging-holder').css('width',usedwidth+'px');
        that.css('width',usedwidth+'px');
        
        /**
         * change to something reuseable not depend on admin
         * -> count max collum width from options.items.length and maxwidth
         * 
         */
        if(maxwidth<usedwidth) that.parent().css('width',usedwidth+'px')
        var bodywidth = parseInt($("body").css('width'));
        if(bodywidth<usedwidth) $("body").css('width',(usedwidth+40)+'px')
        
        that.find('.pfc-dt-collum').each(function() {
            $(this).centerVerticaly(parseInt($(this).closest(".pfc-dt-list-item").find('.pfc-dt-row').first().css('height')));
        });
        
         
        settings.api.stripes();
        
        
        that.find('.pfc-dt-list-item').mouseover(function(){
            $(this).addClass('pfc-dt-hover');
        }).mouseout(function(){
            $(this).removeClass('pfc-dt-hover');
        });                                       
        
        for(var i=0;i<settings.center.length;i++)
        {
            that.find('.item-'+settings.center[i]).css('text-align','center');
        }
      }
    }

    function stripes() {
        that.find('.pfc-dt-list-item').removeClass('even');
        that.find('.pfc-dt-list-item:even').addClass('even');
    }
    
    
}


$.fn.pfcDatatable.initStatic = function(holder) {
    holder.find('a.pfc-dt-search-form').first().unbind('click').click(function(){        
        if($(this).find('.search-on').first().hasClass('pfc-dt-hidden'))
        {
            $(this).find('.search-off').first().addClass('pfc-dt-hidden');
            $(this).find('.search-on').first().removeClass('pfc-dt-hidden');
            holder.find('.pfc-dt-filters-holder').first().addClass('pfc-dt-hidden');            
        }
        else 
        {
            $(this).find('.search-off').first().removeClass('pfc-dt-hidden');
            $(this).find('.search-on').first().addClass('pfc-dt-hidden');
            holder.find('.pfc-dt-filters-holder').first().removeClass('pfc-dt-hidden');
        }
        
        return false;
    })
    
    var settings = holder.data('settings');
    var search_options = {
        success: settings.api.afterSearch
    }
    holder.find(".pfc-dt-head").first().find("form").ajaxForm(search_options);
    
    holder.find(".pfc-dt-reset").unbind('click').click(function(){
        
        holder.find(".pfc-dt-filters-holder").find("input[type='text']").val('');
        holder.find(".pfc-dt-filters-holder").find("select").each(function(){
            $(this).find('option').first().attr('selected',true);
        });
        holder.find(".pfc-dt-filters-holder").find("input[type='radio']").each(function(){
            var name = $(this).attr('name');
            holder.find(".pfc-dt-filters-holder").find("input[name='"+name+"']").first().attr('çhecked',true);
        });
        
        settings.resetCallback(holder);
        
        return false;
    })
    
    settings.initFilters(holder);
    
    settings.initStaticCallback(holder);
}

$.fn.pfcDatatable.init = function(holder) {
    
    var settings = holder.data('settings');
    
    if( holder.find(".pfc-dt-paging-mode").first().val() == '1' )
    {
        holder.find(".pfc-dt-paging-holder .smart-paging").addClass('pfc-dt-hidden')
    }
    else
    {
        holder.find(".pfc-dt-paging-holder .classic-paging").addClass('pfc-dt-hidden')
    }
    
    holder.find(".pfc-dt-paging-chooser-holder .paging_switch").unbind('click').click(function(){
         if( $(this).closest(".pfc-dt-holder").find(".pfc-dt-paging-mode").first().val()=='0')
         {
             holder.find(".pfc-dt-paging-chooser-holder .to-smart").removeClass("pfc-dt-hidden");
             holder.find(".pfc-dt-paging-chooser-holder .to-classic").addClass("pfc-dt-hidden");
             $(this).closest(".pfc-dt-holder").find(".pfc-dt-paging-mode").first().val('1');
         }
         else
         {
             holder.find(".pfc-dt-paging-chooser-holder .to-smart").addClass("pfc-dt-hidden");
             holder.find(".pfc-dt-paging-chooser-holder .to-classic").removeClass("pfc-dt-hidden");
             $(this).closest(".pfc-dt-holder").find(".pfc-dt-paging-mode").first().val('0');            
         }
         
         
         settings.api.load();
         
         //never checked
         return false;
    })
    
    holder.find(".pfc-dt-lang,.pfc-dt-orderby").change(function(){
         settings.api.load();
    })
    
    holder.find(".pfc-dt-per-page").blur(function(){
         settings.api.load();
    })
    
    holder.find(".pfc-dt-paging-holder .paging").unbind('click').click(function(){
        settings.api.loading();
        $.get(this.href.replace('?1=1',holder.find('.pfc-dt-ajax-list-file').val()+'?1=1'),{},function(html){
            settings.api.afterSearch(html);
            settings.pagingCallback(holder);
        })
        return false;
    })
    
    holder.find(".pfc-dt-paging-holder .smart-paging a").unbind('click').click(function(){        
        holder.find(".pfc-dt-paging-holder .smart-paging").html(holder.find(".pfc-texts").first().find(".loading").val())
        $.get(this.href,{},function(html){
            holder.find(".pfc-dt-paging-holder").replaceWith(html);
            settings.api.initUi();
            settings.api.init(holder);            
            settings.pagingCallback(holder);
        })                     
        return false;
    });
    
    holder.find(".pfc-dt-paging-previos-holder a").unbind('click').click(function(){
        holder.find(".pfc-dt-paging-previos-holder").html(holder.find(".pfc-texts").first().find(".loading").val())
        $.get(this.href,{},function(html){
            $(html).find(".pfc-dt-list-item").addClass('pfc-dt-hidden')
            holder.find(".pfc-dt-paging-previos-holder").replaceWith(html);
            holder.find(".pfc-dt-list-item").each(function(){                 
                if($(this).hasClass('pfc-dt-hidden'))
                {
                    $(this).removeClass('pfc-dt-hidden')
                }                
            })
                    settings.api.initUi();
                    settings.api.init(holder);              
                    settings.pagingCallback(holder);
        })                     
        return false;
    });
    
    var settings = holder.data('settings');
    settings.initCallback(holder);
    
} //end fn init



}(jQuery));
/*
 * END DATATABLE
 */


