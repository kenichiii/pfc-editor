<?php 

//make tool as phpinfo

/*
If your $_ENV array is mysteriously empty, but you still see the variables when calling getenv() or in your phpinfo(), check your http://us.php.net/manual/en/ini.core.php#ini.variables-order ini setting to ensure it includes "E" in the string.
*/

$h = getenv('HOSTNAME');
$c = getenv("COMPUTERNAME");
if ($h)
    $MachineName = $h;
else if  ($c)
    $MachineName = $c;
else $MachineName = ""; 
  
  echo $MachineName ? $MachineName : "Unknown";
  
foreach($_ENV as $key=>$value)
{
  echo $key .' => '.$value.'<hr>';  
}
