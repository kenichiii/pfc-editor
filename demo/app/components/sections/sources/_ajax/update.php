<?php

set_time_limit(0);

$dd = json_decode($_POST['dir']);

if($dd->root)
{
	$root = $dd->root;  
  
$fs = new \PFC\Editor\Sources($root);

$dirs = explode('/',$_SERVER['REQUEST_URI']);
$actualDir = $dirs[count($dirs)-2];
  
$dir = $dd->path;

$opendirs = $dd->openedDirs;  
  
echo $fs->printDir($dir,$opendirs);  
  
}
else echo "no root provided";
