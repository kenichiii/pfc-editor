<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace PFC\Editor;

class Sources extends \PFC\FileSystem\FileSystem {
    
    protected $rootName;
  
    public function __construct($name) {
      if(isset(\PFC\Editor\Config\Sources::$paths[$name]))
        {
          $this->setRootPath(\PFC\Editor\Config\Sources::$paths[$name]['root']);        
          $this->rootName = $name;
        }      	
      else {
        throw new \Exception($name.' is not supported root path');
      }   
    }
    
public function printDir($dir,$opendirs) {

	$dirs = explode('/',$_SERVER['REQUEST_URI']);
	$actualDir = $dirs[count($dirs)-2];  
  
 $html = ""; 
  
  foreach( $opendirs as $key=>$o )
  	$opendirs[$key]->path = str_replace('/','-',$o->path);
  
 if($this->fileExists($dir) && $this->isDir($dir))
 {
     $files = $this->scandir($dir);
     if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		$html .= "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		// All dirs
		foreach( $files as $file ) {
			if( $file != '.' && $file != '..' && $this->fileExists($dir . $file) && $this->isDir($dir . $file)
             && !($this->rootName=='public' && $file==$actualDir )	                                                                                        
             //add better protection this forbid all subfolders with same name
              ) {
              
              $finded = false;
              
			  foreach( $opendirs as $key=>$o )   
              {
                
              	if(str_replace('/','-',$dir.$file).'-'===$o->path)
                {
                	$html .= "<li class=\"directory expanded\"><a href=\"#\"  lastModification=\"".$this->getLastModificationTime($dir.$file)."\" rel=\"".htmlentities($dir . $file)."/\">" . htmlentities($file) . "</a>";
               		$html .= $this->printDir($dir . $file.'/',$opendirs);     
                
                    $html .= "</li>";
                    $finded = true;
                }
              }
                
               if(!$finded) 
				$html .= "<li class=\"directory collapsed\"><a href=\"#\"  lastModification=\"".$this->getLastModificationTime($dir.$file)."\" rel=\"".htmlentities($dir . $file)."/\">" . htmlentities($file) . "</a></li>";
			}
		}
		// All files
		foreach( $files as $file ) {
						if( $file != '.' && $file != '..' && $this->fileExists($dir . $file) && !$this->isDir($dir . $file) ) {
				$ext = preg_replace('/^.*\./', '', $file);
				$html .= "<li class=\"file ext_$ext\"><a extension=\"{$ext}\" lastModification=\"".$this->getLastModificationTime($dir.$file)."\" href=\"#\" rel=\"".htmlentities($dir . $file)."\">" . htmlentities($file) . "</a></li>";
			}
		}
		$html .= "</ul>";	
	}
 }

  return $html;
}

}