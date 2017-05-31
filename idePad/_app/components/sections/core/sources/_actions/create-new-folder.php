<?php

$succ = 'no';
$msg = "";

$fs = new \PFC\Editor\Sources($_POST['root']);

$foldername = $_POST['path'].$_POST['foldername'];

if($fs->isDir($foldername))
  {
  	$msg = 'Folder already exists';
  }
else
{
    if($fs->createNewFolder($foldername))
    {
        $succ = 'yes';
        $msg = 'Folder succesfully created';
    }
    else
    {
     	$msg = 'Fail create folder';
    }
  
}

echo json_encode(array(
    'succ'=>$succ,
    'msg'=>$msg
));

