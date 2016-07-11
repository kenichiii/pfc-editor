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
           //$uri = explode('/',$_SERVER['REQUEST_URI']);
           //$req = end($uri);
      if((isset($_GET['app'])||isset($_GET['_app'])) && isset($_GET['action']) && $_GET['action']==='login')
        {
           return true;
        }
      else return false;  
    }  
  
    public static function getLoginActionFilePath()
    {
       return 'components/app/_actions/login.php';
    }  
  
  
    public static function isServerTimeRequest()
    {
        return (isset($_GET['_app']) && isset($_GET['ajax']) && $_GET['ajax']=='server-time');
    }

    public static function getRequestFilePath()
    {
       
         if(isset($_GET['page']) && isset($_GET['ajax'])) 
         {
             $r = 'components/pages/'.$_GET['page'].'/_ajax/'.$_GET['ajax'].'.php';
         }
         elseif(isset($_GET['page']) && isset($_GET['action'])) 
         {
             $r = 'components/pages/'.$_GET['page'].'/_actions/'.$_GET['action'].'.php';     
         }
         elseif(isset($_GET['page'])) 
         {
             $r = 'components/pages/'.$_GET['page'].'/template.php';
         }

         elseif(isset($_GET['section']) && isset($_GET['ajax']))
         {
             if($_GET['section']=='pages')
             {
                 \PFC\WebApp\App::connectDatabase();
             }
             $r = 'components/sections/'.$_GET['section'].'/_ajax/'.$_GET['ajax'].'.php';     
         }
         elseif(isset($_GET['section']) && isset($_GET['action']))
         {
             if($_GET['section']=='pages')
             {
                 \PFC\WebApp\App::connectDatabase();
             }     
             $r = 'components/sections/'.$_GET['section'].'/_actions/'.$_GET['action'].'.php';     
         }

         elseif(isset($_GET['tools']) && isset($_GET['ajax']))
         {
             $r = 'components/tools/'.$_GET['tools'].'/_ajax/'.$_GET['ajax'].'.php';     
         }
         elseif(isset($_GET['tools']) && isset($_GET['action']))
         {
             $r = 'components/tools/'.$_GET['tools'].'/_actions/'.$_GET['action'].'.php';     
         }


         elseif(isset($_GET['editor']) && isset($_GET['ajax']))
         {
             $r = 'components/editor/_ajax/'.$_GET['ajax'].'.php';     
         }
         elseif(isset($_GET['editor']) && isset($_GET['action']))
         {
             $r = 'components/editor/_actions/'.$_GET['action'].'.php';     
         }

      
      
         elseif((isset($_GET['app'])||isset($_GET['_app']))  && isset($_GET['ajax']))
         {
             $r = 'components/app/_ajax/'.$_GET['ajax'].'.php';     
         }
         elseif((isset($_GET['app'])||isset($_GET['_app'])) && isset($_GET['action']))
         {
             $r = 'components/app/_actions/'.$_GET['action'].'.php';     
         }

         elseif(isset($_GET['sandbox']))
         {
            set_include_path(implode(PATH_SEPARATOR, array(
                get_include_path(), 
                \PFC\Editor\SANDBOX_PATH
            )));

             $r = \PFC\Editor\SANDBOX_PATH.'/'.$_GET['sandbox'];     
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
                    $r = 'layout/404.php';
                }
                else
                {
                    $r = 'layout/layout.php';
                }
            
         }

      return $r;
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
  
    public static function pagelink($page,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
        return "?page={$page}{$plugin_href}";
    }
    
    public static function pagelinkaction($page,$file,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
        return "?page={$page}&amp;action={$file}{$plugin_href}";
    }
    
    public static function pagelinkajax($page,$file,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
        return "?page={$page}&amp;ajax={$file}{$plugin_href}";
    }    
    public static function sectionlinkaction($page,$file,$params=null,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
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
      
        return "?section={$page}&amp;action={$file}{$uri}{$plugin_href}";
    }
    public static function sectionlinkajax($page,$file,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
        return "?section={$page}&amp;ajax={$file}{$plugin_href}";
    }        
    public static function editorlinkaction($file,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
        return "?editor=true&action={$file}{$plugin_href}";
    }
    public static function editorlinkajax($file,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
        return "?editor=true&ajax={$file}{$plugin_href}";
    }     
    public static function applinkaction($file,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
        return "?_app=true&action={$file}{$plugin_href}";
    }
    public static function applinkajax($file,$plugin=null)
    {
      $plugin_href = $plugin?'&plugin='.$plugin:'';
        return "?_app=true&ajax={$file}{$plugin_href}";
    }    
}