/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/ 

(function(window,$){
  
var soundsManager = {
    on: null,
    iphone: null,
    iphoneSoundList: [],
    checkFront: function() {
        var now = new Date();
        for( var i in this.iphoneSoundList )
        {
            
            if( typeof this.iphoneSoundList[i] ===  'object' && ( now - this.iphoneSoundList[i].date > 2000 ) )
            {
                var id = this.iphoneSoundList[i].id;
                delete(this.iphoneSoundList[i]);
                this.play(id);                
                return;
            }
            else delete(this.iphoneSoundList[i]);
            
        }
        
        
    },
    clon: function(audioId,remove) {
                    var cloned = $('#'+audioId).clone()[0];

                    $(cloned).attr('id',audioId + 'cl' + remove);

                    if(remove > 0)
                    cloned.onend = function() {
                        $(cloned).remove();
                    };
                    
                    $('body').append(cloned);
                    
                    
    },
    play: function(audioId,index) {
      
     var test = document.getElementById(audioId);   
     
     if( !test || typeof test.play !== 'function' ) return;
        
     if(navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) )
     {
         
      if( this.on  )  
      {
          if( this.iphone === null || this.iphone.paused )
          {
              this.iphone = test;
              this.iphone.play();
                    var that = this;
                    this.iphone.onend = function() {
                        that.checkFront();
                    };                    
          }
          else {
              this.iphoneSoundList.push({
                  'date': new Date(),
                  'id': audioId 
              });
          }
      }
         return;
     }
        
        
      if( index === undefined )  index = 0;
        
      if( this.on  )  
      {
          
        
        
        
            if( test.paused )            
                test.play();          
            else {
                audioId = audioId.replace('cl'+(index-1),'');
                
                if( $('#'+ audioId + 'cl' + (index+1)).length === 0)
                this.clon(audioId,index+1);
            
                this.play(audioId + 'cl' + index, index+1);
            }
        
      } 
       
    }
   };
            
  
  window.pfcSoundsManager = soundsManager;
  
  
            $(function(){                
               $('audio.smsound').each(function(){
                  pfcSoundsManager.clon($(this).attr('id'),0); 
               }); 
            });
  
})(window,jQuery);
