<!DOCTYPE html>
<html>
    <head>
        <title>pfc editor</title>
        <meta charset="UTF-8">
        <!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
        
        <!-- libraries css -->
        
                <link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/jquery_ui/jquery-ui.min.css" rel="stylesheet">
                               
                
      
      			<link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/colpick/css/colpick.css" rel="stylesheet" type="text/css"/>
      
      			<link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/CalcSS3/CalcSS3.css" rel="stylesheet" type="text/css" />
      
                <link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/fileTree/jqueryFileTree.css" rel="stylesheet">
      
                <link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/hint/show-hint.css" rel="stylesheet">
                <link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/foldgutter.css" rel="stylesheet">
                <!--link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/display/fullscreen.css" rel="stylesheet"-->      
                
      
                <link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/lib/codemirror.css" rel="stylesheet">
      
                <link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/dialog/dialog.css" rel="stylesheet">
                <link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/search/matchesonscrollbar.css" rel="stylesheet">
                 <link rel="stylesheet" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/lint/lint.css">                 
                 
                 
                 
                 
                 
                 <link rel="stylesheet" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/pfc/pfcss/pfcss.css">                 
                 <link rel="stylesheet" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/pfc/ui/pfc-ui.css">                 
                 
        <!-- end libraries -->        
        
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/layout/css/theme/<?php echo \PFC\Editor\Config::theme; ?>.css" rel="stylesheet" type="text/css"/>
      
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/pages/css/about.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/pages/css/config.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/pages/css/phpinfo.css" rel="stylesheet" type="text/css"/>
        
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/editor/extensions.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/editor/fileactions.css" rel="stylesheet" type="text/css"/>      
        
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/tools/default/styles.css" rel="stylesheet" type="text/css"/>        
      
        <link href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/sections/css/sources.css" rel="stylesheet" type="text/css"/>
        
        
        
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
   
      
    <?php require 'components/app/sounds.php'; ?> 
      
      
        
            <!-- javascript  -->    
              
                
      
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/jquery/jquery.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/jquery_ui/jquery-ui.min.js"></script>                           
              
      			<script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/CalcSS3/CalcSS3.js"></script>
    
                <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/colpick/js/colpick.js" type="text/javascript"></script>
    
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/jquery_form/jquery.form.js"></script>
                
                   
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/fileTree/jqueryFileTree.js"></script>
      
      			<script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','18px')
      			</script>
      			
<?php if (\PFC\Editor\Config::editor === 'codemirror') { ?>      
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/lib/codemirror.js"></script>
                
      
      
      
                <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/xml-fold.js"></script-->
      
                <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/foldcode.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/foldgutter.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/brace-fold.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/xml-fold.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/markdown-fold.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/comment-fold.js"></script-->

                <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode/xml/xml.js"></script-->

                
                <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/edit/matchbrackets.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode/htmlmixed/htmlmixed.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode/xml/xml.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode/javascript/javascript.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode/css/css.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode/clike/clike.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode/php/php.js"></script-->
   
                <script src="//ajax.aspnetcdn.com/ajax/jshint/r07/jshint.js"></script>
                <script src="https://rawgithub.com/zaach/jsonlint/79b553fb65c192add9066da64043458981b3972b/lib/jsonlint.js"></script>
                <script src="https://rawgithub.com/stubbornella/csslint/master/release/csslint.js"></script>
                <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/lint/lint.js"></script>
                <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/lint/javascript-lint.js"></script>
                <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/lint/json-lint.js"></script>
                <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/lint/css-lint.js"></script>
                
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/dialog/dialog.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/search/searchcursor.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/search/search.js"></script>
                <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/search/goto-line.js"></script>      
      
                <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/scroll/annotatescrollbar.js"></script-->
                <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/search/matchesonscrollbar.js"></script-->

        <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','38px')
        </script>
      
               <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/search/match-highlighter.js"></script>
               <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/selection/active-line.js"></script>
           
                       <!-- dont work with // key support -->
                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/edit/closetag.js"></script-->      						
                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/edit/matchtags.js"></script-->
      				   <!-- dont work with // key support -->
      
      
                          <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/edit/matchbrackets.js"></script>
                          <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/edit/closebrackets.js"></script>
           

                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/comment/continuecomment.js"></script-->
                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/display/fullscreen.js"></script-->
                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/comment/comment.js"></script-->
                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/fold/foldcode.js"></script-->
                          <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/hint/show-hint.js"></script>
                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/hint/javascript-hint.js"></script>
                          <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/hint/html-hint.js"></script-->
  
              <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','68px')
        </script>
      
      
                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/hint/css-hint.js"></script-->

                          <script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/hint/anyword-hint.js"></script>

                          <!--script type="text/javascript" src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/hint/sql-hint.js"></script-->
    
                            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/addon/mode/loadmode.js"></script>
                            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode/meta.js"></script>        
        
<?php } //codemirror 

      elseif (\PFC\Editor\Config::editor === 'ace-editor') {
?>

                            
                            
<?php } //ace-editor ?>                            
                            
                            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/pfc/functions.js"></script>        
                            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/pfc/pfcss/pfcss.js"></script>        
                            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/pfc/ui/pfc-ui.js"></script>        
          
        
        <!-- end libararies javascript -->
            
              <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','88px')
        </script>
        
        
        <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/functions/functions.js" type="text/javascript"></script>
            
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/sounds/manager.js" type="text/javascript"></script>
            
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/editor.js" type="text/javascript"></script>
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/editor/codemirror.editor.js" type="text/javascript"></script>
            
