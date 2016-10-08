<!DOCTYPE html>
<html>
    <head>
        <title>pfc editor</title>
        <meta charset="UTF-8">
        <!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
        
        <!-- libraries css -->
        
                <link type="text/css" href="assets/vendor/jquery_ui/jquery-ui.min.css" rel="stylesheet">
                               
                
      
      			<link href="assets/vendor/colpick/css/colpick.css" rel="stylesheet" type="text/css"/>
      
      			<link href="assets/vendor/CalcSS3/CalcSS3.css" rel="stylesheet" type="text/css" />
      
                <link type="text/css" href="assets/vendor/fileTree/jqueryFileTree.css" rel="stylesheet">

                 
                 
                 
                 
                 
                 <link rel="stylesheet" href="assets/vendor/pfc/pfcss/pfcss.css">                 
                 <link rel="stylesheet" href="assets/vendor/pfc/ui/pfc-ui.css">                 
                 
        <!-- end libraries -->        
        
        <link href="assets/pfc-editor/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="assets/pfc-editor/layout/css/theme/<?php echo \PFC\Editor\Config::theme; ?>.css" rel="stylesheet" type="text/css"/>
      
        <link href="assets/pfc-editor/pages/pfc-editor/editor-about/about.css" rel="stylesheet" type="text/css"/>
        <link href="assets/pfc-editor/pages/pfc-editor/editor-config/config.css" rel="stylesheet" type="text/css"/>
        <link href="assets/pfc-editor/pages/phpinfo/css/phpinfo.css" rel="stylesheet" type="text/css"/>
        
        <link href="assets/pfc-editor/editor/css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="assets/pfc-editor/editor/css/extensions.css" rel="stylesheet" type="text/css"/>
        <link href="assets/pfc-editor/editor/css/fileactions.css" rel="stylesheet" type="text/css"/>      
        
        <link href="assets/pfc-editor/tools/default/styles.css" rel="stylesheet" type="text/css"/>        
      
        <link href="assets/pfc-editor/sections/css/sources.css" rel="stylesheet" type="text/css"/>
        <link href="assets/pfc-editor/sections/css/extensions.css" rel="stylesheet" type="text/css"/>
        
        
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
           
				<?php require 'components/app/header.php'; ?>	
            </header> <!-- pfc-editor-head -->
               
   
        
         <aside id="pfc-editor-sections">   
               
            <section id="pfc-sources-sources" class="pfc-editor-section">
                <?php require 'components/sections/sources/left-panel-sources.php';?>
            </section> <!-- pfc-sources -->

            <section id="pfc-sources-sandbox" class="pfc-editor-section" style="display:none">
                <?php require 'components/sections/sources/left-panel-sandbox.php';?>
            </section> <!-- pfc-sources -->
            
            <section id="pfc-sources-editor" class="pfc-editor-section" style="display:none">
                <?php require 'components/sections/sources/left-panel-editor.php';?>
            </section> <!-- pfc-sources -->            
            
           <section id="pfc-sources-include" class="pfc-editor-section" style="display:none">
                <?php require 'components/sections/sources/left-panel-include.php';?>
            </section> <!-- pfc-sources -->            
            
           
            <?php require 'components/sections/sources/context-menu.php';?>

            
         </aside> <!-- pfc-editor-sections -->
        
           
           <aside id="pfc-editor-tools" class="pfc-editor-section">
               <?php require 'components/tools/layout.php' ?>
           </aside> <!-- pfc-editor-tools -->   
           
         <main>      
           <?php require 'components/editor/template.php'; ?>
          
         </main>                            
         
      
      
      
      
         <footer id="pfc-editor-footer">
			<?php require 'components/app/footer.php'; ?>
         </footer>    
                           
     
	<?php require 'components/app/ui.php'; ?>            
      
      
      
    <?php require 'components/tools/default/calculator/template.php'; ?>   
   
    <?php require 'components/tools/default/color-picker/template.php'; ?> 
           
    <?php require 'components/app/sounds.php'; ?> 
      
      
        
            <!-- javascript  -->    
              
                
      
                <script type="text/javascript" src="assets/vendor/jquery/jquery.js"></script>
                <script type="text/javascript" src="assets/vendor/jquery_ui/jquery-ui.min.js"></script>                           
              
      		<script type="text/javascript" src="assets/vendor/CalcSS3/CalcSS3.js"></script>
    
                <script src="assets/vendor/colpick/js/colpick.js" type="text/javascript"></script>
    
                <script type="text/javascript" src="assets/vendor/jquery_form/jquery.form.js"></script>
                
                   
                <script type="text/javascript" src="assets/vendor/fileTree/jqueryFileTree.js"></script>
      
      			<script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','18px')
      			</script>
      		
                  <!-- load ace -->
                    <script src="assets/vendor/ace/ace.js"></script>
                    <script src="assets/vendor/ace/ext-modelist.js"></script>       
                    <script src="assets/vendor/ace/ext-settings_menu.js"></script>
                    <script src="assets/vendor/ace/ext-statusbar.js"></script>
                    <script src="assets/vendor/ace/ext-language_tools.js"></script>
                    <script src="assets/vendor/ace/keybinding-vim.js"></script>
                    <script src="assets/vendor/ace/keybinding-emacs.js"></script>
                  <!-- end ace editor -->  
                    
                            <script src="assets/vendor/pfc/functions.js"></script>        
                            <script src="assets/vendor/pfc/pfcss/pfcss.js"></script>        
                            <script src="assets/vendor/pfc/ui/pfc-ui.js"></script>        
          
        
        <!-- end libararies javascript -->
            
              <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','88px')
        </script>
        
        
        <script src="assets/vendor/functions/functions.js" type="text/javascript"></script>
            
            <script src="assets/pfc-editor/sounds/manager.js" type="text/javascript"></script>
            
            <script src="assets/pfc-editor/pfc-editor.js" type="text/javascript"></script>


            <script src="assets/pfc-editor/editor/ace.editor.js" type="text/javascript"></script>                            
                                            
            <script src="assets/pfc-editor/editor/ace.editor.config.js"></script>             
            
            
            <script src="assets/pfc-editor/tools/default/tools.js" type="text/javascript"></script>
            <script src="assets/pfc-editor/tools/default/snippets/snippets.js" type="text/javascript"></script>
            
            
            
              <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','108px')
        </script>
      
      
            <script src="assets/pfc-editor/sections/sources.js" type="text/javascript"></script>
      
                 <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','128px')
        </script>
      
            
            <script src="assets/pfc-editor/pages/pfc-editor/editor-about/editor-about.js" type="text/javascript"></script>
            <script src="assets/pfc-editor/pages/pfc-editor/editor-config/editor-config.js" type="text/javascript"></script>
            <script src="assets/pfc-editor/pages/pfc-editor/editor-help/editor-help.js" type="text/javascript"></script>
            <script src="assets/pfc-editor/pages/pfc-editor/editor-home/editor-home.js" type="text/javascript"></script>
            <script src="assets/pfc-editor/pages/phpinfo/phpinfo.js" type="text/javascript"></script>            
            
         
            
            
      
              <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','138px')
        </script>
            
            <script type="text/javascript"> 
            
                
             /**
              *   pfc editor
              */
             
