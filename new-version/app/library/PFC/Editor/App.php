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
         $page = \filter_input(\INPUT_GET, 'page');
         $tools = \filter_input(\INPUT_GET, 'tools');
      	 $editor = \filter_input(\INPUT_GET, 'editor');
      	 $section = \filter_input(\INPUT_GET, 'section');
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