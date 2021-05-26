<?php 

echo posix_getuid()."<hr>"; //10001
echo posix_geteuid()."<hr>"; //10001

$processUser = posix_getpwuid(posix_geteuid());
print $processUser['name'];
echo '<hr>';


$username = getenv('USERNAME') ?: getenv('USER');
echo $username; // e.g. root or www-data
echo '<hr>';

echo $r2 = exec('whoami',$res2);

echo '<h2>RESULTS whoami: '.count($res2).'</h2>';
foreach($res2 as $key2=>$cmd2)
  {
    echo $key2.' => '.htmlspecialchars( json_encode($cmd2) ).'<hr>';
  }

echo '<br>';




/*
You can use the bash(1) built-in compgen

    compgen -c will list all the commands you could run.
    compgen -a will list all the aliases you could run.
    compgen -b will list all the built-ins you could run.
    compgen -k will list all the keywords you could run.
    compgen -A function will list all the functions you could run.
    compgen -A function -abck will list all the above in one go.
*/

$r = exec('compgen -abck',$res);

echo '<h2>RESULTS: '.count($res).'</h2>';
foreach($res as $key=>$cmd)
  {
    echo $key.' => '.htmlspecialchars( json_encode($cmd) ).'<hr>';
  }

echo '<br><br><br>';