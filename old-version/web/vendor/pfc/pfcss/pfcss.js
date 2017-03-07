
var PFC_LastWindowWidth = jQuery(window).width();    

(function ( $ ) {    

 $.fn.pfcss = function(resize) {   
  if(resize==undefined) resize=false;

  this.each(function()  
  {
        var t = this;
        runPfcss(t,resize);
                
  });   
  
  
    function removePfcss(that,resize)
    {                                                             
        $(that).children().each(function(){                                       
             removePfcss(this);
        })            

        if( $(that).hasClass("pfcss-max-parent-width") ) {
            
            $(that).css('width','auto');
            $(that).css('max-width',$(that).css('width'));         
        }        
        
        if( $(that).hasClass("pfcss-max-parent-height") ) {
            $(that).css('max-height','0px');         
            $(that).css('height','auto');         
        }        
                
        if( $(that).hasClass("pfcss-fill-parent-height") )
        {
            $(that).css('height','auto');            
        }

        if( $(that).hasClass("pfcss-fill-parent-width") )
        {
            $(that).css('width','auto');            
        }        
        
        if($(that).hasClass("pfcss-fit-parent-height") )
        {
            $(that).css('min-height','auto');                        
        }
        
        if( $(that).hasClass("pfcss-fit-parent-width") )
        { 
            $(that).css('min-width','auto');             
        }                        
        
        if( $(that).hasClass("pfcss-fit-body-width") ) {
            $(that).css('width','auto');         
        }
        
        if( $(that).hasClass("pfcss-fit-body-height") ) {
            $(that).css('height','auto');                                 
        }
      
      
        $(document).css('height',$('.pfc-body').height()) 
    }
  
    function runPfcss(that,resize)
    {               
        if( $(that).hasClass("pfcss-fit-body-height") 
         || $(that).hasClass("pfcss-fit-body-width") 
         || $(that).hasClass("pfcss-max-parent-height")
         || $(that).hasClass("pfcss-max-parent-width") 
        
         || $(that).hasClass("pfcss-fit-parent-height")
         || $(that).hasClass("pfcss-fill-parent-height") 
        
         || $(that).hasClass("pfcss-fit-parent-width") 
         || $(that).hasClass("pfcss-fill-parent-width")
         
         || $(that).hasClass("pfcss-max-parent-width-float")
         
         || $(that).hasClass("pfcss-parent")
        )
     {
        if(resize)
        {
            
            
            
            $(that).find(".pfcss-max-parent-width-float").each(function()
            {           

                $(this).find(".pfcss-clear-float:last").removeClass("pfcss-clear-float").addClass("pfcss-clearalias").css('width','auto').css('max-width','auto')        

                var tw = parseInt($(this).css('width'));
                var ww = parseInt($(window).width());
                var pw = parseInt($(this).parent().width()); 

                            var caw=0;
                                caw+= parseInt($(that).css('padding-left'));
                                caw+= parseInt($(that).css('padding-right'));
                                caw+= parseInt($(that).css('margin-left'));
                                caw+= parseInt($(that).css('margin-right'));                
                
                 if(ww<pw)
                 {
                    $(this).css('max-width',(ww-caw)+"px");                                
                    $(this).css('width',(ww-caw)+"px");                                                     
                 }   
                 
                 else 
                 {
                    $(this).css('max-width',"auto");                                
                    $(this).css('width',"auto");                                
                 }
                 

                 $(this).find(".pfcss-clearalias:last").addClass("pfcss-clear-float").removeClass("pfcss-clearalias")                                                                                      
            });     
        }

        
        removePfcss(that,resize);                
        

        if( $(that).hasClass("pfcss-fit-body-height") ) $(that).fitBodyHeight();
        if( $(that).hasClass("pfcss-fit-body-width") ) $(that).fitBodyWidth();  
        
        if( $(that).hasClass("pfcss-max-parent-height") ) $(that).maxParentHeight();
        if( $(that).hasClass("pfcss-max-parent-width") ) $(that).maxParentWidth();
        
        if( $(that).hasClass("pfcss-fit-parent-height") ) $(that).fitParentHeight();
        if( $(that).hasClass("pfcss-fill-parent-height") ) $(that).fillParentHeight();        
        
        if( $(that).hasClass("pfcss-fit-parent-width") ) $(that).fitParentWidth();                                            
        if( $(that).hasClass("pfcss-fill-parent-width") ) $(that).fillParentWidth();                  

        
        if( $(that).hasClass("pfcss-max-parent-width-float") ) {

                var winw = parseInt($(window).width());
                var doch = parseInt($(document).height());
                var winh = parseInt($(window).height());
                
                if((winw>parseInt(PFC_LastWindowWidth) && parseInt($(that).parent().width())>0)||!resize)
                {       
                    var neww;
                    
                            var cw=0;
                                cw+= parseInt($(that).css('padding-left'));
                                cw+= parseInt($(that).css('padding-right'));
                                cw+= parseInt($(that).css('margin-left'));
                                cw+= parseInt($(that).css('margin-right'));
                    
                        var ph = parseInt($(that).parent().css('min-width'))>0?parseInt($(that).parent().css('min-width')):parseInt($(that).parent().width());        
                        neww = (ph-cw)+"px"

                    
                        $(that).css('max-width',neww);   
                        $(that).css('width',neww);                   
                }
        }
        
        
        if(resize)
        {
            $(that).find(".pfcss-max-parent-width-float").each(function()
            {           
                if(parseInt($(this).css('max-width'))+19==parseInt($(this).parent().width()))
                {
                    $(this).css('max-width',$(this).parent().width());   
                    $(this).css('width',$(this).parent().width());   
                }                
            })
        }

/*
                if(parseInt($(that).css('width'))+19==parseInt($(that).parent().width()))
                {
                    $(this).css('max-width',$(this).parent().width());   
                    $(this).css('width',$(this).parent().width());   
                }                
*/
        
                    $(that).children().each(function(){                        
                       runPfcss(this,false)
                    })
     
         $(that).find('.pfcss-show-after-load').css('visibility','visible')      
      }   
    }  
  
  
  return this;
 }
})( jQuery );


