<?php

@set_time_limit(0);

$root = $_GET['root'];
$path = $_GET['path'];

$fs = new \PFC\Editor\Sources($root);

if($fs->fileExists($path) && !$fs->isDir($path))
{
  $fs->readFile($path);
}
elseif($fs->fileExists($path))
{
   //pack to zip
  //serve
}
else
{
  echo "NOT EXISTiNG FLESYSTEM PATH {$root} {$path}";  
}
 

