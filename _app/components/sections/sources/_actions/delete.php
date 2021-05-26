<?php 

$succ = 'no';
$msg = "";

$root = $_POST['root'];
$path = $_POST['path'];


$fs = new \PFC\Editor\Sources($root);

if($fs->delete($path))
{
    $succ = 'yes';
    $msg = 'Successfully deleted';
}
else
{
    $msg = 'Fail delete folder or file';
}


echo json_encode(array(
    'succ'=>$succ,
    'msg'=>$msg,
    'fileTab'=>'#file_'.$root.'_'.str_replace('.','_',str_replace('/', '_', $path))
));

