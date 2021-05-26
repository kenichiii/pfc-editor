
(function(window,$){
    
    
    
    $.pfc = {
       __GUID: 1, 
       guid: function() {
         return this.__GUID++;         
       }, 
       
       bean: function(name, parent, custom) {
           var bean = $.extend({
              isDecentBean: true,               
              isConstructed: false,
              
              __ctype: 'bean',               
               __name: name,
               __guid: this.guid(),    
               
               __list: [],
               __statuses: [],
               __events: [],
                              
               __construct: function(callback) {
                  //to be overriden    
                  callback.call(this);
                },
              
               getParent: function() {
                  return parent;  
                },
                
               guid: function() {
                  return this.__guid;  
               },
               rawname: function() {return this.__name;},
               rawctype: function() {return this.__ctype;},
               name: function(name) {
                    if(this.getParent() && typeof this.getParent().name === "function") {
                        return this.getParent().name(this.rawname()+(name ? '-'+name : ''));
                    } else {
                        return (this.rawname() ? this.rawname()+'-' : "")+(name ? name+'-' : '')+this.rawctype();
                    }
                },                
                ctype: function(name) {
                    if(this.getParent() && typeof this.getParent().ctype === "function") {
                        return this.getParent().ctype(this.rawctype()+(name ? '-'+name : ''));
                    } else {
                        return this.rawctype()+(name ? '-'+name : '');
                    }
                },
               
               on: function(name, fn) {
                    if(!this.__events[name]) {
                        this.__events[name]= [];
                    }  
                    
                    this.__events[name].push(fn);
                    return this;
               },
               
                trigger: function(name, params) {
                    if(this.__events[name]) {
                        for(var i = 0; i < this.__events[name].length; i++) {
                            this.__events[name][i].apply(this, params ? params : []);
                        }
                    }
                    return this;
                },
                
                
               foreach: function(fn) {
                 for(var i = 0; i < this.__list.length; i++) {
                     if(fn(i, this.__list[i]) === false) {
                         break;
                     }
                 }  
                 return this;
               },
               count: function() {
                  return this.__list.length; 
               },
               getIndex: function(index) {
                  return this.__list[index];   
               },
               add: function(bean) {                   
                   if(bean && bean.isDecentBean === true) {
                       
                   } else {
                       var decent = $.pfc.bean("item"+this.count().toString(),
                            this, {
               
                            }
                       );
                       $.extend(bean, decent, bean);
                   }
                   
                   this.trigger("add",[bean]);
                   
                   //do html change -> add
                   this.__list.push(bean);
                   return this;
               },
 
               set: function(index, bean) {
                   if(bean && bean.isDecentBean === true) {
                       
                   } else {
                       var decent = $.pfc.bean("item"+this.count().toString(),
                            this, {
               
                            }
                       );
                       $.extend(bean, decent, bean);
                   }
                  
                  this.trigger("set",[bean, index]); 
                   
                  this.__list[index] = bean;    
                  return this;
               },
               
               remove: function(index) {  
                   
                   this.trigger("remove",[index]); 
                   
                   //do html change -> remove
                   this.__list.remove(index);
                   return this;
               },
               
               getId: function(guid) {
                  for(var i = 0; i < this.count(); i++) {
                       if(this.__list[i].guid() == guid) {
                           return this.__list[i];
                       }
                   }
                   
                   return null;
               },    
               getCType: function(ctype) {
                  var list = []; 
                  for(var i = 0; i < this.count(); i++) {
                       if(this.__list[i].rawctype() == ctype) {
                           list.push(this.__list[i]);
                       }
                   }
                   
                   return list;
               },                   
               get: function(name) {
                   for(var i = 0; i < this.count(); i++) {
                       if(this.__list[i].rawname() == name) {
                           return this.__list[i];
                       }
                   }
                   
                   return null;
               },               
                
                closest: function(name) {
                  if(this.getParent() && this.getParent().isDecentBean) {
                      if(this.getParent().rawname() == name) {return this.getParent();}
                      return this.getParent().closest(name);
                  }  
                  return null;
                },
                closestCType: function(name) {
                  if(this.getParent() && this.getParent().isDecentBean) {
                      if(this.getParent().rawctype() == name) {return this.getParent();}
                      return this.getParent().closestCType(name);
                  }  
                  return null;
                },
                getRootParent: function() {
                  if(this.getParent() && this.getParent().isDecentBean) {                      
                      return this.getParent().getRootParent();
                  }    
                  return this;
                }
               
           }, custom ? custom : {});
           
           bean.__construct(function(){
               this.isConstructed = true;
           });
           
           return bean;
       },
       
       tagable: function(name, parent, custom) {
            var bean = $.pfc.bean(name, parent, $.extend({                
                
                __ctype: 'tag',
                isDecentTag: true,
                
                tag: '<span />',          
                
                assign: function(element) {
                  this.tag = $(element);                  
                  
                  this.getTag().addClass(this.name());
                  this.getTag().addClass(this.ctype());
                  
                  this.trigger("assign");
                  
                  return this;
                },
                getTag: function(selector) { 
                    if(typeof this.tag === "string") {
                        this.assign(this.tag);
                    }
                    
                    if(selector) {
                        return this.tag.find(selector);
                    }
                    
                    return this.tag;
                }
                                                                
            },custom ? custom : {}));                 
            
            return bean;
       },
       
       getJSON: function(url) {
           var deffer = {
               resolved: false,
               data: null,
               resolve: function() {
                   if(this.resolved) {
                       return this.data;
                   } else {
                       
                       
                      return this.resolve();
                                              
                   }
               },
               promise: function(data) {
                   this.data = data;
                   this.resolved = true;
               }
           };
           
           $.getJSON(url, {}, function(json){
               deffer.promise(json);
           }).error(function(){
               deffer.promise({error:true});
           });
           
           return deffer.resolve();
       }
       
       
    };


})(window, jQuery);
