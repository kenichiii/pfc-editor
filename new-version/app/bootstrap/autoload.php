<?php 


namespace PFC\Editor;  
  
function autoload($class)
{
    $class = str_replace('\\', '/', $class );

    
    
    if($class === 'PFC/Editor/Config') 
      { require_once APPLICATION_PATH . '/config/Editor.php'; }      

    elseif(substr($class,0,18) === 'PFC/Editor/Config/')
      { require_once 
            str_replace(
                'PFC/Editor/Config/',
                 APPLICATION_PATH . '/config/',
                 $class
            )
            .'.php'
        ; 
      }      
      
    elseif(file_exists(LIBRARY_PATH.'/'.$class.".php"))
      { require_once LIBRARY_PATH.'/'.$class.".php"; }
      
    //else echo $class;

}
