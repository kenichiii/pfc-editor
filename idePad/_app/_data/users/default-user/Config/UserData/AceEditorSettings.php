<?php

return [
    /** keyboard bindings **/
          //default, emacs, vim
    'keyboardBindings' => 'default',
    
    /** editor options **/
    'highlightActiveLine' => true,
    'highlightSelectedWord' => true,
    
    /** renderer options **/
    'showFoldWidgets' => true,
    'showLineNumbers' => true,
    'fontSize' => '120%',    
    //Ace can display only monospace fonts, The issue you describe can happen either if something changes font of the editor to non monospace, or assigns different fonts to different parts of the editor. 
    'fontFamily' => 'monospace',
        
    'theme' => false,//"ace/theme/twilight"
    
    /** session options **/
    'overwrite' => false,
    
    /** editor options defined by extensions **/
    'enableBasicAutocompletion' => true,
    'enableSnippets' => true,
    'enableEmmet' => true,
    'enableLiveAutocompletion' => true,
    'spellcheck' => false,
    'useElasticTabstops' => false,
    
/** keyboard bindings **/
//keyboardBindings: "default", //"default","emacs","vim" 

/** editor options **/
//selectionStyle: "line"|"text"
//highlightActiveLine: true,
//highlightSelectedWord: true,
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
//showFoldWidgets: true,
//showLineNumbers: true,
//showGutter:
//displayIndentGuides:
//fontSize: "130%",
//fontFamily: "monospace",//Ace can display only monospace fonts, The issue you describe can happen either if something changes font of the editor to non monospace, or assigns different fonts to different parts of the editor. 
//maxLines: 
//minLines:
//scrollPastEnd: 
//fixedWidthGutter:


/** mouseHandler options **/
//scrollSpeed: number
//dragDelay:  number
//dragEnabled:
//focusTimout: number
//tooltipFollowsMouse:
                
/** session options **/
//firstLineNumber: number
//overwrite: false,
//newLineMode:
//useWorker:
//useSoftTabs:
//tabSize: number
//wrap: 
//foldStyle:
//mode: path to a mode e.g "ace/mode/text"

/** editor options defined by extensions **/
//enableMultiselect: 
//enableEmmet: 
//enableBasicAutocompletion: true,
//enableSnippets: true,
//enableLiveAutocompletion: false
//spellcheck:
//useElasticTabstops:        

    
    
];