/**
 * 
 * fill parent width
 */
//rewrite to use pfc-coll
(function ( $ ) {
$.fn.fillParentWidth = function() {

  this.each(function()  
  {
     var maxwidth = parseInt($(this).parent().css('min-width'))>0?parseInt($(this).parent().css('min-width')):parseInt($(this).parent().width()); 
  
        var cw=0;
        
        cw+= parseInt($(this).css('padding-left'));
        cw+= parseInt($(this).css('padding-right'));
        cw+= parseInt($(this).css('margin-left'));
        cw+= parseInt($(this).css('margin-right'));
        
        
     $(this).prevAll().not(':hidden').each(function(){
      if($(this).hasClass("pfc-coll"))   
      {         
        var cwidth = parseInt($(this).css('min-width'))>0?parseInt($(this).css('min-width')):parseInt($(this).width()); 
        
        cwidth+= parseInt($(this).css('padding-left'));
        cwidth+= parseInt($(this).css('padding-right'));
        cwidth+= parseInt($(this).css('margin-left'));
        cwidth+= parseInt($(this).css('margin-right'));
        
        
        cw += cwidth;
       }
     
     })

     $(this).nextAll().not(':hidden').each(function(){
      if($(this).hasClass("pfc-coll"))   
      {                  
        var cwidth = parseInt($(this).css('min-width'))>0?parseInt($(this).css('min-width')):parseInt($(this).width()); 
        
        cwidth+= parseInt($(this).css('padding-left'));
        cwidth+= parseInt($(this).css('padding-right'));
        cwidth+= parseInt($(this).css('margin-left'));
        cwidth+= parseInt($(this).css('margin-right'));
        
        
        cw += cwidth;
       }
       // $(this).append(cheight)
     })      
     
    // $(this).parent().append(maxheight)
      
     $(this).css('width',(maxwidth-cw)+'px');
  })     
  
    return this;
  
 }
})( jQuery );








/**
 * 
 * fill parent height
 */
(function ( $ ) {
$.fn.fillParentHeight = function() {
   
  this.each(function()  
  {
     var maxheight = parseInt($(this).parent().height());
  
        var cw=0;
        
        cw+= parseInt($(this).css('padding-top'));
        cw+= parseInt($(this).css('padding-bottom'));
        cw+= parseInt($(this).css('margin-top'));
        cw+= parseInt($(this).css('margin-bottom'));
        
         //if($(this).css('overflow-x')=='scroll'||$(this).css('overflow-x')=='visible')
          //  cw+=20;
        
     $(this).prevAll().not(':hidden').each(function(){ 
      if($(this).hasClass("pfc-panel"))   
      {
        var cheight = parseInt($(this).height()); 
        
        cheight+= parseInt($(this).css('padding-top'));
        cheight+= parseInt($(this).css('padding-bottom'));
        cheight+= parseInt($(this).css('margin-top'));
        cheight+= parseInt($(this).css('margin-bottom'));
        
           //     if($(this).css('overflow-x')=='scroll'||$(this).css('overflow-x')=='visible')
           // cheight+=20;
        
        cw += cheight;
        //$(this).append("|"+cheight)
      }
     })

     $(this).nextAll().not(':hidden').each(function(){
      if($(this).hasClass("pfc-panel"))   
      {  
        var cheight = parseInt($(this).height()); 
        
        cheight+= parseInt($(this).css('padding-top'));
        cheight+= parseInt($(this).css('padding-bottom'));
        cheight+= parseInt($(this).css('margin-top'));
        cheight+= parseInt($(this).css('margin-bottom'));
        
         //       if($(this).css('overflow-x')=='scroll'||$(this).css('overflow-x')=='visible')
         //   cheight+=20;
        
        cw += cheight;
        //$(this).append("|"+cheight)
      }
     })      
     
    // $(this).parent().append(maxheight)
     if(maxheight-cw>0) 
     $(this).css('height',(maxheight-cw-1)+'px');
  })     
  
    return this;
  
 }
})( jQuery );


