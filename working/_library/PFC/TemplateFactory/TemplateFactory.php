<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace PFC\TemplateFactory;

    //use const PFC\WebApp\APPLICATION_PATH;
    //use const PFC\WebApp\LIBRARY_PATH;

class TemplateFactory
{        

    public static function getTemplateFile($file)
    {
        //if(file_exists(\PFC\Editor\APPLICATION_PATH.'/'.self::getTemplateDir().$file) )
                return \PFC\Editor\APPLICATION_PATH.'/'.self::getTemplateDir().$file;
        
    }
        
    public static function getTemplateDir()
    {
        return 'template-factory/';
    }
    
    public static function translatePHP($template)
    {
        $template = str_replace('[[:', '<?php',$template);
        $template = str_replace(':]]', '?>',$template);
        //$template = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $template);
        
        //$template = preg_replace("/\s+/", "", $template);
        
        $template = str_replace('</textarea>', '[[:/textarea:]]',$template);        
        
        return $template;
    }

    public static function encodePHP($template)
    {
        $template = str_replace('<?php', '[[:',$template);
        $template = str_replace('?>', ':]]',$template);
        //$template = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $template);
        
        //$template = preg_replace("/\s+/", "", $template);
        
        $template = str_replace('[[:/textarea:]]', '</textarea>',$template);        
        
        return $template;
    }    
    
    public static function decodeTemplate($content)
    {
        return str_replace('[[:/textarea:]]', '</textarea>', $content);        
    }
    
    
    public static function loadHtmlTemplateWithPhpQuery($file)
    {
            $html = file_get_contents($file);
            $html = self::encodePHP($html);      

            $html = preg_replace('/(\&)(\w+)(\;)/i', '[:[${2}]:]', $html);
            $html = preg_replace('/(\&)(\#)(\d+)(\;)/i', '[:[${2}${3}]:]', $html);

            //because of html5
            libxml_use_internal_errors(true);
            $doc = \phpQuery::newDocumentHTML($html);  
            libxml_use_internal_errors(false);
            
            return $doc;
    }
    
    public static function saveHtmlTemplateFromPhpQuery($phpQueryDocument,$file=null)
    {
          $test = (string)  $doc;  
  
            $test = self::translatePHP($test);
            $test = urldecode(  html_entity_decode($test) );
            $test = str_replace(']:]', ';', $test);
            $test = str_replace('[:[', '&', $test);

          if($file!=null)  
            file_put_contents($file, $test);
          
         return $test;
    }
    
    
}
