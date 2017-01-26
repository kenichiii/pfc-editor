<?php 

namespace PFC\Editor;

class Router
{
    public static function pagelink($page, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?page={$page}{$plugin_href}";
    }
    
    public static function pagelinkaction($page, $file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?page={$page}&action={$file}{$plugin_href}";
    }
    
    public static function pagelinkajax($page, $file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?page={$page}&ajax={$file}{$plugin_href}";
    }  
    
    public static function sectionlinkaction($page, $file, $params = null, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        $uri='';
        
           if(is_array($params)) {
               $uri .= '&amp;';  
               $i = 0;
               
               foreach($params as $key=>$value) {
                   $uri .= $key .'='. \urlencode ($value);
                   
                   if($i < \count($params)-1) {
                       $uri .= '&';
                   }
                   
                   $i++;
               }
            }
      
        return "?section={$page}&action={$file}{$uri}{$plugin_href}";
    }
    
    public static function sectionlinkajax($page, $file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?section={$page}ajax={$file}{$plugin_href}";
    }
    
    public static function editorlinkaction($file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?editor=true&action={$file}{$plugin_href}";
    }
    
    public static function editorlinkajax($file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?editor=true&ajax={$file}{$plugin_href}";
    }
    
    public static function applinkaction($file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?_app=true&action={$file}{$plugin_href}";
    }
    
    public static function applinkajax($file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?_app=true&ajax={$file}{$plugin_href}";
    }
    
    public static function isAjaxRequest()
    {
        return \filter_input(\INPUT_GET, 'ajax');
    }
    
    public static function isActionRequest()
    {
        return \filter_input(\INPUT_GET, 'action');
    }

    public static function isAppRequest()
    {
        return \filter_input(\INPUT_GET, '_app');
    }

    public static function isPageRequest()
    {
        return \filter_input(\INPUT_GET, 'page');
    }
    
    public static function isToolsRequest()
    {
        return \filter_input(\INPUT_GET, 'tools');
    }
    
    public static function isEditorRequest()
    {
        return \filter_input(\INPUT_GET, 'editor');
    }
    
    public static function isSectionRequest()
    {
        return \filter_input(\INPUT_GET, 'section');
    }
    
    public static function isSandboxRequest()
    {
        return \filter_input(\INPUT_GET, 'sandbox');
    }  
    
    public static function isLoginActionRequest()
    {
        return Router::isAppRequest() && Router::isActionRequest() === 'login';//\filter_input(\INPUT_GET, '_app') && \filter_input(\INPUT_GET, 'action') === 'login';
    }  

    public static function isServerTimeRequest()
    {
        return Router::isAppRequest() && Router::isAjaxRequest() === 'server-time';//\filter_input(\INPUT_GET, '_app') && \filter_input(\INPUT_GET, 'ajax') === 'server-time';
    }

    public static function getRequestFilePath()
    {      
         $ajax = Router::isAjaxRequest();
         $action = Router::isActionRequest();
      
       	 $app = Router::isAppRequest();
         $page = Router::isPageRequest();
         $tools = Router::isToolsRequest();
      	 $editor = Router::isEditorRequest();
      	 $section = Router::isSectionRequest();
         $sandbox = Router::isSandboxRequest();
       
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
                SANDBOX_PATH
            )));

             $r = SANDBOX_PATH.'/'.$sandbox;     
         } 
      
      
      	 else {          
            $r = 'layout/layout.php';                            
         }

      return $r;
    }
    
    public static function getRequestControllerClass()
    {      
         $ajax = Router::isAjaxRequest();
         $action = Router::isActionRequest();
      
       	 $app = Router::isAppRequest();
         $page = Router::isPageRequest();
         $tools = Router::isToolsRequest();
      	 $editor = Router::isEditorRequest();
      	 $section = Router::isSectionRequest();
         $sandbox = Router::isSandboxRequest();
         
         if($page && $ajax) 
         {
             $r = 'Components\\Ajax\\pages\\'.str_replace('/','\\',$page).'\\'.$ajax;
         } elseif($page && $action) {
             $r = 'Component\\Action\\pages\\'.str_replace('/','\\',$page).'\\'.$action;     
         } elseif($page) {
             $r = 'Component\\pages\\'.str_replace('/','\\',$page);
         }

         elseif($section && $ajax)
         {
             $r = 'Component\\Ajax\\sections\\'.str_replace('/','\\',$section).'\\'.$ajax;     
         }
         elseif($section && $action)
         {   
             $r = 'Component\\Action\\sections\\'.str_replace('/','\\',$section).'\\'.$action;     
         }
         
         elseif($tools && $ajax) {
             $r = 'Component\\Ajax\\tools\\'.str_replace('/','\\',$tools).'\\'.$ajax;     
         } elseif($tools && $action) {
             $r = 'Component\\Action\\tools\\'.str_replace('/','\\',$tools).'\\'.$action;     
         }


         elseif($editor && $ajax) {
             $r = 'Component\\Ajax\\editor\\'.$ajax;     
         } elseif($editor && $action) {
             $r = 'Component\\Action\\editor\\'.$action;     
         }
            
      
         elseif($app && $ajax) {
             $r = 'Component\\Ajax\\app\\'.$ajax;     
         } elseif($app && $action) {
             $r = 'Component\\Action\\app\\'.$action;                
         } 
      
      
         elseif($sandbox) {
            return null;
         } 
      
      
      	 else {          
            $r = 'Layout\\pfcEditor';                            
         }

      return '\\pfcEditor\\' . preg_replace_callback(
                                    '/([a-zA-Z]){1}(-){1}([a-zA-Z0-9]){1}/',
                                    function ($matches) {
                                        return $matches[1] . strtoupper($matches[3]);
                                    },
                                $r
                   );         
    }
}