/*
 * ADD TO EDITOR
 */

$.pfcEditor.addSection('#pfc-sources-sources-href',$pfcEditorSources.factory({secid:'pfc-sources-sources'}));
$.pfcEditor.addSection('#pfc-sources-sandbox-href',$pfcEditorSources.factory({secid:'pfc-sources-sandbox'}));
$.pfcEditor.addSection('#pfc-sources-editor-href',$pfcEditorSources.factory({secid:'pfc-sources-editor'}));

      
      
              //configure
                //editor
                $.pfcEditor.editor.config.appSaveFileUrl =  "<?php echo \PFC\Editor\App::editorlinkaction('save-file'); ?>";
                $.pfcEditor.editor.config.getFileContentsUrl =  "<?php echo \PFC\Editor\App::editorlinkajax('get-file-contents'); ?>";
                $.pfcEditor.editor.config.checkLastModificationTimeCheckerUrl = "<?php echo \PFC\Editor\App::editorlinkajax('get-file-last-update'); ?>";
              
                $.pfcEditor.editor.config.sandboxUrl =  "?sandbox=";
             
                //pages
                $.pfcEditor.getPage('pfc-editor_editor-home').config.url = '<?php echo \PFC\Editor\App::pagelink('pfc-editor/editor-home'); ?>';
                $.pfcEditor.getPage('pfc-editor_editor-about').config.url = '<?php echo \PFC\Editor\App::pagelink('pfc-editor/editor-about'); ?>';
                $.pfcEditor.getPage('pfc-editor_editor-config').config.url = '<?php echo \PFC\Editor\App::pagelink('pfc-editor/editor-config'); ?>';
                $.pfcEditor.getPage('pfc-editor_editor-help').config.url = '<?php echo \PFC\Editor\App::pagelink('pfc-editor/editor-help'); ?>';
                
                                
                $.pfcEditor.getPage('phpinfo').config.url = '<?php echo \PFC\Editor\App::pagelink('phpinfo'); ?>';
                
                //sections
                
                $.pfcEditor.getSection('pfc-sources-editor').config.opendirs = [
                        <?php 
                              foreach(\PFC\Editor\Config\Sources::$paths as $k=>$s) 
                              { 
                                if($s['section']=='editor') {  
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

                $.pfcEditor.getSection('pfc-sources-sources').config.opendirs = [
                        <?php 
                              foreach(\PFC\Editor\Config\Sources::$paths as $k=>$s) 
                              { 
                                if($s['section']=='sources') {  
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
           
        
                $.pfcEditor.getSection('pfc-sources-sandbox').config.opendirs = [
                        <?php 
                              foreach(\PFC\Editor\Config\Sources::$paths as $k=>$s) 
                              { 
                                if($s['section']=='sandbox') {  
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
                
                   
              
              
              
                $.pfcEditor.getSection('pfc-sources-sources').config.updaterTimeout = <?php echo \PFC\Editor\Config::SourcesLastModificationCheckerInterval; ?>;
                $.pfcEditor.getSection('pfc-sources-sources').config.lastModificationCheckerOn = <?php echo \PFC\Editor\Config::SourcesLastModificationChecker ?  'true':'false'; ?>;
                
                $.pfcEditor.getSection('pfc-sources-editor').config.updaterTimeout = <?php echo \PFC\Editor\Config::SourcesLastModificationCheckerInterval; ?>;
                $.pfcEditor.getSection('pfc-sources-editor').config.lastModificationCheckerOn = <?php echo \PFC\Editor\Config::SourcesLastModificationChecker ?  'true':'false'; ?>;;
 
                $.pfcEditor.getSection('pfc-sources-sandbox').config.updaterTimeout = <?php echo \PFC\Editor\Config::SourcesLastModificationCheckerInterval; ?>;
                $.pfcEditor.getSection('pfc-sources-sandbox').config.lastModificationCheckerOn = <?php echo \PFC\Editor\Config::SourcesLastModificationChecker ?  'true':'false'; ?>;;
              
              
              
  
                          
                $.pfcEditor.editor.config.lastModificationTimeCheckerDelay = <?php echo \PFC\Editor\Config::EditorLastModificationCheckerInterval; ?>;
                $.pfcEditor.editor.config.lastModificationCheckerOn = <?php echo \PFC\Editor\Config::EditorLastModificationChecker ?  'true':'false'; ?>;          
                
                pfcSoundsManager.on = <?php echo \PFC\Editor\Config::sounds ?  'true':'false'; ?>;
                
                //lets boot
                $.pfcEditor.init(function(that){    
                    setTimeout(function(){                            
                        $('#pfc-editor-logo').trigger('click');
                        $('#pfc-editor-dialogs-heads a[href="#editor-home"]').text('Welcome');
                        $.pfcEditor.getSection('pfc-sources-sources').focus();
                        //end booting
                        $('#pfc-editor-booting').css('left','15000px');
                    },500);                                        
                });                                                                                

            </script>
            
            
    </body>
</html>

