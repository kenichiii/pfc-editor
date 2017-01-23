<?php

use PFC\Editor\Config\Sources;
use PFC\Editor\Router;
use PFC\Editor\Config;

?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>pfc editor</title>
        
        <meta charset="UTF-8">
        
        <!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
        
        <!-- INTERNAL libraries css -->
        <link type="text/css" href="vendor/jquery_ui/jquery-ui.min.css" rel="stylesheet">
      
        <link type="text/css" href="vendor/fileTree/jqueryFileTree.css" rel="stylesheet">
                 
        <link rel="stylesheet" href="vendor/pfc/pfcss/pfcss.css">                 
        <link rel="stylesheet" href="vendor/pfc/ui/pfc-ui.css">                 
        
        <!-- APPLICATIONS -->
        <link href="vendor/colpick/css/colpick.css" rel="stylesheet" type="text/css"/>
      
      	<link href="vendor/CalcSS3/CalcSS3.css" rel="stylesheet" type="text/css" />
      
                 
        <!-- pfc EDITOR -->        
        <link href="pfc-editor/layout/css/layout.css" rel="stylesheet" type="text/css"/>        
              
        <!-- CODE EDITOR -->
        <link href="pfc-editor/editor/css/extensions.css" rel="stylesheet" type="text/css"/>
        <link href="pfc-editor/editor/css/fileactions.css" rel="stylesheet" type="text/css"/>            
      
        <!-- PAGES -->
        <link href="pfc-editor/pages/pfc-editor/editor-about/about.css" rel="stylesheet" type="text/css"/>
        <link href="pfc-editor/pages/pfc-editor/editor-config/config.css" rel="stylesheet" type="text/css"/>
        
        <!-- TOOLS -->
        <link href="pfc-editor/tools/defaultApps/styles.css" rel="stylesheet" type="text/css"/>        
      
        <!-- SECTIONS -->
        <link href="pfc-editor/sections/css/sources.css" rel="stylesheet" type="text/css"/>
        <link href="pfc-editor/sections/css/extensions.css" rel="stylesheet" type="text/css"/>
        
        <!-- THEME -->
        <link href="pfc-editor/theme/<?php echo Config::theme; ?>/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <div id="pfc-editor-booting">
            booting pfc editor. please wait...
            <div id="pfc-editor-booting-holder">
              <div id="pfc-editor-booting-inner">
                <div id="pfc-editor-booting-prct"></div>
              </div>
            </div>
        </div>
        
    
    <header id="pfc-editor-head">           
		        
	    <?php echo $this->component('app/header'); ?>	
		        
    </header> 
    <!-- pfc-editor-head -->
               
   
        
         <aside id="pfc-editor-sections">   
            
            <?php foreach(['sources','sandbox','editor'] as $srcs) { ?>                          
            <section id="pfc-sources-<?php echo $srcs; ?>" class="pfc-editor-section">
                <?php require 'components/sections/sources/left-panel-'.$srcs.'.php';?>
            </section> <!-- pfc-sources-<?php echo $srcs; ?> -->
            <?php } ?>

            <?php require 'components/sections/sources/context-menu.php';?>

         </aside> 
         <!-- pfc-editor-sections -->
        
           
        
        <aside id="pfc-editor-tools" class="pfc-editor-section">
        
            <?php echo $this->component('tools'); ?>
               
        </aside> 
        <!-- pfc-editor-tools -->   
           
    
    
    <section class="pfc-editor-main-section">      
    
        <?php echo $this->component('editor'); ?>
    
    </section>                            
    <!-- MAIN -->     
      
      
      
      
    <footer id="pfc-editor-footer">
        
        <?php echo $this->component('app/footer'); ?>
        
    </footer>    
    <!-- FOOTER -->
                           
     
	<?php echo $this->component('app/ui'); ?>          
      
        
        <?php echo $this->component('tools/default-apps/calculator'); ?>
           
        <?php echo $this->component('tools/default-apps/color-picker'); ?>
           
        <?php echo $this->component('tools/default-apps/key-code'); ?>
        
           
        <?php echo $this->component('app/sounds'); ?>             
    
                    
    
    
    
    <!-- javascript  -->    
    
    <script type="text/javascript" src="vendor/jquery/jquery.js"></script>
    <script type="text/javascript" src="vendor/jquery_ui/jquery-ui.min.js"></script>                           
              
    <script type="text/javascript" src="vendor/CalcSS3/CalcSS3.js"></script>
    
    <script src="vendor/colpick/js/colpick.js" type="text/javascript"></script>
    
    <script type="text/javascript" src="vendor/jquery_form/jquery.form.js"></script>
                
                   
    <script type="text/javascript" src="vendor/fileTree/jqueryFileTree.js"></script>
      
      	<script  type="text/javascript">
            $('#pfc-editor-booting-prct').css('width','18px');
      	</script>
      		
    <!-- load ace -->
    <script src="vendor/ace/ace.js"></script>
    <script src="vendor/ace/ext-modelist.js"></script>       
    <script src="vendor/ace/ext-settings_menu.js"></script>
    <script src="vendor/ace/ext-statusbar.js"></script>
    <script src="vendor/ace/ext-language_tools.js"></script>
    <script src="vendor/ace/keybinding-vim.js"></script>
    <script src="vendor/ace/keybinding-emacs.js"></script>
    <!-- end ace editor -->  

        <script  type="text/javascript">
            $('#pfc-editor-booting-prct').css('width','50px');
        </script>

                    
    <script src="vendor/pfc/functions.js"></script>        
    <script src="vendor/pfc/pfcss/pfcss.js"></script>        
    <script src="vendor/pfc/ui/pfc-ui.js"></script>        
    
    <script src="vendor/functions/functions.js" type="text/javascript"></script>
    <!-- end libararies javascript -->
    
            
        <script  type="text/javascript">
            $('#pfc-editor-booting-prct').css('width','88px');
        </script>
        
        
    
    <!-- pfc EDITOR -->        
    <script src="pfc-editor/sounds/manager.js" type="text/javascript"></script>
            
    <script src="pfc-editor/pfc-editor.js" type="text/javascript"></script>

    <script src="pfc-editor/theme/<?php echo Config::theme; ?>/ace.editor.js" type="text/javascript"></script>                            
    <script src="pfc-editor/editor/ace.editor.config.js"></script>             
            
    <!-- TOOLS -->        
    <script src="pfc-editor/tools/defaultApps/tools.js" type="text/javascript"></script>
    <script src="pfc-editor/tools/defaultApps/snippets/snippets.js" type="text/javascript"></script>
      
    <!-- SECTIONS -->  
    <script src="pfc-editor/sections/sources.js" type="text/javascript"></script>
      
        <script  type="text/javascript">
            $('#pfc-editor-booting-prct').css('width','108px');
        </script>
      
    <!-- PAGES -->        
    <script src="pfc-editor/pages/pfc-editor/editor-about/editor-about.js" type="text/javascript"></script>
    <script src="pfc-editor/pages/pfc-editor/editor-config/editor-config.js" type="text/javascript"></script>
    <script src="pfc-editor/pages/pfc-editor/editor-help/editor-help.js" type="text/javascript"></script>
    <script src="pfc-editor/pages/pfc-editor/editor-home/editor-home.js" type="text/javascript"></script>
            
    <script src="pfc-editor/pages/phpinfo/phpinfo.js" type="text/javascript"></script>            
            
    <script src="pfc-editor/pages/adminer/adminer.js" type="text/javascript"></script>            
            
    <script src="pfc-editor/pages/webterminal/webterminal.js" type="text/javascript"></script> 
      
        <script  type="text/javascript">
            $('#pfc-editor-booting-prct').css('width','128px');
        </script>
            
