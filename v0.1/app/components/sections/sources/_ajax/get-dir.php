<?php

@set_time_limit(0);

$root = $_POST['root'];

$fs = new \PFC\Editor\Sources($root);

$dirs = explode('/',$_SERVER['REQUEST_URI']);
$actualDir = $dirs[count($dirs)-2];
  
$dir = $_POST['dir'];


 if($fs->isDir($dir) && $fs->fileExists($dir))
 {
     $files = $fs->scandir($dir);
     if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		// All dirs
		foreach( $files as $file ) {
			if( $file != '.' && $file != '..' && $fs->fileExists($dir . $file) && $fs->isDir($dir . $file)
             //&& !($root=='public' && $file==$actualDir )                                                                              
             //add better protection this forbid all subfolders with same name               
              ) {
				echo "<li class=\"directory collapsed\"><a href=\"#\"  lastModification=\"".$fs->getLastModificationTime($dir.$file)."\" rel=\"".base64_encode(htmlentities($dir . $file))."/\">" . htmlentities($file) . "</a></li>";
			}
		}
		// All files
		foreach( $files as $file ) {
						if( $file != '.' && $file != '..' && $fs->fileExists($dir . $file) && !$fs->isDir($dir . $file) ) {
				$ext = preg_replace('/^.*\./', '', $file);
				echo "<li class=\"file ext_$ext\"><a extension=\"{$ext}\" lastModification=\"".$fs->getLastModificationTime($dir.$file)."\" href=\"#\" rel=\"".base64_encode(htmlentities($dir . $file))."\">" . htmlentities($file) . "</a></li>";
			}
		}
		echo "</ul>";	
	}
 }
 