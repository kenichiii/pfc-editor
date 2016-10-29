<?php

namespace PFC\Editor;

class App {

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
             $r = 'Component\\Ajax\\editor\\'.$action;     
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