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

    public static function pagelinkpjs($page, $file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?page={$page}&pjs={$file}{$plugin_href}";
    }  

    public static function pagelinkpcss($page, $file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?page={$page}&pcss={$file}{$plugin_href}";
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
        return "?section={$page}&ajax={$file}{$plugin_href}";
    }

    public static function sectionlinkpjs($page, $file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?section={$page}&pjs={$file}{$plugin_href}";
    }
    
    public static function sectionlinkpcss($page, $file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?section={$page}&pcss={$file}{$plugin_href}";
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
    
    public static function editorlinkpjs($file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?editor=true&pjs={$file}{$plugin_href}";
    }

    public static function editorlinkpcss($file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?editor=true&pcss={$file}{$plugin_href}";
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

    public static function applinkpjs($file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?_app=true&pjs={$file}{$plugin_href}";
    }

    public static function applinkpcss($file, $plugin = null)
    {
        $plugin_href = $plugin ? '&plugin='.$plugin : '';
        return "?_app=true&pcss={$file}{$plugin_href}";
    }
    
    public static function isAjaxRequest()
    {
        return filter_input(INPUT_GET, 'ajax');
    }
    
    public static function isActionRequest()
    {
        return filter_input(INPUT_GET, 'action');
    }

    public static function isPjsRequest()
    {
        return filter_input(INPUT_GET, 'pjs');
    }

    public static function isPcssRequest()
    {
        return filter_input(INPUT_GET, 'pcss');
    }    
    
    public static function isAppRequest()
    {
        return filter_input(INPUT_GET, '_app');
    }

    public static function isPageRequest()
    {
        return filter_input(INPUT_GET, 'page');
    }
    
    public static function isToolsRequest()
    {
        return filter_input(INPUT_GET, 'tools');
    }
    
    public static function isEditorRequest()
    {
        return filter_input(INPUT_GET, 'editor');
    }
    
    public static function isSectionRequest()
    {
        return filter_input(INPUT_GET, 'section');
    }
    
    public static function isSandboxRequest()
    {
        return filter_input(INPUT_GET, 'sandbox');
    }  
    
    public static function isLoginActionRequest()
    {
        return Router::isAppRequest() && Router::isActionRequest() === 'login';
    }  
    
    public static function isServerTimeRequest()
    {
        return Router::isAppRequest() && Router::isAjaxRequest() === 'server-time';
    }

    public static function getSandboxRequestFilePath()
    {      
         $sandbox = Router::isSandboxRequest();
         
            set_include_path(implode(PATH_SEPARATOR, [
                get_include_path(), 
                SANDBOX_PATH
            ]));

            $r = SANDBOX_PATH.'/'.$sandbox.".php";              
            
        return $r;
    }
    
    public static function getRequestControllerClass()
    {      
         $ajax = Router::isAjaxRequest();
         $action = Router::isActionRequest();
         $pjs = Router::isPjsRequest();
         $pcss = Router::isPcssRequest();
         
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
         } elseif($page && $pjs) {
             $r = 'Component\\Pjs\\pages\\'.str_replace('/','\\',$page).'\\'.$pjs;     
         } elseif($page && $pcss) {
             $r = 'Component\\Pcss\\pages\\'.str_replace('/','\\',$page).'\\'.$pcss;                  
         } elseif($page) {
             $r = 'Component\\pages\\'.str_replace('/','\\',$page);
         }

         elseif($section && $ajax) {
             $r = 'Component\\Ajax\\sections\\'.str_replace('/','\\',$section).'\\'.$ajax;     
         } elseif($section && $action) {   
             $r = 'Component\\Action\\sections\\'.str_replace('/','\\',$section).'\\'.$action;     
         } elseif($section && $pjs) {   
             $r = 'Component\\Pjs\\sections\\'.str_replace('/','\\',$section).'\\'.$pjs;     
         } elseif($section && $pcss) {   
             $r = 'Component\\Pcss\\sections\\'.str_replace('/','\\',$section).'\\'.$pcss;     
         }
         
         elseif($tools && $ajax) {
             $r = 'Component\\Ajax\\tools\\'.str_replace('/','\\',$tools).'\\'.$ajax;     
         } elseif($tools && $action) {
             $r = 'Component\\Action\\tools\\'.str_replace('/','\\',$tools).'\\'.$action;     
         } elseif($tools && $pjs) {
             $r = 'Component\\Pjs\\tools\\'.str_replace('/','\\',$tools).'\\'.$pjs;     
         } elseif($tools && $pcss) {
             $r = 'Component\\Pcss\\tools\\'.str_replace('/','\\',$tools).'\\'.$pcss;     
         }



         elseif($editor && $ajax) {
             $r = 'Component\\Ajax\\editor\\'.$ajax;     
         } elseif($editor && $action) {
             $r = 'Component\\Action\\editor\\'.$action;     
         } elseif($editor && $pjs) {
             $r = 'Component\\Pjs\\editor\\'.$pjs;     
         } elseif($editor && $pcss) {
             $r = 'Component\\Pcss\\editor\\'.$pcss;     
         }
            
      
         elseif($app && $ajax) {
             $r = 'Component\\Ajax\\app\\'.$ajax;     
         } elseif($app && $action) {
             $r = 'Component\\Action\\app\\'.$action;                
         } elseif($app && $pjs) {
             $r = 'Component\\Pjs\\app\\'.$pjs;                
         } elseif($app && $pcss) {
             $r = 'Component\\Pcss\\app\\'.$pcss;                
         } 
      
      
         //elseif($sandbox) {
           // return null;
         //} 
      
      
      	 else {          
            $r = 'Layout\\main';                            
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