<?php if (\PFC\Editor\Config::editor === 'codemirror') { ?>                  
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/config/codeMirror.js" type="text/javascript"></script>
<?php } elseif (\PFC\Editor\Config::editor === 'ace-editor') { ?>
                                                        
<?php } //ace-editor ?>                            
            
            
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/tools/default/tools.js" type="text/javascript"></script>
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/tools/snippets/snippets.js" type="text/javascript"></script>
            
            
            
              <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','108px')
        </script>
      
      
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/sections/sources.js" type="text/javascript"></script>
      
                 <script  type="text/javascript">
                  $('#pfc-editor-booting-prct').css('width','128px')
        </script>
      
            
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/pages/editor-about.js" type="text/javascript"></script>
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/pages/editor-config.js" type="text/javascript"></script>
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/pages/editor-help.js" type="text/javascript"></script>
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/pages/editor-home.js" type="text/javascript"></script>
            <script src="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/pfc-editor/pages/phpinfo.js" type="text/javascript"></script>            
            
         
            
            
      
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
$.pfcEditor.addSection('#pfc-sources-include-href',$pfcEditorSources.factory({secid:'pfc-sources-include'}));
      
      
              //configure
                //editor
                $.pfcEditor.editor.config.appSaveFileUrl =  "<?php echo \PFC\Editor\App::editorlinkaction('save-file'); ?>";
                $.pfcEditor.editor.config.checkPhpSyntaxUrl =  "<?php echo \PFC\Editor\App::editorlinkajax('check-php-syntax'); ?>";
                $.pfcEditor.editor.config.getFileContentsUrl =  "<?php echo \PFC\Editor\App::editorlinkajax('get-file-contents'); ?>";
                $.pfcEditor.editor.config.checkLastModificationTimeCheckerUrl = "<?php echo \PFC\Editor\App::editorlinkajax('get-file-last-update'); ?>";
              
                $.pfcEditor.editor.config.sandboxUrl =  "?sandbox=";
              
              	$.pfcEditor.editor.codeMirror.config.modeUrl =  "<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/mode";
                
              if($.pfcEditor.editor.codeMirror.config.ui.theme)
                $('head').append('<link type="text/css" href="<?php echo \PFC\Editor\Config::assetsUrl; ?>assets/libs/codemirror/theme/'+$.pfcEditor.editor.codeMirror.config.ui.theme+'.css" rel="stylesheet">');
              
                //pages
                $.pfcEditor.getPage('editor-about').config.url = '<?php echo \PFC\Editor\App::pagelink('editor-about'); ?>';
                $.pfcEditor.getPage('editor-config').config.url = '<?php echo \PFC\Editor\App::pagelink('editor-config'); ?>';
                $.pfcEditor.getPage('editor-help').config.url = '<?php echo \PFC\Editor\App::pagelink('editor-help'); ?>';
                
                                
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
                
                $.pfcEditor.getSection('pfc-sources-include').config.opendirs = [
                        <?php 
                              foreach(\PFC\Editor\Config\Sources::$paths as $k=>$s) 
                              { 
                                if($s['section']=='include') {  
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
              
              
              
                //deprecated
                $.pfcEditor.editor.config.phpSyntaxCheckerDelay = 1900;
                $.pfcEditor.editor.config.phpSyntaxCheckerOn = true;   
                          
                $.pfcEditor.editor.config.lastModificationTimeCheckerDelay = <?php echo \PFC\Editor\Config::EditorLastModificationCheckerInterval; ?>;
                $.pfcEditor.editor.config.lastModificationCheckerOn = <?php echo \PFC\Editor\Config::EditorLastModificationChecker ?  'true':'false'; ?>;          
                
                pfcSoundsManager.on = <?php echo \PFC\Editor\Config::sounds ?  'true':'false'; ?>;
                
                //lets boot
                $.pfcEditor.init();
                $.pfcEditor.getPage('editor-home').init();
                $.pfcEditor.getSection('pfc-sources-sources').focus();
                
                 //end booting
                 $('#pfc-editor-booting').css('left','15000px');

            </script>
            
            
    </body>
</html>