/**
 * 
 * fit body width
 */
(function ( $ ) {
$.fn.fitBodyWidth = function() {
   
  this.each(function()  
  {
     var winh = parseInt($(window).height());     
     var doch = parseInt($(document).height());
     var maxwidth = parseInt($(document).width());
     
        var cw=0;
        /*
        
        cw+= parseInt($(this).css('padding-left'));
        cw+= parseInt($(this).c ss('padding-right'));
        cw+= parseInt($(this).css('margin-left'));
        cw+= parseInt($(this).css('margin-right'));
        
      $(this).append(maxwidth)
     $(this).children().not(':hidden').each(function(){
      if($(this).hasClass("pfc-panel"))   
      {   
        var cwidth = parseInt($(this).width()); 
        
        cwidth+= parseInt($(this).css('padding-left'));
        cwidth+= parseInt($(this).css('padding-right'));
        cwidth+= parseInt($(this).css('margin-left'));
        cwidth+= parseInt($(this).css('margin-right'));
        
        if(cwidth>maxwidth)
            maxwidth = cwidth;
        
        $(this).append(cwidth)
      }
     })
     */
     
      
      if(doch > winh)
     {
        $(this).css('width',(maxwidth-cw)+'px');
     }
     else {
        $(this).css('width',(maxwidth-cw)+'px');  
     }
  })     
  
    return this;
  
 }
})( jQuery );

/**
 * 
 * fit parent width
 */
(function ( $ ) {
$.fn.fitParentWidth = function() {
   
  this.each(function()  
  {
     var maxwidth = parseInt($(this).parent().css('min-width'))>0 ? parseInt($(this).parent().css('min-width')) : parseInt($(this).parent().css('width'));
  
        var cw=0;
        
        cw+= parseInt($(this).css('padding-left'));
        cw+= parseInt($(this).css('padding-right'));
        cw+= parseInt($(this).css('margin-left'));
        cw+= parseInt($(this).css('margin-right'));


      if(maxwidth) 
        $(this).css('min-width',(maxwidth-cw)+'px');

    // $(this).append('|'+maxwidth);
  })     
  
    return this;
  
 }
})( jQuery );

/**
 * 
 * fit parent width
 */
(function ( $ ) {
$.fn.maxParentWidth = function() {
   
  this.each(function()  
  {
     var maxwidth;
     //if($(this).parent().hasClass("pfcss-fit-parent-width")||$(this).parent().hasClass("pfcss-fill-parent-width")||$(this).parent().hasClass("pfcss-fit-body-width"))
        maxwidth = parseInt($(this).parent().css('min-width'))>0?parseInt($(this).parent().css('min-width')):parseInt($(this).parent().css('width'));
        
     //   maxwidth = parseInt($(this).parent().css('min-width'));
  
        var cw=0;
        cw+= parseInt($(this).css('padding-left'));
        cw+= parseInt($(this).css('padding-right'));
        cw+= parseInt($(this).css('margin-left'));
        cw+= parseInt($(this).css('margin-right'));
     
     
     if(maxwidth) 
     {
         $(this).css('max-width',(maxwidth-cw)+'px');
         $(this).css('width',(maxwidth-cw)+'px');
     }
 
    // $(this).append('|'+maxwidth);
  })     
  
    return this;
  
 }
})( jQuery );


/**
 * 
 * fit parent height
 */
(function ( $ ) {
$.fn.maxParentHeight = function() {
   
  this.each(function()  
  {
     
     //if($(this).parent().hasClass("pfcss-fit-parent-width")||$(this).parent().hasClass("pfcss-fill-parent-width")||$(this).parent().hasClass("pfcss-fit-body-width"))
      var  maxh = parseInt($(this).parent().css('min-height'))>0?parseInt($(this).parent().css('min-height')):parseInt($(this).parent().css('height'));
        
     //   maxwidth = parseInt($(this).parent().css('min-width'));
  
        var cw=0;
        cw+= parseInt($(this).css('padding-top'));
        cw+= parseInt($(this).css('padding-bottom'));
        cw+= parseInt($(this).css('margin-top'));
        cw+= parseInt($(this).css('margin-bottom'));
     
     
     if(maxh) 
     {
         $(this).css('max-height',(maxh-cw)+'px');
         $(this).css('height',(maxh-cw)+'px');
     }
 
    // $(this).append('|'+maxwidth);
  })     
  
    return this;
  
 }
})( jQuery );

