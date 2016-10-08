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
      return \filter_input(\INPUT_GET, '_app') && \filter_input(\INPUT_GET, 'action') === 'login';
    }  

    public static function isServerTimeRequest()
    {
        return \filter_input(\INPUT_GET, '_app') && \filter_input(\INPUT_GET, 'ajax') === 'server-time';
    }

    public static function getRequestFilePath()
    {      
         $ajax = \filter_input(\INPUT_GET, 'ajax');
         $action = \filter_input(\INPUT_GET, 'action');
      
       	 $app = \filter_input(\INPUT_GET, '_app');
         $section = \filter_input(\INPUT_GET, 'section');
         $page = \filter_input(\INPUT_GET, 'page');
         $tools = \filter_input(\INPUT_GET, 'tools');
      	 $editor = \filter_input(\INPUT_GET, 'editor');
         $sandbox = \filter_input(\INPUT_GET, 'sandbox');
       
         if($page && $ajax) 
         {
             $r = 'components/pages/'.$page.'/_ajax/'.$ajax.'.php';
         } elseif($page && $action) {
             $r = 'components/pages/'.$page.'/_actions/'.$action.'.php';     
         } elseif($page) {
             $r = 'components/pages/'.$page.'/template.php';
         }

         elseif($section && $ajax)
         {
             return 'components/sections/'.$section.'/_ajax/'.$ajax.'.php';     
         }
         elseif($section && $action)
         {   
             return 'components/sections/'.$section.'/_actions/'.$action.'.php';     
         }
         
         elseif($tools && $ajax) {
             $r = 'components/tools/'.$tools.'/_ajax/'.$ajax.'.php';     
         } elseif($tools && $action) {
             $r = 'components/tools/'.$tools.'/_actions/'.$action.'.php';     
         }


         elseif($editor && $ajax) {
             $r = 'components/editor/_ajax/'.$ajax.'.php';     
         } elseif($editor && $action) {
             $r = 'components/editor/_actions/'.$action.'.php';     
         }
            
      
         elseif($app && $ajax) {
             $r = 'components/app/_ajax/'.$ajax.'.php';     
         } elseif($app && $action) {
             $r = 'components/app/_actions/'.$action.'.php';                
         } 
      
      
         elseif($sandbox) {
            set_include_path(implode(PATH_SEPARATOR, array(
                get_include_path(), 
                \PFC\Editor\SANDBOX_PATH
            )));

             $r = \PFC\Editor\SANDBOX_PATH.'/'.$sandbox;     
         } 
      
      
      	 else {          
            $r = 'layout/layout.php';                            
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