<?php 

namespace PFC\Editor\Config;

class Sources
{    
    protected static $paths = [

          'public'=>array(
              'section'=>'sources',              
              'title'=>'Workspace',
              'name'=>'public',
              'root'=>\PFC\Editor\PUBLIC_PATH,
              'path'=>'../../../'
          ),
               
          'sandbox-src'=>array(
              'section'=>'sandbox',
              'title'=>'Sandbox',
              'name'=>'sandbox-src',
              'root'=>\PFC\Editor\SANDBOX_PATH,
              'path'=>'./'
          ),          

        

          'pfc-public'=>array(
              'section'=>'editor',
              'title'=>'Public',
              'name'=>'pfc-public',
              'root'=>\PFC\Editor\PUBLIC_PATH,
              'path'=>'./'
          ),
          'pfc-app'=>array(
               'section'=>'editor',
                'title'=>'app',
                'name'=>'pfc-app',
                'root'=>\PFC\Editor\APPLICATION_PATH,
                'path'=>'./'              
          ),
          'pfc-lib'=>array(
                'section'=>'editor',
                'title'=>'lib',
                'name'=>'pfc-lib',
                'root'=>\PFC\Editor\LIBRARY_PATH,
                'path'=>'./'              
          ),
          'pfc-data'=>array(
                'section'=>'editor',
                'title'=>'data',
                'name'=>'pfc-data',
                'root'=>\PFC\Editor\DATA_PATH,
                'path'=>'./'              
          ),
          'pfc-cfg'=>array(
                'section'=>'editor',
                'title'=>'cfg',
                'name'=>'pfc-cfg',
                'root'=>\PFC\Editor\APPLICATION_PATH,
                'path'=>'./config/'              
          ),                                
    ];
 
    public static function getPaths()
    {
        return self::$paths;
    }
    
    public static function getBySections() 
    {
        $sections = [];
        foreach(self::getPaths() as $path) {            
            if(!isset($sections [$path['section']])) {
                $sections [$path['section']]= [];
            }
            
            $sections [$path['section']] [$path['name']]= $path;                            
        }
        
      return $sections;  
    }
    
    public static function getSections() 
    {
        $sections = [];
        foreach(self::getPaths() as $path) {
            if(!in_array($path['section'], $sections)) {
                $sections []= $path['section'];
            }
        }
        
      return $sections;  
    }
    
    public static function addPath($key, array $data) {        
        self::$paths [$key]= $data;        
    }    
}