/**
 * 
 * fit body width
 */
(function ( $ ) {
$.fn.fitBodyHeight = function() {
   
  this.each(function()  
  {
     var maxheight = parseInt($(document).height());
     var theight = parseInt($(this).height());  
     var wheight = parseInt($(window).height());  
     
        var cw=0;
        
        cw+= parseInt($(this).css('padding-top'));
        cw+= parseInt($(this).css('padding-bottom'));
        cw+= parseInt($(this).css('margin-top'));
        cw+= parseInt($(this).css('margin-bottom'));
        
     
     if(theight>wheight) 
        $(this).css('height',(theight-cw)+'px');
     else
        $(this).css('height',(wheight-cw)+'px'); 
  })     
  
    return this;
  
 }
})( jQuery );

/**
 * 
 * fit parent height
 */
(function ( $ ) {
$.fn.fitParentHeight = function() {
   
  this.each(function()  
  {
     var maxheight = parseInt($(this).parent().height());
  
        var cw=0;
     /*   
        cw+= parseInt($(this).css('padding-top'));
        cw+= parseInt($(this).css('padding-bottom'));
        cw+= parseInt($(this).css('margin-top'));
        cw+= parseInt($(this).css('margin-bottom'));
     */
        
     
     if(maxheight) 
     $(this).css('min-height',(maxheight-cw)+'px');
  })     
  
    return this;
  
 }
})( jQuery );


/**
 * 
 * same width
 */
(function ( $ ) {
$.fn.sameWidth = function() {
        
    var mw = 0;

    var cw;
    $(this).each(function() {       
        cw = parseInt($(this).css('width'));
        cw+= parseInt($(this).css('padding-left'));
        cw+= parseInt($(this).css('padding-right'));
        if(cw>mw) mw=cw;
    });

    if(mw>0)
    $(this).each(function() {        
        $(this).css('width',mw+'px');
    });      

        
    return this;
};//end $.fn.sameWidth
}( jQuery ));

/**
 * 
 * same width
 */
(function ( $ ) {
$.fn.sameHeight = function() {
        
    var mw = 0;

    var cw;
    $(this).each(function() {       
        cw = parseInt($(this).css('height'));
        cw+= parseInt($(this).css('padding-top'));
        cw+= parseInt($(this).css('padding-bottom'));        
        if(cw>mw) mw=cw;
    });

    if(mw>0)
    $(this).each(function() {        
        $(this).css('width',mw+'px');
    });      

        
    return this;
};//end $.fn.sameHeight
}( jQuery ));

/*
 * 
 * CENTER HORIZONTALY
 */
(function ( $ ) {
$.fn.centerHorizontaly = function(autophminus) {
  //alert('teseeet');  
  
  
  
  this.each(function(){      
      
         var ph = parseInt($(this).parent().css('width'));
         
         if(ph)
         {
            var th = parseInt($(this).css('width'));
            var thpt = parseInt($(this).css('padding-left'));
            var thpb = parseInt($(this).css('padding-right'));
            var thmt = parseInt($(this).css('margin-left'));
            var thmb = parseInt($(this).css('margin-right'));
                        
            if(autophminus) ph -= autophminus;
            
            var hh = (ph - th - thpt - thpb - thmt - thmb)/2;
            
            $(this).css('margin-left',(hh+thmt)+'px');            
         }
     
    });     
    return this;
};//end centerHorizontaly
}( jQuery ));


/*
 * 
 * CENTER VERTICALY
 */
(function ( $ ) {
$.fn.centerVerticaly = function(autophminus) {
  //alert('teseeet');  
  
  
  
  this.each(function(){      
      
         var ph = parseInt($(this).parent().css('height'));
         
         if(ph)
         {
            var th = parseInt($(this).css('height'));
            var thpt = parseInt($(this).css('padding-top'));
            var thpb = parseInt($(this).css('padding-bottom'));
            var thmt = parseInt($(this).css('margin-top'));
            var thmb = parseInt($(this).css('margin-bottom'));
                        
            if(autophminus) ph -= autophminus;
            
            var hh = (ph - th - thpt - thpb - thmt - thmb)/2;
            //.append(ph+'|'+th+'|'+hh+'|'+$(this).closest('.grid-list-item').css('height'));//
            $(this).css('margin-top',(hh+thmt)+'px');
            var that = $(this);           
         }
     
    });     
    return this;
};//end centerHorizontaly
}( jQuery ));