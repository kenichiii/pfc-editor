

 //configuring codeMirror                
                $.pfcEditor.editor.codeMirror.config.ui = 
                      {      
                              
                            lineNumbers: true,
                              
                            theme: "night",
                                                            
                            styleActiveLine: true,                            
                            autoCloseTags: true,
                            autoCloseBrackets: true,
                            matchBrackets: true,
                  
							extraKeys: {"Ctrl-Space": "autocomplete"},   
                  
                            gutters: ["error-gutter", "CodeMirror-linenumbers"]
                      };
                 
                 