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
}