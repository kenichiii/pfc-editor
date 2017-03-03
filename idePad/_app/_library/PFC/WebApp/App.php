<?php

namespace PFC\WebApp;

class App {
    
    protected static $ins = null;
    
    protected $lang = 'en';
    protected $dict = null;
    
    public static function ins()
    {
        $appname = APPNAME;
        $user_config = "\\{$appname}\\Config\UserData\Settings";
        
        if(self::$ins === null) {
            self::$ins = new App($user_config::lang());
        }
        
        return self::$ins;
    }
    
    public function __construct($lang) 
    {                    
        $this->setLang($lang);                                                 
    }
    
    /*
     * LANGUAGES
     */
    public function getLanguages()
    {
        $langs = [];
        foreach(new \DirectoryIterator(APPLICATION_PATH.'/_langs') as $lang) {
            if($lang->isFile()) {
                $langs []= preg_replace('/(\.php)$/', '', $lang->getFilename());
            }
        }
        return $langs;
    }
    
    public function loadDictionary()
    {
        if(file_exists(APPLICATION_PATH.'/_langs/'.$this->getLang().'.php')) {
           $this->setDictionary(require APPLICATION_PATH.'/_langs/'.$this->getLang().'.php');
        } else {
           $this->setDictionary([]);
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
            $this->loadDictionary();
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
    
    public function translate($string, $data = []) 
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

