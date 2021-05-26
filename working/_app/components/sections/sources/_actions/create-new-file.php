<?php

$succ = 'no';
$msg = "";

$fs = new \PFC\Editor\Sources($_POST['root']);

$filename = $_POST['path'].$_POST['filename'];

if($fs->fileExists($filename))
  {
  	$err = 'File already exists';
  }
else
  {
  	$exts = explode('.',$filename);
  	$ext = end($exts);
  	
  	if($ext=='php') {
      $contents = "<?php \n";
    }
  	else {
      $contents = "";
    }
  
  
  	if($fs->createNewFile($filename,$contents))
      {
      	$succ = 'yes';
        $msg = 'File succesfully created';
      }
    else
      {
      	$msg = 'Fail create new file';
      }
  
  }

echo json_encode(array(
    'succ'=>$succ,
    'msg'=>$msg
));