<!-- pfc editor BOOTSTRAP -->            
<script type="text/javascript"> 
      
    //configure
        //editor
        pfcSoundsManager.on = <?php echo Config::sounds ?  'true':'false'; ?>;
        
        $.pfcEditor.editor.config.appSaveFileUrl =  "<?php echo Router::editorlinkaction('save-file'); ?>";
        $.pfcEditor.editor.config.getFileContentsUrl =  "<?php echo Router::editorlinkajax('get-file-contents'); ?>";
        $.pfcEditor.editor.config.checkLastModificationTimeCheckerUrl = "<?php echo Router::editorlinkajax('get-file-last-update'); ?>";
        
        $.pfcEditor.editor.config.lastModificationTimeCheckerDelay = <?php echo Config::EditorLastModificationCheckerInterval; ?>;
        $.pfcEditor.editor.config.lastModificationCheckerOn = <?php echo Config::EditorLastModificationChecker ?  'true':'false'; ?>;          
        
        //sandbox      
        $.pfcEditor.editor.config.sandboxUrl =  "?sandbox=";
             
        //pages
        $.pfcEditor.getPage('pfc-editor_editor-home').config.url = '<?php echo Router::pagelink('pfc-editor/editor-home'); ?>';
        $.pfcEditor.getPage('pfc-editor_editor-about').config.url = '<?php echo Router::pagelink('pfc-editor/editor-about'); ?>';
        $.pfcEditor.getPage('pfc-editor_editor-config').config.url = '<?php echo Router::pagelink('pfc-editor/editor-config'); ?>';
        $.pfcEditor.getPage('pfc-editor_editor-help').config.url = '<?php echo Router::pagelink('pfc-editor/editor-help'); ?>';
                
        $.pfcEditor.getPage('phpinfo').config.url = '<?php echo Router::pagelink('phpinfo'); ?>';
                
        $.pfcEditor.getPage('adminer').config.url = '<?php echo Router::pagelink('adminer'); ?>';
        $.pfcEditor.getPage('adminer').multi = <?php echo Config::isAdminerMultiPage ?  'true':'false'; ?>;
                
        $.pfcEditor.getPage('webterminal').config.url = '<?php echo Router::pagelink('webterminal'); ?>';
                
        
        //sections
            //SOURCES
            <?php foreach(['sources','sandbox','editor'] as $srcs) { ?>
            $.pfcEditor.addSection('#pfc-sources-<?php echo $srcs; ?>-href',$pfcEditorSources.factory({secid:'pfc-sources-<?php echo $srcs; ?>'}));
            
            $.pfcEditor.getSection('pfc-sources-<?php echo $srcs; ?>').config.updaterTimeout = <?php echo Config::SourcesLastModificationCheckerInterval; ?>;
            $.pfcEditor.getSection('pfc-sources-<?php echo $srcs; ?>').config.lastModificationCheckerOn = <?php echo Config::SourcesLastModificationChecker ?  'true':'false'; ?>;

            $.pfcEditor.getSection('pfc-sources-<?php echo $srcs; ?>').config.opendirs = [
                        <?php 
                              foreach(Sources::$paths as $k=>$s) 
                              { 
                                if($s['section'] === $srcs) {  
                                    ?>
                                                {
                                                    //id: '<?php echo $s['name']; ?>',
                                                    target: '#pfc-sources-<?php echo $s['name']; ?>',
                                                    root: '<?php echo $s['name']; ?>',
                                                    path: '<?php echo $s['path']; ?>'  
                                                },
                                    <?php
                                }
                              }
                        ?>                    
                ];

            <?php } //foreach
                    ?>
                
                   
    //loading bar move               
    $('#pfc-editor-booting-prct').css('width','138px');          
              
    //lets boot
    $.pfcEditor.init(function(that){    
        setTimeout(function(){                            
            //open welcome page
            $('#pfc-editor-logo').trigger('click');
            $('#pfc-editor-dialogs-heads a[href="#pfc-editor_editor-home"]').text('Welcome');
            
            //trigger opened left panel
            $('#pfc-sources-sources-href').trigger('click');
        
            //END BOOTING
            $('#pfc-editor-booting').css('left','15000px');
            
        },500);                                        
    });                                                                                

</script>
            
            
    </body>
</html>


