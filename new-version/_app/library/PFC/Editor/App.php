<?php

namespace PFC\Editor;

class App {
    
    protected static $ins = null;
    
    protected $lang = 'en';
    protected $dict = [];
    
    public static function ins()
    {
        if(self::$ins === null) {
            self::$ins = new App(Config::lang);
        }
        
        return self::$ins;
    }
    
    public function __construct($lang) 
    {
        if($lang !== null && file_exists(APPLICATION_PATH.'/_langs/'.$lang.'.php')) {
           $this->setLang($lang);
           //write config file
        }
    }
    
    public function setLang($lang) 
    {
        $this->lang = $lang;
        return $this;
    }
    
    public function getLang() 
    {
        return $this->lang;
    }
    
    public function getDictionary()
    {
        if($this->dict === null) { 
            if(file_exists(APPLICATION_PATH.'/_langs/'.$lang.'.php')) {
                $this->setDictionary(require APPLICATION_PATH.'/_langs/'.$lang.'.php');
            } else {
                $this->dict = [];
            }
        }
        
        return $this->dict;
    }
    
    public function addToDictionary(array $translations)
    {
        $this->dict = array_merge($this->dict, $translations);
        return $this;
    }
    
    public function setDictionary(array $dict)
    {
        $this->dict = $dict;
        return $this;
    }
    
    public static function translate($string, array $data = []) 
    {
        if(isset($this->getDictionary()[$string])) {
            $string = $this->getDictionary()[$string];
        }
        
        foreach($data as $key => $value) {
            $string = str_replace('[[:'.$key.':]]', $value, $string);
        }
        
        return $string;
    }
}

