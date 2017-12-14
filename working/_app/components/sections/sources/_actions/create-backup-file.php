<?php

$suff = 'bck';
$succ = 'no';
$msg = "";

$fs = new \PFC\Editor\Sources($_POST['root']);

$filepath = $_POST['filepath'];


$datenowbck = '.' . date('Y-m-d--H-i-s') . '.' . $suff;

if(strchr(substr($filepath, 1, strlen($filepath)), '.'))
{
    $exts = explode('.',$filepath);
    $ext = '.' . end($exts);
    $origsuff = prev($exts);
    $filepathbck = $filepath . $datenowbck . $ext;
}
else
{
    $origsuff = '';
    $filepathbck = $filepath . $datenowbck;
}



if($fs->fileExists($filepathbck))
  {
  	$msg = 'Backup file already exists';
  }
else
  {
        if(($origsuff == $suff) || (substr($filepath, strlen($filepath) - 3, strlen($filepath)) == $suff)) 
        {
            $msg = 'Backup can not be used for backup file';
        }
  	else
        {
           if($fs->createBackupFile($filepath, $filepathbck))
           { 
               $succ = 'yes';
               $msg = 'Backup file succesfully created';
           }
           else
           {
               $msg = 'Backup file is not created';
           }
        }  
  }

echo json_encode(array(
    'succ'=>$succ,
    'msg'=>$msg
));

