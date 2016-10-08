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
  
}