<?php

namespace pfcUserData\Config;

class AceEditorSettings
{
    /** keyboard bindings **/
          //default, emacs, vim
    const keyboardBindings = 'default';
    
    /** editor options **/
    const highlightActiveLine = true;
    const highlightSelectedWord = true;
    
    /** renderer options **/
    const showFoldWidgets = true;
    const showLineNumbers = true;
    const fontSize = '130%';    
    //Ace can display only monospace fonts, The issue you describe can happen either if something changes font of the editor to non monospace, or assigns different fonts to different parts of the editor. 
    const fontFamily = 'monospace';
        
    const theme = false;//"ace/theme/twilight"
    
    /** session options **/
    const overwrite = false;
    
    /** editor options defined by extensions **/
    const enableBasicAutocompletion = true;
    const enableSnippets = true;
    const enableLiveAutocompletion = true;
    const spellcheck = false;
    const useElasticTabstops = false;
    
}
