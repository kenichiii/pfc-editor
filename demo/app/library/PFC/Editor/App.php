<?php


/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace PFC\Editor;

class App {

    public static function isLoginActionRequest()
    {
           $uri = explode('/',$_SERVER['REQUEST_URI']);
           $req = end($uri);
      if($req==='login.action')
        {
           return true;
        }
      else return false;  
    }  
  
    public static function getLoginActionFilePath()
    {
       return 'components/app/_actions/login.php';
    }  
  
    public static function isLoginActionsRedirects()
    {
        return (isset($_GET['afterlogout'])||isset($_GET['afterlogin']));
    }
  
    public static function loginActionsRun()
    {
      
        if(isset($_GET['afterlogin']))
         {                
            \PFC\Editor\AppFile::send301RedirectHeaders(str_replace('?afterlogin', '', $_SERVER['REQUEST_URI']));
         }        

        if(isset($_GET['afterlogout']))
         {    
            \PFC\Editor\AppFile::send301RedirectHeaders(str_replace('?afterlogout', '', $_SERVER['REQUEST_URI']));
         }        
    }
  
    public static function isServerTimeRequest()
    {
        return (isset($_GET['_app']) && isset($_GET['ajax']) && $_GET['ajax']=='server-time');
    }

    public static function getRequestFilePath()
    {
       
         if(isset($_GET['page']) && isset($_GET['ajax'])) 
         {
             return 'components/pages/'.$_GET['page'].'/_ajax/'.$_GET['ajax'].'.php';
         }
         elseif(isset($_GET['page']) && isset($_GET['action'])) 
         {
             return 'components/pages/'.$_GET['page'].'/_actions/'.$_GET['action'].'.php';     
         }
         elseif(isset($_GET['page'])) 
         {
             return 'components/pages/'.$_GET['page'].'/template.php';
         }

         elseif(isset($_GET['section']) && isset($_GET['ajax']))
         {
             if($_GET['section']=='pages')
             {
                 \PFC\WebApp\App::connectDatabase();
             }
             return 'components/sections/'.$_GET['section'].'/_ajax/'.$_GET['ajax'].'.php';     
         }
         elseif(isset($_GET['section']) && isset($_GET['action']))
         {
             if($_GET['section']=='pages')
             {
                 \PFC\WebApp\App::connectDatabase();
             }     
             return 'components/sections/'.$_GET['section'].'/_actions/'.$_GET['action'].'.php';     
         }

         elseif(isset($_GET['tools']) && isset($_GET['ajax']))
         {
             return 'components/tools/'.$_GET['tools'].'/_ajax/'.$_GET['ajax'].'.php';     
         }
         elseif(isset($_GET['tools']) && isset($_GET['action']))
         {
             return 'components/tools/'.$_GET['tools'].'/_actions/'.$_GET['action'].'.php';     
         }


         elseif(isset($_GET['editor']) && isset($_GET['ajax']))
         {
             return 'components/editor/_ajax/'.$_GET['ajax'].'.php';     
         }
         elseif(isset($_GET['editor']) && isset($_GET['action']))
         {
             return 'components/editor/_actions/'.$_GET['action'].'.php';     
         }

         elseif(isset($_GET['_app']) && isset($_GET['ajax']))
         {
             return 'components/app/_ajax/'.$_GET['ajax'].'.php';     
         }
         elseif(isset($_GET['_app']) && isset($_GET['action']))
         {
             return 'components/app/_actions/'.$_GET['action'].'.php';     
         }

         elseif(isset($_GET['sandbox']))
         {
            set_include_path(implode(PATH_SEPARATOR, array(
                get_include_path(), 
                \PFC\Editor\SANDBOX_PATH
            )));

             return \PFC\Editor\SANDBOX_PATH.'/'.$_GET['sandbox'];     
         } 

         else
         {
           $uri = explode('?',$_SERVER['REQUEST_URI']);
           $req = $uri[0];  
           $pub = \PFC\Editor\PUBLIC_PATH.'/';
           
           $pos = strrpos($pub, $req);
           
                if (
                  $pos === false ||
                  strlen($pub)!== strlen(substr($pub,0,$pos).$req) 
                    ) {
                    // not found...
                    \PFC\Editor\AppFile::send404NotFoundHeaders();
                    return 'layout/404.php';
                }
                else
                {
                    return 'layout/layout.php';
                }
            
         }

    
    }

    public static function getLoginCheckFilePath()
    {
        return 'components/app/_actions/login.php';   
    }
  
    public static function bufferOn()
    {
        ob_start();
    }

    public static function bufferEnd()
    {
        $code = ob_get_contents();
        ob_end_clean();
        return $code;
    }
  
    public static function pagelink($page)
    {
        return "?page={$page}";
    }
    
    public static function pagelinkaction($page,$file)
    {
        return "?page={$page}&amp;action={$file}";
    }
    
    public static function pagelinkajax($page,$file)
    {
        return "?page={$page}&amp;ajax={$file}";
    }    
    public static function sectionlinkaction($page,$file,$params=null)
    {
      $uri='';
           if(is_array($params))
            {
               $uri .= '&amp;';  
               $i = 0;
               foreach($params as $key=>$value)
               {
                   $uri .= $key.'='.urlencode ($value);
                   if( $i < count($params)-1 ) $uri .= '&amp;';
                   $i++;
               }
            }
      
        return "?section={$page}&amp;action={$file}{$uri}";
    }
    public static function sectionlinkajax($page,$file)
    {
        return "?section={$page}&amp;ajax={$file}";
    }        
    public static function editorlinkaction($file)
    {
        return "?editor=true&action={$file}";
    }
    public static function editorlinkajax($file)
    {
        return "?editor=true&ajax={$file}";
    }     
    public static function applinkaction($file)
    {
        return "?_app=true&action={$file}";
    }
    public static function applinkajax($file)
    {
        return "?_app=true&ajax={$file}";
    }    
    
    
}

