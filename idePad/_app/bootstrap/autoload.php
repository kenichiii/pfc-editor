<?php 


namespace PFC\WebApp;  
  
function autoload($class)
{
    $class = str_replace('\\', '/', $class );

    if(file_exists(LIBRARY_PATH.'/'.$class.".php"))
      { require_once LIBRARY_PATH.'/'.$class.".php"; return; }
    
    elseif(preg_match('/^(pfcUserData\/)/', $class)) 
      { require_once preg_replace('/^(pfcUserData)/', USER_DATA_PATH, $class).".php"; }    
      
    else 
    {
        //test for application
        $pies = explode('/', $class);        
        $piesCount = count($pies);                
        if ($pies[0] === APPNAME && $piesCount > 2) {                                                
            //set default $isController
            $isController = true;
            if ($pies[1] === 'Component') {
                $pies[1] = 'components';
            } elseif ($pies[1] === 'Layout') {
                $pies[1] = 'layouts';
           } 
                             
                            
                    //get right folders and script names
                    foreach ($pies as $key => $pie)
                    {                                                                            
                        if ($key === 0) {
                            $pies[$key] = preg_replace('/(\/)$/', '', APPLICATION_PATH);
                            continue;
                        }
                        
                        if ($pies[$key] === 'Model') { 
                            $pies[$key] = $key > 1 ? '_models' : 'models';                            
                            $isController = false;
                            break;
                        } elseif ($pies[$key] === 'Config') {
                            $pies[$key] = $key > 1 ? '_configs' : 'configs';
                            $isController = false;                            
                            break;
                        }
                        
                        $pies[$key] = preg_replace_callback(
                                    '/([a-z0-9]){1}([A-Z]){1}/',
                                    function($matches) {
                                        return $matches[1] .'-'. strtolower($matches[2]);
                                    },
                                    $pie
                                );
                                    
                        $pies[$key] = strtolower($pies[$key]);            
                    } //foreach           
            
            //build new path
            if ($isController) {
                                                                                                                                                                                                       
                $scriptName = $pies[(count($pies)-1)];    
                unset($pies[(count($pies)-1)]);
                
                //do subtype folder rewrites and script rewrites                   
                if (isset($pies[2]) && $pies[2] === 'ajax') {                             
                    unset($pies[2]);
                    $pies[] = '_ajax';
                    $pies[] = $scriptName;
                } elseif (isset($pies[2]) && $pies[2] === 'action') {
                    unset($pies[2]);
                    $pies[] = '_actions';
                    $pies[] = $scriptName;                     
                } elseif (isset($pies[2]) && $pies[2] === 'pjs') { 
                    unset($pies[2]);
                    $pies[] = '_pjs';
                    $pies[] = $scriptName;
                } elseif (isset($pies[2]) && $pies[2] === 'pcss') {                      
                    unset($pies[2]);
                    $pies[] = '_pcss'; 
                    $pies[] = $scriptName;                     
                } else {            
                    //controller is file main
                    $pies[] = $scriptName;                     
                    $pies[] = 'controller';
                }                                                                          
            }
            
            //require application script
            $appFileScript = implode('/', $pies) .'.php';
            if (file_exists($appFileScript)) {
                require_once $appFileScript;                
            } else {
                throw new \Exception("NOT EXISTING FILE {$appFileScript} FOR {$class}");
            }                                                
        } //if pies[0] === pfcApp
    }
    
    
    
    
      
    //else echo $class;

}
