<?php

namespace idePad\Component\Ajax\sections\core\sources;

use PFC\Editor\Component\AjaxController;

class getDir extends AjaxController
{
   protected $VIEW_CLASS_NAME = "HTML";
           
   public function indexAction() 
   {       
            @set_time_limit(0);

            $root = filter_input(INPUT_POST, 'root');

            $fs = new \PFC\Editor\Sources($root);

            $dirs = explode('/',filter_input(INPUT_SERVER, 'REQUEST_URI'));
            $actualDir = $dirs[count($dirs)-2];

            $dir = $_POST['dir'];

            $output = "";

             if($fs->isDir($dir) && $fs->fileExists($dir))
             {
                 $files = $fs->scandir($dir);
                 if( count($files) > 2 ) { /* The 2 accounts for . and .. */
                            $output .= "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
                            // All dirs
                            foreach( $files as $file ) {
                                    if( $file != '.' && $file != '..' && $fs->fileExists($dir . $file) && $fs->isDir($dir . $file)
                         //&& !($root=='public' && $file==$actualDir )                                                                              
                         //add better protection this forbid all subfolders with same name               
                          ) {
                                            $output .= "<li class=\"directory collapsed\"><a href=\"#\"  lastModification=\"".$fs->getLastModificationTime($dir.$file)."\" rel=\"".base64_encode(htmlentities($dir . $file))."/\">" . htmlentities($file) . "</a></li>";
                                    }
                            }
                            // All files
                            foreach( $files as $file ) {
                                                            if( $file != '.' && $file != '..' && $fs->fileExists($dir . $file) && !$fs->isDir($dir . $file) ) {
                                            $ext = preg_replace('/^.*\./', '', $file);
                                            $output .= "<li class=\"file ext_$ext\"><a extension=\"{$ext}\" lastModification=\"".$fs->getLastModificationTime($dir.$file)."\" href=\"#\" rel=\"".base64_encode(htmlentities($dir . $file))."\">" . htmlentities($file) . "</a></li>";
                                    }
                            }
                            $output .= "</ul>";	
                    }
             }
 
        $this->getResponse()->setData($output);     
    }
}
 