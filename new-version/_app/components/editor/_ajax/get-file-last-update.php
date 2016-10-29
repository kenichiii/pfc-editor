<?php 

$root = $_POST['root'];
$path = $_POST['path'];
$last = $_POST['lu'];

$fs = new \PFC\Editor\Sources($root);

if($fs->fileExists($path))
  {
     echo json_encode(array(
     	'uptodate'=> $fs->getLastModificationTime($path)>$last
          ? 'no' : 'yes',
         "actualTime" => $fs->getLastModificationTime($path)
     ));
     
  }
else
  {
     echo json_encode(array(
     	'uptodate'=>'not-exists'
     ));
  }