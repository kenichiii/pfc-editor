<?php 

$succ = 'no';
$msg = "";

$root = $_POST['root'];
$path = $_POST['path'];
$action = $_POST['action'];
$newright = $_POST['newright'];

$perm = '0';


$fs = new \PFC\Editor\Sources($root);

if(!$action)
{
    $perm = $fs->security($path,0,'0');
    $succ = 'yes';
    $msg = 'Security loaded';
    
}
else
{
    if($fs->security($path,1,$newright))
    {
        $succ = 'yes';
        $msg = 'Successfully change right';
    }
    else
    {
        $msg = 'Fail change right';
    } 
}
echo json_encode(array(
    'perm'=>$perm,
    'succ'=>$succ,
    'msg'=>$msg    
));

