<?php 

namespace freePad\Config;

use PFC\WebApp\DataConfig;

class SourcesConfig 
{      
    use DataConfig;
    
    public static function getPaths()
    {
        return self::getConfig();
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
    
    public static function addPath(array $data) {    
        self::getConfig();
        self::$config [$data['name']]= $data;        
    }    
}

