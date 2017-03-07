<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace PFC\Editor;

class AppFile
{
    public static $served;
    
    public static function serve($ext,$file,$name,$thumb=false)
    {                
        self::$served = self::loadfile($file);
        
        if ($thumb !== false) {
            self::serveThumb ($ext, $file, $name,$thumb);
        }
        elseif ($ext === 'png'||$ext=='gif'||$ext=='jpg'||$ext=='jpeg') {
            self::serveImage($ext,$file,$name);
        }
        elseif ($ext === 'pdf') {
            self::servePDF($ext,$file,$name);
        }
        elseif ($ext === 'xls') {
            self::serveXLS($ext,$file,$name);
        }
        elseif ($ext === 'doc' || $ext === 'docx') {
            self::serveDOC($ext,$file,$name);
        }
        else {
            echo "neplatna pripona {$ext}";
        }
    }
    
    public static function loadfile($file)
    {
        return file_get_contents(PUBLIC_PATH.$file);
    }
    
    public static function getext($filename)
    {
        $pies = explode('.',$filename);
        return strtolower(end($pies));
    }
    
    public static function sendCssHeaders()
    {
         header("Content-Type: text/css"); 
         header("X-Content-Type-Options: nosniff"); //for IE
    }

    public static function sendJavascriptHeaders()
    {
        header('Content-Type: application/javascript');
    }    
    
    public static function sendJpgHeaders()
    {
         header("Content-Type: image/jpg");  
    }
   
	public static function sendRedirectHeaders($newLocation)
  	{
         header("Location: ".$newLocation);
    }
  
  	public static function send301RedirectHeaders($newLocation)
  	{
         header("HTTP/1.1 301 Moved Permanently"); //we have lang here in message
         self::sendRedirectHeaders($newLocation);
    }
  
    public static function send404NotFoundHeaders()
    {
         header("HTTP/1.1 404 Not Found");
    }
  
    public static function servePDF($ext,$file,$name)
    {
        header('Cache-Control: public'); 
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename="'.$name.'"');
		header('Content-Length: '.filesize(PUBLIC_PATH.$file));
		readfile(PUBLIC_PATH.$file);
    }  
  
    public static function serveImage($ext,$file,$name)
    {
        switch( $ext ) {
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "jpeg":
            case "jpg": $ctype="image/jpg"; break;
            default:
        }
        
        header('Content-Disposition: inline; filename="'.$name.'"');
        header('Content-type: ' . $ctype);
        readfile(PUBLIC_PATH.$file);
    }
            
   public static function serveXLS($ext,$file,$name)
   {
       header("Content-type: application/vnd.ms-excel");
       header("Content-Disposition: attachment;Filename={$name}");
       readfile(PUBLIC_PATH.$file);
   }
            
   public static function serveDOC($ext,$file,$name)
   {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename={$name}");
        
        readfile(PUBLIC_PATH.$file);
   }
   
   public static function serveThumb($ext,$file,$name,$params)
   {
       $filename = $file.$ext;       
       if( copy(PUBLIC_PATH.$file,PUBLIC_PATH.$filename) )
       {
        
            $ctype="image/jpg"; 
            header('Content-Disposition: inline; filename="'.$name.'"');
            header('Content-type: ' . $ctype);
        
           MagickFactory::generateThumb(PUBLIC_PATH.$filename, $params['width'], $params['height'], 1,0,true);
           unlink(PUBLIC_PATH.$filename);
       }
       
       
   }
}