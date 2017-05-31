<?php

use PFC\WebApp\Router;

use idePad\Config\WebAppConfig;
use idePad\Config\SourcesConfig;
use idePad\Config\UserData\Settings;
use idePad\Config\UserData\Account;

?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>idePad :: web development tool</title>
        
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- INTERNAL libraries css -->
        <link type="text/css" href="vendor/jquery_ui/jquery-ui.min.css" rel="stylesheet">
      
        <link type="text/css" href="vendor/fileTree/jqueryFileTree.css" rel="stylesheet">                    
        
        <!-- DEFAULT APPLICATIONS -->
        <link href="vendor/colpick/css/colpick.css" rel="stylesheet" type="text/css"/>
      
      	<link href="vendor/CalcSS3/CalcSS3.css" rel="stylesheet" type="text/css" />
      
                 
        <!-- IDEPAD -->        
        <link href="application/layouts/main/css/layout.css" rel="stylesheet" type="text/css"/>        
              
        <!-- CODE EDITOR -->
        <link href="application/components/editor/css/extensions.css" rel="stylesheet" type="text/css"/>
        <link href="application/components/editor/css/fileactions.css" rel="stylesheet" type="text/css"/>            
      
        <!-- PAGES -->
        <link href="application/components/pages/free-pad/ide-about/css/about.css" rel="stylesheet" type="text/css"/>
        <link href="application/components/pages/free-pad/ide-config/css/config.css" rel="stylesheet" type="text/css"/>
        
        <!-- DEFAULT TOOLS -->
        <link href="application/components/tools/default-apps/styles.css" rel="stylesheet" type="text/css"/>        
      
        <!-- SECTIONS -->
        <link href="application/components/sections/sources/css/sources.css" rel="stylesheet" type="text/css"/>
        <link href="application/components/sections/sources/css/extensions.css" rel="stylesheet" type="text/css"/>
        
        <!-- THEME -->
        <link href="application/theme/<?php echo Settings::theme(); ?>/styles.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body class="idePad-theme-<?php echo Settings::theme(); ?>">

        <div class="idePad-booting">
          <div class="idePad-booting-inner-holder">  
            <?php echo _tr('booting <em>ide</em>Pad... please wait...'); ?>
            <div class="idePad-booting-holder">
              <div class="idePad-booting-inner">
                <div class="idePad-booting-prct"></div>
              </div>
            </div>
          </div>    
        </div>
        
    
    <header class="idePad-webapp-header">           		        
        <?php echo $this->component('application/header'); ?>			        
    </header> 
    <!-- idePad-webapp-head -->
                          
    <aside class="idePad-webapp-left-panel">   
        <?php //echo $this->component('sections/sources'); ?>              
    </aside> 
    <!-- idePad-webapp-left-panel -->
        
    <aside class="idePad-webapp-right-panel">
        <?php //echo $this->component('tools'); ?>
    </aside> 
    <!-- idePad-webapp-right-panel -->   
                   
    <section class="idePad-webapp-content">      
        <?php //echo $this->component('editor'); ?>    
    </section>                            
    <!-- MAIN -->         
    
    <footer class="idePad-webapp-footer">
        <?php echo $this->component('application/footer'); ?>        
    </footer>    
    <!-- FOOTER -->                                
      
        <?php echo $this->component('application/ui'); ?>   
    
        <?php echo $this->component('application/sounds'); ?>                    

    
    <!-- JAVASCRIPT  -->       
    
    <script type="text/javascript" src="vendor/jquery/jquery.js"></script>
    <script type="text/javascript">
        jQuery.noConflict();
    </script>    
    <script type="text/javascript" src="vendor/jquery_ui/jquery-ui.min.js"></script>                           
              
    <script type="text/javascript" src="vendor/CalcSS3/CalcSS3.js"></script>
    
    <script src="vendor/colpick/js/colpick.js" type="text/javascript"></script>
    
    <script type="text/javascript" src="vendor/jquery_form/jquery.form.js"></script>
                
                   
    <script type="text/javascript" src="vendor/fileTree/jqueryFileTree.js"></script>
      
      	<script  type="text/javascript">
            (function($) {    
                  $('.idePad-booting-prct').css('width','18px');
              })(jQuery);
      	</script>
      		
    <!-- load ace -->
    <script type="text/javascript" src="vendor/ace/ace.js"></script>
    <script type="text/javascript" src="vendor/ace/ext-modelist.js"></script>       
    <script type="text/javascript" src="vendor/ace/ext-settings_menu.js"></script>
    <script type="text/javascript" src="vendor/ace/ext-statusbar.js"></script>
    <script type="text/javascript" src="vendor/ace/ext-language_tools.js"></script>
    <script type="text/javascript" src="vendor/ace/keybinding-vim.js"></script>
    <script type="text/javascript" src="vendor/ace/keybinding-emacs.js"></script>
    
        <!-- Emmet script -->
        <script type="text/javascript" src="vendor/ace/ext-emmet.js"></script>    
        <script type="text/javascript" src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
        <script type="text/javascript">
            var Emmet = ace.require("ace/ext/emmet");
            Emmet.setCore(window.emmet);
        </script>
    <!-- end ace editor -->  

        <script  type="text/javascript">
            (function($) {    
                    $('.idePad-booting-prct').css('width','50px');
                })(jQuery);
        </script>

        <script src="vendor/pfc/_php.js" type="text/javascript"></script>
        <script src="vendor/pfc/_sounds_manager.js" type="text/javascript"></script>
        <script src="vendor/pfc/pfc.js" type="text/javascript"></script>
        <script src="vendor/pfc/component.js" type="text/javascript"></script>
        <script src="vendor/pfc/webapp.js" type="text/javascript"></script>
        
    <!-- end libararies javascript -->
    
            
        <script  type="text/javascript">
          (function($) {      
                $('.idePad-booting-prct').css('width','88px');
            })(jQuery);
        </script>
        
        
    
    <!-- FREEPAD IDE -->                        
    <script src="application/application.js" type="text/javascript"></script>
    <script type="text/javascript">
    (function($) {      
                $.idePad.user = {
                  isLogged: true,  
                  GUID: "<?php echo Account::authGUID(); ?>",   
                  login: "<?php echo Account::authLogin(); ?>",
                  email: "<?php echo Account::authEmail(); ?>",
                  name: "<?php echo Account::authName(); ?>"
                };
     })(jQuery);
     </script>
    
    <!-- CODE EDITOR & PAGES AND EXPAGES VIEWER--> 
    <script src="application/components/editor/code.editor.js" type="text/javascript"></script>
    
    <!-- TOOLS -->        
      
    <!-- SECTIONS -->      
      
        <script  type="text/javascript">
          (function($) {      
                 $('.idePad-booting-prct').css('width','108px');
            })(jQuery);
        </script>
      
    <!-- PAGES -->        
      
        <script  type="text/javascript">
          (function($) {    
                $('.idePad-booting-prct').css('width','128px');
            })(jQuery);     
        </script>
            
<!-- idePad BOOTSTRAP -->            
<script type="text/javascript">
(function($) {              
    //configure                        
                   
    //loading bar move               
    $('.idePad-booting-prct').css('width','138px');          
              
    //lets boot
    $.idePad.init(function(that){    
        setTimeout(function(){                            
            
            //END BOOTING
            $('.idePad-booting').css('left','15000px');
            
        },500);                                        
    });                                                                                
     
        
})(jQuery);
</script>
            
            
    </body>
</html>


