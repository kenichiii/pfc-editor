<?php 

$succ = 'no';
$msg = "";

$root = $_POST['root'];
$oldname = $_POST['oldname'];
$newname = $_POST['newname'];


$fs = new \PFC\Editor\Sources($root);


if($fs->renaming($oldname,$newname))
{
    $succ = 'yes';
    $msg = 'Successfully rename';
}
else
{
    $msg = 'Fail rename folder or file';
}


echo json_encode(array(
    'succ'=>$succ,
    'msg'=>$msg
));

