<?php
   
    use pfcUserData\Config\AceEditorSettings;

?>
(function(window, $) {

    $.extend($.pfcEditor.editor.aceEditorOptions, {
    
            /** keyboard bindings **/
            keyboardBindings: "<?php echo AceEditorSettings::keyboardBindings; ?>", //"default","emacs","vim" 


            /** editor options **/

            //selectionStyle: "line"|"text"
            highlightActiveLine: <?php echo AceEditorSettings::highlightActiveLine ? 'true' : 'false'; ?>,
            highlightSelectedWord: <?php echo AceEditorSettings::highlightSelectedWord ? 'true' : 'false'; ?>,
            //readOnly: 
            //cursorStyle: "ace"|"slim"|"smooth"|"wide"
            //mergeUndoDeltas: false true "always"
            //behavioursEnabled: 
            //wrapBehavioursEnabled: 
            //autoScrollEditorIntoView: // this is needed if editor is inside scrollable page


            /** renderer options **/
            //hScrollBarAlwaysVisible:
            //vScrollBarAlwaysVisible:
            //highlightGutterLine:
            //animatedScroll:
            //showInvisibles:
            //showPrintMargin: true,
            ////printMarginColumn: number //80
            //printMargin:
            //fadeFoldWidgets:
            showFoldWidgets: <?php echo AceEditorSettings::showFoldWidgets ? 'true' : 'false'; ?>,
            showLineNumbers: <?php echo AceEditorSettings::showLineNumbers ? 'true' : 'false'; ?>,
            //showGutter:
            //displayIndentGuides:
            fontSize: "<?php echo AceEditorSettings::fontSize; ?>",
            fontFamily: "<?php echo AceEditorSettings::fontFamily; ?>",//Ace can display only monospace fonts, The issue you describe can happen either if something changes font of the editor to non monospace, or assigns different fonts to different parts of the editor. 
            //maxLines: 
            //minLines:
            //scrollPastEnd: 
            //fixedWidthGutter:
    
            <?php if(AceEditorSettings::theme) { ?>
            theme: "<?php echo AceEditorSettings::theme; ?>",
            <?php } ?>
            

            /** mouseHandler options **/
            //scrollSpeed: number
            //dragDelay:  number
            //dragEnabled:
            //focusTimout: number
            //tooltipFollowsMouse:


            /** session options **/
            //firstLineNumber: number
            overwrite: <?php echo AceEditorSettings::overwrite ? 'true' : 'false'; ?>,
            //newLineMode:
            //useWorker:
            //useSoftTabs:
            //tabSize: number
            //wrap: 
            //foldStyle:
            //mode: path to a mode e.g "ace/mode/text"




            /** editor options defined by extensions **/
            //enableMultiselect: true,
            enableEmmet: true,
            enableBasicAutocompletion: <?php echo AceEditorSettings::enableBasicAutocompletion ? 'true' : 'false'; ?>,
            enableSnippets: <?php echo AceEditorSettings::enableSnippets ? 'true' : 'false'; ?>,
            enableLiveAutocompletion:  <?php echo AceEditorSettings::enableLiveAutocompletion ? 'true' : 'false'; ?>,
            spellcheck: <?php echo AceEditorSettings::spellcheck ? 'true' : 'false'; ?>,
            useElasticTabstops: <?php echo AceEditorSettings::useElasticTabstops ? 'true' : 'false'; ?>,       

        somelastproperty: true    
    });

})(window, jQuery);
