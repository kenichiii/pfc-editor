(function(window,$){
    
    $.extend($.pfc,  {

    component: function(name, parent, custom) {
          var bean = $.pfc.tagable(name, parent, $.extend({              
               
               isDecentComponent:true,
               __ctype: 'component', 
               
              tag: '<section />',
         
                __INIT_REFRESH_PERIOD: 150,
                init: function(callback) {
                  if(this.isConstructed) {  
                    //to be overriden
                    this.trigger('init');
                    if(typeof callback === "function") {
                        callback.call(this);
                    }
                  } else {
                      var that = this;
                      setTimeout(function(){
                         that.init(callback); 
                      }, this.__INIT_REFRESH_PERIOD);
                  }
                },                
              
                templates: {                                    
                  content: '<section />',
                  header: '<header />',
                  footer: '<footer />',
                  leftPanel: '<aside />',
                  rightPanel: '<aside />'
                },  
                getContentTag: function(selector) {
                  if(this.getTag('.'+this.name()+'-content').length === 0) {  
                    if(this.getTag('.'+this.name()+'-header').length === 0) {
                      this.getTag().prepend(  
                            $(this.templates.content).addClass(this.name()+'-content')
                        );
                    } else {
                      this.getTag('.'+this.name()+'-header').after(
                            $(this.templates.content).addClass(this.name()+'-content')  
                        );  
                    }
                  }
                  
                  if(selector) {
                      return this.getTag('.'+this.name()+'-content').find(selector);
                  }
                  return this.getTag('.'+this.name()+'-content');
                },
                getHeaderTag: function(selector) {
                    if(this.getTag('.'+this.name()+'-header').length === 0) {
                      this.getTag().prepend(  
                            $(this.templates.header).addClass(this.name()+'-header')
                        );
                    }
                    
                    if(selector) {
                      return this.getTag('.'+this.name()+'-header').find(selector);
                    }
                    return this.getTag('.'+this.name()+'-header');
                },
                getFooterTag: function(selector) {
                    if(this.getTag('.'+this.name()+'-footer').length === 0) {
                      this.getTag().append(  
                            $(this.templates.footer).addClass(this.name()+'-footer')
                        );
                    }
                    if(selector) {
                      return this.getTag('.'+this.name()+'-footer').find(selector);
                    }
                    return this.getTag('.'+this.name()+'-footer');
                },
                getLeftPanelTag: function(selector) {
                  if(this.getTag('.'+this.name()+'-left-panel').length === 0) {  
                    if(this.getTag('.'+this.name()+'-header').length === 0) {
                      this.getTag().prepend(  
                            $(this.templates.leftPanel).addClass(this.name()+'-left-panel')
                        );
                    } else {
                      this.getTag('.'+bean.name()+'-header').after(
                            $(this.templates.leftPanel).addClass(this.name()+'-left-panel')  
                        );  
                    }
                  }
                  
                  if(selector) {
                      return this.getTag('.'+this.name()+'-left-panel').find(selector);
                  }
                  return this.getTag('.'+this.name()+'-left-panel');
                },
                
                getRightPanelTag :function(selector) {
                  if(this.getTag('.'+this.name()+'-right-panel').length === 0) {  
                    if(this.getTag('.'+this.name()+'-header').length === 0) {
                      this.getTag().prepend(  
                            $(this.templates.rightPanel).addClass(this.name()+'-right-panel')
                        );
                    } else {
                      this.getTag('.'+this.name()+'-header').after(
                            $(this.templates.rightPanel).addClass(this.name()+'-right-panel')  
                        );  
                    }
                  }
                  
                  if(selector) {
                      return this.getTag('.'+this.name()+'-right-panel').find(selector);
                  }
                  return this.getTag('.'+this.name()+'-right-panel');
                },
              
        
                          
                  
                  
              getLocalStorageLastStateImageKey: function() {
                return '___' + this.name() + '__' + 'LastStateImageKey'
                        + (this.rawctype() == "webapp" 
                            ? this.user.GUID 
                            : (this.closestCType('webapp') ? this.closestCType('webapp').user.GUID : ''));  
              },
              writeLastStateImage: function() {
                if(localStorage) {              
                    localStorage.setItem(
                            this.getLocalStorageLastStateImageKey(),
                            JSON.stringify(this.serializeLastStateImage())
                              );
                }  
              },
              serializeLastStateImage: function() {
                return this;  
              },
              getLastStateImage: function() {
                var image = null;

                if(localStorage) {
                  image = localStorage.getItem(this.getLocalStorageLastStateImageKey());
                }

                if(image) {
                   return JSON.parse(image);     
                } else {
                   return null;     
                }          
              },
              
              service: function(name, params, type) {
                  
                  
              }
              
          },custom ? custom : {}));     
          
          
          
          return bean;
       }//component
       
    });


})(window, jQuery);

