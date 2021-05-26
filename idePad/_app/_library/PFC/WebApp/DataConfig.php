<?php

namespace PFC\WebApp;

trait DataConfig 
{
    protected static $config = null;
    
    public static function __callStatic($name, $arguments) {
        return self::getConfig($name);
    }
    
    public static function getConfig($name = null) {

        if(self::$config === null) {
            self::loadConfigFile();
        }
        
        if($name !== null) {
            if(isset(self::$config[$name])) {
                return self::$config[$name];
            } else {
                throw new \Exception("NOT EXISTING CONFIG PROPERTY {$name}");
            }
        }
        
        return self::$config;
    }
    
    public static function loadConfigFile() {
            $class = get_called_class();
            
            $pies = explode("\\", $class);
            
            $pies[0] = self::getDataPath();
            
            $file = implode("/", $pies) . '.php';            
            
            if(file_exists($file)) {
                self::$config = require $file;
            } else {
                throw new \Exception("NOT EXISTING CONFIG FILE {$file}");
            }
    }
    
    public static function getDataPath() {
        return DATA_PATH;
    }
}

